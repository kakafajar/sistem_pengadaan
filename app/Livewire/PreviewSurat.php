<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Spp;

class PreviewSurat extends Component
{
    public $spps;
    public $selectedSppId;
    public $spp;

    // Form fields
    public $no_po;
    public $tgl_po;
    public $bulan_po;
    public $pic;
    
    public function mount()
    {
        // Get all SPPs
        $this->spps = Spp::orderBy('id', 'desc')->get();
    }

    public function updatedSelectedSppId($value)
    {
        if($value) {
            $this->spp = Spp::find($value);
            if($this->spp) {
                $this->no_po = $this->spp->no_po;
                $this->tgl_po = $this->spp->tgl_po;
                $this->bulan_po = $this->spp->bulan_po;
                $this->pic = $this->spp->pic;
            }
        } else {
            $this->reset(['spp', 'no_po', 'tgl_po', 'bulan_po', 'pic']);
        }
    }

    public function simpanPerubahan()
    {
        if($this->spp) {
            $this->spp->update([
                'no_po' => $this->no_po,
                'tgl_po' => $this->tgl_po,
                'bulan_po' => $this->bulan_po,
                'pic' => $this->pic,
            ]);
            
            session()->flash('message', 'Perubahan berhasil disimpan!');
        }
    }

    public function getTerbilangProperty()
    {
        if(!$this->spp) return '';
        return trim($this->terbilang($this->spp->total_bayar)) . " Rupiah";
    }

    private function terbilang($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->terbilang($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = $this->terbilang($nilai/10)." Puluh". $this->terbilang($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . $this->terbilang($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->terbilang($nilai/100) . " Ratus" . $this->terbilang($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . $this->terbilang($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->terbilang($nilai/1000) . " Ribu" . $this->terbilang($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->terbilang($nilai/1000000) . " Juta" . $this->terbilang($nilai % 1000000);
        }
        return $temp;
    }

    public function getBulanPoIndoProperty()
    {
        if(!$this->bulan_po) return '';
        $bulanMap = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April',
            '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus',
            '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        
        return isset($bulanMap[$this->bulan_po]) ? $bulanMap[$this->bulan_po] : $this->bulan_po;
    }

    public function cetakPdf()
    {
        $this->simpanPerubahan();
        if($this->spp) {
            return redirect()->route('spp.cetak', $this->spp->id);
        }
    }

    public function render()
    {
        return view('livewire.preview-surat')->layout('components.layouts.app');
    }
}
