<x-app-layout>
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Planning</h5>
                        <div>
                            <a href="{{ route('planings.calendar') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="icon-base ri ri-arrow-left-line icon-18px me-1"></i>
                                Kembali ke Kalender
                            </a>
                            <a href="{{ route('planings.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="icon-base ri ri-list-check icon-18px me-1"></i>
                                Data Planning
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Judul:</strong> {{ $planing->judul }}</p>
                            <p><strong>Kategori:</strong> {{ $planing->kategori->nama }}</p>
                            <p><strong>Tanggal Kontak:</strong> {{ \Carbon\Carbon::parse($planing->tgl_kontak)->format('d/m/Y') }}</p>
                            <p><strong>Status:</strong>
                                @php
                                    $statusClass = [
                                        'Belum dihubungi' => 'warning',
                                        'Sudah dihubungi' => 'primary',
                                        'Pertimbangan' => 'orange',
                                        'Selesai' => 'success'
                                    ][$planing->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">
                                    {{ $planing->status }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Budget:</strong> Rp {{ number_format($planing->budget, 0, ',', '.') }}</p>
                            <p><strong>Alamat:</strong> {{ $planing->alamat }}</p>
                            <p><strong>Dibuat:</strong> {{ $planing->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Diupdate:</strong> {{ $planing->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <p><strong>Deskripsi:</strong></p>
                            <div class="border rounded p-3 bg-light">
                                {{ $planing->deskripsi }}
                            </div>
                        </div>
                    </div>
                    @if($planing->foto)
                    <div class="row mt-3">
                        <div class="col-12">
                            <p><strong>Foto:</strong></p>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode('|', $planing->foto) as $fotoPath)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $fotoPath) }}"
                                         alt="Foto Planning"
                                         class="img-thumbnail"
                                         style="height: 150px; width: auto; cursor: pointer;"
                                         onclick="openImageModal('{{ asset('storage/' . $fotoPath) }}')">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

    <!-- Modal untuk preview gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(src) {
            document.getElementById('modalImage').src = src;
            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>

</x-app-layout>
