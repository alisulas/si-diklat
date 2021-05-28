<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>
<?php echo anchor('sarfas/add_peminjaman_laptop', 'Tambah', array('class' => 'btn btn-primary')); ?>
&nbsp;<input type="button" id="buka" class="btn btn-inverse" value="Pencarian"
    onclick="$('#pencarian').show('normal'),$('#buka').hide('normal')" />
<?php echo $refresh; ?>

<div id="pencarian">
    <?php echo form_open($action) ?>
    <table>
        <tr>
            <td><span class="label label-inverse">Nopek</span></td>
            <td><input type="text" name="nopek" placeholder="Nopek" /></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Nama</span></td>
            <td><input type="text" name="nama" class="input input-small" placeholder="Nama"></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Status</span></td>
            <td><select name="status">
                    <option value="">-</option>
                    <option value="0">Belum Kembali</option>
                    <option value="1">Sudah Kembali</option>
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Cari"></td>
        </tr>
    </table>

    <?php echo form_close(); ?>

    <!-- <input type="button" class="btn btn-danger" value="Tutup" onclick="$('#pencarian').hide('normal'),$('#buka').show('normal')" /> -->
</div>
<br>
<p>
    <?php echo $pagination; ?>
    <?php echo $content; ?>
    <?php echo $pagination; ?>
    <?php echo $detail_laptop; ?>
    <?php echo $edit_laptop; ?>
</p>

<script type="text/javascript">
$(document).ready(function() {
    $("#pencarian").hide();
});
</script>