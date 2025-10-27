<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Data Kategori</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <div class="mb-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createKategoriModal">
                                <i class="icon-base ri ri-add-line icon-18px me-1"></i>
                                Tambah Kategori
                            </button>
                        </div>

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
                                    <th>Nama Kategori</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategoris as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <i class="icon-base ri ri-calendar-event-line icon-22px text-primary me-3"></i>
                                        <span>{{ $kategori->nama }}</span>
                                    </td>
                                    <td>{{ $kategori->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow shadow-none" data-bs-toggle="dropdown">
                                                <i class="icon-base ri ri-more-2-line icon-18px"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editKategoriModal"
                                                   data-id="{{ $kategori->id }}"
                                                   data-nama="{{ $kategori->nama }}">
                                                    <i class="icon-base ri ri-pencil-line icon-18px me-1"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#deleteKategoriModal"
                                                   data-id="{{ $kategori->id }}"
                                                   data-nama="{{ $kategori->nama }}">
                                                    <i class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>

    <!-- Create Kategori Modal -->
    <div class="modal fade" id="createKategoriModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('kategoris.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Kategori Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama kategori" required />
                                    <label for="nama">Nama Kategori</label>
                                </div>
                                @error('nama')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Kategori Modal -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalTitle">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-6 mt-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="edit_nama" name="nama" class="form-control" placeholder="Masukkan nama kategori" required />
                                    <label for="edit_nama">Nama Kategori</label>
                                </div>
                                @error('nama')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Kategori Modal -->
    <div class="modal fade" id="deleteKategoriModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalTitle">Hapus Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus kategori <strong id="deleteKategoriName"></strong>?</p>
                        <p class="text-danger">Data yang dihapus tidak dapat dikembalikan!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script untuk modal edit
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Modal
            $('#editKategoriModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');

                var modal = $(this);
                modal.find('#edit_nama').val(nama);
                modal.find('#editForm').attr('action', '/kategoris/' + id);
            });

            // Delete Modal
            $('#deleteKategoriModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');

                var modal = $(this);
                modal.find('#deleteKategoriName').text(nama);
                modal.find('#deleteForm').attr('action', '/kategoris/' + id);
            });
        });
    </script>
</x-app-layout>
