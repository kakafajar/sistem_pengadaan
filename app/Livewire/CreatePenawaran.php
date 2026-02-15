<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Penawaran;
use App\Models\Spp;

class CreatePenawaran extends Component
{
    // Properti untuk menampung inputan Form
    public $no_surat;
    public $mitra;
    public $petani;
    public $komoditi = 'GKP AnyQuality'; // Default
    public $kualitas = 'Standar';
    public $kemasan = 'Curah';
    public $harga;
    public $tgl_penawaran;
    public $kuantum_kg;
    public $nominal = 0;
    public $gudang;
    public $kode_erp;

    // Aturan Validasi
    protected $rules = [
        'no_surat' => 'required|unique:penawarans,no_surat',
        'mitra' => 'required',
        'petani' => 'required',
        'harga' => 'required|numeric',
        'kuantum_kg' => 'required|numeric',
        'tgl_penawaran' => 'required|date',
    ];

    // Hitung Otomatis saat user mengetik
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        // Rumus: Harga x Kuantum = Nominal
        if (is_numeric($this->harga) && is_numeric($this->kuantum_kg)) {
            $this->nominal = $this->harga * $this->kuantum_kg;
        }
    }

    // Fungsi saat tombol SIMPAN ditekan
    public function simpan()
    {
        $this->validate();

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

        // 2. Otomatis Copy ke Tabel SPP (Untuk diproses selanjutnya)
            Spp::create([
            'penawaran_id' => $penawaran->id,
            
            // INI DATA YANG DI-COPY DARI FORM:
            'no_surat'      => $this->no_surat,       // <-- Baru
            'mitra_kerja'   => $this->mitra,
            'petani'        => $this->petani,         // <-- Baru
            'komoditi'      => $this->komoditi,       // <-- Baru
            'kualitas'      => $this->kualitas,       // <-- Baru
            'kemasan'       => $this->kemasan,        // <-- Baru
            'tgl_penawaran' => $this->tgl_penawaran,  // <-- Baru
            
            'kuantum'       => $this->kuantum_kg,
            'harga'         => $this->harga,
            'total_bayar'   => $this->nominal,
        ]);

        // Reset Form
        $this->reset();
        session()->flash('message', 'Data Penawaran Berhasil Disimpan!');
    }

public function render()
    {
        // KITA TAMBAHKAN ->layout(...) AGAR JELAS ALAMATNYA
        return view('livewire.create-penawaran')
            ->layout('components.layouts.app'); 
    }
}