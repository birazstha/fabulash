@extends('system.layouts.form')

@section('form')
    {{-- Title --}}
    <x-system.input :input="[
        'name' => 'title',
        'required' => true,
        'value' => $item->title ?? old('title'),
        'autofocus' => true,
    ]" />

    {{-- Rank --}}
    <x-system.input :input="[
        'name' => 'rank',
        'type' => 'number',
        'required' => true,
        'value' => $item->rank ?? old('rank'),
    ]" />

    {{-- Status --}}
    <x-system.radio :input="[
        'name' => 'status',
        'options' => $status,
        'value' => $item->status ?? true,
    ]" />

    {{-- Image --}}
    <x-system.image :input="[
        'name' => 'photo',
        'required' => isset($item) ? false : true,
        'value' => $item->files ?? null,
        'folder' => $indexUrl,
    ]" />
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let count = 0;
            let maxFileCount = null;
            var fileId = null;

            function setCurrentId($id) {
                fileId = $id;
            }

            //Removing Document
            $(document).on('click', '.removeDocument', function() {
                let buttonId = $(this).data('buttonid');
                $(`#document-${buttonId}`).remove();
                let countDocuments = $('.removeDocument').length;

                if (countDocuments === 1) {
                    $('.removeDocument').addClass('d-none');
                }
            })

            function test(maxCount) {
                if ($('.removeDocument').length == maxCount) {
                    $('.toggle-add-button').addClass('d-none');
                } else {
                    $('.toggle-add-button').removeClass('d-none');
                }

            }

            $('#btnAdd').click(function() {
                count++;

                if ($('.removeDocument').length == maxFileCount - 1) {
                    $('.toggle-add-button').addClass('d-none');
                } else {
                    $('.toggle-add-button').removeClass('d-none');
                }

                $('.removeDocument').removeClass('d-none');

                var template = ` 
        <div class="form-group row" id="document-${count+1}">
            <label for="inputName" class="col-sm-2 col-form-label">
                Photo ${count+1}
                <span class="text text-danger">*</span>
            </label>

            <div class="col-sm-10">
                <div class="d-flex document">
                    <input type="file" class="form-control image" id="document-${count+1}" style="width:100%" accept="image/jpg,image/jpeg,image/png" data-id="${count+1}">
                    <i class="fas fa-times removeDocument text text-danger" data-buttonid="${count+1}"></i>
                </div>
                <div class="previewImage">
                    <img src="" alt="" class="img-thumbnail d-none mt-3" width="200px"
                    data-croppedImageId="${count+1}" required>
                    <input type="hidden" name="photos[${count}]" id="cropped_image_${count+1}" >
                </div>
            </div>
        </div>`;

                $('.dynamic-input').append(template);
            });

            $(document).on('keyup', '#pid', function() {
                let inputValue = $(this).val();

                if (inputValue.length > 8) {
                    inputValue = inputValue.slice(0, 8);
                }

                inputValue = inputValue.toUpperCase();

                $(this).val(inputValue);
            });


            // Cropping
            var $modal = $('#modal');
            var image = document.getElementById('image');
            var cropper;

            $(document).on("change", ".image", function(e) {
                var currentFileId = $(this).attr('data-id');
                setCurrentId(currentFileId);
                var files = e.target.files;
                var done = function(url) {
                    image.src = url;
                    $modal.modal('show');
                };

                var reader;
                var file;
                var url;

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

            $modal.on('shown.bs.modal', function() {
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
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function() {
                        var base64data = reader.result;
                        $modal.modal('hide');
                        $(`[data-croppedImageId="${fileId}"]`).removeClass('d-none')
                            .attr(
                                'src',
                                base64data);
                        $(`#cropped_image_${fileId}`).val(
                            base64data);
                        setCurrentId(null);
                    }
                }, 'image/png', 0.5);
            });

            // Rotate Left
            $("#rotate-left").click(function() {
                cropper.rotate(-90);
            });

            // Rotate Right
            $("#rotate-right").click(function() {
                cropper.rotate(90);
            });
        });
    </script>
@endsection
