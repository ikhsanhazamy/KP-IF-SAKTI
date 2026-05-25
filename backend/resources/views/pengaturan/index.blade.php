@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#F5F7F6]">

    <main class="flex-1 p-8">

        <div class="mb-8">

            <h1 class="text-5xl font-bold">
                Pengaturan
            </h1>

            <p class="text-gray-500 text-xl mt-2">
                Kelola preferensi dan konfigurasi sistem
            </p>

        </div>

        <div class="grid grid-cols-12 gap-8">

            {{-- SIDEBAR --}}
            <div class="col-span-3">

                <div class="bg-white rounded-3xl border p-4 space-y-3">

                    <a href="/pengaturan/profil"
                       class="block px-6 py-5 rounded-2xl
                       {{ $activeTab == 'profil' ? 'bg-[#15633D] text-white' : 'text-gray-600' }}">
                        Profil
                    </a>

                    <a href="/pengaturan/keamanan"
                       class="block px-6 py-5 rounded-2xl
                       {{ $activeTab == 'keamanan' ? 'bg-[#15633D] text-white' : 'text-gray-600' }}">
                        Keamanan
                    </a>

                    <a href="/pengaturan/notifikasi"
                       class="block px-6 py-5 rounded-2xl
                       {{ $activeTab == 'notifikasi' ? 'bg-[#15633D] text-white' : 'text-gray-600' }}">
                        Notifikasi
                    </a>

                    <a href="/pengaturan/sistem"
                       class="block px-6 py-5 rounded-2xl
                       {{ $activeTab == 'sistem' ? 'bg-[#15633D] text-white' : 'text-gray-600' }}">
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

    </main>

</div>

@endsection