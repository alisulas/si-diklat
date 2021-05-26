<?php echo form_open($action); ?>

<table class="table table-striped">
    <tr>
        <td width="150"><b>Kode Program</b></td><td>: <?php echo $kode; ?></td>
    </tr>
    <tr>
        <td><b>Judul Program</b></td><td>: <?php echo $judul; ?></td>
    </tr>
    <tr>
        <td><b>Tempat Pelaksanaan</b></td><td>: <?php echo $tempat; ?></td>
    </tr>
    <tr>
        <td><b>Tanggal Pelaksanaan</b></td><td>: <?php echo $tanggal; ?></td>
    </tr>
    <tr>
        <td><b>Sifat</b></td><td>: <?php echo $sifat; ?></td>
    </tr>
    <tr>
        <td><b>Jenis Pembayaran</b></td><td>: <?php echo $jenis_pembayaran; ?></td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <th>Dokumen</th><th>Status</th><th>Verifikasi Finance</th>
    </tr>
    <tr>
        <td>Invoice / Kwitansi</td><td><?php echo $st_invoice; ?></td><td><?php echo $f_invoice ?></td>
    </tr>
    <tr>
        <td>Daftar Hadir Instruktur</td><td><?php echo $st_daftar_hadir_inst; ?></td><td><?php echo $f_daftar_hadir_inst; ?></td>
    </tr>
    <tr>
        <td>Daftar Hadir Peserta</td><td><?php echo $st_daftar_hadir_peserta; ?></td><td><?php echo $f_daftar_hadir_peserta; ?></td>
    </tr>
    <tr>
        <td>Penawaran Harga</td><td><?php echo $st_penawaran_harga; ?></td><td><?php echo $f_penawaran_harga; ?></td>
    </tr>
    <tr>
        <td>Surat Perintah</td><td><?php echo $st_surat_perintah; ?></td><td><?php echo $f_surat_perintah; ?></td>
    </tr>
    <tr>
        <td>Surat Perjanjian</td><td><?php echo $st_surat_perjanjian; ?></td><td><?php echo $f_surat_perjanjian; ?></td>
    </tr>
    <tr>
        <td>Surat Pendukung</td><td><?php echo $st_surat_pendukung; ?></td><td><?php echo $f_surat_pendukung; ?></td>
    </tr>
    <tr>
        <td>Sertifikat</td><td><?php echo $st_sertifikat; ?></td><td><?php echo $f_sertifikat; ?></td>
    </tr>
    <tr>
        <td>SPD</td><td><?php echo $st_spd; ?></td><td><?php echo $f_spd; ?></td>
    </tr>
    <tr>
        <td>Faktur Pajak</td><td><?php echo $st_faktur_pajak; ?></td><td><?php echo $f_faktur_pajak; ?></td>
    </tr>
    <tr>
        <td>Nota Permintaan</td><td><?php echo $st_nota_permintaan; ?></td><td><?php echo $f_nota_permintaan; ?></td>
    </tr>
    <tr>
        <td>Rincian UMK</td><td><?php echo $st_rincian_umk; ?></td><td><?php echo $f_rincian_umk; ?></td>
    </tr>
    <tr>
        <td>Rincian Honor</td><td><?php echo $st_rincian_honor; ?></td><td><?php echo $f_rincian_honor; ?></td>
    </tr>
</table>
<table class="table table-striped">
    <tr>
        <td>Tanggal Kirim</td><td><?php echo $tgl_kirim;?></td>
    </tr>
    <tr>
        <td>Pengirim</td><td><?php echo $pengirim;?></td>
    </tr>
    <tr>
        <td>Tanggal Terima</td><td><input type="text" name="tgl_terima" value="<?php echo $tgl_terima; ?>" id="tgl_terima" class="input input-medium"></td>
    </tr>
    <tr>
        <td>Penerima</td><td><input type="text" name="penerima" value="<?php echo $penerima; ?>" class="input input-medium"></td>
    </tr>
    <tr>
        <td>Ket</td><td><textarea name="ket"><?php echo $ket; ?></textarea></td>
    </tr>
    
</table>

<input type="submit" value="Simpan" class="btn btn-primary"> <?php echo anchor('finance', 'Kembali', array('class'=>'btn')); ?>
<?php echo form_close(); ?>

<script type="text/javascript">
$(function () {
    $(".btn-group").button();
    $("#tgl_kirim").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_terima").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});

</script>