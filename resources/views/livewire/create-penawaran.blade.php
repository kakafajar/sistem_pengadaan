<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
        <h4 class="card-title fw-bold text-dark mb-0 flex align-items-center">
            <i class="bi bi-pencil-square me-2 text-warning"></i> Form Input Penawaran
        </h4>
    </div>

    <div class="card-body p-4">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form wire:submit.prevent="simpan">
            <div class="row g-4">
                
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">No. Surat</label>
                        <input wire:model.live="no_surat" type="text" class="form-control form-control-lg text-uppercase" placeholder="Contoh: 304/GABAH/02/2026">
                        @error('no_surat') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Mitra</label>
                        <input wire:model="mitra" type="text" class="form-control bg-light" placeholder="Nama PT/CV">
                        @error('mitra') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary">Petani</label>
                        <input wire:model="petani" type="text" class="form-control bg-light">
                    </div>
                </div>

                <!-- Right Column (Yellow Box) -->
                <div class="col-md-6">
                    <div class="p-4 rounded-3 bg-warning-subtle border border-warning-subtle h-100">
                        <div class="row g-3 mb-3">
                            <div class="col-4">
                                <label class="form-label fw-bold small text-secondary">Komoditi</label>
                                <input wire:model="komoditi" type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label class="form-label fw-bold small text-secondary">Kualitas</label>
                                <input wire:model="kualitas" type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label class="form-label fw-bold small text-secondary">Kemasan</label>
                                <input wire:model="kemasan" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold text-secondary">Tanggal</label>
                                <input wire:model="tgl_penawaran" type="date" class="form-control">
                                 @error('tgl_penawaran') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold text-secondary">Kuantum (Kg)</label>
                                <input wire:model.live="kuantum_kg" type="number" class="form-control text-end fw-bold">
                                 @error('kuantum_kg') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Harga Satuan (Rp)</label>
                            <input wire:model.live="harga" type="number" class="form-control text-end fw-bold text-primary">
                             @error('harga') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="form-label fw-bold text-secondary">Total Nominal (Otomatis)</label>
                            <div class="form-control text-end fw-black fs-4 bg-white border-warning text-dark">
                                Rp {{ number_format($nominal, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top text-end">
                <button type="submit" class="btn btn-primary btn-lg shadow fw-bold px-5">
                    <i class="bi bi-save me-2"></i> SIMPAN PENAWARAN
                </button>
            </div>
        </form>
    </div>
</div>