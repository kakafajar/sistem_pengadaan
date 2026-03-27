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

        // Format Bulan Indonesia
        $bulanMap = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April',
            '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus',
            '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        // Konversi bulan_po jika numeric
        $bulanPoIndo = $spp->bulan_po;
        if (is_numeric($spp->bulan_po) && isset($bulanMap[$spp->bulan_po])) {
            $bulanPoIndo = $bulanMap[$spp->bulan_po];
        }

        // Tanggal Surat Hari Ini (Format Indonesia)
        $bulanIni = date('n'); // 1-12
        $tglSuratIndo = date('d') . ' ' . $bulanMap[$bulanIni] . ' ' . date('Y');

        // Generate PDF
        $pdf = Pdf::loadView('pdf.surat-permohonan', compact('spp', 'terbilang', 'bulanPoIndo', 'tglSuratIndo'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream('Surat-Permohonan-' . $spp->mitra_kerja . '.pdf');
    }
}