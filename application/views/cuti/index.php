<!-- FCK Editor -->
<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/editor/_samples/sample.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action_nopek); ?>
<input type="text" name="nopek" class="text" value="" placeholder="Masukan Nopek">
<input type="submit" class="btn btn-primary" value="Cari">
<?php echo form_close(); ?>
<br>
<br>

<?php if (empty($nopek)) { ?>

<table class="table table-bordered">

    <tr>
        <td>Cuti Tanggal</td>
        <td>
            <input type="text" class="text input-small" id="mulai" disabled="true" />
        </td>
    </tr>
    <tr>
        <td>Sampai Tanggal</td>
        <td>
            <input type="text" class="text input-small" id="akhir" disabled="true" />
        </td>
    </tr>
    <tr>
        <td>Total Hari Kerja Cuti</td>
        <td>
            <input type="text" class="text input-small" disabled="true" />
        </td>
    </tr>
    <tr>
        <td>Sisa Cuti</td>
        <td>
            0 Hari
        </td>
    </tr>
</table>

<?php } else { ?>

<table class="table table-bordered">
    <tr>
        <td>Nopek</td>
        <td>
            <?php echo $nopek; ?>
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>
            <?php echo $nama; ?>
        </td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>
            <?php echo $jabatan; ?>
        </td>
    </tr>
    <tr>
        <td>Due Date Cuti</td>
        <td>
            <?php echo $tanggal; ?>
        </td>
    </tr>
    <tr>
        <td>Cuti Tahun Ke</td>
        <td>
            <?php echo $tahun_ke; ?>
        </td>
    </tr>
    <tr>
        <td>Jumlah Hari</td>
        <td>
            <?php echo $total_hari; ?>
        </td>
    </tr>
</table>
<?php echo form_open($action); ?>
<table class="table table-bordered">
    <input type="hidden" name="nopek" value="<?php echo $nopek; ?>">
    <tr>
        <td>Cuti Tanggal</td>
        <td>
            <input type="text" name="tgl_mulai" class="text input-small" id="mulai" />
        </td>
    </tr>
    <tr>
        <td>Sampai Tanggal</td>
        <td>
            <input type="text" name="tgl_selesai" class="text input-small" id="akhir" />
        </td>
    </tr>
    <tr>
        <td>Total Hari Kerja Cuti</td>
        <td>
            <input type="text" name="total_hk" class="text input-small" id="target" />
        </td>
    </tr>
    <tr>
        <td>Sisa Cuti</td>
        <td>
            <input type="hidden" value="<?php echo $sisa_cuti; ?>" id="sisa_cuti">
            <input type="text" id="hasil_target" disabled="true" class="text input-small"
                value="<?php echo $sisa_cuti; ?>" name="sisa"> Hari
        </td>
    </tr>
    <tr>
        <td style="background-color:#FFE7A1" colspan="2">
            <b> Catatan : </b><br>
            1. Sisa cuti yang ada sudah dikurangi Cuti Bersama 2013 sebanyak 5 Hari Kerja <br>
            2. Cuti Bersama tahun 2013 sebagai berikut: <br>
            - 5,6,7 Agustus 2013 = Hari Raya Idul Fitri 1434 H <br>
            - 14 Oktober 2013 = Hari Raya Idul Adha 1434 H <br>
            - 26 Desember 2013 = Hari Raya Natal
        </td>

    </tr>
</table>
<div class="form-actions">
    <input type="submit" class="btn btn-primary" value="Kirim">
</div>
<?php echo form_close(); ?>

<?php } ?>




<script type="text/javascript">
$("#target").change(function() {
    var str = "";
    str += $("#sisa_cuti").val() - $(this).val();
    $("#hasil_target").val(str);

});




$(function() {
    $("#mulai").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#akhir").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
    $("#kembali").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });
});
</script>