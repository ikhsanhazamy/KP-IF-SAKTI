@extends('layouts.app')

@section('content')

<!-- HEADER -->
<div class="flex items-start justify-between mb-8">

    <div>

        <h1 class="text-5xl font-bold text-[#1E1E1E]">
            Data Anggota
        </h1>

        <p class="text-gray-500 text-lg mt-2">
            Kelola data anggota Fatayat NU Sukabumi
        </p>

    </div>

    <div class="flex gap-4">

        <button class="border border-gray-300 px-6 py-3 rounded-2xl bg-white hover:bg-gray-50">
            Export
        </button>

        <button class="bg-[#15633D] text-white px-6 py-3 rounded-2xl hover:bg-[#0F5E3A]">
            + Tambah Anggota
        </button>

    </div>

</div>

<!-- STATS -->
<div class="grid grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-3xl p-6 shadow-sm">
        <h2 class="text-5xl font-bold">8</h2>
        <p class="text-gray-500 mt-2">Total Anggota</p>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">
        <h2 class="text-5xl font-bold text-[#15633D]">7</h2>
        <p class="text-gray-500 mt-2">Anggota Aktif</p>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">
        <h2 class="text-5xl font-bold">0</h2>
        <p class="text-gray-500 mt-2">Anggota Baru (Bulan Ini)</p>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">
        <h2 class="text-5xl font-bold">98%</h2>
        <p class="text-gray-500 mt-2">Tingkat Verifikasi</p>
    </div>

</div>

<!-- FILTER -->
<div class="bg-white rounded-3xl p-6 mb-8 shadow-sm flex justify-between items-center gap-4">

    <input
        type="text"
        placeholder="Cari nama, email, atau PAC..."
        class="flex-1 border border-gray-300 rounded-2xl px-5 py-4 outline-none focus:ring-4 focus:ring-[#15633D]/20"
    >

    <div class="flex gap-3">

        <button class="bg-[#15633D] text-white px-6 py-3 rounded-2xl">
            Semua
        </button>

        <button class="border border-gray-300 px-6 py-3 rounded-2xl bg-white">
            Aktif
        </button>

        <button class="border border-gray-300 px-6 py-3 rounded-2xl bg-white">
            Tidak Aktif
        </button>

    </div>

</div>

<!-- TABLE -->
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">

    <table class="w-full">

        <thead class="border-b bg-gray-50">

            <tr class="text-left">

                <th class="p-6 font-semibold">Nama</th>
                <th class="p-6 font-semibold">Email</th>
                <th class="p-6 font-semibold">PAC</th>
                <th class="p-6 font-semibold">Profesi</th>
                <th class="p-6 font-semibold">Status</th>
                <th class="p-6 font-semibold">Tanggal Bergabung</th>
                <th class="p-6 font-semibold text-center">Aksi</th>

            </tr>

        </thead>

        <tbody>

            @php
                $anggota = [
                    [
                        'nama' => 'Hj. Siti Aminah, S.Pd',
                        'email' => 'siti.aminah@email.com',
                        'pac' => 'PAC Cibadak',
                        'profesi' => 'Guru',
                        'status' => 'Aktif',
                        'tanggal' => '15/1/2024'
                    ],
                    [
                        'nama' => 'Hj. Nurhayati, M.Pd',
                        'email' => 'nurhayati@email.com',
                        'pac' => 'PAC Palabuhanratu',
                        'profesi' => 'Dosen',
                        'status' => 'Aktif',
                        'tanggal' => '20/2/2024'
                    ],
                    [
                        'nama' => 'Dra. Hj. Fatimah',
                        'email' => 'fatimah@email.com',
                        'pac' => 'PAC Cicurug',
                        'profesi' => 'Pengusaha',
                        'status' => 'Aktif',
                        'tanggal' => '10/11/2023'
                    ],
                    [
                        'nama' => 'Hj. Aisyah, S.Kom',
                        'email' => 'aisyah@email.com',
                        'pac' => 'PAC Parungkuda',
                        'profesi' => 'IT Specialist',
                        'status' => 'Aktif',
                        'tanggal' => '5/3/2024'
                    ],
                ];
            @endphp

            @foreach($anggota as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-6 font-medium">
                        {{ $item['nama'] }}
                    </td>

                    <td class="p-6 text-gray-500">
                        {{ $item['email'] }}
                    </td>

                    <td class="p-6 text-gray-500">
                        {{ $item['pac'] }}
                    </td>

                    <td class="p-6 text-gray-500">
                        {{ $item['profesi'] }}
                    </td>

                    <td class="p-6">

                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                            {{ $item['status'] }}
                        </span>

                    </td>

                    <td class="p-6 text-gray-500">
                        {{ $item['tanggal'] }}
                    </td>

                    <td class="p-6">

                        <div class="flex justify-center gap-4">

                            <button class="text-gray-500 hover:text-black">
                                👁
                            </button>

                            <button class="text-blue-500">
                                ✏
                            </button>

                            <button class="text-red-500">
                                🗑
                            </button>

                        </div>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <!-- FOOTER -->
    <div class="flex items-center justify-between p-6">

        <p class="text-gray-500">
            Menampilkan 1-4 dari 8 anggota
        </p>

        <div class="flex gap-3">

            <button class="border px-5 py-2 rounded-xl bg-gray-100 text-gray-500">
                Previous
            </button>

            <button class="bg-[#15633D] text-white px-5 py-2 rounded-xl">
                1
            </button>

            <button class="border px-5 py-2 rounded-xl bg-white">
                Next
            </button>

        </div>

    </div>

</div>

@endsection