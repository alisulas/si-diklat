<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>
<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top" width="250">No <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="no" class="text"
		   value="<?php echo (set_value('no'))?
		   set_value('no'):$provider['no'];?>" />
	    <?php echo form_error('no');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Nama Perusahaan <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="name" class="text"
		   value="<?php echo (set_value('name'))?
		   set_value('name'):$provider['name'];?>" />
	    <?php echo form_error('name');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Alamat Perusahaan</td>
	<td class="left" colspan="3">
	    <input type="text" name="address" class="text input-xxlarge"
		   value="<?php echo (set_value('address'))?
		   set_value('address'):$provider['address'];?>" />
	    <?php echo form_error('address');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Telp <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="phone" class="text"
		   value="<?php echo (set_value('phone'))?
		   set_value('phone'):$provider['phone'];?>" />
	    <?php echo form_error('phone');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Fax <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="fax" class="text"
		   value="<?php echo (set_value('fax'))?
		   set_value('fax'):$provider['fax'];?>" />
	    <?php echo form_error('fax');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Email <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="email" class="text"
		   value="<?php echo (set_value('email'))?
		   set_value('email'):$provider['email'];?>" />
	    <?php echo form_error('email');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Website <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="website" class="text"
		   value="<?php echo (set_value('website'))?
		   set_value('website'):$provider['website'];?>" />
	    <?php echo form_error('website');?>
	</td>
    </tr>
    <tr>
	<td valign="top">No NPWP <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="npwp_no" class="text"
		   value="<?php echo (set_value('npwp_no'))?
		   set_value('npwp_no'):$provider['npwp_no'];?>" />
	    <?php echo form_error('npwp_no');?>
	</td>
    </tr>
    <tr>
	<td valign="top">No Akte <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="akte_no" class="text"
		   value="<?php echo (set_value('akte_no'))?
		   set_value('akte_no'):$provider['akte_no'];?>" />
	    <?php echo form_error('akte_no');?>
	</td>
        <td valign="top">Tanggal Akte <span style="color:red">*</span></td>
	<td class="left">
	    <input id ="datepicker" type="text" name="akte_date" class="text"
		   value="<?php echo (set_value('akte_date'))?
		   set_value('akte_date'):$provider['akte_date'];?>" />
	    <?php echo form_error('akte_date');?>

	</td>
    </tr>
    <tr>
	<td valign="top">No SIUP <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="siup_no" class="text"
		   value="<?php echo (set_value('siup_no'))?
		   set_value('siup_no'):$provider['siup_no'];?>" />
	    <?php echo form_error('siup_no');?>
	</td>
        <td valign="top">Tanggal SIUP <span style="color:red">*</span></td>
	<td class="left">
	    <input id ="datepicker2" type="text" name="siup_date" class="text"
		   value="<?php echo (set_value('siup_date'))?
		   set_value('siup_date'):$provider['siup_date'];?>" />
	    <?php echo form_error('siup_date');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Nomor PKP <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="pkp_no" class="text"
		   value="<?php echo (set_value('pkp_no'))?
		   set_value('pkp_no'):$provider['pkp_no'];?>" />
	    <?php echo form_error('pkp_no');?>
	</td>
        <td valign="top">Tanggal PKP <span style="color:red">*</span></td>
	<td class="left">
	    <input id ="datepicker3" type="text" name="pkp_date" class="text"
		   value="<?php echo (set_value('pkp_date'))?
		   set_value('pkp_date'):$provider['pkp_date'];?>" />
	    <?php echo form_error('pkp_date');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Asosiasi <span style="color:red">*</span></td>
	<td class="left" colspan="3">
	    <input type="text" name="association" class="text"
		   value="<?php echo (set_value('association'))?
		   set_value('association'):$provider['association'];?>" />
	    <?php echo form_error('association');?>
	</td>
    </tr>
            <tr>
	<td valign="top">Kompetensi</td>
	<td class="left" colspan="3">
	    <?php echo $this->editor->textarea("learning_competence",(set_value('learning_competence'))?set_value('learning_competence'):$provider['learning_competence']);?>
	    <?php echo form_error('learning_competence');?>
	</td>
    </tr>
        <tr>
        <td valign="top">Keterangan</td>
        <td>
            <?php
if ($provider['ket']=='Black List') {
 echo '<input type="radio" name="ket" value="Black List" checked="checked">Black List <input type="radio" name="ket" value="White List">White List ';               
}  else {
echo '<input type="radio" name="ket" value="Black List">Black List <input type="radio" name="ket" value="White List" checked="checked">White List ';     
}
            ?>
            
        </td>
    </tr>
            <tr>
        <td valign="top">Catatan</td>
        <td><textarea name="catatan"><?php echo $provider['catatan']; ?></textarea></td>
    </tr>
    <tr>
	<td valign="top">Surat Pengantar dan Proposal Calon Provider (Softcopy dan Hardcopy)</td>
	<td class="left">
	    <input type="file" name="doc_surat" size="20"/> 
                
            <?php 

            if($provider['doc_surat']==''){
              echo  '<div class="btn btn-danger">Belum Tersedia</div>';
            }else{
              echo  '<a href="assets/uploads/provider/'.$provider['doc_surat'].'" class="btn btn-success">Download File</a>';
            }
            
            ?>
            <input type="hidden" name="doc_surat2" value="<?php echo (set_value('doc_surat'))?
		   set_value('doc_surat'):$provider['doc_surat'];?>" />
	</td>
    </tr>
    <tr>
	<td valign="top">NPWP (Softcopy dan Hardcopy)</td>
	<td class="left">
	    <input type="file" name="doc_npwp" size="20"/> 
                
            <?php 

            if($provider['doc_npwp']==''){
              echo  '<div class="btn btn-danger">Belum Tersedia</div>';
            }else{
              echo  '<a href="assets/uploads/provider/'.$provider['doc_npwp'].'" class="btn btn-success">Download File</a>';
            }
            
            ?>
            <input type="hidden" name="doc_npwp2" value="<?php echo (set_value('doc_npwp'))?
		   set_value('doc_npwp'):$provider['doc_npwp'];?>" />
	</td>
    </tr>
    <tr>
	<td valign="top">Akte Pendirian (Softcopy dan Hardcopy)</td>
		<td class="left">
	    <input type="file" name="doc_akte" size="20"/> 
                
            <?php 

            if($provider['doc_akte']==''){
              echo  '<div class="btn btn-danger">Belum Tersedia</div>';
            }else{
              echo  '<a href="assets/uploads/provider/'.$provider['doc_akte'].'" class="btn btn-success">Download File</a>';
            }
            
            ?>
            <input type="hidden" name="doc_akte2" value="<?php echo (set_value('doc_akte'))?
		   set_value('doc_akte'):$provider['doc_akte'];?>" />
	</td>
    </tr>
        <tr>
	<td valign="top">SIUP (Softcopy dan Hardcopy)</td>
		<td class="left">
	    <input type="file" name="doc_siup" size="20"/> 
                
            <?php 

            if($provider['doc_siup']==''){
              echo  '<div class="btn btn-danger">Belum Tersedia</div>';
            }else{
              echo  '<a href="assets/uploads/provider/'.$provider['doc_siup'].'" class="btn btn-success">Download File</a>';
            }
            
            ?>
            <input type="hidden" name="doc_siup2" value="<?php echo (set_value('doc_siup'))?
		   set_value('doc_siup'):$provider['doc_siup'];?>" />
	</td>
    </tr>
     <tr>
	<td valign="top">PKP  (Softcopy dan Hardcopy)</td>
		<td class="left">
	    <input type="file" name="doc_pkp" size="20"/> 
                
            <?php 

            if($provider['doc_pkp']==''){
              echo  '<div class="btn btn-danger">Belum Tersedia</div>';
            }else{
              echo  '<a href="assets/uploads/provider/'.$provider['doc_pkp'].'" class="btn btn-success">Download File</a>';
            }
            
            ?>
            <input type="hidden" name="doc_pkp2" value="<?php echo (set_value('doc_pkp'))?
		   set_value('doc_pkp'):$provider['doc_pkp'];?>" />
	</td>
    </tr>

         <tr>
	<td valign="top">Form Kurikulum Silabus (Softcopy dan Hardcopy)</td>
		<td class="left">
	    <input type="file" name="doc_kursil" size="20"/> 
                
            <?php 

            if($provider['doc_kursil']==''){
              echo  '<div class="btn btn-danger">Belum Tersedia</div>';
            }else{
              echo  '<a href="assets/uploads/provider/'.$provider['doc_kursil'].'" class="btn btn-success">Download File</a>';
            }
            
            ?>
            <input type="hidden" name="doc_kursil2" value="<?php echo (set_value('doc_kursil'))?
		   set_value('doc_kursil'):$provider['doc_kursil'];?>" />
	</td>
    </tr>


</table>

<div class="form-actions">
    <a class="btn" href="provider"><i class="icon-hand-left"></i> Cancel</a>
    <button class="btn btn-primary" type="submit">Save Changes</button>
</div>
<?php echo form_close();?>

<script type="text/javascript">
$(function () {
    $(".btn-group").button();
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
});

</script>