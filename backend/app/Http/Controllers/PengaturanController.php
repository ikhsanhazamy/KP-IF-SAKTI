<?php

namespace App\Http\Controllers;

class PengaturanController extends Controller
{
    public function index()
    {
        return redirect('/pengaturan/profil');
    }

    public function profil()
    {
        return view('pengaturan.index', [
            'activeTab' => 'profil'
        ]);
    }

    public function keamanan()
    {
        return view('pengaturan.index', [
            'activeTab' => 'keamanan'
        ]);
    }

    public function notifikasi()
    {
        return view('pengaturan.index', [
            'activeTab' => 'notifikasi'
        ]);
    }

    public function sistem()
    {
        return view('pengaturan.index', [
            'activeTab' => 'sistem'
        ]);
    }
}