<script type="text/javascript" src="assets/js/currency/autoNumeric.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open_multipart($action);?>

<table class="table table-bordered table-condensed">
    <tr>
	<td valign="top">PIC <span style="color:red">*</span></td>
	<td class="left">
            <select name="pic">
                <?php echo $pic; ?>
            </select>
	</td>
    </tr>
    <tr>
        <td>
            Judul Pelatihan <span style="color:red">*</span> &nbsp;
        </td>
        <td>
         <div id="result_program">		
	    </div>
	    <a id="add_program" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="program" style="display: none" placeholder="Masukkan nama program"/>
            <a href="pelatihan/add" class="btn btn-success" target="_blank" style="float:right">Tambah Pelatihan Baru &nbsp;<i class="icon icon-pencil icon-white"></i></a>
        </td>
    </tr>
    
    <tr>
	<td valign="top">Jenis Pelatihan <span style="color:red">*</span></td>
	<td class="left">
            <select name="jenis">
                <option value="Inhouse">Inhouse</option>
                <option value="Public">Public</option>
            </select>
	</td>
    </tr>
    <tr>
	<td valign="top">Dasar Pelatihan <span style="color:red">*</span></td>
	<td class="left">
            <select name="dasar">
                <option value="Reguler">Reguler</option>
                <option value="Adhoc">Adhoc</option>
            </select>
	</td>
    </tr>
        <tr>
	<td valign="top">Sifat <span style="color:red">*</span></td>
	<td class="left">
            <select name="sifat">
                <option value="Non Residential">Non Residential</option>
                <option value="Residential">Residential</option>
                
            </select>
	</td>
    </tr>
    </tr>
        <tr>
	<td valign="top">Reference</td>
	<td class="left">
            <input type="text" name="ref_user" >&nbsp;<input type="text" name="ref_memo" placeholder="No Memo">&nbsp;<input type="text" name="ref_tgl" id="ref_tgl" placeholder="Tanggal"><span style="color:red">*</span><i>Wajib di isi untuk perhitungan SLA</i><br>
            <input type="text" name="ref_hrbp" >&nbsp;<input type="text" name="ref_hrbp_memo" placeholder="No Memo">&nbsp;<input type="text" name="ref_hrbp_tgl" id="ref_hrbp_tgl" placeholder="Tanggal">
	</td>
    </tr>   
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left">
            <input type="text" name="tgl_mulai" class="text input-small" id="start_date" placeholder="Tanggal Mulai" /> s/d
            <input type="text" name="tgl_selesai" class="text input-small" id="end_date" placeholder="Tanggal Selesai"/>	
	</td>
    </tr>

        <tr>
            <td valign="top">Pengajar </td>
	<td class="left"><span style="color:red">*</span><i>(Wajib di isi jika provider internal/PCU)</i>
	    <table border="0" id="result">                
		<?php echo $trainer=null;?>
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
	    </div>
	    <a id="add_provider" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="provider" style="display: none" placeholder="Nama Provider"/>
            <a href="provider/add" class="btn btn-success" target="_blank" style="float:right">Tambah Provider Baru &nbsp;<i class="icon icon-pencil icon-white"></i></a>
        </td>
    </tr>
    
    <tr>
	<td valign="top">Jumlah Maks Kelas <span style="color:red">*</span></td>
	<td class="left">
	    <input type="text" name="kuota_kelas" class="text" />
	</td>
    </tr>
    <tr>
	<td valign="top">Kota <span style="color:red">*</span></td>
	<td class="left">
        <div id="result_kota">		
	    </div>
	    <a id="add_kota" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="kota" style="display: none" placeholder="Nama Kota"/>
            <a href="location/list_city" class="btn btn-success" target="_blank" style="float:right">Tambah Lokasi Baru &nbsp;<i class="icon icon-pencil icon-white"></i></a>
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
       $("#ref_tgl").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
          $("#ref_hrbp_tgl").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>

    <script type="text/javascript">
              $('#other').hide();
		$('#kel').click(function(){
			
        if ($('#kel').val()==19){
            $('#other').show();
        }else{
            $('#other').hide();
        }
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
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='pengajar[]'/><a href='trainer/detail/"+ ui.item.id + "' target='_blank'>"+ ui.item.value + "</a>&nbsp;<input type='text' name='jml_sesi[]' placeholder='Jumlah Sesi' class='input-small' />&nbsp;<input type='text' name='honor_sesi[]' placeholder='Honor / Sesi' class='input-medium' id='cur_pengajar'>&nbsp;<a href='#' class='remove_trainer'><i class='icon-remove'></i></a></td></tr>"
                    );
               $("#cur_pengajar").autoNumeric('init');
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
            $("#program").autocomplete({
                minLength: 4,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/fgt_pelatihan/lookup_pelatihan",
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
                    $("#result_program").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='kd_pelatihan'/>"+ ui.item.value + "<a href='#' class='remove_program'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#program").hide();
		    $("#null_program").remove();
                }
                }
            });

            $('.remove_program').live('click', function() {
		$(this).parent().remove();
                $("#add_program").show();
		return false;
	    });

	    $("#add_program").click(function(){
		$("#program").show();
		$("#program").val('');
		$("#add_program").hide();
	    });
        });
</script>

<script type="text/javascript">
       $(this).ready( function() {
            $("#kota").autocomplete({
                minLength: 3,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/fgt_pelatihan/lookup_kota",
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
                    $("#result_kota").append(
                        "<div><input type='hidden' value='"+ ui.item.value + "' name='lokasi_kota'/>"+ ui.item.value + "<a href='#' class='remove_kota'><i class='icon-remove'></i></a></div>"
                    );
		    $("#kota").hide();
		    $("#null_kota").remove();
                }
                }
            });

            $('.remove_kota').live('click', function() {
		$(this).parent().remove();
                $("#add_kota").show();
		return false;
	    });

	    $("#add_kota").click(function(){
		$("#kota").show();
		$("#kota").val('');
		$("#add_kota").hide();
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
                        "<tr><td>\n\
    <input type='hidden' value='"+ ui.item.id + "' name='provider'/>\n\
<a href='provider/detail/"+ ui.item.id + "' target='_blank'>"+ ui.item.value + "</a>&nbsp;\n\
<a href='#' class='remove_provider'><span class='label label-important'><i class='icon-remove icon-white'></i></span></a><br>\n\
<table><tr><th>Keterangan</th><th>Harga Penawaran</th><th>Harga Negosiasi</th>\n\
<th>Jumlah Peserta</th><th>Harga Tambahan Peserta</th></tr>\n\
<tr><td><input type='text' name='ket' placeholder='Keterangan' class='input-medium' /></td>\n\
<td><input type='text' name='harga_penawaran' placeholder='Harga Penawaran' class='input-medium' id='cur1'/></td>\n\
<td><input type='text' name='harga_negosiasi' placeholder='Harga Negosiasi' class='input-medium' id='cur2'></td>\n\
<td><input type='text' name='jml_peserta' placeholder='Jumlah Peserta' class='input-small'></td>\n\
<td><input type='text' name='harga_tambahan_peserta' placeholder='Harga Tambahan Peserta' class='input-medium'  id='cur3'></td></tr>\n\
<tr><td><input type='text' name='ket2' placeholder='Keterangan' class='input-medium' /></td>\n\
<td><input type='text' name='harga_penawaran2' placeholder='Harga Penawaran' class='input-medium' id='xcur1'/></td>\n\
<td><input type='text' name='harga_negosiasi2' placeholder='Harga Negosiasi' class='input-medium' id='xcur2'></td>\n\
<td><input type='text' name='jml_peserta2' placeholder='Jumlah Peserta' class='input-small'></td>\n\
<td><input type='text' name='harga_tambahan_peserta2' placeholder='Harga Tambahan Peserta' class='input-medium' id='xcur3'></td></tr>\n\
<tr><td><input type='text' name='ket3' placeholder='Keterangan' class='input-medium' /></td>\n\
<td><input type='text' name='harga_penawaran3' placeholder='Harga Penawaran' class='input-medium'  id='zcur1'/></td>\n\
<td><input type='text' name='harga_negosiasi3' placeholder='Harga Negosiasi' class='input-medium' id='zcur2'></td>\n\
<td><input type='text' name='jml_peserta3' placeholder='Jumlah Peserta' class='input-small'></td>\n\
<td><input type='text' name='harga_tambahan_peserta3' placeholder='Harga Tambahan Peserta' class='input-medium' id='zcur3'></td></tr></table></td></tr>"
                    );
            $("#cur1").autoNumeric('init');
            $("#cur2").autoNumeric('init');
            $("#cur3").autoNumeric('init');
            $("#xcur1").autoNumeric('init');
            $("#xcur2").autoNumeric('init');
            $("#xcur3").autoNumeric('init');
            $("#zcur1").autoNumeric('init');
            $("#zcur2").autoNumeric('init');
            $("#zcur3").autoNumeric('init');
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