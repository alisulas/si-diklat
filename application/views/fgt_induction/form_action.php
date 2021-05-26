<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<i style="float: right">*Last Updated by <?php echo $action['action_user']; ?></i>
<?php echo form_open_multipart($act);?>
<input type="hidden" name="id_trans_pelatihan" value="<?php echo $action['id']; ?>">
<table class="table table-bordered table-condensed">
    <tr>
            <td valign="top">Pengajar </td>
	<td class="left"><span style="color:red">*</span><i>(Wajib di isi jika provider internal/PCU)</i>
            <table class="table table-condensed table-bordered" id="result">  
                <tr><th>Nama Pengajar</th><th>Jml Sesi</th><th>Biaya</th></tr>
		<?php echo $pengajar;?>
	    </table>
	    <a id="add_trainer" class="btn btn-mini btn-inverse">Tambah</a>
            <input type="text" id="trainer" style="display: none" placeholder="Nama Pengajar" onFocus="javascript:this.value=''">	   
            <a href="trainer/add" class="btn btn-success" target="_blank" style="float:right">Tambah Pengajar Baru &nbsp;<i class="icon icon-pencil icon-white"></i></a>
        </td>
    </tr>
            <tr>
	<td valign="top">Provider <span style="color:red">*</span></td>
        <td>
         <div id="result_provider">
             <table border='1'>
             <?php echo $provider; ?>    
             </table>
             
	    </div>
	    <a id="add_provider" class="btn btn-mini btn-inverse">Ubah</a>
	    <input type="text" id="provider" style="display: none" placeholder="Nama Provider"/>
            <a href="provider/add" class="btn btn-success" target="_blank" style="float:right">Tambah Provider Baru &nbsp;<i class="icon icon-pencil icon-white"></i></a>
        </td>
    </tr>
        <tr>
	<td valign="top">Memo Bantuan Mengajar <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_memo_mengajar[]" placeholder="No Memo" value="<?php echo $no_memo_mengajar; ?>">&nbsp;<input type="text" name="tgl_memo_mengajar" id="tgl_memo_mengajar" placeholder="Tanggal" value="<?php echo $tgl_memo_mengajar; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Fax Bantuan Mengajar <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_fax_mengajar" placeholder="No Fax" value="<?php echo $no_fax_mengajar; ?>">&nbsp;<input type="text" name="tgl_fax_mengajar" id="tgl_fax_mengajar" placeholder="Tanggal" value="<?php echo $tgl_fax_mengajar; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Surat Bantuan Mengajar <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_surat_mengajar" placeholder="No Surat" value="<?php echo $no_surat_mengajar; ?>">&nbsp;<input type="text" name="tgl_surat_mengajar" id="tgl_surat_mengajar" placeholder="Tanggal" value="<?php echo $tgl_surat_mengajar; ?>">
	</td>
    </tr>  
    <tr>
	<td valign="top">SPK <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_spk" placeholder="No SPK"  value="<?php echo $no_spk; ?>">&nbsp;<input type="text" name="tgl_spk" id="tgl_spk" placeholder="Tanggal"  value="<?php echo $tgl_spk; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Cetak Sertifikat <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_sertifikat" placeholder="No Sertifikat" value="<?php echo $no_sertifikat; ?>">&nbsp;<input type="text" name="tgl_sertifikat" id="tgl_sertifikat" placeholder="Tanggal" value="<?php echo $tgl_sertifikat; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Invoice Diterima <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_invoice_diterima" placeholder="No Invoice Diterima" value="<?php echo $no_invoice_diterima; ?>">&nbsp;<input type="text" name="tgl_invoice_diterima" id="tgl_invoice_diterima" placeholder="Tanggal" value="<?php echo $tgl_invoice_diterima; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Invoice Dikirim<span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_invoice_dikirim" placeholder="No Invoice Dikirim" value="<?php echo $no_invoice_dikirim; ?>">&nbsp;<input type="text" name="tgl_invoice_dikirim" id="tgl_invoice_dikirim" placeholder="Tanggal" value="<?php echo $tgl_invoice_dikirim; ?>">
	</td>
    </tr>
    <tr>
	<td valign="top">Memo Pembayaran Honor <span style="color:red">*</span></td>
	<td class="left">
            <input type="text" name="no_memo_honor" placeholder="No Memo" value="<?php echo $no_memo_honor; ?>">&nbsp;<input type="text" name="tgl_memo_honor" id="tgl_memo_honor" placeholder="Tanggal" value="<?php echo $tgl_memo_honor; ?>">
	</td>
    </tr>              
</table>

<div class="form-actions">
<button onclick="goBack()" class="btn" type="button"><i class="icon-hand-left"></i>Kembali</button>
    <button class="btn btn-primary" type="submit">Simpan</button>
</div>
<?php echo form_close();?>

<script>
function goBack() {
    window.history.back()
}
</script>
<script type="text/javascript">
$(function () {
    $("#tgl_bap").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_sertifikat").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
       $("#tgl_invoice_diterima").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    
          $("#tgl_invoice_dikirim").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
          $("#tgl_memo_honor").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    
    $("#tgl_memo_mengajar").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    
          $("#tgl_fax_mengajar").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
          $("#tgl_surat_mengajar").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
          $("#tgl_spk").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
      
});

</script>

<script type="text/javascript">
 
        $(this).ready( function() {
            $("#trainer").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/fgt_pelatihan/lookup_pengajar",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result").append(
                        "<tr><td colspan='4'><input type='hidden' value='"+ ui.item.id + "' name='pengajar[]'/><a href='trainer/detail/"+ ui.item.id + "' target='_blank'>"+ ui.item.value + "</a>&nbsp;<input type='text' name='jml_sesi[]' placeholder='Jumlah Sesi' class='input-small' />&nbsp;<input type='text' name='honor_sesi[]' placeholder='Honor / Sesi' class='input-medium'>&nbsp;<a href='#' class='remove_trainer'><i class='icon-remove'></i></a></td></tr>"
                    );
		    $("#trainer").hide();
		    $("#null_trainer").remove();
		    $("#add_trainer").show();
                }
                }
            });

            $('.remove_trainer').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_trainer").click(function(){
		$("#trainer").show();
                
		$("#add_trainer").hide();
	    });
        });
</script>
<script type="text/javascript">
       $(this).ready( function() {
            $("#provider").autocomplete({
                minLength: 3,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/fgt_pelatihan/lookup_provider",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result_provider").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='provider'/><a href='provider/detail/"+ ui.item.id + "' target='_blank'>"+ ui.item.value + "</a>&nbsp;<a href='#' class='remove_provider'><span class='label label-important'><i class='icon-remove icon-white'></i></span></a></td></tr>"
                    );
		    $("#provider").hide();
		    $("#null_provider").remove();
                }
                }
            });

            $('.remove_provider').live('click', function() {
		$(this).parent().remove();
                $("#add_provider").show();
		return false;
	    });

	    $("#add_provider").click(function(){
		$("#provider").show();
		$("#provider").val('');
		$("#add_provider").hide();
	    });
        });
</script>

