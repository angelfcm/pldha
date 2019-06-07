@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- TÍTULO Y SINCRONIZACIÓN DE BD -->
    
    <div class="mb-3">
        <div class="float-right">
            <a href="{{ route('members.create') }}" class="btn btn-success">{{ __('Nuevo Miembro') }}</a>
        </div>
        <h1>Miembros PLDHA</h1> 
    </div>

    <!-- FILTRO DE MIEMBROS -->
    <div class="row justify-content-center">
        <div class="col col-10 col-sm-auto">
            <form method="GET" action="{{ route('members.index') }}">
                @csrf
                <div class="form-row justify-content-center align-items-center">
                    <div class="col-auto">
                        <label class="sr-only" for="folioInput">Folio</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Folio</div>
                            </div>
                            <input type="text" name="folio" class="form-control" id="folioInput" placeholder="" value="{{ $folio }}">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="hideVerifiedInput" name="hide_verified" {{ $hide_verified ? 'checked' : '' }}>
                            <label class="form-check-label" for="hideVerifiedInput">
                                {{ __('Ocultar verificados') }}
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="hideNoVerifiedInput" name="hide_no_verified" {{ $hide_no_verified  ? 'checked' : '' }}>
                            <label class="form-check-label" for="hideNoVerifiedInput">
                                {{ __('Ocultar no verificados') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-warning mb-2">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- LISTA DE MIEMBROS -->
    <div class="row justify-content-center">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">{{ __('# Folio') }}</th>
                            <th scope="col" class="text-center">{{ __('Foto') }}</th>
                            <th scope="col">{{ __('Nombre Completo') }}</th>
                            <th scope="col">{{ __('Número de Teléfono') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('País') }}</th>
                            <th scope="col">{{ __('Código de Estado') }}</th>
                            <th scope="col">{{ __('Código de Municipio') }}</th>
                            <th scope="col">{{ __('Identificación (REVERSO)') }}</th>
                            <th scope="col">{{ __('Identificación (FRENTE)') }}</th>
                            <th scope="col">{{ __('Otra Identificación (PASAPORTE)') }}</th>
                            <th scope="col">{{ __('Código de Cargo') }}</th>
                            <th scope="col">{{ __('Ocupación') }}</th>
                            <th scope="col">{{ __('Comentario') }}</th>
                            <th scope="col" class="text-right">{{ __('Credencial') }}</th>
                            <th scope="col" class="text-left">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                        <tr>
                            <th scope="row">{{ $member->folio }}</th>
                            <td class="text-center"><img src="{{ $member->credential_photo }}" style="height: 70px"></td>
                            <td>{{ $member->fullname }}</td>
                            <td>{{ $member->phone_number }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->country_abbr }}</td>
                            <td>{{ $member->state_code }}</td>
                            <td>{{ $member->town_code }}</td>
                            <td><a class="btn btn-info btn-sm" href="{{ $member->official_id_photo_back }}" target="_blank">Ver</a></td>
                            <td><a class="btn btn-info btn-sm" href="{{ $member->official_id_photo_front }}" target="_blank">Ver</a></td>
                            <td><a class="btn btn-info btn-sm" href="{{ $member->other_official_id_photo }}" target="_blank">Ver</a></td>
                            <td>{{ $member->occupation_code }}</td>
                            <td>{{ $member->occupation }}</td>
                            <td>{{ $member->member_comment }}</td>
                            <td class="text-right">
                                <div class="row justify-content-center">
                                    <div class="col col-auto">
                                        <a class="btn btn-primary btn-sm" href="{{ route('members.printPdfCredential', ['id' => $member->id]) }}" target="_blank">Abrir</a>
                                    </div>
                                    <div class="col col-auto mt-2">
                                        <button class="btn btn-secondary btn-sm" onclick="copyCredentialLink({{ $member->id }})">NFC</button>
                                    </div>
                                </div>
                            </td>
                            <td class="text-left">
                                <div class="custom-control custom-checkbox">
                                    <input onclick="updateVerification({{ $member->id }}, this.checked)" type="checkbox" class="custom-control-input" id="verifiedMemberInput{{ $member->id }}" {{ $member->verified ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="verifiedMemberInput{{ $member->id }}">
                                        @if($member->verified)
                                            <span class="badge badge-pill badge-success">Verificado</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">No Verificado</span>
                                        @endif
                                    </label>
                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach;
                    </tbody>
                </table>
            </div>

            <div class="float-right">
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Credential Link Modal -->
<div class="modal fade" id="credentialLinkModal" tabindex="-1" role="dialog" aria-labelledby="credentialLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="credentialLinkModalLabel">{{ __('Enlace de Credencial')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ __('Este es el enlace para acceder a la credencial correspondiente.') }}</p>
                <input type="text" readonly id="credentialLinkModalInput" value="" class="w-100 text-center">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar')}}</button>
            </div>
        </div>
    </div>
</div>
<script>
    function updateVerification(memberId, verified) 
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('{{ url("/") }}/members/' + memberId + '/verify', {
            verified: verified ? 1 : 0,
        }).catch(function() {
            $('#verifiedMemberInput' + memberId).prop('checked', !verified);
            updateVerificationCheckbox(memberId, !verified);
        });

        updateVerificationCheckbox(memberId, verified);
    }

    function updateVerificationCheckbox(memberId, verified) 
    {
        var labelCt = $('[for=verifiedMemberInput' + memberId + ']');
        if(verified) {
            labelCt.html('<span class="badge badge-pill badge-success">Verificado</span>');
        }
        else {
            labelCt.html('<span class="badge badge-pill badge-danger">No Verificado</span>');
        }
    }

    function copyCredentialLink(memberId) 
    {
        $('#credentialLinkModalInput').val('{{ config("app.url") }}' + '/members/' + memberId + '/credential');
        $('#credentialLinkModal').modal('show');
    }
</script>
@endsection
