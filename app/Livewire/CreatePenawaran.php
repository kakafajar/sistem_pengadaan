<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Penawaran;
use App\Models\Spp;
use App\Models\Mitra;

class CreatePenawaran extends Component
{
    // ... Properti Form ...
    public $no_surat;
    public $mitra;
    public $petani;
    public $komoditi = 'GKP AnyQuality';
    public $kualitas = 'Standar';
    public $kemasan = 'Curah';
    public $harga;
    public $tgl_penawaran;
    public $kuantum_kg;
    public $nominal = 0;
    public $gudang;
    public $kode_erp;

    // ... Aturan Validasi ...
    protected $rules = [
        'no_surat' => 'required|unique:penawarans,no_surat',
        'mitra' => 'required',
        'petani' => 'required',
        'harga' => 'required|numeric',
        'kuantum_kg' => 'required|numeric',
        'tgl_penawaran' => 'required|date',
    ];

    // ... Hitung Otomatis ...
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        if (is_numeric($this->harga) && is_numeric($this->kuantum_kg)) {
            $this->nominal = $this->harga * $this->kuantum_kg;
        }
    }

    public function simpan()
    {
        $this->validate();

        // Cari data Mitra untuk mengambil detail bank
        $dataMitra = Mitra::where('nama_mitra', $this->mitra)->first();

        // 1. Simpan ke Tabel Penawaran
        $penawaran = Penawaran::create([
            'no_surat' => $this->no_surat,
            'mitra' => $this->mitra,
            'petani' => $this->petani,
            'komoditi' => $this->komoditi,
            'kualitas' => $this->kualitas,
            'kemasan' => $this->kemasan,
            'harga' => $this->harga,
            'tgl_penawaran' => $this->tgl_penawaran,
            'kuantum_kg' => $this->kuantum_kg,
            'nominal' => $this->nominal,
            'gudang' => $this->gudang,
            'kode_erp' => $this->kode_erp,
        ]);

        // 2. Otomatis Copy ke Tabel SPP
        Spp::create([
            'penawaran_id' => $penawaran->id,
            'no_surat'      => $this->no_surat,
            'mitra_kerja'   => $this->mitra,
            'petani'        => $this->petani,
            'komoditi'      => $this->komoditi,
            'kualitas'      => $this->kualitas,
            'kemasan'       => $this->kemasan,
            'tgl_penawaran' => $this->tgl_penawaran,
            'kuantum'       => $this->kuantum_kg,
            'harga'         => $this->harga,
            'total_bayar'   => $this->nominal,
            
            // MAP DETAIL BANK DARI MITRA:
            'nama_bank'     => $dataMitra->nama_bank ?? null,
            'no_rekening'   => $dataMitra->no_rekening ?? null,
            'atas_nama'     => $dataMitra->atas_nama ?? null,
        ]);

        $this->reset();
        session()->flash('message', 'Data Penawaran Berhasil Disimpan!');
    }

    public function render()
    {
        return view('livewire.create-penawaran', [
            'mitras' => Mitra::all()
        ])->layout('components.layouts.app'); 
    }
}
