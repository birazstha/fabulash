@extends('system.layouts.form')

@section('form')
    <div class="form-group row" id="document-1">
        <label for="inputName" class="col-2 col-form-label">
            Photo
            <span class="text text-danger">*</span>
        </label>

        <div class="col-10">
            <input type="file" class="form-control image" style="width:100%" onchange="previewFile()"
                accept="image/jpeg,image/jpg,image/png">

            <div class="previewImage">
                <img src="{{ asset($item->path . '/' . $item->name) }}" alt=""
                    class="croppedImage img-thumbnail mt-3" width="200px">
                <input type="hidden" name="cropped_image">
            </div>

        </div>

        {{-- Modal Starts --}}
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop Document</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img id="image" src="{{ asset($item->path . '/' . $item->name) }}">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview-cropped-image"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-sm" id="rotateLeft">Rotate Left</button>
                        <button type="button" class="btn btn-info btn-sm" id="rotateRight">Rotate Right</button>
                        <button type="button" class="btn btn-primary btn-sm" id="crop">Crop</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        {{-- Modal Ends --}}
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script>
        var image = document.getElementById('image');
        var cropper;

        $(document).on('click', '.img-thumbnail', function() {
            $('#modal').modal('show');

            var reader;
            var file;

            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });


        $(document).on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $('#modal').modal('show');
            };

            var reader;
            var file;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        $('#modal').on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                preview: '.preview-cropped-image'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            var canvas = cropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {
                var url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#modal').modal('hide');
                    $('.croppedImage').removeClass('d-none').attr('src', base64data);
                    $('input[name="cropped_image"]').val(base64data);
                }
            }, 'image/jpeg', 0.5);
        });

        // Add rotation functionality
        $("#rotateLeft").click(function() {
            cropper.rotate(-90);
        });

        $("#rotateRight").click(function() {
            cropper.rotate(90);
        });
    </script>
@endsection
