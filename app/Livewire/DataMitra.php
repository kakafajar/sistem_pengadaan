<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mitra;

class DataMitra extends Component
{
    public $mitras;
    public $nama_mitra, $nama_bank, $no_rekening, $atas_nama, $mitra_id;
    public $isEditing = false;

    public function render()
    {
        $this->mitras = Mitra::latest()->get();
        return view('livewire.data-mitra')->layout('components.layouts.app');
    }

    public function store()
    {
        $this->validate([
            'nama_mitra' => 'required',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'atas_nama' => 'required',
        ]);

        Mitra::create([
            'nama_mitra' => $this->nama_mitra,
            'nama_bank' => $this->nama_bank,
            'no_rekening' => $this->no_rekening,
            'atas_nama' => $this->atas_nama,
        ]);

        session()->flash('message', 'Data Mitra Berhasil Ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $mitra = Mitra::findOrFail($id);
        $this->mitra_id = $id;
        $this->nama_mitra = $mitra->nama_mitra;
        $this->nama_bank = $mitra->nama_bank;
        $this->no_rekening = $mitra->no_rekening;
        $this->atas_nama = $mitra->atas_nama;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'nama_mitra' => 'required',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'atas_nama' => 'required',
        ]);

        if ($this->mitra_id) {
            $mitra = Mitra::findOrFail($this->mitra_id);
            $mitra->update([
                'nama_mitra' => $this->nama_mitra,
                'nama_bank' => $this->nama_bank,
                'no_rekening' => $this->no_rekening,
                'atas_nama' => $this->atas_nama,
            ]);
            
            session()->flash('message', 'Data Mitra Berhasil Diupdate.');
            $this->resetInput();
            $this->isEditing = false;
        }
    }

    public function delete($id)
    {
        Mitra::find($id)->delete();
        session()->flash('message', 'Data Mitra Berhasil Dihapus.');
    }

    public function cancelEdit()
    {
        $this->resetInput();
        $this->isEditing = false;
    }

    private function resetInput()
    {
        $this->nama_mitra = null;
        $this->nama_bank = null;
        $this->no_rekening = null;
        $this->atas_nama = null;
        $this->mitra_id = null;
    }
}
