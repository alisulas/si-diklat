<?php echo form_open($action); ?>

<table class="table table-striped table-condensed table-bordered">
    <tr>
        <td>No Asset</td>
        <td><input type="text" name="no_asset" value="<?php echo $laptop['no_asset']; ?>"></td>
    </tr>
    <tr>
        <td>No Seri</td>
        <td><input type="text" name="no_seri" value="<?php echo $laptop['no_seri']; ?>"></td>
    </tr>
        <tr>
            <td>Merk</td>
        <td><input type="text" name="merk" value="<?php echo $laptop['merk']; ?>"></td>
    </tr>
    <tr>
        <td>Lokasi</td>
        <td><input type="text" name="lokasi" value="<?php echo $laptop['lokasi']; ?>"></td>
    </tr>
    <tr>
        <td>Kelengkapan</td>
        <td>
            <?php echo $this->editor->textarea("kelengkapan",$laptop['kelengkapan']);?>
	    <?php echo form_error('kelengkapan');?>
        </td>
    </tr>
    <tr>
    <td>Catatan</td>
    <td>
        <?php echo $this->editor->textarea("catatan",$laptop['catatan']);?>
	<?php echo form_error('catatan');?>
    </td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?php echo $status; ?></td>
    </tr>
</table>
<a class="btn" href="laptop" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
<input type="submit" class="btn btn-primary" value="Simpan">
<?php echo form_close(); ?>
