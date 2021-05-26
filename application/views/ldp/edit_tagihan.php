<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<?php echo form_open_multipart($action); ?>
<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top" width="250">Program <span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <input type="text" name="program" class="text" value="<?php echo $program; ?>"/>
	    <?php echo form_error('program');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Lembaga Provider <span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <input type="text" name="provider" class="text" value="<?php echo $provider; ?>"/>
	    <?php echo form_error('provider');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left" colspan="3">
            <input type="text" id="datepicker" name="tgl_mulai" value="<?php echo $tgl_mulai; ?>" class="text input-mini" /> s/d <input type="text" id="datepicker2" name="tgl_selesai" value="<?php echo $tgl_selesai; ?>" class="text input-mini" />
	    <?php echo form_error('tgl_mulai');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Tagihan Masuk<span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <input type="text" id="datepicker3" name="tgl_tagihan_masuk" value="<?php echo $tgl_tagihan_masuk; ?>" class="text" />
	    <?php echo form_error('tgl_tagihan_masuk');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Dokumen Lengkap<span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <input type="text" id="datepicker7" name="tgl_dokumen_lengkap" value="<?php echo $tgl_dokumen_lengkap; ?>" class="text" />
	    <?php echo form_error('tgl_dokumen_lengkap');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Tagihan ke GSFA <span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <input type="text" id="datepicker4" name="tgl_tagihan_gsfa" value="<?php echo $tgl_tagihan_gsfa; ?>" class="text"/>
	    <?php echo form_error('tgl_tagihan_gsfa');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Catatan</td>
	<td class="left" colspan="3">
	    <?php echo $this->editor->textarea("catatan",$catatan);?>
	    <?php echo form_error('catatan');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Tanggal Pembayaran <span style="color:red">*</span></td>
	<td class="left" colspan="3">
            <input type="text" id="datepicker5" name="tgl_pembayaran" value="<?php echo $tgl_pembayaran; ?>" class="text"/>
	    <?php echo form_error('tgl_pembayaran');?>
	</td>
    </tr>
</table>

<button class="btn btn-primary" type="submit">Simpan</button>&nbsp;&nbsp;
    <a href="ldp/index_tagihan" class="btn">Kembali</a>
<?php echo form_close();?>

<script type="text/javascript">
$(function () {
 
    $("#datepicker").datepicker({
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
    $("#datepicker7").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>