<?php echo form_open($action); ?>
<table class="table table-condensed table-striped">
    <tr>
        <td>Nomor </td><td>: <input type="text" name="no_gl" value="<?php echo $gl['no_gl']; ?>" class="text"><?php echo form_error('no_gl');?></td>
    </tr>
    <tr>
        <td>Tanggal </td><td>: <input type="text" name="tanggal" value="<?php echo $gl['tanggal']; ?>" class="text" id="tanggal"><?php echo form_error('tanggal');?></td>
    </tr>
    <tr>
        <td>Kepada </td><td>: <input type="text" name="kepada" value="<?php echo $gl['kepada']; ?>" class="text"><?php echo form_error('kepada');?></td>
    </tr>
    <tr>
        <td>Dari </td><td>: <input type="text" name="dari" value="<?php echo $gl['dari']; ?>" class="text"><?php echo form_error('dari');?></td>
    </tr>
    <tr>
        <td>No. Fax </td><td>: <input type="text" name="no_fax" value="<?php echo $gl['no_fax'] ; ?>" class="text"><?php echo form_error('no_fax');?></td>
    </tr>
</table>

<hr>
<br>
Bersama ini Disampaikan bahwa PT. Pertamina(Persero) akan menyelenggarakan Program berikut :
<table class="table table-condensed table-striped">
    <tr>
        <td>Judul Program </td><td>: <input type="text" name="judul_program" value="<?php echo $gl['judul_program']; ?>" class="text"><?php echo form_error('judul_program');?></td>
    </tr>
    <tr>
        <td>Kode Program </td><td>: <input type="text" name="kode_program" value="<?php echo $gl['kode_program']; ?>" class="text"><?php echo form_error('kode_program');?></td>
    </tr>    
    <tr>
        <td>Tanggal Pelaksanaan </td><td>: <input type="text" name="tgl_pelaksanaan" value="<?php echo $gl['tgl_pelaksanaan']; ?>" class="text" id="tgl_pelaksanaan"><?php echo form_error('tgl_pelaksanaan');?></td>
    </tr>
    <tr>
        <td>Durasi </td><td>: <input type="text" name="durasi" value="<?php echo $gl['durasi']; ?>" class="text"><?php echo form_error('durasi');?></td>
    </tr>
    <tr>
        <td>Waktu </td><td>: <input type="text" name="waktu" value="<?php echo $gl['waktu']; ?>" class="text"><?php echo form_error('waktu');?></td>
    </tr>
    <tr>
        <td>Tempat </td><td>: <input type="text" name="tempat" value="<?php echo $gl['tempat']; ?>" class="text"><?php echo form_error('tempat');?></td>
    </tr>
    <tr>
        <td>Sifat </td><td>: <input type="radio" name="sifat" value="Residensial" <?php if($gl['sifat'] == 'Residensial') { echo 'checked="checked"';} ?>>Residensial &nbsp; &nbsp;<input type="radio" name="sifat" value="Non Residensial" <?php if($gl['sifat'] == 'Non Residensial') { echo 'checked="checked"';}  ?>>Non Residensial</td>
    </tr>
</table>

Mohon dapat disiapkan sarana dan fasililtas sebagai berikut :
<table class="table table-condensed">
    <tr>
        <td><b>1. Ruang Meeting</b></td>
    </tr>
    <tr>
        <td>&starf; Kapasitas </td><td>: <input type="text" class="text" name="rm_kapasitas" value="<?php echo $gl['rm_kapasitas']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Perlengkapan </td><td>: <input type="text" class="text" name="rm_perlengkapan" value="<?php echo $gl['rm_perlengkapan']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Layout Ruangan </td><td>: <input type="radio" name="rm_layout" value="Class Room" <?php if($gl['rm_layout'] == 'Class Room') { echo 'checked="checked"';} ?>> Class Room &nbsp; <input type="radio" name="rm_layout" value="Round Table" <?php if($gl['rm_layout'] == 'Round Table') { echo 'checked="checked"';}  ?>> Round Table &nbsp; <input type="radio" name="rm_layout" value="U Shape" <?php if($gl['rm_layout'] == 'U Shape') { echo 'checked="checked"';} ?>> U Shape</td>
    </tr>
    <tr>
        <td>&starf; Keterangan </td><td>: <input type="text" class="text" name="rm_keterangan" value="<?php echo $gl['rm_keterangan']; ?>"></td>
    </tr>    
    
        <tr>
        <td><b>2. Business Center</b></td>
    </tr>
    <tr>
        <td>&starf; Ukuran Ruangan </td><td>: <input type="text" class="text" name="bc_ukuran_ruangan" value="<?php echo $gl['bc_ukuran_ruangan']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Perlengkapan </td><td>: <input type="text" class="text" name="bc_perlengkapan" value="<?php echo $gl['bc_perlengkapan']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Keterangan </td><td>: <input type="text" class="text" name="bc_keterangan" value="<?php $gl['bc_keterangan'] ?>"></td>
    </tr>
    <tr>
        <td><b>3. Akomodasi (Khusus Residensial)</b></td>
    </tr>
    <tr>
        <td>&starf; Peserta </td><td>: <input type="text" class="input-mini" name="kamar_pes" value="<?php echo $kamar_pes; ?>">Kamar&nbsp; Type <input type="text" class="input-mini" name="type_pes" value="<?php echo $type_pes; ?>">Check In &nbsp;<input type="text" class="input-mini" id="check_in_pes" name="check_in_pes" value="<?php echo $check_in_pes; ?>">Check Out&nbsp;<input type="text" class="input-mini" id="check_out_pes" name="check_out_pes" value="<?php echo $check_out_pes; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Instruktur </td><td>: <input type="text" class="input-mini" name="kamar_ins" value="<?php echo $kamar_ins; ?>">Kamar&nbsp; Type <input type="text" class="input-mini" name="type_ins" value="<?php echo $type_ins; ?>">Check In &nbsp;<input type="text" class="input-mini" id="check_in_ins" name="check_in_ins" value="<?php echo $check_in_ins; ?>">Check Out&nbsp;<input type="text" class="input-mini" id="check_out_ins" name="check_out_ins" value="<?php echo $check_out_ins; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Keterangan </td><td>: <input type="text" class="text" name="akomodasi_keterangan" value="<?php echo $gl['akomodasi_keterangan']; ?>"></td>
    </tr>
    
            <tr>
        <td><b>4. Konsumsi</b></td>
    </tr>
    <tr>
        <td><b>Meal</b></td>
    </tr>
    <tr>
        <td>&starf; Breakfast </td><td>: <input type="text" class="text" name="meal_breakfast" value="<?php echo $gl['meal_breakfast']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Lunch </td><td>: <input type="text" class="text" name="meal_lunch" value="<?php echo $gl['meal_launch']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Dinner </td><td>: <input type="text" class="text" name="meal_dinner" value="<?php echo $gl['meal_dinner']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Keterangan </td><td>: <input type="text" class="text" name="konsumsi_ket" value="<?php echo $gl['konsumsi_ket']; ?>"></td>
    </tr>
    <tr>
        <td><b>Cofee Break</b></td>
    </tr>
    <tr>
        <td>&starf; Jumlah </td><td>: <input type="text" class="text" name="cb_jumlah" value="<?php echo $gl['cb_jumlah']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Frekuensi </td><td>: <input type="text" class="text" name="cb_frekuensi" value="<?php echo $gl['cb_frekuansi']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Waktu Pemberian </td><td>: <input type="checkbox" name="pemberian[]" value="9:45" <?php if($pemberian1 == '9:45') { echo 'checked="checked"';}; ?>>&nbsp;9:45&nbsp;<input type="checkbox" name="pemberian[]" value="14:00" <?php if($pemberian2 == '14:00') { echo 'checked="checked"';} ?>>&nbsp;14:00&nbsp;<input type="checkbox" name="pemberian[]" value="20:00" <?php if($pemberian3 == '20:00') { echo 'checked="checked"';}?>>&nbsp;20:00</td>
    </tr>
    <tr>
        <td>&starf; Refreshment di Ruangan </td><td>: <input type="checkbox" name="refreshment[]" value="Air Mineral Kemasan Botol 600ml" <?php if($refreshment1 == 'Air Mineral Kemasan Botol 600ml') { echo 'checked="checked"';} ?>>&nbsp;Air Mineral Kemasan Botol 600ml&nbsp;<input type="checkbox" name="refreshment[]" value="Permen (max. 3 Jenis)" <?php if($refreshment2 == 'Permen (max. 3 Jenis)') { echo 'checked="checked"';} ?>>&nbsp;Permen (max. 3 Jenis)</td>
    </tr>
    <tr>
        <td><b>5. Transportasi</b></td>
    </tr>
    <tr>
        <td>&starf; Jenis Kendaraan </td><td>: <input type="text" class="text" name="trans_jenis_kendaraan" value="<?php echo $gl['trans_jenis_kendaraan']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Tanggal Penggunaan </td><td>: <input type="text" id="trans_tgl" class="text" name="trans_tanggal" value="<?php echo $gl['trans_tanggal']; ?>"></td>
    </tr>
    <tr>
        <td>&starf; Waktu Penggunaan </td><td>: <input type="text" class="text" name="trans_waktu" value="<?php echo $gl['trans_waktu']; ?>"></td>
    </tr>
                <tr>
        <td><b>6. Training Kit</b></td>
    </tr>
    <tr>
        <td>&starf; Tas Ransel </td><td>: <input type="text" class="input-mini" name="tk_tas_ransel" value="<?php echo $gl['tk_tas_ransel']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&starf; Block Note </td><td>: <input type="text" class="input-mini" name="tk_block_note" value="<?php echo $gl['tk_block_note']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&starf; Ballpoint </td><td>: <input type="text" class="input-mini" name="tk_ballpoint" value="<?php echo $gl['tk_ballpoint']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&starf; Flashdisk </td><td>: <input type="text" class="input-mini" name="tk_flashdisk" value="<?php echo $gl['tk_flashdisk']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&starf; Keping CD </td><td>: <input type="text" class="input-mini" name="tk_cd" value="<?php echo $gl['tk_cd']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&starf; Keping DVD </td><td>: <input type="text" class="input-mini" name="tk_dvd" value="<?php echo $gl['tk_dvd']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>&starf; Lainnya </td><td>: <input type="text" class="input-mini" name="tk_lainnya" value="<?php echo $gl['tk_lainnya']; ?>">&nbsp;pcs</td>
    </tr>
    <tr>
        <td>Cost Center </td><td>: <input type="text" name="cost_center" value="<?php echo $gl['cost_center']; ?>"></td>
    </tr>
    <tr>
        <td>Cost Element </td><td>: <input type="text" name="cost_element" value="<?php echo $gl['cost_element']; ?>"></td>
    </tr>
</table>
<input type="submit" class="btn btn-primary" value="Simpan">
<?php echo anchor('sarfas/gl_front', 'Kembali', array('class'=>'btn')); ?>
<?php echo form_close() ?>

<script type="text/javascript">
$(function () {
    $("#tanggal").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#tgl_pelaksanaan").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#trans_tgl").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#check_out_ins").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#check_out_pes").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#check_in_pes").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#check_in_ins").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});

</script>