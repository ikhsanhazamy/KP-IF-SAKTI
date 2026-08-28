@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-[1600px] space-y-7">

    <div>

        <h1 class="text-[30px] font-bold tracking-[-0.03em] text-[#202321] sm:text-[34px]">
            Dashboard Overview
        </h1>

        <p class="mt-2 text-[15px] text-[#747887] sm:text-base">
            Selamat datang di dashboard Fatayat NU Sukabumi
            <span class="hidden sm:inline">
                - Update terakhir: {{ $lastUpdated->locale('id')->translatedFormat('d F Y') }}
            </span>
        </p>

    </div>

    @include('dashboard.cards')

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        @include('dashboard.anggota-growth-chart')

        @include('dashboard.profesi-chart')

    </div>

    <div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(320px,1fr)]">

        @include('dashboard.aktivitas')

        <div class="space-y-6">
            @include('dashboard.status-pac')
            @include('dashboard.top-pac')
        </div>

    </div>

</div>

@include('dashboard.charts')

@endsection
