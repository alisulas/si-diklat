<?php echo '<center><u><b>'.$title.'</b></u></center><br>'; ?>
<table class="table table-condensed table-striped">
    <tr>
        <td style="width: 90px">Nomor </td><td>: <?php echo $gl['no_gl']; ?></td>
    </tr>
    <tr>
        <td>Tanggal </td><td>: <?php echo $this->editor->date_correct($gl['tanggal']); ?></td>
    </tr>
    <tr>
        <td>Kepada </td><td>: <?php echo $gl['kepada']; ?></td>
    </tr>
    <tr>
        <td>Dari </td><td>: <?php echo $gl['dari'];?></td>
    </tr>
    <tr>
        <td>No. Fax </td><td>: <?php echo $gl['no_fax'];?></td>
    </tr>
</table>

<hr>
<br>
Bersama ini Disampaikan bahwa PT. Pertamina(Persero) akan menyelenggarakan Program berikut :
<table class="table table-condensed table-striped">
    <tr>
        <td style="width: 130px">Judul Program </td><td>: <?php echo $gl['judul_program'];?></td>
    </tr>
    <tr>
        <td>Kode Program </td><td>: <?php echo $gl['kode_program'];?></td>
    </tr>    
    <tr>
        <td>Tanggal Pelaksanaan </td><td>: <?php echo $this->editor->date_correct($gl['tgl_pelaksanaan']);?></td>
    </tr>
    <tr>
        <td>Durasi </td><td>: <?php echo $gl['durasi']; ?></td>
    </tr>
    <tr>
        <td>Waktu </td><td>: <?php echo $gl['waktu'];?></td>
    </tr>
    <tr>
        <td>Tempat </td><td>: <?php echo $gl['tempat'];?></td>
    </tr>
    <tr>
        <td>Sifat </td><td>: <?php echo $gl['sifat']; ?></td>
    </tr>
</table>

Mohon dapat disiapkan sarana dan fasililtas sebagai berikut :
<table class="table table-condensed">
    <tr>
        <td colspan="2"><b>1. Ruang Meeting</b></td>
    </tr>
    <tr>
        <td style="width: 200px">&raquo; Kapasitas </td><td>: <?php echo $gl['rm_kapasitas']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Perlengkapan </td><td>: <?php echo $gl['rm_perlengkapan'];?></td>
    </tr>
    <tr>
        <td>&raquo; Layout Ruangan </td><td>: <?php echo $gl['rm_layout'];?></td>
    </tr>
    <tr>
        <td>&raquo; Keterangan </td><td>: <?php echo $gl['rm_keterangan'];?></td>
    </tr>    
    
        <tr>
        <td colspan="2"><b>2. Business Center</b></td>
    </tr>
    <tr>
        <td>&raquo; Ukuran Ruangan </td><td>: <?php echo $gl['bc_ukuran_ruangan'];?></td>
    </tr>
    <tr>
        <td>&raquo; Perlengkapan </td><td>: <?php echo $gl['bc_perlengkapan']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Keterangan </td><td>: <?php echo $gl['bc_keterangan'];?></td>
    </tr>
    <tr>
        <td colspan="2"><b>3. Akomodasi (Khusus Residensial)</b></td>
    </tr>
    <tr>
        <td>&raquo; Peserta </td><td> <?php echo $akomodasi_peserta; ?></td>
    </tr>
    <tr>
        <td>&raquo; Instruktur </td><td> <?php echo $akomodasi_instruktur?>
    </tr>
    <tr>
        <td>&raquo; Keterangan </td><td>: <?php echo $gl['akomodasi_keterangan'];?></td>
    </tr>
    
            <tr>
        <td colspan="2"><b>4. Konsumsi</b></td>
    </tr>
    <tr>
        <td colspan="2"><b>Meal</b></td>
    </tr>
    <tr>
        <td>&raquo; Breakfast </td><td>: <?php echo $gl['meal_breakfast']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Lunch </td><td>: <?php echo $gl['meal_launch']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Dinner </td><td>: <?php echo $gl['meal_dinner']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Keterangan </td><td>: <?php echo $gl['konsumsi_ket']; ?></td>
    </tr>
    <tr>
        <td colspan="2"> <b>Cofee Break</b></td>
    </tr>
    <tr>
        <td>&raquo; Jumlah </td><td>: <?php echo $gl['cb_jumlah']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Frekuensi </td><td>: <?php echo $gl['cb_frekuansi']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Waktu Pemberian </td><td> <?php echo $waktu_pemberian;?></td>
    </tr>
    <tr>
        <td>&raquo; Refreshment di Ruangan </td><td><?php echo $refreshment; ?></td>
    </tr>
                <tr>
        <td colspan="2"><b>5. Transportasi</b></td>
    </tr>
    <tr>
        <td>&raquo; Jenis Kendaraan </td><td>: <?php echo $gl['trans_jenis_kendaraan']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Tanggal Penggunaan </td><td>: <?php echo $gl['trans_tanggal']; ?></td>
    </tr>
    <tr>
        <td>&raquo; Waktu Penggunaan </td><td>: <?php echo $gl['trans_waktu']; ?></td>
    </tr>
                <tr>
        <td colspan="2"><b>6. Training Kit</b></td>
    </tr>
    <tr>
        <td>&raquo; Tas Ransel </td><td>: <?php echo $gl['tk_tas_ransel']; ?>&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&raquo; Block Note </td><td>: <?php echo $gl['tk_block_note']; ?>&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&raquo; Ballpoint </td><td>: <?php echo $gl['tk_ballpoint']; ?>&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&raquo; Flashdisk </td><td>: <?php echo $gl['tk_flashdisk']; ?>&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&raquo; Keping CD </td><td>: <?php echo $gl['tk_cd']; ?>&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&raquo; Keping DVD </td><td>: <?php echo $gl['tk_dvd']; ?>&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&raquo; Lainnya </td><td>: <?php echo $gl['tk_lainnya']; ?>&nbsp;pcs</td>
    </tr>
</table>
<?php echo $kembali; ?><br>