<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>
<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top">PIC</td>
	<td class="left">
	    <input type="text" name="pic" class="text"
		   value="<?php echo (set_value('pic'))?
		   set_value('pic'):$course['pic'];?>" />
	    <?php echo form_error('pic');?>
	</td>	
    </tr>
    <tr>
	<td valign="top" width="200">Kode Program<span style="color:red">*</span></td>
	<td class="left">
	    <?php echo $course['kode']; ?>
            <input type="hidden" name="kode" value="<?php echo $course['kode']; ?>" >
	</td>
    </tr>
    <tr>
	<td valign="top">Nama Pelatihan <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="course_name" class="text"
		   value="<?php echo (set_value('course_name'))?
		   set_value('course_name'):$course['course_name'];?>" />
	    <?php echo form_error('course_name');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left">
	    <input type="text" name="start_date" class="text input-small" id="start_date"
		   value="<?php echo (set_value('start_date'))?
		   set_value('start_date'):$course['start_date'];?>" /> -
            <input type="text" name="end_date" class="text input-small" id="end_date"
		   value="<?php echo (set_value('end_date'))?
		   set_value('end_date'):$course['end_date'];?>" />
	    <?php echo form_error('start_date');?>
	    <?php echo form_error('end_date');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Lokasi</td>
        <td>
            <select name ="location" id="i_n_r_reason">
                <?php echo $options_class; ?>
                
            </select>
            <input id="other_reason" name="other" type="text" placeholder="Masukan nama Hotel/Kantor/Kota" />

        </td>
    </tr>
   <tr>
	<td valign="top">Sifat</td>
	<td class="left">
            <select name="sifat">
                <?php echo $sifat; ?>
            </select>
	</td>
    </tr>
    <tr>
        <td>Jenis</td>
	<td class="left">
	    <input type="text" name="jenis" class="text"
		   value="<?php echo (set_value('jenis'))?
		   set_value('jenis'):$course['jenis'];?>" />
	    <?php echo form_error('jenis');?>
	</td>
    </tr>
    <tr>
        <td>Nama User</td>
	<td class="left">
	    <input type="text" name="user_name" class="text"
		   value="<?php echo (set_value('user_name'))?
		   set_value('user_name'):$course['user_name'];?>" />
	    <?php echo form_error('user_name');?>
	</td>
    </tr>
    <tr>
        <td>User Referensi</td>
	<td class="left">
	    <input type="text" name="user_ref" class="text"
		   value="<?php echo (set_value('user_ref'))?
		   set_value('user_ref'):$course['user_ref'];?>" />
	    <?php echo form_error('user_ref');?>
	</td>
    </tr>
    <tr>
        <td>Jumlah Peserta</td>
	<td class="left">
	    <input type="text" name="jml_peserta" class="text"
		   value="<?php echo (set_value('jml_peserta'))?
		   set_value('jml_peserta'):$course['jml_peserta'];?>" />
	    <?php echo form_error('jml_peserta');?>
	</td>
    </tr>
    <tr>
        <td>Provider</td>
        	<td class="left">
	    <select name="provider">
		<?php echo $options_provider;?>
	    </select>
	    <?php echo anchor('provider/add','Add Provider',array('class'=>'btn','target'=>'blank'));?>
	    <?php echo form_error('provider');?>
	</td>
    </tr>
    <tr>
        <td>Course Steward</td>
	<td class="left">
	    <input type="text" name="course_steward" class="text"
		   value="<?php echo (set_value('course_steward'))?
		   set_value('course_steward'):$course['course_steward'];?>" />
	    <?php echo form_error('course_steward');?>
	</td>
    </tr> 
    <tr>
        <td>Jumlah / Kelas</td>
	<td class="left">
	    <input type="text" name="jumlah_per_kelas" class="text"
		   value="<?php echo (set_value('jumlah_per_kelas'))?
		   set_value('jumlah_per_kelas'):$course['jumlah_per_kelas'];?>" />
	    <?php echo form_error('jumlah_per_kelas');?>
	</td>
    </tr> 
    <tr>
        <td>Penawaran</td>
	<td class="left">
	    <input type="text" name="penawaran" class="text"
		   value="<?php echo (set_value('penawaran'))?
		   set_value('penawaran'):$course['penawaran'];?>" />
	    <?php echo form_error('penawaran');?>
	</td>
    </tr> 
    <tr>
        <td>Negosiasi</td>
	<td class="left">
	    <input type="text" name="negosiasi" class="text"
		   value="<?php echo (set_value('negosiasi'))?
		   set_value('negosiasi'):$course['negosiasi'];?>" />
	    <?php echo form_error('negosiasi');?>
	</td>
    </tr> 
    <tr>
        <td>Penambahan / Peserta</td>
	<td class="left">
	    <input type="text" name="penambahan_peserta" class="text"
		   value="<?php echo (set_value('penambahan_peserta'))?
		   set_value('penambahan_peserta'):$course['penambahan_peserta'];?>" />
	    <?php echo form_error('penambahan_peserta');?>
	</td>
    </tr> 
    <tr>
        <td>Memo Panggilan</td>
	<td class="left">
            <input type="text" name="memo_panggilan" class="text" id="memo_panggilan"
		   value="<?php echo (set_value('memo_panggilan'))?
		   set_value('memo_panggilan'):$course['memo_panggilan'];?>" />
	    <?php echo form_error('memo_panggilan');?>
	</td>
    </tr> 
    <tr>
        <td>SP</td>
	<td class="left">
            <input type="text" name="sp" class="text" id="sp"
		   value="<?php echo (set_value('sp'))?
		   set_value('sp'):$course['sp'];?>" />
	    <?php echo form_error('sp');?>
	</td>
    </tr> 
    <tr>
        <td>Fax Panggilan</td>
	<td class="left">
            <input type="text" name="fax_panggilan" class="text" id="fax_panggilan"
		   value="<?php echo (set_value('fax_panggilan'))?
		   set_value('fax_panggilan'):$course['fax_panggilan'];?>" />
	    <?php echo form_error('fax_panggilan');?>
	</td>
    </tr> 
    <tr>
        <td>Undangan Pengajar</td>
	<td class="left">
            <input type="text" name="undangan_pengajar" class="text" id="undangan_pengajar"
		   value="<?php echo (set_value('undangan_pengajar'))?
		   set_value('undangan_pengajar'):$course['undangan_pengajar'];?>" />
	    <?php echo form_error('undangan_pengajar');?>
	</td>
    </tr> 
    <tr>
        <td>SPK</td>
	<td class="left">
            <input type="text" name="spk" class="text" id="spk"
		   value="<?php echo (set_value('spk'))?
		   set_value('spk'):$course['spk'];?>" />
	    <?php echo form_error('spk');?>
	</td>
    </tr> 
    <tr>
        <td>Memo Sarfas</td>
	<td class="left">
            <input type="text" name="memo_sarfas" class="text" id="memo_sarfas"
		   value="<?php echo (set_value('memo_sarfas'))?
		   set_value('memo_sarfas'):$course['memo_sarfas'];?>" />
	    <?php echo form_error('memo_sarfas');?>
	</td>
    </tr> 
    <tr>
        <td>Sertifikat</td>
	<td class="left">
            <input type="text" name="sertifikat" class="text" id="sertifikat"
		   value="<?php echo (set_value('sertifikat'))?
		   set_value('sertifikat'):$course['sertifikat'];?>" />
	    <?php echo form_error('sertifikat');?>
	</td>
    </tr> 
    <tr>
        <td>Koresksi SP</td>
	<td class="left">
            <input type="text" name="koreksi_sp" class="text" id="koreksi_sp"
		   value="<?php echo (set_value('koreksi_sp'))?
		   set_value('koreksi_sp'):$course['koreksi_sp'];?>" />
	    <?php echo form_error('koreksi_sp');?>
	</td>
    </tr> 
    <tr>
        <td>Peserta Hadir</td>
	<td class="left">
	    <input type="text" name="peserta_hadir" class="text"
		   value="<?php echo (set_value('peserta_hadir'))?
		   set_value('peserta_hadir'):$course['peserta_hadir'];?>" />
	    <?php echo form_error('peserta_hadir');?>
	</td>
    </tr> 
    <tr>
        <td>Invoice Masuk</td>
	<td class="left">
            <input type="text" name="invoice_masuk" class="text" id="inv_masuk"
		   value="<?php echo (set_value('invoice_masuk'))?
		   set_value('invoice_masuk'):$course['invoice_masuk'];?>" />
	    <?php echo form_error('invoice_masuk');?>
	</td>
    </tr> 
    <tr>
        <td>Nilai Invoice</td>
	<td class="left">
	    <input type="text" name="nilai_invoice" class="text"
		   value="<?php echo (set_value('nilai_invoice'))?
		   set_value('nilai_invoice'):$course['nilai_invoice'];?>" />
	    <?php echo form_error('nilai_invoice');?>
	</td>
    </tr> 
    <tr>
        <td>FU Ke Finanace</td>
	<td class="left">
            <input type="text" name="fu_ke_finance" class="text" id="fu_ke_finance"
		   value="<?php echo (set_value('fu_ke_finance'))?
		   set_value('fu_ke_finance'):$course['fu_ke_finance'];?>" />
	    <?php echo form_error('fu_ke_finance');?>
	</td>
    </tr> 
    
</table>

<div class="form-actions">
<a class="btn" href="course/index" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close();?>

<script type="text/javascript">
$(function () {
    $("#start_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#memo_panggilan").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#sp").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#fax_panggilan").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#undangan_pengajar").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#spk").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#memo_sarfas").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#sertifikat").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#koreksi_sp").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#inv_masuk").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#fu_ke_finance").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
                                        
});

</script>

    <script type="text/javascript">
        $(function(){
            //initially hide the textbox
            $("#other_reason").hide();
            $('#i_n_r_reason').change(function() {
              if($(this).find('option:selected').val() == "other"){
                $("#other_reason").show();
              }else{
                $("#other_reason").hide();
              }
            });

            $('#i_n_r_reason').load(function() {
              if($(this).find('option:selected').val() == "other"){
                $("#other_reason").show();
              }else{
                $("#other_reason").hide();
              }
            });
            $("#othe_reason").keyup(function(ev){
                  var othersOption = $('#i_n_r_reason').find('option:selected');
                  if(othersOption.val() == "other"){
                    ev.preventDefault();
                    //change the selected drop down text
                    $(othersOption).html($("#other_reason").val()); 


                  } 
            });
        });
    </script>