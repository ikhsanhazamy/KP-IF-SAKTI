<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();

        return view('kegiatan', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        Kegiatan::create($request->all());

        return redirect('/kegiatan');
    }
}