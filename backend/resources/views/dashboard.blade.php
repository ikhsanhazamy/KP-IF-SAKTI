@extends('layouts.app')

@section('content')

<div class="space-y-7">

    <div>
        <h1 class="text-[26px] font-bold text-gray-900 tracking-tight">
            Dashboard Overview
        </h1>
        <p class="text-[#717182] mt-1 text-[14px] font-medium">
            Selamat datang di dashboard Fatayat NU Sukabumi - Update terakhir: 11 Mei 2026
        </p>
    </div>

    @include('dashboard.cards')

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @include('dashboard.pendidikan-chart')
        @include('dashboard.profesi-chart')
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column: Aktivitas Terbaru -->
        <div class="lg:col-span-2 flex">
            @include('dashboard.aktivitas')
        </div>
        
        <!-- Right Column: Status PAC & Top 5 PAC vertical stack -->
        <div class="lg:col-span-1 flex flex-col gap-6">
            @include('dashboard.status-pac')
            @include('dashboard.top-pac')
        </div>
    </div>

</div>

@include('dashboard.charts')

@endsection