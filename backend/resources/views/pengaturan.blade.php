@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#F5F7F6]">

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-8 overflow-y-auto">

        {{-- HEADER --}}
        <div class="mb-8">

            <h1 class="text-5xl font-bold text-[#111827]">
                Pengaturan
            </h1>

            <p class="text-gray-500 mt-2 text-xl">
                Kelola preferensi dan konfigurasi sistem
            </p>

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">

            {{-- SIDEBAR SETTING --}}
            <div class="xl:col-span-3">

                <div class="bg-white rounded-3xl border border-gray-200 p-4 space-y-3">

                    {{-- PROFILE --}}
                    <button onclick="showTab('profil')"
                            id="tab-profil"
                            class="setting-tab active-tab w-full flex items-center gap-4 px-6 py-5 rounded-2xl text-left transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>

                        </svg>

                        <span class="text-2xl font-medium">
                            Profil
                        </span>

                    </button>

                    {{-- SECURITY --}}
                    <button onclick="showTab('keamanan')"
                            id="tab-keamanan"
                            class="setting-tab w-full flex items-center gap-4 px-6 py-5 rounded-2xl text-left transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 11c0 .552-.448 1-1 1s-1-.448-1-1 .448-1 1-1 1 .448 1 1zm0 0v2m6-6h-1V5a5 5 0 00-10 0v2H6a2 2 0 00-2 2v9a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2z"/>

                        </svg>

                        <span class="text-2xl font-medium">
                            Keamanan
                        </span>

                    </button>

                    {{-- NOTIF --}}
                    <button onclick="showTab('notifikasi')"
                            id="tab-notifikasi"
                            class="setting-tab w-full flex items-center gap-4 px-6 py-5 rounded-2xl text-left transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9"/>

                        </svg>

                        <span class="text-2xl font-medium">
                            Notifikasi
                        </span>

                    </button>

                    {{-- SYSTEM --}}
                    <button onclick="showTab('sistem')"
                            id="tab-sistem"
                            class="setting-tab w-full flex items-center gap-4 px-6 py-5 rounded-2xl text-left transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-7 h-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 17v-2a4 4 0 118 0v2m-4-8V3m0 0L9 7m4-4l4 4"/>

                        </svg>

                        <span class="text-2xl font-medium">
                            Sistem
                        </span>

                    </button>

                </div>

            </div>

            {{-- CONTENT --}}
            <div class="xl:col-span-9">

                {{-- ================= PROFILE ================= --}}
                <div id="content-profil" class="setting-content">

                    <div class="bg-white rounded-3xl border border-gray-200 p-8">

                        <h2 class="text-4xl font-bold mb-8">
                            Informasi Profil
                        </h2>

                        <div class="flex flex-col md:flex-row md:items-center gap-6 mb-10">

                            <div class="w-32 h-32 rounded-full bg-[#EDF7F0] flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-16 h-16 text-[#15633D]"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>

                                </svg>

                            </div>

                            <div class="flex items-center gap-4">

                                <button class="px-6 py-3 border border-gray-200 rounded-2xl hover:bg-gray-50 transition">
                                    Ganti Foto
                                </button>

                                <button class="text-red-500 font-medium">
                                    Hapus
                                </button>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    Nama Lengkap
                                </label>

                                <input type="text"
                                       value="Administrator"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:border-[#15633D]">
                            </div>

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    Email
                                </label>

                                <input type="email"
                                       value="admin@fatayatnusukabumi.or.id"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:border-[#15633D]">
                            </div>

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    No. Telepon
                                </label>

                                <input type="text"
                                       value="081234567890"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:border-[#15633D]">
                            </div>

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    Jabatan
                                </label>

                                <input type="text"
                                       value="Administrator Sistem"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4 outline-none focus:border-[#15633D]">
                            </div>

                        </div>

                        <div class="flex justify-end mt-10">

                            <button class="bg-[#15633D] hover:bg-[#0F4D2F] text-white px-8 py-4 rounded-2xl text-lg transition">
                                Simpan Perubahan
                            </button>

                        </div>

                    </div>

                </div>

                {{-- ================= SECURITY ================= --}}
                <div id="content-keamanan" class="setting-content hidden">

                    <div class="bg-white rounded-3xl border border-gray-200 p-8">

                        <h2 class="text-4xl font-bold mb-8">
                            Keamanan & Password
                        </h2>

                        <div class="space-y-6">

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    Password Lama
                                </label>

                                <input type="password"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4">
                            </div>

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    Password Baru
                                </label>

                                <input type="password"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4">
                            </div>

                            <div>
                                <label class="block text-lg font-medium mb-2">
                                    Konfirmasi Password Baru
                                </label>

                                <input type="password"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4">
                            </div>

                        </div>

                        <div class="border-t border-gray-200 my-10"></div>

                        <h3 class="text-3xl font-bold mb-6">
                            Two-Factor Authentication
                        </h3>

                        <div class="border border-gray-200 rounded-3xl p-6 flex items-center justify-between">

                            <div class="flex items-center gap-5">

                                <div class="w-16 h-16 rounded-full bg-[#EDF7F0] flex items-center justify-center text-[#15633D] text-3xl">
                                    🛡️
                                </div>

                                <div>

                                    <h4 class="text-2xl font-semibold">
                                        2FA via SMS
                                    </h4>

                                    <p class="text-gray-500">
                                        Kirim kode verifikasi melalui SMS
                                    </p>

                                </div>

                            </div>

                            <label class="relative inline-flex items-center cursor-pointer">

                                <input type="checkbox" class="sr-only peer">

                                <div class="w-14 h-8 bg-gray-200 rounded-full peer peer-checked:bg-[#15633D]"></div>

                            </label>

                        </div>

                        <div class="flex justify-end mt-10">

                            <button class="bg-[#15633D] text-white px-8 py-4 rounded-2xl text-lg">
                                Update Password
                            </button>

                        </div>

                    </div>

                </div>

                {{-- ================= NOTIFICATION ================= --}}
                <div id="content-notifikasi" class="setting-content hidden">

                    <div class="bg-white rounded-3xl border border-gray-200 p-8">

                        <h2 class="text-4xl font-bold mb-8">
                            Preferensi Notifikasi
                        </h2>

                        <div class="space-y-5">

                            @foreach([
                                ['Email Notifications', 'Terima notifikasi via email'],
                                ['Push Notifications', 'Notifikasi di aplikasi mobile'],
                                ['Kegiatan Baru', 'Notifikasi saat ada kegiatan baru']
                            ] as $notif)

                            <div class="border border-gray-200 rounded-3xl p-6 flex justify-between items-center">

                                <div>

                                    <h3 class="text-2xl font-semibold">
                                        {{ $notif[0] }}
                                    </h3>

                                    <p class="text-gray-500">
                                        {{ $notif[1] }}
                                    </p>

                                </div>

                                <label class="relative inline-flex items-center cursor-pointer">

                                    <input type="checkbox"
                                           checked
                                           class="sr-only peer">

                                    <div class="w-14 h-8 bg-gray-200 rounded-full peer peer-checked:bg-[#15633D]"></div>

                                </label>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                {{-- ================= SYSTEM ================= --}}
                <div id="content-sistem" class="setting-content hidden">

                    <div class="bg-white rounded-3xl border border-gray-200 p-8">

                        <h2 class="text-4xl font-bold mb-8">
                            Pengaturan Sistem
                        </h2>

                        <div class="space-y-6">

                            <div>

                                <label class="block text-lg font-medium mb-2">
                                    Bahasa
                                </label>

                                <input type="text"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4">

                            </div>

                            <div>

                                <label class="block text-lg font-medium mb-2">
                                    Zona Waktu
                                </label>

                                <input type="text"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4">

                            </div>

                            <div>

                                <label class="block text-lg font-medium mb-2">
                                    Format Tanggal
                                </label>

                                <input type="text"
                                       class="w-full border border-gray-200 rounded-2xl px-5 py-4">

                            </div>

                        </div>

                        <div class="border-t border-gray-200 my-10"></div>

                        <h3 class="text-3xl font-bold mb-6">
                            Backup & Restore
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <button class="border border-gray-200 rounded-2xl py-5 hover:bg-gray-50 transition text-xl">
                                Backup Database
                            </button>

                            <button class="border border-gray-200 rounded-2xl py-5 hover:bg-gray-50 transition text-xl">
                                Restore Database
                            </button>

                        </div>

                        <div class="flex justify-end mt-10">

                            <button class="bg-[#15633D] text-white px-8 py-4 rounded-2xl text-lg">
                                Simpan Pengaturan
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

{{-- STYLE --}}
<style>

    .setting-tab{
        color:#6B7280;
    }

    .active-tab{
        background:#15633D;
        color:white;
    }

</style>

{{-- SCRIPT --}}
<script>

    function showTab(tab){

        document.querySelectorAll('.setting-content').forEach(content => {

            content.classList.add('hidden');

        });

        document.querySelectorAll('.setting-tab').forEach(button => {

            button.classList.remove('active-tab');

        });

        document
            .getElementById('content-' + tab)
            .classList.remove('hidden');

        document
            .getElementById('tab-' + tab)
            .classList.add('active-tab');

    }

</script>

@endsection