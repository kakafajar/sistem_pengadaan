<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Spp;

class SppTable extends Component
{
    public $spps;
    public $isEditing = false;
    public $editId;

    // Data PO Lama
    public $no_po, $tgl_po, $bulan_po, $pic;

    // 1. TAMBAHAN BARU: Data Rekening
    public $nama_bank, $no_rekening, $atas_nama;

    public function mount()
    {
        $this->spps = Spp::with('penawaran')->latest()->get();
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->editId = $id;
        $spp = Spp::find($id);

        $this->no_po = $spp->no_po;
        $this->tgl_po = $spp->tgl_po;
        $this->bulan_po = $spp->bulan_po;
        $this->pic = $spp->pic;

        // 2. Load Data Bank dari Database ke Form
        $this->nama_bank = $spp->nama_bank;
        $this->no_rekening = $spp->no_rekening;
        $this->atas_nama = $spp->atas_nama;
    }

    public function update()
    {
        // Validasi
        $this->validate([
            'no_po' => 'required',
            'tgl_po' => 'required|numeric',
            'bulan_po' => 'required',
            'pic' => 'required',
            // Bank boleh kosong (nullable), jadi tidak perlu required
        ]);

        $spp = Spp::find($this->editId);
        
        $spp->update([
            'no_po' => $this->no_po,
            'tgl_po' => $this->tgl_po,
            'bulan_po' => $this->bulan_po,
            'pic' => $this->pic,
            'tgl_hari_ini' => now(),

            // 3. Simpan Data Bank ke Database
            'nama_bank' => $this->nama_bank,
            'no_rekening' => $this->no_rekening,
            'atas_nama' => $this->atas_nama,
        ]);

        $this->isEditing = false;
        $this->mount(); // Refresh data
        session()->flash('message', 'Data PO & Rekening Berhasil Disimpan!');
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.spp-table')->layout('components.layouts.app');
    }
}
