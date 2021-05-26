<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>
<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top" width="250">Nama <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="nama" class="text"
		   value="<?php echo (set_value('nama'))?
		   set_value('nama'):$observer['nama'];?>" />
	    <?php echo form_error('nama');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Alamat <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="alamat" class="text input-xxlarge"
		   value="<?php echo (set_value('alamat'))?
		   set_value('alamat'):$observer['alamat'];?>" />
	    <?php echo form_error('nama');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Telp</td>
	<td class="left" colspan="3">
	    <input type="text" name="telp" class="text input-medium"
		   value="<?php echo (set_value('telp'))?
		   set_value('telp'):$observer['telp'];?>" />
	    <?php echo form_error('telp');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Fax <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="fax" class="text"
		   value="<?php echo (set_value('fax'))?
		   set_value('fax'):$observer['fax'];?>" />
	    <?php echo form_error('fax');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Email <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="email" class="text"
		   value="<?php echo (set_value('email'))?
		   set_value('email'):$observer['email'];?>" />
	    <?php echo form_error('email');?>
	</td>
    </tr>
</table>

<div class="form-actions">
    <a class="btn" href="observer"><i class="icon-hand-left"></i> Kembali</a>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close();?>