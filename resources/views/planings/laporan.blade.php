<x-app-layout>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <h4 class="fw-bold py-3 mb-4">
                <i class="icon-base ri ri-bar-chart-box-line me-1"></i> Laporan Ringkas Planning
            </h4>

            <!-- Card stats tetap sama -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card shadow-sm border-start border-primary border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <div class="bg-label-primary p-2 rounded">
                                        <i class="icon-base ri ri-folder-chart-line icon-24px text-primary"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold d-block text-muted">Total Planning</span>
                                    <h3 class="card-title mb-0">{{ number_format($totalPlanning) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card shadow-sm border-start border-success border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <div class="bg-label-success p-2 rounded">
                                        <i class="icon-base ri ri-wallet-line icon-24px text-success"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold d-block text-muted">Total Budget</span>
                                    <h3 class="card-title mb-0">Rp {{ number_format($totalBudget, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card shadow-sm border-start border-warning border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <div class="bg-label-warning p-2 rounded">
                                        <i class="icon-base ri ri-check-double-line icon-24px text-warning"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold d-block text-muted">Progress Overall</span>
                                    <h3 class="card-title mb-0">{{ number_format($totalProgressPercentage, 1) }}%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card shadow-sm border-start border-info border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    <div class="bg-label-info p-2 rounded">
                                        <i class="icon-base ri ri-list-check icon-24px text-info"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold d-block text-muted">Total Kategori</span>
                                    <h3 class="card-title mb-0">{{ $laporanKategori->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-body py-3">
                    <h6 class="card-title mb-2"><i class="icon-base ri ri-information-line me-1 text-secondary"></i> Keterangan Progress Bar:</h6>
                    <div class="d-flex flex-wrap gap-4">
                        <small class="d-flex align-items-center">
                            <span class="badge badge-dot bg-success me-2"></span> Selesai: 100%
                        </small>
                        <small class="d-flex align-items-center">
                            <span class="badge badge-dot bg-primary me-2"></span> Sudah dihubungi: 50%
                        </small>
                        <small class="d-flex align-items-center">
                            <span class="badge badge-dot bg-warning me-2"></span> Pertimbangan: 25%
                        </small>
                        <small class="d-flex align-items-center">
                            <span class="badge badge-dot bg-secondary me-2"></span> Belum dihubungi: 0%
                        </small>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <h5 class="card-header d-flex justify-content-between align-items-center">
                    <span>Laporan Progress Planning per Kategori</span>
                    <button onclick="window.print()" class="btn btn-primary btn-sm">
                        <i class="icon-base ri ri-printer-line icon-18px me-1"></i>
                        Cetak Laporan
                    </button>
                </h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped table-hover" id="laporan-table">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th style="width: 20%">Nama Kategori</th>
                                    <th style="width: 12%" class="text-center">Jml. Planning</th>
                                    <th style="width: 15%" class="text-center">Budget Kategori</th>
                                    <th style="width: 28%">Progress (Overall)</th>
                                    <th style="width: 20%">Status Breakdown</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporanKategori as $kategori)
                                @php
                                $statusCounts = $kategori->planings->groupBy('status')->map->count();
                                $selesai = $statusCounts['Selesai'] ?? 0;
                                $sudah_dihubungi = $statusCounts['Sudah dihubungi'] ?? 0;
                                $pertimbangan = $statusCounts['Pertimbangan'] ?? 0;
                                $belum_dihubungi = $statusCounts['Belum dihubungi'] ?? 0;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-bold">
                                        <i class="icon-base ri ri-folder-fill icon-18px text-info me-2"></i>
                                        {{ $kategori->nama }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $kategori->planings_count }}</span>
                                    </td>
                                    <td class="text-center fw-bold text-success">
                                        Rp {{ number_format($kategori->total_budget, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-3" style="height: 10px;">
                                                <div class="progress-bar
                                                    @if($kategori->progress_percentage >= 80) bg-success
                                                    @elseif($kategori->progress_percentage >= 50) bg-primary
                                                    @elseif($kategori->progress_percentage >= 25) bg-warning
                                                    @else bg-secondary @endif" role="progressbar"
                                                    style="width: {{ $kategori->progress_percentage }}%;"
                                                    aria-valuenow="{{ $kategori->progress_percentage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                            <span
                                                class="fw-bold small text-nowrap
                                                @if($kategori->progress_percentage >= 80) text-success
                                                @elseif($kategori->progress_percentage >= 50) text-primary
                                                @elseif($kategori->progress_percentage >= 25) text-warning
                                                @else text-secondary @endif">
                                                {{ number_format($kategori->progress_percentage, 1) }}%
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @if($selesai > 0)
                                            <span class="badge bg-label-success" data-bs-toggle="tooltip" title="Selesai: {{ $selesai }}">
                                                <i class="ri-check-line me-1"></i>{{ $selesai }}
                                            </span>
                                            @endif
                                            @if($sudah_dihubungi > 0)
                                            <span class="badge bg-label-primary" data-bs-toggle="tooltip" title="Sudah dihubungi: {{ $sudah_dihubungi }}">
                                                <i class="ri-phone-line me-1"></i>{{ $sudah_dihubungi }}
                                            </span>
                                            @endif
                                            @if($pertimbangan > 0)
                                            <span class="badge bg-label-warning" data-bs-toggle="tooltip" title="Pertimbangan: {{ $pertimbangan }}">
                                                <i class="ri-time-line me-1"></i>{{ $pertimbangan }}
                                            </span>
                                            @endif
                                            @if($belum_dihubungi > 0)
                                            <span class="badge bg-label-secondary" data-bs-toggle="tooltip" title="Belum dihubungi: {{ $belum_dihubungi }}">
                                                <i class="ri-close-circle-line me-1"></i>{{ $belum_dihubungi }}
                                            </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-info fw-bold">
                                    <td colspan="2">TOTAL KESELURUHAN</td>
                                    <td class="text-center">{{ $totalPlanning }}</td>
                                    <td class="text-center text-success">Rp {{ number_format($totalBudget, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress w-100 me-3" style="height: 10px;">
                                                <div class="progress-bar
                                                    @if($totalProgressPercentage >= 80) bg-success
                                                    @elseif($totalProgressPercentage >= 50) bg-primary
                                                    @elseif($totalProgressPercentage >= 25) bg-warning
                                                    @else bg-secondary @endif" role="progressbar"
                                                    style="width: {{ $totalProgressPercentage }}%;"
                                                    aria-valuenow="{{ $totalProgressPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                            <span
                                                class="fw-bold small text-nowrap
                                                @if($totalProgressPercentage >= 80) text-success
                                                @elseif($totalProgressPercentage >= 50) text-primary
                                                @elseif($totalProgressPercentage >= 25) text-warning
                                                @else text-secondary @endif">
                                                {{ number_format($totalProgressPercentage, 1) }}%
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-success" data-bs-toggle="tooltip" title="Total Selesai">
                                                <i class="ri-check-line me-1"></i>{{ $planingPerStatus['Selesai'] ?? 0 }}
                                            </span>
                                            <span class="badge bg-primary" data-bs-toggle="tooltip" title="Total Sudah dihubungi">
                                                <i class="ri-phone-line me-1"></i>{{ $planingPerStatus['Sudah dihubungi'] ?? 0 }}
                                            </span>
                                            <span class="badge bg-warning" data-bs-toggle="tooltip" title="Total Pertimbangan">
                                                <i class="ri-time-line me-1"></i>{{ $planingPerStatus['Pertimbangan'] ?? 0 }}
                                            </span>
                                            <span class="badge bg-secondary" data-bs-toggle="tooltip" title="Total Belum dihubungi">
                                                <i class="ri-close-circle-line me-1"></i>{{ $planingPerStatus['Belum dihubungi'] ?? 0 }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambahkan script ini untuk mengaktifkan Tooltip Bootstrap --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
</x-app-layout>
