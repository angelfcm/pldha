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
        <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="fullnameInput">{{ __('Nombre(s) Completo *') }}</label>
                <input type="text" class="form-control" name="fullname" id="fullnameInput" placeholder="">
            </div>

            <div class="form-group">
                <label>{{ __('Código de cargo *') }}</label>
                <small id="occupationCodeHelp" class="form-text text-muted">{{ __('15= Observadores & Colaboradores | 30= Delegado | 35= Sub Delegado | 50= Coordinador - Procurador - Otros Cargos') }}</small>
                <div class="custom-control custom-radio">
                    <input type="radio" id="occupationCodeRadio1" name="occupation_code" class="custom-control-input" aria-describedby="occupationCodeHelp" value="15">
                    <label class="custom-control-label" for="occupationCodeRadio1">15</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="occupationCodeRadio2" name="occupation_code" class="custom-control-input" aria-describedby="occupationCodeHelp" value="30">
                    <label class="custom-control-label" for="occupationCodeRadio2">30</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="occupationCodeRadio3" name="occupation_code" class="custom-control-input" aria-describedby="occupationCodeHelp" value="35">
                    <label class="custom-control-label" for="occupationCodeRadio3">35</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="occupationCodeRadio4" name="occupation_code" class="custom-control-input" aria-describedby="occupationCodeHelp" value="50">
                    <label class="custom-control-label" for="occupationCodeRadio4">50</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="occupationCodeRadio5" name="occupation_code" class="custom-control-input" aria-describedby="occupationCodeHelp" value="0">
                    <label class="custom-control-label" for="occupationCodeRadio5">Otro:</label>
                    <input type="number" class="form-control" onkeyup="this.form.occupationCodeRadio5.value = this.value">
                </div>
            </div>

            <div class="form-group">
                <label>{{ __('País *') }}</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="countryAbbrRadio1" name="country_abbr" class="custom-control-input" value="MEX">
                    <label class="custom-control-label" for="countryAbbrRadio1">15</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="countryAbbrRadio2" name="country_abbr" class="custom-control-input" value="COL">
                    <label class="custom-control-label" for="countryAbbrRadio2">30</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="countryAbbrRadio4" name="country_abbr" class="custom-control-input" value="VEN">
                    <label class="custom-control-label" for="countryAbbrRadio4">35</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="countryAbbrRadio5" name="country_abbr" class="custom-control-input" value="USA">
                    <label class="custom-control-label" for="countryAbbrRadio5">50</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="countryAbbrRadio6" name="country_abbr" class="custom-control-input" value="0">
                    <label class="custom-control-label" for="countryAbbrRadio6">Otro:</label>
                    <input type="number" class="form-control" onkeyup="this.form.countryAbbrRadio6.value = this.value">
                </div>
            </div>
            
            <div class="form-group">
                <label for="stateCodeInput">{{ __('Código de estado *') }}</label>
                <input type="number" class="form-control" name="state_code" id="stateCodeInput" placeholder="">
            </div>

            <div class="form-group">
                <label for="townCodeInput">{{ __('Código de municipio *') }}</label>
                <input type="number" class="form-control" name="town_code" id="townCodeInput" placeholder="">
            </div>

            <div class="form-group">
                <label for="officialIdPhotoBackInput">{{ __('Foto identificación (FRENTE) *') }}</label>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="official_id_photo_back" id="officialIdPhotoBackInput" class="custom-file-input">
                    <label class="custom-file-label" for="officialIdPhotoBackInput">Elige una Foto</label>
                </div>
            </div>

            <div class="form-group">
                <label for="officialIdPhotoFrontInput">{{ __('Foto identificación (REVERSO) *') }}</label>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="official_id_photo_front" id="officialIdPhotoFrontInput" class="custom-file-input">
                    <label class="custom-file-label" for="officialIdPhotoFrontInput">Elige una Foto</label>
                </div>
            </div>

            <div class="form-group">
                <label for="credentialPhotoInput">{{ __('Foto para credencial *') }}</label>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="credential_photo" id="credentialPhotoInput" class="custom-file-input">
                    <label class="custom-file-label" for="credentialPhotoInput">Elige una Foto</label>
                </div>
            </div>

            <div class="form-group">
                <label for="otherOfficialIdPhotoInput">{{ __('Otra foto (Pasaporte) *') }}</label>
                <div class="custom-file">
                    <input type="file" accept="image/*" name="other_official_id_photo" id="otherOfficialIdPhotoInput" class="custom-file-input">
                    <label class="custom-file-label" for="otherOfficialIdPhotoInput">Elige una Foto</label>
                </div>
            </div>

            <div class="form-group">
                <label for="memberCommentInput">{{ __('Comentario para PLDHA *') }}</label>
                <textarea class="form-control" name="member_comment" id="memberCommentInput" placeholder="" aria-describedby="memberCommentHelp"></textarea>
                <small id="memberCommentHelp" class="form-text text-muted">{{ __('Escribe alguna razón por la cual quieres pertenecer a PLDHA México') }}</small>
            </div>

            <div class="form-group">
                <label for="idNumberInput">{{ __('Número de identificación') }}</label>
                <input type="number" class="form-control" name="id_number" id="idNumberInput" placeholder="">
            </div>

            <div class="form-group">
                <label for="phoneNumberInput">{{ __('Teléfono de contacto o WhatsApp') }}</label>
                <input type="tel" class="form-control" name="phone_number" id="phoneNumberInput" placeholder="">
            </div>

            <div class="form-group">
                <label for="occupationInput">{{ __('Ocupación') }}</label>
                <input type="text" class="form-control" name="occupation" id="occupationInput" placeholder="">
            </div>

            <div class="form-group">
                <label for="emailInput">{{ __('Correo Electrónico') }}</label>
                <input type="email" class="form-control" name="email" id="emailInput" placeholder="">
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
