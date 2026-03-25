<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Participantes</title>
    <style>
        @page {
            margin: 26px 24px 52px 24px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            font-size: 10px;
        }

        .report-header {
            width: 100%;
            border: 1px solid #9ca3af;
            background: #f3f4f6;
            border-radius: 6px;
            padding: 10px 12px;
            margin-bottom: 10px;
        }

        .header-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .logo {
            width: 70px;
        }

        .title {
            font-size: 15px;
            font-weight: bold;
            color: #111827;
            margin: 0;
            text-align: left;
        }

        .subtitle {
            margin: 3px 0 0 0;
            color: #374151;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .meta-wrap {
            margin-top: 7px;
            width: 100%;
            border-collapse: collapse;
        }

        .meta-box {
            border: 1px solid #9ca3af;
            background: #ffffff;
            border-radius: 4px;
            text-align: center;
            padding: 5px 2px;
            font-size: 9px;
            color: #4b5563;
        }

        .meta-box strong {
            display: block;
            color: #111827;
            font-size: 10px;
            margin-top: 2px;
            font-weight: bold;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
            border: 1px solid #9ca3af;
        }

        .content-table thead th {
            background: #d1d5db;
            color: #111827;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
            border: 1px solid #9ca3af;
            padding: 6px 5px;
        }

        .content-table tbody td {
            border: 1px solid #9ca3af;
            padding: 5px;
            font-size: 9px;
        }

        .zebra-cell {
            background: #eef2f7;
        }

        .text-center {
            text-align: center;
        }

        .footer-line {
            position: fixed;
            left: 0;
            right: 0;
            bottom: -28px;
            border-top: 1px solid #9ca3af;
            color: #6b7280;
            font-size: 8.5px;
            text-align: left;
            padding-top: 5px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
    $chunks = $online->chunk(40);
    $totalPaginas = $chunks->count();
    @endphp

    @foreach($chunks as $pageIndex => $items)
    <div class="report-header">
        <table class="header-grid">
            <tr>
                <td style="width: 80px; vertical-align: top;">
                    <img class="logo" src="{{ public_path('images/logo.png') }}" alt="logotipo">
                </td>
                <td style="vertical-align: top;">
                    <h1 class="title">Reporte de Votación en Línea</h1>
                    <p class="subtitle">Cooperativa Cobán Responsabilidad Limitada</p>
                </td>
            </tr>
        </table>

        <table class="meta-wrap">
            <tr>
                <td style="width: 50%; padding-right: 4px;">
                    <div class="meta-box">
                        Fecha de generación
                        <strong>{{ $generatedAt }}</strong>
                    </div>
                </td>
                <td style="width: 50%; padding-left: 4px;">
                    <div class="meta-box">
                        Total de registros
                        <strong>{{ $totalRegistros }}</strong>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th style="width: 9%;">No.</th>
                <th style="width: 31%;">Nombre</th>
                <th style="width: 21%;">DPI</th>
                <th style="width: 16%;">Teléfono</th>
                <th style="width: 10%;">Género</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            @php
            $dpiDigits = preg_replace('/\D+/', '', (string) $item->dpi);
            $dpiFormatted = strlen($dpiDigits) === 13
            ? substr($dpiDigits, 0, 4) . '-' . substr($dpiDigits, 4, 5) . '-' . substr($dpiDigits, 9, 4)
            : $item->dpi;
            @endphp
            @php $zebraClass = $loop->even ? 'zebra-cell' : ''; @endphp
            <tr>
                <td class="text-center {{ $zebraClass }}">{{ $item->correlativo }}</td>
                <td class="{{ $zebraClass }}">{{ $item->nombre }}</td>
                <td class="{{ $zebraClass }}">{{ $dpiFormatted }}</td>
                <td class="{{ $zebraClass }}">{{ $item->telefono }}</td>
                <td class="text-center {{ $zebraClass }}">{{ $item->sexo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-line">Listado de participantes en linea.</div>

    @if(!$loop->last)
    <div class="page-break"></div>
    @endif
    @endforeach

    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->get_font('DejaVu Sans', 'normal');
            $pdf->page_text(500, 816, 'Página {PAGE_NUM}/{PAGE_COUNT}', $font, 9, [107, 114, 128]);
        }
    </script>
</body>

</html>