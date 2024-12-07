<div>

    <div class="form-group row">
        <label for="inputName" class="col-2 col-form-label">
            {{ isset($input['label']) ? $input['label'] : formatter($input['name']) }}
            <span class="text text-danger">
                {{ isset($input['required']) && $input['required'] == true ? '*' : '' }}
            </span>
        </label>

        <div class="col-10">
            <div class="">
                <input type="file" class="{{ $input['name'] }} form-control" accept="image/*"
                    {{ isset($input['required']) && $input['required'] == 'true' ? 'required' : '' }}>
                <div>
                    @php
                        $filePath = isset($input['value'])
                            ? $input['value']->value('path') . '/' . $input['value']->value('title')
                            : null;
                    @endphp

                    <img src="{{ asset($filePath) }}" alt=""
                        class="cropped{{ $input['name'] }} {{ isset($filePath) ? '' : 'd-none' }} img-thumbnail mt-2"
                        width="200px">
                    <input type="hidden" name="cropped_{{ $input['name'] }}">
                    <input type="hidden" name="folder" value="{{ $input['folder'] }}">
                </div>
            </div>
        </div>

        <div class="modal fade" id="{{ $input['name'] }}Modal" tabindex="-1" role="dialog"
            aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Crop Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img id="{{ $input['name'] }}"
                                        src="https://avatars0.githubusercontent.com/u/3456749"
                                        style="   display: block;max-width: 100%;">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview{{ $input['name'] }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm"
                            id="crop{{ $input['name'] }}">Crop</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

<script>
    $("input[type='file']").each(function() {
        var input = $(this);
        var imageName = input.attr('class').split(' ')[0];
        var $modal = $(`#${imageName}Modal`);
        var image = document.getElementById(imageName);
        var imageCropper;

        input.on("change", function(e) {
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
            imageCropper = new Cropper(image, {
                aspectRatio: 0,
                viewMode: 3,
                preview: `.preview${imageName}`
            });
        }).on('hidden.bs.modal', function() {
            imageCropper.destroy();
            imageCropper = null;
        });

        $(`#crop${imageName}`).click(function() {
            canvas = imageCropper.getCroppedCanvas();

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $modal.modal('hide');

                    $(`.cropped${imageName}`).removeClass('d-none').attr('src', base64data);
                    $(`input[name="cropped_${imageName}"]`).val(
                        base64data); // Set base64 data to the input field
                }
            }, 'image/jpeg', 0.5);
        });
    });
</script>
