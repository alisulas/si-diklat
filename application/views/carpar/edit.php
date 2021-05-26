<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>
<table class="table table-bordered">
    <tr>
	<td valign="top" width="300">No Report<span style="color:red">*</span></td>
	<td class="left">
	   <?php echo $no_report; ?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tempat terjadinya ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
<?php echo $carpar['tempat'];?>
	</td>
    </tr>

    <tr>
	<td valign="top">Nama Program <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="nama_program" class="text" 
		   value="<?php echo $carpar['nama_program'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Kode Program <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="kode_program" class="text" 
		   value="<?php echo $carpar['kode_program'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Email <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="email_pic" class="text" 
		   value="<?php echo $carpar['email_pic'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Temuan / Potensi Ketidaksesuaian Penanggungjawab <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="temuan" class="text" 
		   value="<?php echo $carpar['temuan'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Analisa Penyebab terjadinya ketidaksesuaian / Potensi ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
            <textarea name="analisa" rows="5" cols="50"><?php echo $carpar['analisa'];?></textarea>
	</td>
    </tr>

    <tr>
	<td valign="top">Penyelidikan akar permasalahan ketidaksesuaian / potensi ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
            
<textarea name="penyelidikan" rows="5" cols="50"><?php echo $carpar['penyelidikan'];?></textarea>
	</td>
    </tr>

    </table>


<div class="form-actions">
    <a class="btn" href="carpar"><i class="icon-hand-left"></i> Kembali</a>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>

<?php echo form_close();?>
