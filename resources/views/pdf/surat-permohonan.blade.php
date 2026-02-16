<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Permohonan Pembayaran</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5; margin: 40px; }
        .judul { text-align: center; font-weight: bold; text-decoration: underline; margin-bottom: 5px; }
        .sub-judul { text-align: center; font-weight: bold; margin-bottom: 30px; }
        .tebal { font-weight: bold; }
        .ttd-box { float: right; width: 40%; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="judul">SURAT PERMOHONAN PEMBAYARAN</div>
    <div class="sub-judul">PENGADAAN GKP DALAM NEGERI</div>

    <p>Kepada Yth.<br>
    <span class="tebal">Pemimpin Cabang Karawang</span><br>
    Di Tempat</p>

    <div style="text-align: justify;">
        <p>Bersama ini kami <span class="tebal">{{ $spp->mitra_kerja }}</span> menyampaikan permohonan pembayaran GKP Pengadaan Dalam Negeri Tahun {{ date('Y') }} sebanyak <span class="tebal">{{ number_format($spp->kuantum, 0, ',', '.') }} Kg</span> dengan nilai <span class="tebal">Rp {{ number_format($spp->total_bayar, 0, ',', '.') }}</span> ({{ $terbilang }}) sebagaimana tercantum dalam Order Pembelian nomor <span class="tebal">{{ $spp->no_po }}</span> Tanggal {{ $spp->tgl_po }} {{ $spp->bulan_po }} {{ date('Y') }}.</p>

        <p>Mohon kiranya pembayaran tersebut di atas dapat dibayar/dipindahbukukan ke rekening:</p>
        
        <div style="margin-left: 20px; font-weight: bold;">
            {{ $spp->nama_bank ?? '....................' }} - {{ $spp->no_rekening ?? '....................' }}<br>
            a.n {{ $spp->atas_nama ?? '....................' }}
        </div>

        <p>Sebagai bahan syarat pembayaran kami lampirkan:</p>
        <ul>
            <li>Dokumen Penerimaan Barang Gudang</li>
            <li>Lembar Hasil Pemeriksaan Kualitas (LHPK)</li>
            <li>Order Pembelian</li>
        </ul>

        <p>Demikian disampaikan dan atas perkenannya diucapkan terima kasih.</p>
    </div>

    <div class="ttd-box">
        Karawang, {{ date('d F Y') }}<br>
        Pemohon,<br>
        <br><br><br><br>
        <span class="tebal" style="text-decoration: underline;">{{ $spp->mitra_kerja }}</span><br>
        {{ $spp->atas_nama ?? 'Direktur' }}
    </div>
</body>
</html>