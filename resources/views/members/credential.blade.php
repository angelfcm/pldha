<!DOCTYPE html>
<html>
    <head>
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            @page {
                margin: 0;
            }
            html {
                margin: 0;
                font-family: 'Courier New', Courier, monospace;
            }
            body {
                font-family: Helvetica;
                margin-top: 10mm;
            }
            hr {
                page-break-after: always;
                border: 0;
                margin: 0;
                padding: 0;
            }
            /* Estándar de medida para identificación: CR80 */
            .credential-container {
                margin: 0 auto;
                width: 98.552mm;
                height: 157.244mm;
                position: relative;
            }
            .credential-template-image {
                width: 98.552mm;
                height: 157.244mm;
                z-index: 100;
                position: absolute;
            }
            .credential-photo {
                width: 47mm;
                height: 47mm;
                left: 35mm;
                top: 32mm;
                background: red;
                position: absolute;
                display: block;
            }
            .credential-folio {
                width: 226.83px;
                height: 27.2px;
                position: absolute;
                transform: rotate(-90deg);
                top: 114mm;
                left: -16mm;
                color: white;
                z-index: 200;
                font-size: 18pt;
                font-weight: bold;
            }
            .credential-occupation-title {
                width: 160.26px;
                height: 19.2px;
                position: absolute;
                transform: rotate(-90deg);
                top: 28mm;
                left: -8mm;
                color: white;
                z-index: 200;
                font-size: 12.5pt;
            }
            .credential-fullname {
                position: absolute;
                width: 66mm;
                height: 24mm;
                left: 26mm;
                top: 86mm;
                z-index: 200;
                text-align: center;
                font-size: 20pt;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center">
            <img src="{{ asset('img/logo.png') }}" height="150px">
            <h1 style="color: #55ff55;">Verificado</h1>
        </div>
        <div class="credential-container">
            <img class="credential-photo" src="{{ $member->credential_photo }}">
            <img class="credential-template-image" src="{{ asset('img/pldha-credential-front.png') }}">
            <div class="credential-folio">{{ $member->folio }}</div>
            <div class="credential-occupation-title">{{ $member->occupation_title }}</div>
            <div class="credential-fullname">{{ $member->fullname }}</div>
        </div>
    </body>
</html>