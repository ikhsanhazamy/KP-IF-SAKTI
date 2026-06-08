@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- Header -->
    <div>

        <h1 class="text-[30px] font-bold text-[#1D1D1D]">
            Dashboard Overview
        </h1>

        <p class="text-[#717182] mt-2 text-[16px]">
            Selamat datang di dashboard Fatayat NU Sukabumi
        </p>

    </div>

    @include('dashboard.cards')

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        @include('dashboard.pendidikan-chart')

        @include('dashboard.profesi-chart')

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        @include('dashboard.aktivitas')

        @include('dashboard.status-pac')

        @include('dashboard.top-pac')

    </div>

</div>

@include('dashboard.charts')

@endsection