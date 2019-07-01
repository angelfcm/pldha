<div class="form-group{{ $errors->has($field) ? ' has-error has-danger has-feedback' : '' }}">
    <label for="{{ $id }}">{{ $title }}</label>
    <div class="custom-dropzone dropzone dz-clickable p-3 text-center d-flex justify-content-center align-items-center" id="{{ $id }}" data-url="{{ $url }}">
        <input type="hidden" name="{{ $inputName }}" value="{{ $value }}">
        <div class="dz-default dz-message">
            <button type="button" class="btn btn-info btn-sm">{{ __('Elige una imagen') }}</button>
            @if ($errors->has($field))
                <div class="text-left mt-2">@include('utils.fragments.input-errors', ['field' => $field])</div>
            @endif
        </div>
        <div class="preview-template">
            <div class="dz-preview dz-file-preview position-relative w-100 mh-100">
                <div class="dz-success-mark"><i class="fa fa-check-circle text-success"></i></div>
                <div class="dz-error-mark"><i class="fa fa-exclamation-circle text-danger"></i></div>
                <div class="dz-details position-relative mh-100 d-flex align-items-center justify-content-center  mb-2">
                    <img data-dz-thumbnail />
                    <div class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                        <div class="dz-filename badge badge-dark"><span data-dz-name></span></div>
                        <div class="dz-size badge badge-light" data-dz-size></div>
                        <div class="dz-progress progress w-50 text-success">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="dz-error-message text-left mb-2">
                    <span data-dz-errormessage>
                    </span>
                </div>
                <button type="button" data-dz-remove class="dz-remove-btn btn btn-danger btn-sm position-relative"><i class="fa fa-trash text-white"></i> {{ __('Quitar') }}</button>
            </div>
        </div>
    </div>
</div>