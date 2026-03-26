<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Participantes</title>
    <style>
        @page {
            margin: 95px 20px 20px 40px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            margin: 0;
            color: #1f2937;
            background: #ffffff;
            font-size: 10.5px;
        }

        .card {
            border: 1px solid #dbe3ef;
            border-radius: 7px;
            margin-bottom: 8px;
            padding: 8px 10px;
        }

        .page-header {
            position: fixed;
            top: -85px;
            left: 0;
            right: 0;
            padding: 8px 10px;
        }

        .content {
            margin-top: 5px;
        }

        .page-block {
            page-break-after: always;
        }

        .page-block:last-child {
            page-break-after: auto;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo-wrap {
            width: 66px;
        }

        .logo {
            width: 56px;
            height: auto;
        }

        .title-main {
            margin: 0;
            font-size: 14px;
            color: #0f172a;
            font-weight: bold;
        }

        .title-sub {
            margin: 2px 0 0;
            font-size: 9px;
            color: #475569;
        }

        .meta {
            text-align: right;
            font-size: 8.5px;
            color: #64748b;
        }

        .section-title {
            margin: 0 0 6px;
            font-size: 10.5px;
            color: #0f172a;
            font-weight: bold;
        }

        table.data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead th {
            background: #0f172a;
            color: #ffffff;
            padding: 5px 6px;
            border: 1px solid #0f172a;
            font-size: 8.5px;
            text-transform: uppercase;
            letter-spacing: .25px;
        }

        .data-table tbody td {
            padding: 4px 6px;
            border: 1px solid #dbe3ef;
            font-size: 8px;
            line-height: 1.3;
        }

        .data-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .data-table tr {
            page-break-inside: avoid;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <div class="card">
            <table class="header-table">
                <tr>
                    <td class="logo-wrap">
                        <img class="logo" src="{{ public_path('images/logo.png') }}" alt="logotipo">
                    </td>
                    <td>
                        <p class="title-main">Votos Virtuales</p>
                        <p class="title-sub">58 Asamblea General Ordinaria</p>
                        <p class="title-sub">Cooperativa Cobán Responsabilidad Limitada</p>
                    </td>
                    <td class="meta">
                        <div>Fehca: {{ now()->format('d/m/Y') }}</div>
                        <div>Registros: {{ $online->count() }}</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="content">
        @if($online->isEmpty())
        <div class="card">
            <p class="section-title">Listado de participacntes</p>
            <table class="data-table">
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">
                            No hay registro para mostrar.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @else
        @foreach($online->chunk(41) as $pageIndex => $chunk)
        <div class="card page-block">
            <p class="section-title">Listado de Participantes</p>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 40px;">#</th>
                        <th style="width: 200px;">Nombre</th>
                        <th style="width: 100px;">DPI</th>
                        <th style="width: 75px;">TELEFONO</th>
                        <th style="width: 200px;">EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chunk as $user)
                    <tr>
                        <td class="text-center" style="width: 40px;">{{ $user->correlativo ?? (($pageIndex * 41) + $loop->iteration) }}</td>
                        <td style="width: 200px;">{{ $user->nombre ?? '' }}</td>
                        <td style="width: 100px;" class="text-center">{{ $user->dpi ?? '' }}</td>
                        <td style="width: 75px;" class="text-center"> {{ $user->telefono ?? '' }}</td>
                        <td style="width: 200px;" class="text-center">{{ $user->email ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
        @endif
    </div>
</body>

</html>