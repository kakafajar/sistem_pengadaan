<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spp;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakSppController extends Controller
{
    // Fungsi mengubah Angka -> Huruf
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

    public function cetak($id)
    {
        $spp = Spp::findOrFail($id);
        
        // Siapkan kalimat terbilang
        $terbilang = trim($this->terbilang($spp->total_bayar)) . " Rupiah";

        // Generate PDF
        $pdf = Pdf::loadView('pdf.surat-permohonan', compact('spp', 'terbilang'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream('Surat-Permohonan-' . $spp->mitra_kerja . '.pdf');
    }
}