<x-app-layout>
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">💍 Mahar & Seserahan</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMSModal">
                                <i class="icon-base ri ri-gift-line icon-18px me-1"></i>
                                Tambah Data Baru
                            </button>
                        </div>

                        <!-- Notifikasi Sukses -->
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

                        <!-- Tabel Data MS -->
                        <table class="table table-bordered" id="res-config">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ms as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge {{ $item->jenis == 'mahar' ? 'bg-label-warning' : 'bg-label-info' }}">
                                            {{ ucfirst($item->jenis) }}
                                        </span>
                                    </td>
                                    <td><strong>{{ $item->nama }}</strong></td>
                                    <td>
                                        @if($item->nominal)
                                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $item->status == 'Selesai' ? 'bg-label-success' : 'bg-label-warning' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($item->ket)
                                            <span class="text-truncate" title="{{ $item->ket }}">
                                                {{ Str::limit($item->ket, 30) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow shadow-none" data-bs-toggle="dropdown">
                                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Tombol Edit -->
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editMSModal"
                                                   data-id="{{ $item->id }}"
                                                   data-jenis="{{ $item->jenis }}"
                                                   data-nama="{{ $item->nama }}"
                                                   data-nominal="{{ $item->nominal }}"
                                                   data-status="{{ $item->status }}"
                                                   data-ket="{{ $item->ket }}">
                                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                                    Edit
                                                </a>
                                                <!-- Tombol Delete -->
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#deleteMSModal"
                                                   data-id="{{ $item->id }}"
                                                   data-nama="{{ $item->nama }}">
                                                    <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data mahar/seserahan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create MS Modal -->
    <div class="modal fade" id="createMSModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('ms.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mahar/Seserahan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-3">
                                <label for="jenis" class="form-label">Jenis <span class="text-danger">*</span></label>
                                <select id="jenis" name="jenis" class="form-select" required>
                                    <option value="">Pilih Jenis</option>
                                    <option value="mahar">Mahar</option>
                                    <option value="seserahan">Seserahan</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="nama" class="form-label">Nama Item <span class="text-danger">*</span></label>
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama item" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="nominal" class="form-label">Nominal (Opsional)</label>
                                <input type="number" id="nominal" name="nominal" class="form-control" placeholder="Masukkan nominal (tanpa titik/koma)">
                                <small class="text-muted">Contoh: 1000000 (untuk 1.000.000)</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select id="status" name="status" class="form-select" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="ket" class="form-label">Keterangan (Opsional)</label>
                                <textarea id="ket" name="ket" class="form-control" placeholder="Masukkan keterangan tambahan" rows="3"></textarea>
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
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit MS Modal -->
    <div class="modal fade" id="editMSModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editFormMS" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Mahar/Seserahan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-12 mb-3">
                                <label for="edit_jenis" class="form-label">Jenis <span class="text-danger">*</span></label>
                                <select id="edit_jenis" name="jenis" class="form-select" required>
                                    <option value="mahar">Mahar</option>
                                    <option value="seserahan">Seserahan</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_nama" class="form-label">Nama Item <span class="text-danger">*</span></label>
                                <input type="text" id="edit_nama" name="nama" class="form-control" placeholder="Masukkan nama item" required>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_nominal" class="form-label">Nominal (Opsional)</label>
                                <input type="number" id="edit_nominal" name="nominal" class="form-control" placeholder="Masukkan nominal (tanpa titik/koma)">
                                <small class="text-muted">Contoh: 1000000 (untuk 1.000.000)</small>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select id="edit_status" name="status" class="form-select" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="edit_ket" class="form-label">Keterangan (Opsional)</label>
                                <textarea id="edit_ket" name="ket" class="form-control" placeholder="Masukkan keterangan tambahan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete MS Modal -->
    <div class="modal fade" id="deleteMSModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="deleteFormMS" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data <strong id="deleteMSNama"></strong>?</p>
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
            const baseUrl = '/ms/';

            // Logic untuk Edit Modal
            $('#editMSModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var jenis = button.data('jenis');
                var nama = button.data('nama');
                var nominal = button.data('nominal');
                var status = button.data('status');
                var ket = button.data('ket');

                var modal = $(this);
                modal.find('#edit_jenis').val(jenis);
                modal.find('#edit_nama').val(nama);
                modal.find('#edit_nominal').val(nominal);
                modal.find('#edit_status').val(status);
                modal.find('#edit_ket').val(ket);

                modal.find('#editFormMS').attr('action', baseUrl + id);
            });

            // Logic untuk Delete Modal
            $('#deleteMSModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');

                var modal = $(this);
                modal.find('#deleteMSNama').text(nama);
                modal.find('#deleteFormMS').attr('action', baseUrl + id);
            });
        });
    </script>

</x-app-layout>
