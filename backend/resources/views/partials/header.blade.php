<header class="bg-white border-b border-gray-100 px-8 py-4 flex items-center justify-between shrink-0">

    <!-- SEARCH -->
    <div class="relative w-[380px]">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input
            type="text"
            placeholder="Cari anggota, PAC, kegiatan..."
            class="w-full bg-[#f6f8f7] border-0 rounded-xl pl-11 pr-4 py-3 text-[14px] text-gray-800 placeholder-gray-400 outline-none focus:ring-2 focus:ring-[#0F5E3A]/20 transition"
        >
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-6">

        <!-- NOTIF -->
        @php
            if (!session()->has('notifications')) {
                session()->put('notifications', [
                    [
                        'id' => 1,
                        'title' => 'Anggota Baru Bergabung',
                        'message' => 'Siti Aminah telah mendaftar sebagai anggota baru.',
                        'time' => '10 menit yang lalu',
                        'read' => false
                    ],
                    [
                        'id' => 2,
                        'title' => 'Kegiatan Mendatang',
                        'message' => 'Workshop Manajemen Organisasi akan dimulai besok pagi.',
                        'time' => '1 jam yang lalu',
                        'read' => false
                    ],
                    [
                        'id' => 3,
                        'title' => 'Pembaruan Data PAC',
                        'message' => 'PAC Cibadak telah memperbarui data pengurus.',
                        'time' => '2 jam yang lalu',
                        'read' => false
                    ]
                ]);
            }
            $sessionNotifs = session()->get('notifications', []);
            $unreadCount = collect($sessionNotifs)->where('read', false)->count();
        @endphp
        <div class="relative">
            <button
                id="notificationBell"
                onclick="toggleNotificationDropdown(event)"
                class="relative w-10 h-10 flex items-center justify-center text-gray-500 hover:bg-gray-50 rounded-xl transition cursor-pointer"
                title="Notifikasi"
            >
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span
                    id="notificationDot"
                    class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white {{ $unreadCount > 0 ? '' : 'hidden' }}"
                ></span>
            </button>

            <!-- DROPDOWN -->
            <div
                id="notificationDropdown"
                class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 p-4 transform origin-top-right transition-all duration-200"
            >
                <div class="flex items-center justify-between border-b border-gray-50 pb-2 mb-3">
                    <h4 class="text-xs font-bold text-gray-800">Notifikasi</h4>
                    @if($unreadCount > 0)
                        <button
                            id="markAllReadBtn"
                            onclick="markAllNotificationsAsRead(event)"
                            class="text-[10px] font-bold text-[#0F5E3A] hover:underline cursor-pointer"
                        >
                            Tandai semua dibaca
                        </button>
                    @endif
                </div>
                <div class="space-y-2.5 max-h-60 overflow-y-auto pr-1">
                    @forelse($sessionNotifs as $notif)
                        <div
                            id="notif-item-{{ $notif['id'] }}"
                            class="p-2.5 rounded-xl transition cursor-pointer flex flex-col gap-1 {{ $notif['read'] ? 'bg-white' : 'bg-gray-50/70 border border-gray-50' }}"
                            onclick="markNotifAsRead({{ $notif['id'] }}, {{ $notif['read'] ? 'true' : 'false' }}, event)"
                        >
                            <div class="flex items-start justify-between gap-2">
                                <span class="text-[11px] font-bold text-gray-800 {{ $notif['read'] ? 'text-gray-500 font-medium' : '' }}">
                                    {{ $notif['title'] }}
                                </span>
                                @if(!$notif['read'])
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full flex-shrink-0 mt-1.5"></span>
                                @endif
                            </div>
                            <p class="text-[10px] text-gray-500 font-medium leading-relaxed">
                                {{ $notif['message'] }}
                            </p>
                            <span class="text-[9px] text-gray-400 mt-0.5">
                                {{ $notif['time'] }}
                            </span>
                        </div>
                    @empty
                        <p class="text-center text-xs text-gray-400 py-6">Tidak ada notifikasi.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <script>
            function toggleNotificationDropdown(event) {
                event.stopPropagation();
                const dropdown = document.getElementById('notificationDropdown');
                if (dropdown) {
                    dropdown.classList.toggle('hidden');
                }
            }

            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('notificationDropdown');
                const bell = document.getElementById('notificationBell');
                if (dropdown && bell) {
                    if (!bell.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                }
            });

            function markAllNotificationsAsRead(event) {
                event.stopPropagation();
                fetch('/notifications/read-all', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const dot = document.getElementById('notificationDot');
                        if (dot) dot.classList.add('hidden');

                        const unreadItems = document.querySelectorAll('[id^="notif-item-"]');
                        unreadItems.forEach(item => {
                            item.classList.remove('bg-gray-50/70', 'border', 'border-gray-50');
                            item.classList.add('bg-white');
                            const titleSpan = item.querySelector('span');
                            if (titleSpan) {
                                titleSpan.classList.add('text-gray-500', 'font-medium');
                            }
                            const redCircle = item.querySelector('.bg-red-500');
                            if (redCircle) redCircle.remove();
                        });

                        const markAllBtn = document.getElementById('markAllReadBtn');
                        if (markAllBtn) markAllBtn.remove();
                    }
                });
            }

            function markNotifAsRead(id, isAlreadyRead, event) {
                event.stopPropagation();
                if (isAlreadyRead) return;

                fetch(`/notifications/read/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const item = document.getElementById(`notif-item-${id}`);
                        if (item) {
                            item.classList.remove('bg-gray-50/70', 'border', 'border-gray-50');
                            item.classList.add('bg-white');
                            item.setAttribute('onclick', `markNotifAsRead(${id}, true, event)`);
                            
                            const titleSpan = item.querySelector('span');
                            if (titleSpan) {
                                titleSpan.classList.add('text-gray-500', 'font-medium');
                            }
                            const redCircle = item.querySelector('.bg-red-500');
                            if (redCircle) redCircle.remove();
                        }

                        const remainingUnread = document.querySelectorAll('[id^="notif-item-"] .bg-red-500').length;
                        if (remainingUnread === 0) {
                            const dot = document.getElementById('notificationDot');
                            if (dot) dot.classList.add('hidden');
                            const markAllBtn = document.getElementById('markAllReadBtn');
                            if (markAllBtn) markAllBtn.remove();
                        }
                    }
                });
            }
        </script>

        <!-- ACCOUNT -->
        <div class="flex items-center gap-3">

            <div class="text-right">
                <h3 class="font-semibold text-gray-800 text-[14px] leading-tight">
                    Admin Kabupaten Sukabumi
                </h3>
                <p class="text-[11px] text-[#717182] font-medium mt-0.5">
                    Super Admin
                </p>
            </div>

            <div class="w-10 h-10 rounded-full bg-[#f6f8f7] border border-gray-100 flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>

        </div>

    </div>

</header>