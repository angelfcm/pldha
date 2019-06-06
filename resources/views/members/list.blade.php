@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- TÍTULO Y SINCRONIZACIÓN DE BD -->
    
    <div class="mb-3">
        <div class="float-right">
            <button type="submit" formaction="#" class="btn btn-success">Sincronizar BD</button>
        </div>
        <h1>Miembros PLDHA</h1> 
    </div>

    <!-- FILTRO DE MIEMBROS -->
    <div class="row justify-content-center">
        <div class="col col-10 col-sm-auto">
            <form class="form-inline">
                <div class="form-group mb-3">
                    <label for="folioInput">Folio</label>
                    <input type="password" id="folioInput" class="form-control mx-3" />
                </div>
                <button type="submit" formaction="#" class="btn btn-primary mb-3">Filtrar</button>
            </form>
        </div>
    </div>

    <!-- LISTA DE MIEMBROS -->
    <div class="row justify-content-center">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-right">{{ __('# Folio') }}</th>
                        <th scope="col">{{ __('Nombre Completo') }}</th>
                        <th scope="col">{{ __('Código de Cargo') }}</th>
                        <th scope="col">{{ __('País') }}</th>
                        <th scope="col">{{ __('Código de Estado') }}</th>
                        <th scope="col">{{ __('Código de Municipio') }}</th>
                        <th scope="col" class="text-right">{{ __('Identificación (REVERSO)') }}</th>
                        <th scope="col" class="text-right">{{ __('Credencial') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                    <tr>
                        <th scope="row" class="text-right">{{ $member->folio }}</th>
                        <td>{{ $member->fullname }}</td>
                        <td>{{ $member->ocuppation_code }}</td>
                        <td>{{ $member->country_abbr }}</td>
                        <td>{{ $member->state_code }}</td>
                        <td>{{ $member->town_code }}</td>
                        <td class="text-right"><a class="btn btn-secondary" href="{{ $member->official_id_photo_back }}" target="_blank">Ver</a></td>
                        <td class="text-right"><a class="btn btn-info" href="#" target="_blank">Descargar</a></td>
                    </tr>
                    @endforeach;
                </tbody>
            </table>

            <div class="float-right">
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
