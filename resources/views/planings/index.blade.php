<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Data Perencanaan (Planing)</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <div class="mb-4">
                            <!-- Tombol Tambah Planing -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createPlaningModal">
                                <i class="icon-base ri ri-add-line icon-18px me-1"></i>
                                Tambah Rencana Baru
                            </button>
                        </div>

                        <!-- Notifikasi Sukses dari Session -->
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

                        <!-- Tabel Data Planing -->
                        <table class="table table-bordered" id="res-config">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Budget</th>
                                    <th>Tgl Kontak</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($planings as $planing)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $planing->judul }}</strong></td>
                                    <td>
                                        <span class="badge bg-label-info">{{ $planing->kategori->nama }}</span>
                                    </td>
                                    <td>Rp {{ number_format($planing->budget, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($planing->tgl_kontak)->format('d/m/Y') }}</td>
                                    <td>
                                        @php
                                        $badgeClass = match($planing->status) {
                                        'Sudah dihubungi' => 'bg-label-success',
                                        'Belum dihubungi' => 'bg-label-warning',
                                        'Pertimbangan' => 'bg-label-info',
                                        'Selesai' => 'bg-label-primary',
                                        default => 'bg-label-secondary'
                                        };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $planing->status }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow shadow-none"
                                                data-bs-toggle="dropdown">
                                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <!-- Tombol Show -->
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#showPlaningModal"
                                                    data-id="{{ $planing->id }}" data-judul="{{ $planing->judul }}"
                                                    data-kategori="{{ $planing->kategori->nama }}"
                                                    data-deskripsi="{{ $planing->deskripsi }}"
                                                    data-alamat="{{ $planing->alamat }}"
                                                    data-budget="{{ number_format($planing->budget, 0, ',', '.') }}"
                                                    data-tgl-kontak="{{ \Carbon\Carbon::parse($planing->tgl_kontak)->format('d/m/Y') }}"
                                                    data-status="{{ $planing->status }}"
                                                    data-foto="{{ $planing->foto }}">
                                                    <i class="icon-base ri ri-eye-line icon-18px me-1"></i> Detail
                                                </a>
                                                <!-- Tombol Edit -->
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#editPlaningModal"
                                                    data-id="{{ $planing->id }}" data-judul="{{ $planing->judul }}"
                                                    data-kategori-id="{{ $planing->kategori_id }}"
                                                    data-deskripsi="{{ $planing->deskripsi }}"
                                                    data-alamat="{{ $planing->alamat }}"
                                                    data-budget="{{ $planing->budget }}"
                                                    data-tgl-kontak="{{ $planing->tgl_kontak }}"
                                                    data-status="{{ $planing->status }}"
                                                    data-foto="{{ $planing->foto }}">
                                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                                    Edit
                                                </a>
                                                <!-- Tombol Delete -->
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#deletePlaningModal"
                                                    data-id="{{ $planing->id }}" data-judul="{{ $planing->judul }}">
                                                    <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data perencanaan (planing).</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>

    <!-- Create Planing Modal -->
    <div class="modal fade" id="createPlaningModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('planings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Rencana Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="judul" name="judul" class="form-control"
                                        placeholder="Masukkan Judul Rencana" required value="{{ old('judul') }}" />
                                    <label for="judul">Judul</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select id="kategori_id" name="kategori_id" class="form-select" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id')==$kategori->id ?
                                            'selected' : '' }}>{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="kategori_id">Kategori</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="budget" name="budget" class="form-control" placeholder="0"
                                        required value="{{ old('budget') }}" />
                                    <label for="budget">Budget (Rp)</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" id="tgl_kontak" name="tgl_kontak" class="form-control" required
                                        value="{{ old('tgl_kontak') }}" />
                                    <label for="tgl_kontak">Tanggal Kontak</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select id="status" name="status" class="form-select" required>
                                        <option value="Belum dihubungi" {{ old('status')=='Belum dihubungi' ? 'selected'
                                            : '' }}>Belum dihubungi</option>
                                        <option value="Sudah dihubungi" {{ old('status')=='Sudah dihubungi' ? 'selected'
                                            : '' }}>Sudah dihubungi</option>
                                        <option value="Pertimbangan" {{ old('status')=='Pertimbangan' ? 'selected' : ''
                                            }}>Pertimbangan</option>
                                        <option value="Selesai" {{ old('status')=='Selesai' ? 'selected' : '' }}>Selesai
                                        </option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto" class="form-label">Foto (Opsional, bisa pilih lebih dari satu)</label>
                                <input class="form-control" type="file" id="foto" name="foto[]" multiple>
                                <small class="text-muted">Maksimal 5 foto, format: jpeg, png, jpg, gif, svg. Maks 2MB
                                    per foto.</small>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-12 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" id="deskripsi" name="deskripsi"
                                        placeholder="Tulis deskripsi rencana di sini..."
                                        required>{{ old('deskripsi') }}</textarea>
                                    <label for="deskripsi">Deskripsi</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" id="alamat" name="alamat"
                                        placeholder="Tulis alamat di sini..." required>{{ old('alamat') }}</textarea>
                                    <label for="alamat">Alamat</label>
                                </div>
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
                        <button type="submit" class="btn btn-primary">Simpan Rencana</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Show Planing Modal -->
    <div class="modal fade" id="showPlaningModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Rencana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Judul:</strong>
                            <p id="show_judul" class="mt-1"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Kategori:</strong>
                            <p id="show_kategori" class="mt-1"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Budget:</strong>
                            <p id="show_budget" class="mt-1"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Kontak:</strong>
                            <p id="show_tgl_kontak" class="mt-1"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong>
                            <p id="show_status" class="mt-1"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Deskripsi:</strong>
                            <p id="show_deskripsi" class="mt-1"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Alamat:</strong>
                            <p id="show_alamat" class="mt-1"></p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Foto:</strong>
                            <div id="show_fotos" class="mt-2 d-flex flex-wrap gap-2"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Planing Modal -->
    <div class="modal fade" id="editPlaningModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="editFormPlaning" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Rencana</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="edit_judul" name="judul" class="form-control"
                                        placeholder="Masukkan Judul Rencana" required />
                                    <label for="edit_judul">Judul</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select id="edit_kategori_id" name="kategori_id" class="form-select" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label for="edit_kategori_id">Kategori</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" id="edit_budget" name="budget" class="form-control"
                                        placeholder="0" required />
                                    <label for="edit_budget">Budget (Rp)</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="date" id="edit_tgl_kontak" name="tgl_kontak" class="form-control"
                                        required />
                                    <label for="edit_tgl_kontak">Tanggal Kontak</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <select id="edit_status" name="status" class="form-select" required>
                                        <option value="Belum dihubungi">Belum dihubungi</option>
                                        <option value="Sudah dihubungi">Sudah dihubungi</option>
                                        <option value="Pertimbangan">Pertimbangan</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    <label for="edit_status">Status</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_foto" class="form-label">Tambah Foto Baru (Opsional)</label>
                                <input class="form-control" type="file" id="edit_foto" name="foto[]" multiple>
                                <small class="text-muted">Maksimal 5 foto, format: jpeg, png, jpg, gif, svg. Maks 2MB
                                    per foto.</small>
                                <div id="current_fotos" class="mt-2"></div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-12 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" id="edit_deskripsi" name="deskripsi"
                                        placeholder="Tulis deskripsi rencana di sini..." required></textarea>
                                    <label for="edit_deskripsi">Deskripsi</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <textarea class="form-control h-px-100" id="edit_alamat" name="alamat"
                                        placeholder="Tulis alamat di sini..." required></textarea>
                                    <label for="edit_alamat">Alamat</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update Rencana</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Planing Modal -->
    <div class="modal fade" id="deletePlaningModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="deleteFormPlaning" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Rencana</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus rencana berjudul <strong id="deletePlaningJudul"></strong>?
                        </p>
                        <p class="text-danger">Aksi ini akan menghapus data dan foto terkait secara permanen.</p>
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
            const baseUrl = '/planings/';

            // Fungsi untuk memisahkan string foto menjadi array
            function parseFotoString(fotoString) {
                if (!fotoString) return [];
                return fotoString.split('|').filter(foto => foto.trim() !== '');
            }

            // Logic untuk Show Modal
            $('#showPlaningModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var judul = button.data('judul');
                var kategori = button.data('kategori');
                var deskripsi = button.data('deskripsi');
                var alamat = button.data('alamat');
                var budget = button.data('budget');
                var tglKontak = button.data('tgl-kontak');
                var status = button.data('status');
                var fotoString = button.data('foto');

                var modal = $(this);
                modal.find('#show_judul').text(judul);
                modal.find('#show_kategori').text(kategori);
                modal.find('#show_deskripsi').text(deskripsi);
                modal.find('#show_alamat').text(alamat);
                modal.find('#show_budget').text('Rp ' + budget);
                modal.find('#show_tgl_kontak').text(tglKontak);
                modal.find('#show_status').text(status);

                // Tampilkan foto
                var fotosContainer = modal.find('#show_fotos');
                fotosContainer.empty();

                var fotos = parseFotoString(fotoString);
                if (fotos.length > 0) {
                    fotos.forEach(function(foto) {
                        var imgUrl = '/storage/' + foto;
                        fotosContainer.append(
                            '<div class="photo-thumbnail">' +
                                '<img src="' + imgUrl + '" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" alt="Foto">' +
                            '</div>'
                        );
                    });
                } else {
                    fotosContainer.html('<p class="text-muted">Tidak ada foto</p>');
                }
            });

            // Logic untuk Edit Modal
            $('#editPlaningModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var judul = button.data('judul');
                var kategoriId = button.data('kategori-id');
                var deskripsi = button.data('deskripsi');
                var alamat = button.data('alamat');
                var budget = button.data('budget');
                var tglKontak = button.data('tgl-kontak');
                var status = button.data('status');
                var fotoString = button.data('foto');

                var modal = $(this);
                modal.find('#edit_judul').val(judul);
                modal.find('#edit_kategori_id').val(kategoriId);
                modal.find('#edit_deskripsi').val(deskripsi);
                modal.find('#edit_alamat').val(alamat);
                modal.find('#edit_budget').val(budget);
                modal.find('#edit_tgl_kontak').val(tglKontak.substring(0, 10));
                modal.find('#edit_status').val(status);

                // Tampilkan foto yang sudah ada
                var currentFotosContainer = modal.find('#current_fotos');
                currentFotosContainer.empty();

                var fotos = parseFotoString(fotoString);
                if (fotos.length > 0) {
                    currentFotosContainer.append('<p class="mb-2"><strong>Foto Saat Ini:</strong></p>');
                    var fotosList = $('<div class="d-flex flex-wrap gap-2"></div>');

                    fotos.forEach(function(foto, index) {
                        var imgUrl = '/storage/' + foto;
                        fotosList.append(
                            '<div class="position-relative">' +
                                '<img src="' + imgUrl + '" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;" alt="Foto ' + (index + 1) + '">' +
                                '<input type="hidden" name="existing_fotos[]" value="' + foto + '">' +
                            '</div>'
                        );
                    });

                    currentFotosContainer.append(fotosList);
                    currentFotosContainer.append('<p class="text-muted mt-2">Foto baru akan ditambahkan ke foto yang sudah ada.</p>');
                }

                modal.find('#editFormPlaning').attr('action', baseUrl + id);
            });

            // Logic untuk Delete Modal
            $('#deletePlaningModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var judul = button.data('judul');

                var modal = $(this);
                modal.find('#deletePlaningJudul').text(judul);
                modal.find('#deleteFormPlaning').attr('action', baseUrl + id);
            });
        });
    </script>
</x-app-layout>
