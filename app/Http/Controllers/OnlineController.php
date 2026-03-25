<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\online;

class OnlineController extends Controller
{
    public function index()
    {
        $online = online::query()
            ->join('inscriptions as i', 'users.cif', '=', 'i.cif')
            ->join('votes as v', 'users.id', '=', 'v.userId')
            ->where('i.ticket', 0)
            ->whereIn('i.participacion', [1, 2])
            ->select('i.nombre', 'i.dpi', 'i.sexo', 'i.telefono', 'i.cif')
            ->distinct()
            ->orderBy('i.nombre')
            ->get();

        return view('online.index', compact('online'));
    }

    public function exportPDF()
    {
        $online = online::query()
            ->join('inscriptions as i', 'users.cif', '=', 'i.cif')
            ->join('votes as v', 'users.id', '=', 'v.userId')
            ->where('i.ticket', 0)
            ->whereIn('i.participacion', [1, 2])
            ->select('i.nombre', 'i.dpi', 'i.cif', 'i.sexo', 'i.telefono')
            ->distinct()
            ->orderBy('i.nombre')
            ->get()
            ->values()
            ->map(function ($item, $index) {
                $item->correlativo = $index + 1;
                return $item;
            });

        $generatedAt = now()->format('d/m/Y');
        $totalRegistros = $online->count();

        $pdf = PDF::loadView('online.pdf', compact('online', 'generatedAt', 'totalRegistros'));
        return $pdf->download('online.pdf');
    }
}
