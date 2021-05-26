<?php echo form_open($action); ?>
<table class="table table-condensed">
    <tr>
        <td width="250">Nama Pelatihan</td>
        <td width="5">:</td>
        <td><input type="text" name="nama_pelatihan"></td>
    </tr>
    <tr>
        <td>Angkatan</td>
        <td>:</td>
        <td><input type="text" name="angkatan"></td>
    </tr>
    <tr>
        <td>Tempat</td>
        <td>:</td>
        <td><input type="text" name="tempat"></td>
    </tr>
    <tr>
        <td>Waktu Buka</td>
        <td>:</td>
        <td><input type="text" name="wkt_buka" id="datepicker1"></td>
    </tr>
    <tr>
        <td>Waktu Tutup</td>
        <td>:</td>
        <td><input type="text" name="wkt_tutup" id="datepicker2"></td>
    </tr>
    <tr>
        <td>Durasi (Hari)</td>
        <td>:</td>
        <td><input type="text" name="durasi"></td>
    </tr>
    <tr>
        <td>R/NR</td>
        <td>:</td>
        <td><input type="radio" value ="R" name="rnr">&nbsp; R &nbsp;<input type="radio" value ="NR" name="rnr">&nbsp;NR</td>
    </tr>
    <tr>
        <td>IH/P</td>
        <td>:</td>
        <td><input type="radio" value ="IH" name="ihp">&nbsp; IH &nbsp;<input type="radio" value ="P" name="ihp">&nbsp;P</td>
    </tr>
    <tr>
        <td>Penyelenggara</td>
        <td>:</td>
        <td><input type="text" name="penyelenggara"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><input type="text" name="nama"></td>
    </tr>
    <tr>
        <td>Nopek</td>
        <td>:</td>
        <td><input type="text" name="nopek"></td>
    </tr>
    <tr>
        <td>Bagian/Unit/Fungsi</td>
        <td>:</td>
        <td><input type="text" name="fungsi"></td>
    </tr>
    <tr>
        <td>Direktorat/Unit Asal/Anak Perusahaan</td>
        <td>:</td>
        <td><input type="text" name="direktorat"></td>
    </tr>
    <tr>
        <td>Sertifikat</td>
        <td>:</td>
        <td><input type="text" name="sertifikat"></td>
    </tr>
</table>
<br>
<br>
<input type="submit" class="btn btn-primary" value="Simpan"> <?php echo anchor('mandatory/index', 'Kembali', array('class'=>'btn')); ?>
<?php echo form_close(); ?>

<script type="text/javascript">
$(function () {
 
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