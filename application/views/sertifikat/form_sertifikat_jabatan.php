<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo form_open($action); ?>

<table class="table table-bordered table-condensed">
    <tr>
        <td>
            Kode
        </td>
        <td>
            <input type="text" name="kode" class="text" value="<?php echo (set_value('kode')) ?
                                                                    set_value('kode') : $sertifikat['kode']; ?>" />
            <?php echo form_error('kode'); ?>
        </td>
    </tr>

    <tr>
        <td>
            Nama Sertifikasi
        </td>
        <td>
            <input type="text" name="name" class="text" value="<?php echo (set_value('name')) ?
                                                                    set_value('name') : $sertifikat['name']; ?>" />
            <?php echo form_error('name'); ?>
        </td>
    </tr>

    <tr>
        <td>
            <input type="submit" value="simpan" class="btn btn-primary"> <a href="sertifikat/list_sertifikat_jabatan"
                class="btn"><i class="icon-backward"></i> Back</a>
        </td>
        <td></td>
    </tr>
</table>

<?php echo form_close(); ?>