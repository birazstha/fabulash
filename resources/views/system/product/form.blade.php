@extends('system.layouts.form')

@section('form')
    @if (!isset(request()->product_id))
        {{-- Category --}}
        <x-system.select :input="[
            'name' => 'category_id',
            'options' => $categories ?? [],
            'value' => $item->subCategory->parent->id ?? old('category_id'),
            'autofocus' => true,
        ]" />

        {{-- Sub Category --}}
        <x-system.select :input="[
            'name' => 'sub_category_id',
            'options' => [],
            'value' => $item->sub_category_id ?? (old('sub_category_id') ?? request()->moduleId),
        ]" />

        <input type="hidden" id="old_sub_category_id" value="{{ isset($item) ? $item->sub_category_id : '' }}">
        <input type="hidden" id="old_category_id" value="{{ isset($item) ? $item->subCategory->parent->id : '' }}">

        {{-- Title --}}
        <x-system.input :input="[
            'name' => 'title',
            'value' => $item->title ?? old('title'),
        ]" />

        {{-- Short Description --}}
        <x-system.input :input="[
            'name' => 'short_description',
            'value' => $item->short_description ?? old('short_description'),
        ]" />

        {{-- Description --}}
        <x-system.textarea :input="[
            'name' => 'description',
            'value' => $item->description ?? old('description'),
        ]" />

        {{-- Price --}}
        <x-system.input :input="[
            'name' => 'price',
            'type' => 'number',
            'value' => $item->price ?? old('price'),
        ]" />

        {{-- Price --}}
        <x-system.input :input="[
            'name' => 'rank',
            'type' => 'number',
            'value' => $item->rank ?? old('rank'),
        ]" />


        {{-- Status --}}
        <x-system.radio :input="[
            'name' => 'status',
            'options' => $status,
            'value' => $item->status ?? true,
        ]" />
    @endif

    <input type="hidden" value="{{ request()->product_id ?? null }}" name="productId">

    @if (!isset($item))
        <div class="toggle-file">
            <div class="form-group row" id="document-1">
                <label for="inputName" class="col-sm-2 col-form-label">
                    Photo 1
                    <span class="text text-danger">*</span>
                </label>

                <div class="col-sm-10">
                    <div class="d-flex document">
                        <input type="file" class="form-control image" style="width:100%"
                            accept="image/jpg,image/jpeg,image/png" data-id="1">
                        <i class="fas fa-times removeDocument d-none text text-danger" data-buttonId="1"></i>
                    </div>
                    <div class="previewImage">
                        <img src="" alt="" class="img-thumbnail d-none mt-3" width="200px"
                            data-croppedImageId="1">
                        <input type="hidden" name="photo[0]" id="cropped_image_1">
                    </div>
                </div>
            </div>

            <div class="dynamic-input"></div>

            <div class="form-group row toggle-add-button">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btnAdd"><i
                            class="fas fa-plus"></i>&nbspAdd</button>
                </div>
            </div>

            {{-- Modal Starts --}}
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Crop Document</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview-cropped-image"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning btn-sm" id="rotate-left">Rotate Left</button>
                            <button type="button" class="btn btn-info btn-sm" id="rotate-right">Rotate Right</button>
                            <button type="button" class="btn btn-primary btn-sm" id="crop">Crop</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Ends --}}
        </div>
    @endif
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
                        <input type="hidden" name="photo[${count}]" id="cropped_image_${count+1}" >
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

    <script src="{{ asset('compiledCssAndJs/js/categories.js') }}"></script>
@endsection
