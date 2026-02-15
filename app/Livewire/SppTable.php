<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Spp;

class SppTable extends Component
{
    public $spps;
    
    // Variabel untuk Mode Edit
    public $isEditing = false;
    public $editId = null;
    
    // Variabel Form Edit PO
    public $no_po, $tgl_po, $bulan_po, $pic;

    // Ambil data terbaru setiap halaman dibuka
    public function mount()
    {
        $this->spps = Spp::with('penawaran')->latest()->get();
    }

    // Fungsi saat tombol "Edit" ditekan
    public function edit($id)
    {
        $this->isEditing = true;
        $this->editId = $id;
        
        $spp = Spp::find($id);
        $this->no_po = $spp->no_po;
        $this->tgl_po = $spp->tgl_po; // Tanggal saja (misal: 2)
        $this->bulan_po = $spp->bulan_po; // Bulan (misal: Februari)
        $this->pic = $spp->pic;
    }

    // Fungsi Batal Edit
    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->reset(['editId', 'no_po', 'tgl_po', 'bulan_po', 'pic']);
    }

    // Fungsi Simpan Perubahan PO
    public function update()
    {
        // 1. CEK VALIDASI (Pagar Pertama)
        $this->validate([
            // Cek unik di tabel spps kolom no_po, TAPI abaikan (ignore) punya diri sendiri
            'no_po' => 'required|unique:spps,no_po,' . $this->editId,
            'tgl_po' => 'required|numeric',
            'bulan_po' => 'required',
            'pic' => 'required',
        ], [
            'no_po.unique' => 'No PO ini sudah terpakai! Cek data lain.',
            'no_po.required' => 'No PO wajib diisi.'
        ]);

        $spp = Spp::find($this->editId);
        
        $spp->update([
            'no_po' => $this->no_po,
            'tgl_po' => $this->tgl_po,
            'bulan_po' => $this->bulan_po,
            'pic' => $this->pic,
            'tgl_hari_ini' => now(),
        ]);

        $this->isEditing = false;
        $this->mount();
        session()->flash('message', 'Data PO Berhasil Dilengkapi!');
    }
public function render()
    {
        // Kita paksa pakai layout yang benar
        return view('livewire.spp-table')
            ->layout('components.layouts.app'); 
    }
}
