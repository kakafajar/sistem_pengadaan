<div class="container mt-4">
    <div class="card border-0 shadow-sm">
        
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
            <h4 class="card-title fw-bold text-dark mb-0">
                <i class="bi bi-person-lines-fill me-2 text-warning"></i> Data Rekening Mitra
            </h4>
        </div>

        <div class="card-body p-4">
            
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <strong>Berhasil!</strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4 p-4 rounded-3 bg-light border shadow-sm">
                <h6 class="fw-bold text-dark mb-3">
                    <i class="{{ $isEditing ? 'bi bi-pencil-square' : 'bi bi-plus-circle' }} me-1"></i> {{ $isEditing ? 'Edit Data Mitra' : 'Tambah Mitra Baru' }}
                </h6>
                
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-secondary">Nama Mitra / PT</label>
                            <input wire:model="nama_mitra" type="text" class="form-control form-control-sm" placeholder="Contoh: PT. Sumber Rejeki">
                            @error('nama_mitra') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-secondary">Nama Bank</label>
                            <input wire:model="nama_bank" type="text" class="form-control form-control-sm" placeholder="Contoh: BRI">
                            @error('nama_bank') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-secondary">No. Rekening</label>
                            <input wire:model="no_rekening" type="text" class="form-control form-control-sm" placeholder="Contoh: 1234567890">
                            @error('no_rekening') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-secondary">Atas Nama</label>
                            <input wire:model="atas_nama" type="text" class="form-control form-control-sm" placeholder="Contoh: Budi Santoso">
                            @error('atas_nama') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="mt-3 d-flex gap-2 justify-content-end">
                        @if($isEditing)
                            <button type="button" wire:click="cancelEdit" class="btn btn-secondary btn-sm px-4">Batal</button>
                        @endif
                        <button type="submit" class="btn btn-primary btn-sm px-4 fw-bold">
                            {{ $isEditing ? 'Update Data' : 'Simpan Data' }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-3 py-3">No</th>
                            <th scope="col" class="px-3 py-3">Nama Mitra</th>
                            <th scope="col" class="px-3 py-3">Bank</th>
                            <th scope="col" class="px-3 py-3">No. Rekening</th>
                            <th scope="col" class="px-3 py-3">Atas Nama</th>
                            <th scope="col" class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mitras as $index => $mitra)
                        <tr>
                            <td class="px-3">{{ $index + 1 }}</td>
                            <td class="px-3 fw-bold">{{ $mitra->nama_mitra }}</td>
                            <td class="px-3">{{ $mitra->nama_bank }}</td>
                            <td class="px-3 font-monospace">{{ $mitra->no_rekening }}</td>
                            <td class="px-3">{{ $mitra->atas_nama }}</td>
                            <td class="px-3 text-center">
                                <button wire:click="edit({{ $mitra->id }})" class="btn btn-warning btn-sm text-dark shadow-sm me-1">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button wire:click="delete({{ $mitra->id }})" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Yakin ingin menghapus data ini?') || event.stopImmediatePropagation()">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data mitra.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
