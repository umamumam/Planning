<x-app-layout>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row mb-4">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card bg-label-primary shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    {{-- Icon untuk Tamu Umam (laki-laki) --}}
                                    <i class="icon-base ri ri-men-line icon-22px text-primary"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Tamu Umam</h6>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0" id="countUmam">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card bg-label-info shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar flex-shrink-0 me-3">
                                    {{-- Icon untuk Tamu Indah (perempuan) --}}
                                    <i class="icon-base ri ri-women-line icon-22px text-info"></i>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Tamu Indah</h6>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div class="user-progress">
                                        <h6 class="mb-0" id="countIndah">0</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div class="card">
                <h5 class="card-header">📋 Daftar Tamu</h5>
                <div class="card-body">

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="filterTamu" class="form-label">Filter Tamu</label>
                            <select id="filterTamu" class="form-select">
                                <option value="all">Semua Tamu</option>
                                <option value="Tamu Umam">Tamu Umam</option>
                                <option value="Tamu Indah">Tamu Indah</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="filterStatus" class="form-label">Filter Status</label>
                            <select id="filterStatus" class="form-select">
                                <option value="all">Semua Status</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createTamuModal">
                                <i class="icon-base ri ri-user-add-line icon-18px me-1"></i>
                                Tambah Tamu Baru
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">

                        @if(session('success'))
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil!",
                                    text: "{{ session('success') }}",
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            });
                        </script>
                        @endif

                        <table class="table table-bordered" id="res-config">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tamu</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tamuTableBody">
                                @forelse($tamus as $tamu)
                                <tr
                                    data-tamu="{{ $tamu->tamu }}"
                                    data-status="{{ $tamu->status }}"
                                    data-nominal="{{ $tamu->nominal ?? 0 }}"
                                >
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge {{ $tamu->tamu == 'Tamu Umam' ? 'bg-label-primary' : 'bg-label-info' }}">
                                            {{ $tamu->tamu }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $tamu->nama }}</strong></td>
                                    <td>
                                        @if($tamu->nominal)
                                            Rp {{ number_format($tamu->nominal, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $tamu->status == 'Selesai' ? 'bg-label-success' : 'bg-label-warning' }}">
                                            {{ $tamu->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow shadow-none" data-bs-toggle="dropdown">
                                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editTamuModal"
                                                    data-id="{{ $tamu->id }}"
                                                    data-tamu="{{ $tamu->tamu }}"
                                                    data-nama="{{ $tamu->nama }}"
                                                    data-nominal="{{ $tamu->nominal }}"
                                                    data-status="{{ $tamu->status }}">
                                                     <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                                     Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteTamuModal"
                                                    data-id="{{ $tamu->id }}"
                                                    data-nama="{{ $tamu->nama }}">
                                                     <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                                     Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr id="noDataRow">
                                    <td colspan="6" class="text-center">Belum ada data tamu.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createTamuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('tamus.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tamu Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-3">
                                <label for="tamu" class="form-label">Jenis Tamu <span class="text-danger">*</span></label>
                                <select id="tamu" name="tamu" class="form-select" required>
                                    <option value="">Pilih Jenis Tamu</option>
                                    <option value="Tamu Umam">Tamu Umam</option>
                                    <option value="Tamu Indah">Tamu Indah</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="nama" class="form-label">Nama Tamu <span class="text-danger">*</span></label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama tamu" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="nominal" class="form-label">Nominal (Opsional)</label>
                                <input type="number" id="nominal" name="nominal" class="form-control" placeholder="Masukkan nominal (tanpa titik/koma)">
                                <small class="text-muted">Contoh: 1000000 (untuk 1.000.000)</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="status" class="form-label">Status Pengembalian <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                                <small class="text-muted">Status pengembalian dana/barang</small>
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Tamu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editTamuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editFormTamu" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Tamu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-3">
                                <label for="edit_tamu" class="form-label">Jenis Tamu <span class="text-danger">*</span></label>
                                <select id="edit_tamu" name="tamu" class="form-select" required>
                                    <option value="Tamu Umam">Tamu Umam</option>
                                    <option value="Tamu Indah">Tamu Indah</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_nama" class="form-label">Nama Tamu <span class="text-danger">*</span></label>
                                <input type="text" id="edit_nama" name="nama" class="form-control" placeholder="Masukkan nama tamu" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_nominal" class="form-label">Nominal (Opsional)</label>
                                <input type="number" id="edit_nominal" name="nominal" class="form-control" placeholder="Masukkan nominal (tanpa titik/koma)">
                                <small class="text-muted">Contoh: 1000000 (untuk 1.000.000)</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_status" class="form-label">Status Pengembalian <span class="text-danger">*</span></label>
                                <select id="edit_status" name="status" class="form-select" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                                <small class="text-muted">Status pengembalian dana/barang</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update Tamu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteTamuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="deleteFormTamu" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data Tamu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data tamu <strong id="deleteTamuNama"></strong>?</p>
                        <p class="text-danger">Aksi ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const baseUrl = '/tamus/';
            const filterTamu = document.getElementById('filterTamu');
            const filterStatus = document.getElementById('filterStatus');
            const tableBody = document.getElementById('tamuTableBody');
            const tableRows = tableBody.getElementsByTagName('tr');

            // Ambil semua data tamu (semua baris)
            const allTamus = Array.from(tableRows).filter(row => row.dataset.tamu); // Filter untuk memastikan hanya baris data

            // --- FUNGSI UTAMA: FILTER DAN UPDATE HITUNGAN ---
            function applyFilterAndRecount() {
                const tamuValue = filterTamu.value;
                const statusValue = filterStatus.value;
                let umamCount = 0;
                let indahCount = 0;
                let visibleRowCount = 0;

                // Sembunyikan semua baris terlebih dahulu
                allTamus.forEach(row => row.style.display = 'none');

                // Cari baris "Belum ada data" jika ada dan sembunyikan
                const noDataRow = document.getElementById('noDataRow');
                if (noDataRow) {
                    noDataRow.style.display = 'none';
                }

                // Hitung ulang dan tampilkan baris yang sesuai
                allTamus.forEach(row => {
                    const rowTamu = row.dataset.tamu;
                    const rowStatus = row.dataset.status;

                    // Hitung total untuk kartu di atas
                    if (rowTamu === 'Tamu Umam') {
                        umamCount++;
                    } else if (rowTamu === 'Tamu Indah') {
                        indahCount++;
                    }

                    // Tentukan apakah baris harus ditampilkan (filter)
                    const tamuMatch = (tamuValue === 'all' || rowTamu === tamuValue);
                    const statusMatch = (statusValue === 'all' || rowStatus === statusValue);

                    if (tamuMatch && statusMatch) {
                        row.style.display = '';
                        visibleRowCount++;
                    }
                });

                // Update hitungan di kartu atas
                document.getElementById('countUmam').textContent = umamCount;
                document.getElementById('countIndah').textContent = indahCount;

                // Tampilkan pesan "Belum ada data" jika tidak ada baris yang terlihat
                if (visibleRowCount === 0 && allTamus.length > 0) {
                    // Buat baris "Belum ada data" jika belum ada
                    let tempNoDataRow = document.getElementById('filteredNoDataRow');
                    if (!tempNoDataRow) {
                        tempNoDataRow = document.createElement('tr');
                        tempNoDataRow.id = 'filteredNoDataRow';
                        tempNoDataRow.innerHTML = '<td colspan="6" class="text-center">Tidak ada data tamu yang cocok dengan filter.</td>';
                        tableBody.appendChild(tempNoDataRow);
                    }
                    tempNoDataRow.style.display = '';
                } else if (document.getElementById('filteredNoDataRow')) {
                    document.getElementById('filteredNoDataRow').style.display = 'none';
                }
            }

            // Jalankan hitungan dan filter saat halaman dimuat
            applyFilterAndRecount();

            // Tambahkan event listener untuk filter
            filterTamu.addEventListener('change', applyFilterAndRecount);
            filterStatus.addEventListener('change', applyFilterAndRecount);

            // --- LOGIC MODAL (TIDAK BERUBAH) ---

            // Logic untuk Edit Modal
            $('#editTamuModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var tamu = button.data('tamu');
                var nama = button.data('nama');
                var nominal = button.data('nominal');
                var status = button.data('status');

                var modal = $(this);
                modal.find('#edit_tamu').val(tamu);
                modal.find('#edit_nama').val(nama);
                modal.find('#edit_nominal').val(nominal);
                modal.find('#edit_status').val(status);

                modal.find('#editFormTamu').attr('action', baseUrl + id);
            });

            // Logic untuk Delete Modal
            $('#deleteTamuModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');

                var modal = $(this);
                modal.find('#deleteTamuNama').text(nama);
                modal.find('#deleteFormTamu').attr('action', baseUrl + id);
            });
        });
    </script>
</x-app-layout>
