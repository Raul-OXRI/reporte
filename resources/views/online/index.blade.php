<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Listado en Línea</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.24/dist/full.min.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-slate-800">
	<div class="max-w-7xl mx-auto p-4 md:p-8">
		<div class="card bg-white shadow-lg border border-slate-200 overflow-hidden">
			<div class="card-body gap-6">
				<div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
					<div>
						<h1 class="text-2xl font-semibold text-slate-900">Participantes en línea</h1>
						<p class="text-sm text-slate-500">Total de registros: <span class="font-semibold text-slate-700">{{ $online->count() }}</span></p>
					</div>
					<a href="{{ route('online.exportPDF') }}" class="btn border-slate-300 bg-white text-slate-700 hover:bg-slate-100">Exportar PDF</a>
				</div>

				<div class="overflow-x-auto rounded-box border border-slate-200 bg-white">
					<table class="table">
						<thead class="bg-slate-50 text-slate-700">
							<tr>
								<th>Nombre</th>
								<th>DPI</th>
								<th>Teléfono</th>
								<th>Correo Electrónico</th>
								<th>CIF</th>
							</tr>
						</thead>
						<tbody class="[&>tr]:border-b [&>tr]:border-slate-100 [&>tr:hover]:bg-slate-50/70">
							@forelse($online as $item)
								<tr>
									<td>{{ $item->nombre }}</td>
									<td>{{ $item->dpi }}</td>
									<td>{{ $item->telefono }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->cif }}</td>
								</tr>
							@empty
								<tr>
									<td colspan="5" class="text-center py-8 text-slate-500">No hay registros para mostrar.</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
