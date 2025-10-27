<x-app-layout>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                {{-- ID untuk memudahkan update judul halaman --}}
                <h5 class="card-header" id="pageCalendarTitle">Kalender Planning</h5>
                <div class="card-body">

                    <div class="mb-4 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                        <div class="order-1">
                            <a href="{{ route('planings.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ri ri-arrow-left-line icon-18px me-1"></i>
                                Kembali
                            </a>
                        </div>

                        <div class="d-flex flex-wrap gap-3 order-2 order-md-2 small">
                            <small class="d-flex align-items-center">
                                <span class="badge badge-dot bg-warning me-1"></span> Blm dihubungi
                            </small>
                            <small class="d-flex align-items-center">
                                <span class="badge badge-dot bg-primary me-1"></span> Sdh dihubungi
                            </small>
                            <small class="d-flex align-items-center">
                                <span class="badge badge-dot bg-orange me-1"></span> Pertimbangan
                            </small>
                            <small class="d-flex align-items-center">
                                <span class="badge badge-dot bg-success me-1"></span> Selesai
                            </small>
                        </div>

                    </div>

                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var pageTitleEl = document.getElementById('pageCalendarTitle');

            // Fungsi untuk mengupdate judul Halaman dengan bulan/tahun kalender
            function updatePageTitle(calendar) {
                var title = calendar.view.title;
                // FullCalendar sudah memberikan format "Oktober 2025" dll.
                pageTitleEl.textContent = 'Kalender Planning - ' + title;
            }

            // Fungsi untuk menentukan konfigurasi headerToolbar yang responsif
            function getHeaderToolbar() {
                // Sembunyikan 'title' di HP dan hanya tampilkan di desktop.
                var centerContent = (window.innerWidth < 768) ? '' : 'title';

                // Sederhanakan tombol view untuk HP: hanya Month dan List
                var rightContent = (window.innerWidth < 768) ? 'dayGridMonth,listWeek' : 'dayGridMonth,timeGridWeek,timeGridDay,listMonth';

                return {
                    left: 'prev,next today', // Tetap tampilkan tombol navigasi
                    center: centerContent, // Judul hanya di desktop
                    right: rightContent
                };
            }

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',

                // Gunakan fungsi responsif untuk headerToolbar
                headerToolbar: getHeaderToolbar(),

                events: '{{ route("planings.events") }}',
                eventClick: function(info) {
                    window.location.href = info.event.url;
                },

                // Tambahkan hook setelah render untuk update judul
                datesSet: function(info) {
                    updatePageTitle(calendar);
                },

                // Konfigurasi lainnya...
                eventDisplay: 'block',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                dayMaxEvents: 3,
                views: {
                    timeGrid: {
                        dayMaxEvents: 6
                    },
                    listWeek: {
                        buttonText: 'List'
                    }
                },
                locale: 'id',
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari',
                    list: 'List'
                },
                eventDidMount: function(info) {
                    if (info.event.extendedProps.description) {
                        info.el.setAttribute('title', info.event.extendedProps.description);
                    }
                }
            });

            calendar.render();
            // Panggil update judul pertama kali
            updatePageTitle(calendar);


            // Tambahkan event listener untuk merender ulang kalender ketika ukuran layar berubah
            window.addEventListener('resize', function() {
                var newToolbar = getHeaderToolbar();
                var currentToolbar = calendar.getOption('headerToolbar');

                // Hanya setOptions jika ada perubahan signifikan pada toolbar (misalnya, perpindahan dari HP ke Desktop)
                if (JSON.stringify(newToolbar) !== JSON.stringify(currentToolbar)) {
                    calendar.setOption('headerToolbar', newToolbar);
                }

                // Opsional: ganti view ke listWeek saat di HP untuk pengalaman yang lebih baik
                if (window.innerWidth < 768 && calendar.view.type !== 'dayGridMonth' && calendar.view.type !== 'listWeek') {
                    calendar.changeView('listWeek');
                } else if (window.innerWidth >= 768 && calendar.view.type === 'listWeek') {
                    // Kembali ke month view jika di desktop
                    calendar.changeView('dayGridMonth');
                }

                // Pastikan judul tetap terupdate
                updatePageTitle(calendar);
            });
        });
    </script>
</x-app-layout>
