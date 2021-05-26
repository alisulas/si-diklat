<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>
<table class="table table-bordered">
    <tr>
	<td valign="top" width="200">No <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="no" class="text"
		   value="<?php echo (set_value('no'))?
		   set_value('no'):$trainer['no'];?>" />
	    <?php echo form_error('no');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Tanggal <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="date" class="text input-small" id="date_now"
		   value="<?php echo (set_value('date'))?
		   set_value('date'):$trainer['date'];?>" />
	    <?php echo form_error('date');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Nama <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="name" class="text"
		   value="<?php echo (set_value('name'))?
		   set_value('name'):$trainer['name'];?>" />
	    <?php echo form_error('name');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Jenis Kelamin</td>
	<td class="left">
	    <div class="btn-group" data-toggle-name="gender" data-toggle="buttons-radio">
		<button type="button" class="btn" value="L">Laki-laki</button>
		<button type="button" class="btn" value="P">Perempuan</button>
	    </div>
	    <input type="hidden" name="gender" value="<?php echo (set_value('gender'))?
		   set_value('gender'):$trainer['gender'];?>" />
	    <?php echo form_error('gender');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Foto</td>
	<td class="left">
	    <input type="file" name="foto" size="20"/> <?php echo (set_value('foto'))?
		   set_value('foto'):'<img src="assets/uploads/trainer/'.$trainer['foto'].'" height="80"/>';?>
            <input type="hidden" name="foto2" value="<?php echo (set_value('foto'))?
		   set_value('foto'):$trainer['foto'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Pendidikan Terakhir</td>
	<td class="left">
	    <input type="text" name="education" class="text"
		   value="<?php echo (set_value('education'))?
		   set_value('education'):$trainer['education'];?>" />
	    <?php echo form_error('education');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Sertifikasi</td>
	<td class="left">
	    <input type="text" name="certification" class="text"
		   value="<?php echo (set_value('certification'))?
		   set_value('certification'):$trainer['certification'];?>" />
	    <?php echo form_error('certification');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Pengalaman Bekerja</td>
	<td class="left">
	    <input type="text" name="job_experience" class="text"
		   value="<?php echo (set_value('job_experience'))?
		   set_value('job_experience'):$trainer['job_experience'];?>" />
	    <?php echo form_error('job_experience');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Alamat</td>
	<td class="left">
	    <input type="text" name="address" class="text input-xxlarge"
		   value="<?php echo (set_value('address'))?
		   set_value('address'):$trainer['address'];?>" />
	    <?php echo form_error('address');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Telephon/HP</td>
	<td class="left">
	    <input type="text" name="phone" class="text"
		   value="<?php echo (set_value('phone'))?
		   set_value('phone'):$trainer['phone'];?>" />
	    <?php echo form_error('phone');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Fax</td>
	<td class="left">
	    <input type="text" name="fax" class="text"
		   value="<?php echo (set_value('fax'))?
		   set_value('fax'):$trainer['fax'];?>" />
	    <?php echo form_error('fax');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Email</td>
	<td class="left">
	    <input type="text" name="email" class="text" id="prependedInput"
		   value="<?php echo (set_value('email'))?
		   set_value('name'):$trainer['email'];?>" />
	    <?php echo form_error('email');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Website</td>
	<td class="left">
	    <input type="text" name="website" class="text"
		   value="<?php echo (set_value('website'))?
		   set_value('website'):$trainer['website'];?>" />
	    <?php echo form_error('website');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Nomor NPWP</td>
	<td class="left">
	    <input type="text" name="npwp_no" class="text"
		   value="<?php echo (set_value('npwp_no'))?
		   set_value('npwp_no'):$trainer['npwp_no'];?>" />
	    <?php echo form_error('npwp_no');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Tempat / Tanggal Lahir</td>
	<td class="left">
	    <input type="text" name="birth_location" class="text"
		   value="<?php echo (set_value('birth_location'))?
		   set_value('birth_location'):$trainer['birth_location'];?>" /> -
	    <input type="text" name="birth_date" class="text input-small" id="date_birth"
		   value="<?php echo (set_value('birth_date'))?
		   set_value('birth_date'):$trainer['birth_date'];?>" /> (Format : YYYY-MM-DD)
	    <?php echo form_error('birth_location');?>
	    <?php echo form_error('birth_date');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Profesi</td>
	<td class="left">
	    <input type="text" name="profession" class="text"
		   value="<?php echo (set_value('profession'))?
		   set_value('profession'):$trainer['profession'];?>" />
	    <?php echo form_error('profession');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Asosiasi</td>
	<td class="left">
	    <input type="text" name="association" class="text"
		   value="<?php echo (set_value('association'))?
		   set_value('association'):$trainer['association'];?>" />
	    <?php echo form_error('association');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Provider</td>
	<td class="left">
	    <select name="provider">
		<?php echo $provider;?>
	    </select>
	    <?php echo anchor('provider/add','Add Provider',array('class'=>'btn','target'=>'blank'));?>
	    <?php echo form_error('provider');?>
	</td>
    </tr>

    <tr>
	<td valign="top">Kompetensi Inti</td>
	<td class="left">
	    <?php echo $this->editor->textarea("core_competence",(set_value('core_competence'))?set_value('core_competence'):$trainer['core_competence']);?>
	    <?php echo form_error('core_competence');?>
	</td>
    </tr>
    
    <tr>
        <td valign="top">Keterangan</td>
        <td><input type="radio" name="ket" value="Black List">Black List <input type="radio" name="ket" value="White List">White List </td>
    </tr>

</table>


<input type="button" id="tam" class="btn btn-success" value="Tambahan" onclick="$('#more').show('normal'),$('#tam').hide('normal')" />
<div id="more">

    <table class="table table-striped">
        
    <tr>
	<td valign="top" colspan="3" align="center"><div align="center"><b>KELENGKAPAN DOKUMEN</b></div></td>
    </tr>

    <tr>
	<td valign="top">Surat Pengantar / Proposal Calon Instruktur (Softcopy dan Hardcopy)</td>
        <td class="left">
	    <input type="file" name="doc_surat_pengantar" size="20"/> 
                <?php echo (set_value('doc_surat_pengantar'))?
		   set_value('doc_surat_pengantar'):$trainer['doc_surat_pengantar'];?>
            <input type="hidden" name="doc_surat_pengantar2" value="<?php echo (set_value('doc_surat_pengantar'))?
		   set_value('doc_surat_pengantar'):$trainer['doc_surat_pengantar'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">NPWP (Softcopy dan Hardcopy)</td>
	<td class="left">
	    <input type="file" name="doc_npwp" size="20"/> <?php echo (set_value('doc_npwp'))?
		   set_value('doc_npwp'):$trainer['doc_npwp'];?>
            <input type="hidden" name="doc_npwp2" value="<?php echo (set_value('doc_npwp'))?
		   set_value('doc_npwp'):$trainer['doc_npwp'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">KTP (Softcopy dan Hardcopy)</td>
	<td class="left">
	    <input type="file" name="doc_ktp" size="20"/> <?php echo (set_value('doc_ktp'))?
		   set_value('doc_ktp'):$trainer['doc_ktp'];?>
            <input type="hidden" name="doc_ktp2" value="<?php echo (set_value('doc_ktp'))?
		   set_value('doc_ktp'):$trainer['doc_ktp'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Kartu Tanda Anggoga Asosiasi (Softcopy dan Hardcopy)</td>
		<td class="left">
	    <input type="file" name="doc_kta" size="20"/> <?php echo (set_value('doc_kta'))?
		   set_value('doc_kta'):$trainer['doc_kta'];?>
            <input type="hidden" name="doc_kta2" value="<?php echo (set_value('doc_kta'))?
		   set_value('doc_kta'):$trainer['doc_kta'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Ijazah Pendidikan Terakhir (Softcopy dan Hardcopy)</td>
			<td class="left">
	    <input type="file" name="doc_ijazah" size="20"/> <?php echo (set_value('doc_ijazah'))?
		   set_value('doc_ijazah'):$trainer['doc_ijazah'];?>
            <input type="hidden" name="doc_ijazah2" value="<?php echo (set_value('doc_ijazah'))?
		   set_value('doc_ijazah'):$trainer['doc_ijazah'];?>" />
	</td>
    </tr>

    <tr>
	<td valign="top">Sertifikat (Softcopy dan Hardcopy)</td>
				<td class="left">
	    <input type="file" name="doc_sertifikat" size="20"/> <?php echo (set_value('doc_sertifikat'))?
		   set_value('doc_sertifikat'):$trainer['doc_sertifikat'];?>
            <input type="hidden" name="doc_sertifikat2" value="<?php echo (set_value('doc_sertifikat'))?
		   set_value('doc_sertifikat'):$trainer['doc_sertifikat'];?>" />
	</td>
    </tr>


    <tr>
	<td valign="top">NPWP (Softcopy dan Hardcopy)</td>
					<td class="left">
	    <input type="file" name="doc_form_kursil" size="20"/> <?php echo (set_value('doc_form_kursil'))?
		   set_value('doc_form_kursil'):$trainer['doc_form_kursil'];?>
            <input type="hidden" name="doc_form_kursil2" value="<?php echo (set_value('doc_form_kursil'))?
		   set_value('doc_form_kursil'):$trainer['doc_form_kursil'];?>" />
	</td>
    </tr>
    <tr>
	<td valign="top">Form Instruktur</td>
					<td class="left">
	    <input type="file" name="doc_form_instruktur" size="20"/> <?php echo (set_value('doc_form_instruktur'))?
		   set_value('doc_form_instruktur'):$trainer['doc_form_instruktur'];?>
            <input type="hidden" name="doc_form_instruktur2" value="<?php echo (set_value('doc_form_instruktur'))?
		   set_value('doc_form_instruktur'):$trainer['doc_form_instruktur'];?>" />
	</td>
    </tr>
    </table>

    <input type="button" class="btn btn-danger" value="Hapus" onclick="$('#more').hide('normal'),$('#tam').show('normal')" />
</div>

<div class="form-actions">
    <a class="btn" href="trainer"><i class="icon-hand-left"></i> Cancel</a>
    <button class="btn btn-primary" type="submit">Save Changes</button>
</div>
<?php echo form_close();?>
<script type="text/javascript">
    $(function () {
	$(".btn-group").button();
	$("#date_now").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
	});
	$("#date_birth").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
	});
});
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#more").hide();
    });
</script>