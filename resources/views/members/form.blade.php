@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ __('PLDHA - Credencial') }}</h1>
        <p>
            {{ __('Validación de credencial segura, todos los datos solicitados son obligatorios; esto nos permite mantener la credencialización más segura.') }}
        </p>
        <p class="text-danger">
            {{ __('*Obligatorio') }}
        </p>
        <form novalidate action="{{ $member->exists ? route('members.update', ['member' => $member->id]) : route('members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($member->exists)
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="fullnameInput">{{ __('Nombre(s) Completo *') }}</label>
                <input type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" id="fullnameInput" placeholder="" value="{{ $member->fullname }}" required>
                @if ($errors->has('fullname'))
                    @include('utils.components.input-errors', ['field' => 'fullname'])
                @endif
            </div>

            <div class="form-group">
                <label for="occupationCodeInput">{{ __('Código de cargo *') }}</label>
                <small id="occupationCodeHelp" class="form-text text-muted">{{ __('15= Observadores & Colaboradores | 30= Delegado | 35= Sub Delegado | 50= Coordinador - Procurador - Otros Cargos') }}</small>
                <input type="string" name="occupation_code" id="occupationCodeInput" class="form-control{{ $errors->has('occupation_code') ? ' is-invalid' : '' }}" value="{{ $member->occupation_code }}">
                @if ($errors->has('occupation_code'))
                    @include('utils.components.input-errors', ['field' => 'occupation_code'])
                @endif
            </div>

            <div class="form-group">
                <label for="countryAbbrRadio6">{{ __('País *') }}</label>
                <small id="occupationCodeHelp" class="form-text text-muted">{{ __('MEX, USA, COL, ...') }}</small>
                <input type="string" name="country_abbr" id="countryAbbrRadio6" class="form-control{{ $errors->has('country_abbr') ? ' is-invalid' : '' }}" value="{{ $member->country_abbr }}">
                @if ($errors->has('country_abbr'))
                    @include('utils.components.input-errors', ['field' => 'country_abbr'])
                @endif
            </div>
            
            <div class="form-group">
                <label for="stateCodeInput">{{ __('Código de estado *') }}</label>
                <input type="number" class="form-control{{ $errors->has('state_code') ? ' is-invalid' : '' }}" name="state_code" id="stateCodeInput" placeholder="" value="{{ $member->state_code }}">
                @if ($errors->has('state_code'))
                    @include('utils.components.input-errors', ['field' => 'state_code'])
                @endif
            </div>

            <div class="form-group">
                <label for="townCodeInput">{{ __('Código de municipio *') }}</label>
                <input type="number" class="form-control{{ $errors->has('town_code') ? ' is-invalid' : '' }}" name="town_code" id="townCodeInput" placeholder="" value="{{ $member->town_code }}">
                @if ($errors->has('town_code'))
                    @include('utils.components.input-errors', ['field' => 'town_code'])
                @endif
            </div>

            @include('components.custom-dropzone', ['url' => route('members.upload-image'), 'field' => 'official_id_photo_back', 'inputName' => 'official_id_photo_back', 'id' => 'official_id_photo_back', 'title' => __('Foto identificación (FRENTE) *'), 'value' => $member->official_id_photo_back ])

            @include('components.custom-dropzone', ['url' => route('members.upload-image'), 'field' => 'official_id_photo_front', 'inputName' => 'official_id_photo_front', 'id' => 'official_id_photo_front', 'title' => __('Foto identificación (REVERSO) *'), 'value' => $member->official_id_photo_front ])

            @include('components.custom-dropzone', ['url' => route('members.upload-image'), 'field' => 'credential_photo', 'inputName' => 'credential_photo', 'id' => 'credential_photo', 'title' => __('Foto para credencial *'), 'value' => $member->credential_photo ])

            @include('components.custom-dropzone', ['url' => route('members.upload-image'), 'field' => 'other_official_id_photo', 'inputName' => 'other_official_id_photo', 'id' => 'other_official_id_photo', 'title' => __('Otra foto (Pasaporte)'), 'value' => $member->other_official_id_photo ])

            <div class="form-group">
                <label for="memberCommentInput">{{ __('Comentario para PLDHA') }}</label>
                <textarea class="form-control{{ $errors->has('member_comment') ? ' is-invalid' : '' }}" name="member_comment" id="memberCommentInput" placeholder="" aria-describedby="memberCommentHelp">{{ $member->member_comment }}</textarea>
                <small id="memberCommentHelp" class="form-text text-muted">{{ __('Escribe alguna razón por la cual quieres pertenecer a PLDHA México') }}</small>
                @if ($errors->has('member_comment'))
                    @include('utils.components.input-errors', ['field' => 'member_comment'])
                @endif
            </div>

            <div class="form-group">
                <label for="idNumberInput">{{ __('Número de identificación') }}</label>
                <input type="number" class="form-control{{ $errors->has('id_number') ? ' is-invalid' : '' }}" name="id_number" id="idNumberInput" placeholder="" value="{{ $member->id_number }}">
                @if ($errors->has('id_number'))
                    @include('utils.components.input-errors', ['field' => 'id_number'])
                @endif
            </div>

            <div class="form-group">
                <label for="phoneNumberInput">{{ __('Teléfono de contacto o WhatsApp') }}</label>
                <input type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" id="phoneNumberInput" placeholder="" value="{{ $member->phone_number }}">
                @if ($errors->has('phone_number'))
                    @include('utils.components.input-errors', ['field' => 'phone_number'])
                @endif
            </div>

            <div class="form-group">
                <label for="occupationInput">{{ __('Ocupación') }}</label>
                <input type="text" class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" id="occupationInput" placeholder="" value="{{ $member->occupation }}">
                @if ($errors->has('occupation'))
                    @include('utils.components.input-errors', ['field' => 'occupation'])
                @endif
            </div>

            <div class="form-group">
                <label for="emailInput">{{ __('Correo Electrónico') }}</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="emailInput" placeholder="" value="{{ $member->email }}">
                @if ($errors->has('email'))
                    @include('utils.components.input-errors', ['field' => 'email'])
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-lg">ENVIAR</button>
        </form>
    </div>
    <script>
        window.onload = function() {
            $('.custom-file-input').on('change', function() {
                $(this).next().text(this.files.length > 0 ? this.files[0].name : '');
            });
        };
    </script>
@endsection


@push('js')
<!-- Custom Dropzone javascript -->
<script>
$(function(){
    $('.custom-dropzone').each(function(){
        var $ctxEl = $(this);
        var url = $(this).attr('data-url');

        var rawFieldName = $ctxEl.find('input:hidden').prop('name');
        var fieldMatch = rawFieldName.match(/\[([^[]+?)\]$/);
        var field = fieldMatch != null ? fieldMatch[1] : rawFieldName;

        if (!url)
            throw 'Debes especificar una url para el custom dropzone en el atributo data-url.';

        var preview =  $(this).find('.preview-template');
        var previewHTML = preview.html();
        preview.remove();

        var dropZone = new Dropzone(this, {
            url: $(this).attr('data-url'),
            params: {
                _token: '{{ csrf_token() }}'
            },
            maxFilesize: 1024*3,
            previewTemplate: previewHTML,
            paramName: 'image',
            acceptedFiles: 'image/*',
            resize: (file) => { 
                return {
                srcWidth: file.width,
                srcHeight: file.height,
                trgWidth: file.width,
                trgHeight: file.height,
                srcX: 0,
                srcY: 0,
                trgX: 0,
                trgY: 0,
                };
            },
        });

        var setState = function(state) {
            $ctxEl.removeClass('error success empty uploading success-before');
            $ctxEl.addClass(state);
        };
        setState('empty');

        dropZone.on('addedfile', function(file) {
            if (dropZone.files.length > 1) {
                dropZone.removeFile(dropZone.files[0]);
            }
        }).on('thumbnail', function(file, dataURL) {
            var imageURL = dataURL; 
        }).on('removedfile', function(file) {
            if (dropZone.files.length == 0) {
                setState('empty');
                $ctxEl.find('input:hidden').val(null);
            }
        }).on('sending', function(file) {
            setState('uploading');    
            $ctxEl.find('.progress-bar').attr('aria-valuenow', 0).css('width', 0);
        }).on('uploadprogress', function (file, progress) {
            $ctxEl.find('.progress-bar').attr('aria-valuenow', progress).css('width', progress + '%');
        }).on('success', function(file, response) {
            setState('success');
            $ctxEl.find('input:hidden').val(response.url);
        }).on('error', function (file, errorResponse) {
            setState('error');
            var errorOutput = '<ul class="mt-0 m-b-0 text-danger text-left">';
            if (errorResponse && errorResponse.errors && _.isArray(errorResponse.errors.file)) {
                for (var err of errorResponse.errors.file) {
                    errorOutput += '<li><small>' + err + '</small></li>'
                }
            } else if (_.isString(errorResponse)) {
                errorOutput += '<li><small>' + errorResponse + '</small></li>';
            } else {
                errorOutput += '<li><small>Error al subir la imagen.</small></li>';
            }
            errorOutput += '</ul>';
            $ctxEl.find('[data-dz-errormessage]').html(errorOutput);
            $ctxEl.find('input:hidden').val(null);
        }).on('complete', function(){
        });
        // If a previous image was loaded then it is attached as current image.
        var initialImageURL = $ctxEl.find('input:hidden').val();
        if (initialImageURL) {
            setState('success-before');
            dropZone.emit('addedfile', new File([], field+'.jpg')); // it is a fake call to force DropZone to show the thumbnail.
            $ctxEl.find('img[data-dz-thumbnail]').prop('src', initialImageURL);
        }
    });
});
</script>
@endpush