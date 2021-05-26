
<?php echo form_open($action); ?>
<table class="table table-striped">
    <tr>
        <td>Judul</td>
        <td><input name="judul" class="input" value="<?php echo $judul; ?>"></td>
    </tr>
    <tr>
        <td>Template</td>
        <td><?php echo $this->editor->textarea('template',$template); ?></td>
    </tr>
</table>
<div class="form-actions">
    <a href="fgt_induction/list_support" class="btn"><i class="icon-hand-left"></i> Kembali</a>&nbsp;<button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close(); ?>