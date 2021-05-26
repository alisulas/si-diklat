<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>
<table class="table table-bordered">
    <tr>
	<td valign="top" width="300">Tempat terjadinya ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
	   <?php echo $carpar['tempat'];?>
	</td>
    </tr>

    <tr>
	<td valign="top">Nama Program <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="nama_program" class="text" />
	</td>
    </tr>

    <tr>
	<td valign="top">Kode Program <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="kode_program" class="text" />
	</td>
    </tr>

    <tr>
	<td valign="top">Temuan / Potensi Ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="temuan" class="text" />
	</td>
    </tr>
    <tr>
	<td valign="top">PIC <span style="color:red">*</span></td>
	<td class="left">
            <select name="pic">
                <option value="1">P&D</option>
                <option value="2">FGT</option>
                <option value="4">LDT</option>
                <option value="5">LS</option>
            </select>
            &nbsp; Email : <input type="text" name="email" class="text">
	</td>
    </tr>

    <tr>
	<td valign="top">Analisa Penyebab terjadinya ketidaksesuaian / Potensi ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
            <textarea name="analisa" rows="5" cols="50"></textarea>
	</td>
    </tr>

    <tr>
	<td valign="top">Penyelidikan akar permasalahan ketidaksesuaian / potensi ketidaksesuaian <span style="color:red">*</span></td>
	<td class="left">
	    <textarea name="penyelidikan" rows="5" cols="50"></textarea>
	</td>
    </tr>

    
    </table>


<div class="form-actions">
    <a class="btn" href="trainer"><i class="icon-hand-left"></i> Kembali</a>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close();?>

