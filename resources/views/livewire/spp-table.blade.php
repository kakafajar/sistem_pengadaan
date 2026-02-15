<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
            <h4 class="card-title fw-bold text-dark mb-0">
                <i class="bi bi-table me-2 text-warning"></i> Data SPP & PO
            </h4>
            <div>
                <button wire:click="$refresh" class="btn btn-light btn-sm me-2 rounded-pill border">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </button>
                <a href="/" class="btn btn-outline-warning btn-sm rounded-pill fw-bold text-dark">
                    <i class="bi bi-plus-lg"></i> Tambah Penawaran
                </a>
            </div>
        </div>

        <div class="card-body p-4">
            
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <strong>Berhasil!</strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($isEditing)
            <div class="mb-4 p-4 rounded-3 bg-warning-subtle border border-warning-subtle shadow-sm">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="bi bi-pencil-square me-1"></i> Lengkapi Data PO
                </h6>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">No PO</label>
                        <input wire:model="no_po" type="text" class="form-control form-control-sm border-warning" placeholder="Nomor PO...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Tgl PO (Angka)</label>
                        <input wire:model="tgl_po" type="number" class="form-control form-control-sm border-warning" placeholder="Contoh: 14">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">Bulan PO</label>
                        <input wire:model="bulan_po" type="text" class="form-control form-control-sm border-warning" placeholder="Contoh: Februari">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold text-secondary">PIC</label>
                        <input wire:model="pic" type="text" class="form-control form-control-sm border-warning">
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2 justify-content-end">
                    <button wire:click="cancelEdit" class="btn btn-secondary btn-sm px-4">Batal</button>
                    <button wire:click="update" class="btn btn-primary btn-sm px-4 fw-bold">Simpan PO</button>
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-3 py-3">No. Surat / Mitra</th>
                            <th scope="col" class="px-3 py-3 text-end">Kuantum (Kg)</th>
                            <th scope="col" class="px-3 py-3 text-center">Status PO</th>
                            <th scope="col" class="px-3 py-3 text-center">Tgl PO</th>
                            <th scope="col" class="px-3 py-3">PIC</th>
                            <th scope="col" class="px-3 py-3 text-end">Total Bayar</th>
                            <th scope="col" class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($spps as $spp)
                        <tr>
                            <td class="px-3">
                                <div class="fw-bold text-dark">{{ $spp->mitra_kerja }}</div>
                                <small class="text-primary d-block font-monospace mt-1">{{ $spp->no_surat ?? '-' }}</small>
                                <small class="text-muted fst-italic" style="font-size: 0.75rem;">Petani: {{ $spp->petani ?? '-' }}</small>
                            </td>

                            <td class="px-3 text-end fw-medium font-monospace">
                                {{ number_format($spp->kuantum) }}
                            </td>
                            
                            <td class="px-3 text-center">
                                @if(!$spp->no_po)
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Belum Ada</span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">{{ $spp->no_po }}</span>
                                @endif
                            </td>

                            <td class="px-3 text-center text-muted small">
                                {{ $spp->tgl_po ? $spp->tgl_po . ' ' . $spp->bulan_po : '-' }}
                            </td>

                            <td class="px-3 text-muted small">{{ $spp->pic ?? '-' }}</td>
                            
                            <td class="px-3 text-end fw-bold text-dark">
                                Rp {{ number_format($spp->total_bayar, 0, ',', '.') }}
                            </td>
                            
                            <td class="px-3 text-center">
                                @if(!$spp->no_po)
                                    <button wire:click="edit({{ $spp->id }})" class="btn btn-warning btn-sm text-dark shadow-sm fw-bold" style="font-size: 0.75rem;">
                                        <i class="bi bi-pencil"></i> Input PO
                                    </button>
                                @else
                                    <div class="d-flex flex-col gap-1 justify-content-center">
                                        <button class="btn btn-success btn-sm shadow-sm w-100" style="font-size: 0.75rem;">
                                            <i class="bi bi-printer me-1"></i> Cetak
                                        </button>
                                        <a href="#" wire:click.prevent="edit({{ $spp->id }})" class="text-decoration-none small text-secondary">
                                            Ubah Data
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data penawaran.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>