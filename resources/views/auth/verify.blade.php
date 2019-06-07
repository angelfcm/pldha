@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un enlace de verificación ha sido envíado a tu correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, revisa el enlace de verificación en tu correo electrónico.') }}
                    {{ __('Si no recibiste el correo') }}, <a href="{{ route('verification.resend') }}">{{ __('click para solicitar de nuevo.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
