<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        $modelClass = 'App\\Models\\Anggota';

        if (class_exists($modelClass)) {
            $query = $modelClass::query();
        } else {
            $query = DB::table('anggotas');
        }

        if ($status == 'aktif') {

            $query->where('status', 'aktif');

        }

        if ($status == 'tidak_aktif') {

            $query->where('status', 'tidak_aktif');

        }

        $anggota = $query->latest()->paginate(10);

        return view('anggota.index', compact(
            'anggota',
            'status'
        ));
    }
}