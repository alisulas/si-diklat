<?php echo form_open($action); ?>
<table class="table table-condensed">
    <tr>
        <td width="250">Nama Pelatihan</td>
        <td width="5">:</td>
        <td><input type="text" name="nama_pelatihan" value="<?php echo $mandatory['nama_pelatihan']; ?>"></td>
    </tr>
    <tr>
        <td>Angkatan</td>
        <td>:</td>
        <td><input type="text" name="angkatan" value="<?php echo $mandatory['angkatan']; ?>"></td>
    </tr>
    <tr>
        <td>Tempat</td>
        <td>:</td>
        <td><input type="text" name="tempat" value="<?php echo $mandatory['tempat']; ?>"></td>
    </tr>
    <tr>
        <td>Waktu Buka</td>
        <td>:</td>
        <td><input type="text" name="wkt_buka" id="datepicker1" value="<?php echo $mandatory['wkt_buka']; ?>"></td>
    </tr>
    <tr>
        <td>Waktu Tutup</td>
        <td>:</td>
        <td><input type="text" name="wkt_tutup" id="datepicker2" value="<?php echo $mandatory['wkt_tutup']; ?>"></td>
    </tr>
    <tr>
        <td>Durasi (Hari)</td>
        <td>:</td>
        <td><input type="text" name="durasi" value="<?php echo $mandatory['durasi']; ?>"></td>
    </tr>
    <tr>
        <td>R/NR</td>
        <td>:</td>
        <td>
            <?php
            if ($mandatory['rnr'] == 'R') {
                echo '<input type="radio" value ="R" name="rnr" checked>&nbsp; R &nbsp;<input type="radio" value ="NR" name="rnr">&nbsp;NR';
            } else {
                echo '<input type="radio" value ="R" name="rnr">&nbsp; R &nbsp;<input type="radio" checked value ="NR" name="rnr">&nbsp;NR';
            }
            ?>

        </td>
    </tr>
    <tr>
        <td>IH/P</td>
        <td>:</td>
        <td>
            <?php
            if ($mandatory['ihp'] == 'IH') {
                echo '<input type="radio" value ="IH" name="ihp" checked >&nbsp; IH &nbsp;<input type="radio" value ="P" name="ihp">&nbsp;P';
            } else {
                echo '<input type="radio" value ="IH" name="ihp">&nbsp; IH &nbsp;<input type="radio" value ="P" name="ihp" checked >&nbsp;P';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>Penyelenggara</td>
        <td>:</td>
        <td><input type="text" name="penyelenggara" value="<?php echo $mandatory['penyelenggara']; ?>"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><input type="text" name="nama" value="<?php echo $mandatory['nama']; ?>"></td>
    </tr>
    <tr>
        <td>Nopek</td>
        <td>:</td>
        <td><input type="text" name="nopek" value="<?php echo $mandatory['nopek']; ?>"></td>
    </tr>
    <tr>
        <td>Bagian/Unit/Fungsi</td>
        <td>:</td>
        <td><input type="text" name="fungsi" value="<?php echo $mandatory['fungsi']; ?>"></td>
    </tr>
    <tr>
        <td>Direktorat/Unit Asal/Anak Perusahaan</td>
        <td>:</td>
        <td><input type="text" name="direktorat" value="<?php echo $mandatory['direktorat']; ?>"></td>
    </tr>
    <tr>
        <td>Sertifikat</td>
        <td>:</td>
        <td><input type="text" name="sertifikat" value="<?php echo $mandatory['sertifikat']; ?>"></td>
    </tr>
</table>
<br>
<br>
<input type="submit" class="btn btn-primary"
    value="Simpan"><?php echo anchor('mandatory/index', 'Kembali', array('class' => 'btn')); ?>
<?php echo form_close(); ?>

<script type="text/javascript">
$(function() {

    $("#datepicker1").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#datepicker2").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#datepicker3").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#datepicker4").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#datepicker5").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
});
</script>