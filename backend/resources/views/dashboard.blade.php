@extends('layouts.app')

@section('content')

<h1 class="text-5xl font-bold text-[#1E1E1E]">
    Dashboard Overview
</h1>

<p class="text-gray-500 mt-3 text-lg">
    Selamat datang di dashboard Fatayat NU Sukabumi
</p>

<div class="grid grid-cols-4 gap-6 mt-10">

    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <p class="text-gray-500">
            Total Anggota
        </p>

        <h2 class="text-5xl font-bold mt-3">
            2,847
        </h2>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <p class="text-gray-500">
            PAC Aktif
        </p>

        <h2 class="text-5xl font-bold mt-3">
            47
        </h2>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <p class="text-gray-500">
            Kegiatan
        </p>

        <h2 class="text-5xl font-bold mt-3">
            24
        </h2>

    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <p class="text-gray-500">
            Laporan
        </p>

        <h2 class="text-5xl font-bold mt-3">
            156
        </h2>

    </div>

</div>

@endsection