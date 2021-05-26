<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<h3>Tambah Libur</h3>
<p>
    <?php echo form_open($action);?>
    <table class="table table-condensed">
	<tr><td width="100">Tanggal</td><td><input type="text" id="date" name="date"></td></tr>
	<tr><td>Keterangan</td><td><?php echo form_input('ket');?></td></tr>
    </table>
    <div class="form-actions">
	<a class="btn" href="tln"><i class="icon-hand-left"></i> Kembali</a>
	<button class="btn btn-primary" type="submit">Tambah</button>
    </div>
    <?php echo form_close();?>

<p>
    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>


<script type="text/javascript">
$(function () {
    $("#date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>
