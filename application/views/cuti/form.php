<!-- FCK Editor -->
<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/editor/_samples/sample.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<?php echo form_open_multipart($action); ?>
<table class="table table-bordered">
    <tr>
        <td>Nopek</td>
        <td>
            <input type="text" name="nopek" class="text">
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>
            <input type="text" name="nama" class="text">
        </td>
    </tr>
    <tr>
        <td>Tanggal Mulai Cuti</td>
        <td>
<input type="text" name="tgl_mulai_cuti" class="text input-small" id="mulai" />
        </td>
    </tr>
    <tr>
        <td>Tanggal Akhir Cuti</td>
        <td>
<input type="text" name="tgl_akhir_cuti" class="text input-small" id="akhir" />
        </td>
    </tr>
    <tr>
        <td>Tanggal Kembali Bekerja</td>
        <td>
<input type="text" name="tgl_kembali" class="text input-small" id="kembali" />
        </td>
    </tr>
        <tr>
        <td>Sisa Cuti</td>
        <td>
            <input type="text" name="sisa" class="text">
        </td>
    </tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">kirim</button>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
$(function () {
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