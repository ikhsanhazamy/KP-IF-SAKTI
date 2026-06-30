@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <div class="mb-6">
        <h1 class="text-[26px] font-bold text-gray-900 tracking-tight">
            Pengaturan
        </h1>
        <p class="text-[#717182] mt-1 text-[14px] font-medium">
            Kelola preferensi dan konfigurasi sistem
        </p>
    </div>

    <div class="grid grid-cols-12 gap-6">

        {{-- SIDEBAR --}}
        <div class="col-span-3">

            <div class="bg-white rounded-2xl border border-gray-100 p-3 space-y-1.5 shadow-sm">

                <a href="/pengaturan/profil"
                   class="block px-5 py-3 rounded-xl text-[13px] font-bold transition duration-150
                   {{ $activeTab == 'profil' ? 'bg-[#0F5E3A] text-white shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900' }}">
                    Profil
                </a>

                <a href="/pengaturan/keamanan"
                   class="block px-5 py-3 rounded-xl text-[13px] font-bold transition duration-150
                   {{ $activeTab == 'keamanan' ? 'bg-[#0F5E3A] text-white shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900' }}">
                    Keamanan
                </a>

                <a href="/pengaturan/notifikasi"
                   class="block px-5 py-3 rounded-xl text-[13px] font-bold transition duration-150
                   {{ $activeTab == 'notifikasi' ? 'bg-[#0F5E3A] text-white shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900' }}">
                    Notifikasi
                </a>

                <a href="/pengaturan/sistem"
                   class="block px-5 py-3 rounded-xl text-[13px] font-bold transition duration-150
                   {{ $activeTab == 'sistem' ? 'bg-[#0F5E3A] text-white shadow-md shadow-[#0F5E3A]/10' : 'text-[#717182] hover:bg-gray-50 hover:text-gray-900' }}">
                    Sistem
                </a>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="col-span-9">

            @if($activeTab == 'profil')
                @include('pengaturan.profil')
            @endif

            @if($activeTab == 'keamanan')
                @include('pengaturan.keamanan')
            @endif

            @if($activeTab == 'notifikasi')
                @include('pengaturan.notifikasi')
            @endif

            @if($activeTab == 'sistem')
                @include('pengaturan.sistem')
            @endif

        </div>

    </div>

</div>

@endsection