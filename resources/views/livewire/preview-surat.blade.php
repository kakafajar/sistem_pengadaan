<div>
    <div class="row">
        <!-- Sidebar kiri: Form Edit -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white pb-2 pt-3">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-gear-fill me-2 text-primary"></i> Kontrol Surat</h5>
                    <p class="text-muted small mb-0 mt-1">Pilih SPP dan lengkapi data suratnya.</p>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label text-muted fw-bold small">Pilih Data SPP</label>
                        <select wire:model.live="selectedSppId" class="form-select shadow-sm" style="border-radius: 8px;">
                            <option value="">-- Pilih SPP --</option>
                            @foreach($spps as $item)
                                <option value="{{ $item->id }}">{{ $item->mitra_kerja }} (Ku: {{ $item->kuantum }}Kg)</option>
                            @endforeach
                        </select>
                    </div>

                    @if($selectedSppId)
                        <hr class="text-muted my-4">
                        <form wire:submit.prevent="simpanPerubahan">
                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold small">Nomor PO</label>
                                <input type="text" wire:model.live="no_po" class="form-control" placeholder="Contoh: 123/PO/2026">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold small">Tanggal PO</label>
                                    <input type="number" wire:model.live="tgl_po" class="form-control" placeholder="Contoh: 15">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted fw-bold small">Bulan PO</label>
                                    <input type="text" wire:model.live="bulan_po" class="form-control" placeholder="Contoh: 03" maxlength="2">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold small">Nama PIC (Opsional)</label>
                                <input type="text" wire:model.live="pic" class="form-control" placeholder="Nama PIC">
                            </div>

                            @if (session()->has('message'))
                                <div class="alert alert-success py-2 mt-2 border-0 shadow-sm" style="font-size: 0.85rem; border-radius: 8px;">
                                    <i class="bi bi-check-circle-fill me-1"></i> {{ session('message') }}
                                </div>
                            @endif

                            <div class="d-grid gap-2 mt-4 pt-2">
                                <button type="submit" class="btn btn-light border d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px;">
                                    <i class="bi bi-save text-primary"></i> <span class="fw-medium">Simpan Data</span>
                                </button>
                                
                                <button type="button" wire:click="cetakPdf" class="btn btn-warning text-white d-flex align-items-center justify-content-center gap-2 mt-1 shadow-sm" style="border-radius: 8px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none;">
                                    <i class="bi bi-printer-fill"></i> <span class="fw-bold">Cetak PDF</span>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bagian Kanan: Live Preview Kertas -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100 bg-light">
                <div class="card-header bg-white pb-2 pt-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-eye-fill me-2 text-primary"></i> Live Preview</h5>
                        <p class="text-muted small mb-0 mt-1">Pratinjau langsung tampilan surat.</p>
                    </div>
                    @if($selectedSppId)
                        <span class="badge bg-success bg-opacity-10 text-success border border-success fw-medium px-3 py-2 rounded-pill"><i class="bi bi-circle-fill me-1" style="font-size: 0.5rem"></i> Mode Edit Aktif</span>
                    @endif
                </div>
                
                <div class="card-body p-4 p-md-5 d-flex justify-content-center" style="background-color: #f3f4f6; overflow-y: auto; overflow-x: auto;">
                    
                    @if($spp)
                        <!-- Visualisasi Kertas A4 -->
                        <div class="bg-white shadow-sm" style="width: 210mm; min-width: 210mm; min-height: 297mm; padding: 25mm 20mm; position: relative; zoom: 0.9;">
                            
                            <div style="font-family: 'Times New Roman', Times, serif; font-size: 15px; line-height: 1.5; color: black;">
                                <div style="text-align: center; font-weight: bold; margin-bottom: 5px;">SURAT PERMOHONAN PEMBAYARAN</div>
                                <div style="text-align: center; font-weight: bold; margin-bottom: 30px;">PENGADAAN GKP DALAM NEGERI</div>

                                <p>Kepada Yth.<br>
                                <span style="font-weight: bold;">Pemimpin Cabang Karawang</span><br>
                                Di Tempat</p>

                                <div style="text-align: justify; margin-top: 20px;">
                                    <p>Bersama ini kami <span style="font-weight: bold;">{{ $spp->mitra_kerja ?? '..............' }}</span> menyampaikan permohonan pembayaran GKP Pengadaan Dalam Negeri Tahun {{ date('Y') }} sebanyak <span style="font-weight: bold;">{{ number_format($spp->kuantum ?? 0, 0, ',', '.') }} Kg</span> dengan nilai <span style="font-weight: bold;">Rp {{ number_format($spp->total_bayar ?? 0, 0, ',', '.') }}</span> ({{ $this->terbilang }}) sebagaimana tercantum dalam Order Pembelian nomor <span style="font-weight: bold; @if(!$no_po) background-color: #fef08a; padding: 2px; @endif">{{ $no_po ?: '....................' }}</span> Tanggal <span style="@if(!$tgl_po) background-color: #fef08a; padding: 2px; @endif">{{ $tgl_po ?: '...' }}</span> bulan <span style="@if(!$bulan_po) background-color: #fef08a; padding: 2px; @endif">{{ $this->bulanPoIndo ?: '.............' }}</span> Tahun {{ date('Y') }}.</p>

                                    <p style="margin-top: 15px;">Mohon kiranya pembayaran tersebut di atas dapat dibayar/dipindahbukukan ke rekening:</p>
                                    
                                    <div style="margin-left: 20px; font-weight: bold; margin-bottom: 15px;">
                                        {{ $spp->nama_bank ?? '....................' }} - {{ $spp->no_rekening ?? '....................' }}<br>
                                        a.n {{ $spp->atas_nama ?? '....................' }}
                                    </div>

                                    <p>Sebagai bahan syarat pembayaran kami lampirkan:</p>
                                    <ul style="list-style-type: none; padding-left: 0; margin-left: 20px;">
                                        <li>- Dokumen Penerimaan Barang Gudang</li>
                                        <li>- Lembar Hasil Pemeriksaan Kualitas (LHPK)</li>
                                        <li>- Order Pembelian</li>
                                    </ul>

                                    <p style="margin-top: 15px;">Demikian disampaikan dan atas perkenannya diucapkan terima kasih.</p>
                                </div>

                                <div style="float: right; width: 40%; text-align: center; margin-top: 40px;">
                                    @php
                                        $bulanMapHtml = [
                                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                        ];
                                        $tglSuratIndoHtml = date('d') . ' ' . $bulanMapHtml[date('n')] . ' ' . date('Y');
                                    @endphp
                                    Karawang, {{ $tglSuratIndoHtml }}<br>
                                    Pemohon,<br>
                                    <br><br><br><br>
                                    <span style="font-weight: bold; text-decoration: underline;">{{ $spp->mitra_kerja ?? '..............' }}</span><br>
                                    <span style="font-size: 0.9em; @if(!$pic) background-color: #fef08a; padding: 2px; @endif">{{ $pic ?: 'PIC Mitra' }}</span>
                                </div>

                                <div style="clear: both;"></div>
                            </div>
                        </div>
                    @else
                        <div class="text-center text-muted align-self-center my-5 py-5 d-flex flex-column align-items-center">
                            <i class="bi bi-file-earmark-richtext text-secondary mb-3 opacity-25" style="font-size: 5rem;"></i>
                            <h5 class="fw-bold">Pratinjau Surat Kosong</h5>
                            <p class="small opacity-75 max-w-sm mx-auto text-center" style="max-width: 300px;">Silakan pilih data SPP melalui panel kontrol di sebelah kiri untuk menampilkan bentuk dan isi surat yang akan Anda cetak.</p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
