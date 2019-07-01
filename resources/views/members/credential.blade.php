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
            }
            hr {
                page-break-after: always;
                border: 0;
                margin: 0;
                padding: 0;
            }
            /* Estándar de medida para identificación: CR80 */
            .credential-container {
                width: 5.4cm;
                height: 8.6cm;
                position: relative;
                top: 0;
                left: 0;
            }
            .credential-template-image {
                width: 5.4cm;
                height: 8.6cm;
                z-index: 100;
                position: absolute;
            }
            .credential-photo {
                width: 26mm;
                height: 25.5mm;
                left: 18mm;
                top: 13.6mm;
                background: red;
                position: absolute;
                display: block;
            }
            .credential-folio {
                width: 3.5cm;
                transform: rotate(-90deg);
                transform-origin: top left;
                position: absolute;
                top: 4.56cm;
                left: 0.62cm;
                margin-top: 3.5cm;
                color: white;
                z-index: 200;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10pt;
                font-weight: bold;
                text-align: right;
            }
            .credential-occupation {
                width: 4.29cm;
                transform: rotate(-90deg);
                transform-origin: top left;
                position: absolute;
                top: 0.5cm;
                left: 0.7cm;
                margin-top: 4.29cm;
                color: white;
                z-index: 200;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 5pt;
                font-weight: bold;
                text-align: right;
                text-transform: uppercase;
            }
            .credential-fullname {
                width: 25mm;
                height: 11mm;
                position: absolute;
                left: 1.89cm;
                top: 4.47cm;
                z-index: 200;
                text-align: center;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 9.09pt;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="credential-container">
            <img class="credential-photo" src="{{ $member->credential_photo }}">
            <img class="credential-template-image" src="{{ asset('img/pldha-credential-front.png') }}">
            <div class="credential-folio">{{ $member->folio }}</div>
            <div class="credential-occupation">{{ $member->occupation }}</div>
            <div class="credential-fullname">{{ $member->fullname }}</div>
        </div><!--
        <div class="credential-container">
            <img class="credential-template-image" src="{{ asset('img/pldha-credential-back.png') }}">
        </div>-->
    </body>
</html>