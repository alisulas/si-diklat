<table class="table table-condensed">
    <tr>
        <td>Kode Tiket</td>
        <td>: <?php echo $detail['kd_tiket']; ?></td>
    </tr>
    <tr>
        <td>PIC</td><td>: <?php echo $detail['pic']; ?></td>
    </tr>
    <tr>
        <td>Judul </td>
        <td>: <?php echo $judul; ?></td>
    </tr>
    <tr>
        <td>Batch</td>
        <td>: <?php echo $detail['batch']; ?></td>
    </tr>
    <tr>
        <td>Dasar</td><td>: <?php echo $detail['dasar']; ?></td>
    </tr>
       <tr>
        <td>Reference</td><td><?php echo $reference; ?></td>
    </tr>
    <tr>
        <td>Jenis</td><td>: <?php echo $detail['jenis']; ?></td>
    </tr>
    <tr>
        <td>Sifat</td><td>: <?php echo $detail['sifat']; ?></td>
    </tr>
    <tr>
        <td>Kuota Kelas</td><td>: <?php echo $detail['kuota_kelas']; ?></td>
    </tr>
    <tr>
        <td>Tanggal Pelaksanaan</td><td>: <?php echo $this->editor->date_correct($detail['tgl_mulai']).' - '.$this->editor->date_correct($detail['tgl_selesai']); ?></td>
    </tr>
    <tr>
        <td>Lokasi</td><td>: <?php echo $detail['lokasi_kota']; ?></td>
    </tr>
    <tr>
        <td>Tempat</td><td>: <?php echo $detail['tempat']; ?></td>
    </tr>
    <tr>
        <td>Ruangan</td><td>: <?php echo $detail['ruangan']; ?></td>
    </tr>
    <tr>
        <td>Pengajar</td><td>: <table border='1'><?php echo $pengajar; ?></table></td>
    </tr>
    <tr>
        <td>Provider</td><td>: <?php echo $provider; ?></td>
    </tr>
    <tr>
        <td>Observer</td><td>: <table border='1'><?php echo $observer; ?></table></td>
    </tr>
    <tr>
        <td>Memo bantuan Mengajar</td><td> <?php echo $memo_bantuan_mengajar; ?></td>
    </tr>
    <tr>
        <td>Fax bantuan Mengajar</td><td> <?php echo $fax_bantuan_mengajar; ?></td>
    </tr>
    <tr>
        <td>Surat bantuan Mengajar</td><td> <?php echo $surat_bantuan_mengajar; ?></td>
    </tr>
    <tr>
        <td>Memo Panggilan Peserta</td><td> <?php echo $memo_panggilan_peserta; ?></td>
    </tr>
    <tr>
        <td>Fax Panggilan Peserta</td><td> <?php echo $fax_panggilan_peserta; ?></td>
    </tr>
    <tr>
        <td>Peserta</td>
        <td>
        Undangan : <?php echo $jml_peserta; ?> Orang<br>
        Konfirmasi : <?php echo $jml_konfirmasi; ?> Orang<br>
        Hadir : <?php echo $jml_hadir; ?> Orang<br>
        </td>
    </tr>
    <tr>
        <td>Memo Pembatalan Training</td>
        <td> <?php echo $memo_pembatalan_training; ?></td>
    </tr>
    <tr>
        <td>Fax Pembatalan Training</td>
        <td><?php echo $fax_pembatalan_training; ?></td>
    </tr>
    <tr>
        <td>Memo Pembatalan Jadwal Mengajar</td>
        <td><?php echo $memo_pembatalan_mengajar; ?></td>
    </tr>
    <tr>
        <td>Fax pembatalan Jadwal Mengajar</td>
        <td>
            <?php echo $fax_pembatalan_mengajar; ?>
        </td>
    </tr>
    <tr>
        <td>Surat Pembatalan SPK</td>
        <td><?php echo $surat_pembatalan_kerja; ?></td>
    </tr>
    <tr>
        <td>Invoice Diterima</td>
        <td><?php echo $invoice_diterima; ?></td>
    </tr>
    <tr>
        <td>Invoice Dikirim Ke Keuangan</td>
        <td><?php echo $invoice_dikirim; ?></td>
    </tr>
    <tr><td>Status</td><td>: Dibatalkan</td></tr>
</table>
<button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
<script>
function goBack() {
    window.history.back()
}
</script>

