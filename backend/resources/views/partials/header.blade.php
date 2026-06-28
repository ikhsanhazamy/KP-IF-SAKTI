@php
    $user = auth()->user();
    $userName = $user?->name ?? 'Admin Kabupaten Sukabumi';
    $userRole = $user?->jabatan ?? 'Super Admin';
    $userInitial = mb_strtoupper(mb_substr($userName, 0, 1));
    $userPhotoUrl = $user?->photo ? '/storage/'.ltrim($user->photo, '/') : null;
@endphp

<header class="relative z-40 flex min-h-[80px] min-w-0 items-center justify-between border-b border-[#E8ECE9] bg-white px-5 sm:px-7 lg:px-8">
    <div class="mr-4 flex shrink-0 items-center gap-3 lg:hidden">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#237A4B] text-xs font-bold text-white">
            FN
        </div>
        <span class="hidden text-sm font-bold text-[#202321] sm:block">Fatayat NU</span>
    </div>

    <div id="globalSearch" class="relative hidden min-w-0 flex-1 sm:block sm:max-w-[485px]">
        <form id="globalSearchForm" autocomplete="off">
            <label class="relative block">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#8A8F9D]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4"></path>
                    </svg>
                </span>
                <input
                    id="globalSearchInput"
                    type="search"
                    placeholder="Cari anggota, PAC, kegiatan..."
                    class="h-11 w-full rounded-2xl border border-[#DFE4E1] bg-white pl-12 pr-4 text-sm text-[#343735] outline-none transition placeholder:text-[#A0A4AF] focus:border-[#4FA36C] focus:ring-4 focus:ring-[#4FA36C]/10"
                    aria-label="Pencarian global"
                    aria-expanded="false"
                    aria-controls="globalSearchResults"
                >
            </label>
        </form>

        <div
            id="globalSearchResults"
            class="absolute left-0 right-0 top-[52px] hidden max-h-[420px] overflow-y-auto rounded-2xl border border-[#E2E6E3] bg-white p-2 shadow-[0_18px_48px_rgba(31,41,35,0.16)]"
        ></div>
    </div>

    <div class="ml-auto flex min-w-0 shrink-0 items-center gap-3 sm:gap-5">
        <div id="notificationArea" class="relative">
            <button
                id="notificationButton"
                type="button"
                class="relative flex h-10 w-10 items-center justify-center rounded-full text-[#747887] transition hover:bg-[#F3F7F4] hover:text-[#176B43]"
                aria-label="Notifikasi"
                aria-expanded="false"
                aria-controls="notificationDropdown"
            >
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"></path>
                    <path d="M10 21h4"></path>
                </svg>
                <span id="notificationDot" class="absolute right-2 top-1.5 hidden h-2 w-2 rounded-full bg-[#D92D4B] ring-2 ring-white"></span>
            </button>

            <div
                id="notificationDropdown"
                class="absolute right-0 top-[48px] hidden w-[min(380px,calc(100vw-2rem))] overflow-hidden rounded-2xl border border-[#E2E6E3] bg-white shadow-[0_18px_48px_rgba(31,41,35,0.16)]"
            >
                <div class="flex items-center justify-between border-b border-[#EDF0EE] px-5 py-4">
                    <div>
                        <h2 class="font-bold text-[#202321]">Notifikasi</h2>
                        <p id="notificationSummary" class="mt-0.5 text-xs text-[#8A8F9D]">Memuat notifikasi...</p>
                    </div>
                    <button id="markAllNotifications" type="button" class="text-xs font-semibold text-[#176B43] hover:underline">
                        Tandai semua dibaca
                    </button>
                </div>
                <div id="notificationList" class="max-h-[420px] overflow-y-auto p-2">
                    <div class="px-4 py-8 text-center text-sm text-[#8A8F9D]">Memuat...</div>
                </div>
                <a href="/pengaturan/notifikasi" class="block border-t border-[#EDF0EE] px-5 py-3 text-center text-sm font-semibold text-[#176B43] hover:bg-[#F7FAF8]">
                    Pengaturan notifikasi
                </a>
            </div>
        </div>

        <div class="hidden h-9 w-px bg-[#E8ECE9] sm:block"></div>

        <a href="/pengaturan/profil" class="flex min-w-0 items-center gap-3 rounded-xl p-1 transition hover:bg-[#F7FAF8]">
            <div class="hidden min-w-0 text-right md:block">
                <h3 class="max-w-[190px] truncate text-sm font-semibold text-[#262926]">{{ $userName }}</h3>
                <p class="mt-0.5 truncate text-xs text-[#8A8F9D]">{{ $userRole }}</p>
            </div>

            @if($userPhotoUrl)
                <img
                    src="{{ $userPhotoUrl }}"
                    class="h-11 w-11 shrink-0 rounded-full object-cover ring-4 ring-[#EEF5F1]"
                    alt="{{ $userName }}"
                    onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden')"
                >
            @endif
            <div class="{{ $userPhotoUrl ? 'hidden' : 'flex' }} h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#EAF3EE] text-sm font-bold text-[#176B43] ring-4 ring-[#F4F8F5]">
                {{ $userInitial }}
            </div>
        </a>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchRoot = document.getElementById('globalSearch');
        const searchForm = document.getElementById('globalSearchForm');
        const searchInput = document.getElementById('globalSearchInput');
        const searchResults = document.getElementById('globalSearchResults');
        const notificationArea = document.getElementById('notificationArea');
        const notificationButton = document.getElementById('notificationButton');
        const notificationDropdown = document.getElementById('notificationDropdown');
        const notificationList = document.getElementById('notificationList');
        const notificationDot = document.getElementById('notificationDot');
        const notificationSummary = document.getElementById('notificationSummary');
        const markAllButton = document.getElementById('markAllNotifications');
        const searchUrl = @json(route('header.search'));
        const notificationsUrl = @json(route('header.notifications'));
        const readStorageKey = 'fatayat-read-notifications';

        let searchTimer;
        let searchItems = [];
        let notifications = [];
        let notificationsLoaded = false;

        const escapeHtml = value => String(value ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

        const getReadIds = () => {
            try {
                return new Set(JSON.parse(localStorage.getItem(readStorageKey) || '[]'));
            } catch {
                return new Set();
            }
        };

        const saveReadIds = ids => {
            localStorage.setItem(readStorageKey, JSON.stringify([...ids].slice(-100)));
        };

        const showSearchResults = html => {
            searchResults.innerHTML = html;
            searchResults.classList.remove('hidden');
            searchInput.setAttribute('aria-expanded', 'true');
        };

        const hideSearchResults = () => {
            searchResults.classList.add('hidden');
            searchInput.setAttribute('aria-expanded', 'false');
        };

        const renderSearchResults = items => {
            searchItems = items;

            if (!items.length) {
                showSearchResults('<div class="px-4 py-8 text-center text-sm text-[#8A8F9D]">Data tidak ditemukan.</div>');
                return;
            }

            showSearchResults(items.map(item => `
                <a href="${escapeHtml(item.url)}" class="flex items-start gap-3 rounded-xl px-3 py-3 transition hover:bg-[#F2F7F4]">
                    <span class="mt-0.5 rounded-lg bg-[#EAF3EE] px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-[#176B43]">
                        ${escapeHtml(item.type)}
                    </span>
                    <span class="min-w-0">
                        <span class="block truncate text-sm font-semibold text-[#262926]">${escapeHtml(item.title)}</span>
                        <span class="mt-0.5 block truncate text-xs text-[#8A8F9D]">${escapeHtml(item.subtitle)}</span>
                    </span>
                </a>
            `).join(''));
        };

        const runSearch = async () => {
            const query = searchInput.value.trim();

            if (query.length < 2) {
                searchItems = [];
                hideSearchResults();
                return;
            }

            showSearchResults('<div class="px-4 py-8 text-center text-sm text-[#8A8F9D]">Mencari...</div>');

            try {
                const response = await fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
                    headers: { Accept: 'application/json' },
                });

                if (!response.ok) {
                    throw new Error('Search request failed');
                }

                const data = await response.json();

                if (searchInput.value.trim() === query) {
                    renderSearchResults(data.results || []);
                }
            } catch {
                showSearchResults('<div class="px-4 py-8 text-center text-sm text-red-600">Pencarian gagal dimuat.</div>');
            }
        };

        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(runSearch, 250);
        });

        searchInput.addEventListener('focus', () => {
            if (searchInput.value.trim().length >= 2) {
                runSearch();
            }
        });

        searchForm.addEventListener('submit', event => {
            event.preventDefault();

            if (searchItems[0]) {
                window.location.href = searchItems[0].url;
            } else {
                runSearch();
            }
        });

        const markNotificationRead = id => {
            const readIds = getReadIds();
            readIds.add(id);
            saveReadIds(readIds);
            renderNotifications();
        };

        const renderNotifications = () => {
            const readIds = getReadIds();
            const unreadCount = notifications.filter(item => !readIds.has(item.id)).length;

            notificationDot.classList.toggle('hidden', unreadCount === 0);
            notificationSummary.textContent = unreadCount > 0
                ? `${unreadCount} notifikasi belum dibaca`
                : 'Semua notifikasi sudah dibaca';

            if (!notifications.length) {
                notificationList.innerHTML = '<div class="px-4 py-10 text-center text-sm text-[#8A8F9D]">Belum ada notifikasi.</div>';
                return;
            }

            notificationList.innerHTML = notifications.map(item => {
                const unread = !readIds.has(item.id);

                return `
                    <a
                        href="${escapeHtml(item.url)}"
                        data-notification-id="${escapeHtml(item.id)}"
                        class="notification-item relative block rounded-xl px-4 py-3 transition hover:bg-[#F2F7F4] ${unread ? 'bg-[#F7FBF8]' : ''}"
                    >
                        ${unread ? '<span class="absolute right-3 top-4 h-2 w-2 rounded-full bg-[#D92D4B]"></span>' : ''}
                        <span class="block pr-5 text-sm font-semibold text-[#262926]">${escapeHtml(item.title)}</span>
                        <span class="mt-1 block pr-4 text-xs leading-5 text-[#747887]">${escapeHtml(item.message)}</span>
                        <span class="mt-1.5 block text-[11px] text-[#4FA36C]">${escapeHtml(item.time)}</span>
                    </a>
                `;
            }).join('');

            notificationList.querySelectorAll('.notification-item').forEach(item => {
                item.addEventListener('click', () => markNotificationRead(item.dataset.notificationId));
            });
        };

        const loadNotifications = async () => {
            if (notificationsLoaded) {
                renderNotifications();
                return;
            }

            try {
                const response = await fetch(notificationsUrl, {
                    headers: { Accept: 'application/json' },
                });

                if (!response.ok) {
                    throw new Error('Notification request failed');
                }

                const data = await response.json();
                notifications = data.notifications || [];
                notificationsLoaded = true;
                renderNotifications();
            } catch {
                notificationSummary.textContent = 'Notifikasi tidak dapat dimuat';
                notificationList.innerHTML = '<div class="px-4 py-10 text-center text-sm text-red-600">Gagal memuat notifikasi.</div>';
            }
        };

        const toggleNotifications = async () => {
            const willOpen = notificationDropdown.classList.contains('hidden');
            notificationDropdown.classList.toggle('hidden', !willOpen);
            notificationButton.setAttribute('aria-expanded', willOpen ? 'true' : 'false');

            if (willOpen) {
                hideSearchResults();
                await loadNotifications();
            }
        };

        notificationButton.addEventListener('click', toggleNotifications);

        markAllButton.addEventListener('click', () => {
            const readIds = getReadIds();
            notifications.forEach(item => readIds.add(item.id));
            saveReadIds(readIds);
            renderNotifications();
        });

        document.addEventListener('click', event => {
            if (searchRoot && !searchRoot.contains(event.target)) {
                hideSearchResults();
            }

            if (!notificationArea.contains(event.target)) {
                notificationDropdown.classList.add('hidden');
                notificationButton.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                hideSearchResults();
                notificationDropdown.classList.add('hidden');
                notificationButton.setAttribute('aria-expanded', 'false');
            }
        });

        loadNotifications();
    });
</script>
