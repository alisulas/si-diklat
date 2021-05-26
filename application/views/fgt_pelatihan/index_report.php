<link rel="stylesheet" type="text/css" href="assets/datatable/css/dataTables.bootstrap.css">
<link rel="stylesheet" type="text/css" href="assets/datatable/1.10.6/ext/dataTables.tableTools.css">
<script type="text/javascript" language="javascript" src="assets/datatable/1.10.6/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" language="javascript" src="assets/datatable/1.10.6/ext/dataTables.tableTools.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<span class="label label-info" style="float: right"> 
    <?php echo 'Jumlah Program : '.  number_format($jml_pelatihan, 0, "", "."); ?><br>
<?php echo 'Jumlah Peserta Diundang : '.  number_format($jml_peserta, 0, "", "."); ?><br>
<?php echo 'Jumlah Peserta Konfirmasi : '.  number_format($jml_konfirmasi, 0, "", "."); ?><br>
    <?php echo 'Jumlah Peserta Hadir : '.  number_format($jml_hadir, 0, "", "."); ?></span><br><br>
<input type="button" id="buka" class="btn btn-inverse" value="Pencarian" onclick="$('#pencarian').show('normal'),$('#buka').hide('normal')" />
<?php echo $refresh;?>

<div id="pencarian">
    <?php echo form_open($action) ?>
    <table>
        <tr>
            <td><span class="label label-inverse">Judul Program</span></td>
            <td><span id="result_program"><input type="text" id="program" placeholder="Pencarian" /></span></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">No Tiket</span></td>
            <td><input type="text" name="no_tiket" class="input input-small" placeholder="No Tiket"></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Dasar</span></td>
            <td><select name="dasar">
                    <option value="">-</option>
                <option value="Reguler">Reguler</option>
                <option value="Adhoc">Adhoc</option>
            </select></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Jenis</span></td>
            <td><select name="jenis">
                    <option value="">-</option>
                <option value="Inhouse">Inhouse</option>
                <option value="Public">Public</option>
            </select></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Sifat</span></td>
            <td><select name="sifat">
                    <option value="">-</option>
                <option value="Non Residential">Non Residential</option>
                <option value="Residential">Residential</option>
                
            </select>
            </td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Lokasi/Kota</span></td>
            <td><input type="text" name="kota" class="input input-small" placeholder="Lokasi/Kota"></td>
        </tr>
        <tr>
            <td><span class="label label-inverse">Tanggal</span></td>
            <td><input type="text" name="tgl_awal" id="tgl_awal" placeholder="Dari"> - <input type="text" name="tgl_selesai" id="tgl_selesai" placeholder="Sampai"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Cari"></td>
        </tr>
    </table>
       
<?php echo form_close(); ?>  
 
<!-- <input type="button" class="btn btn-danger" value="Tutup" onclick="$('#pencarian').hide('normal'),$('#buka').show('normal')" /> -->
</div>
<p>
  
    <?php echo $content;?>
  
</p>
  <script type="text/javascript">

$(this).ready( function() {
            $("#program").autocomplete({
                minLength: 3,
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
                        "<input type='hidden' value='"+ ui.item.id + "' name='kd_pelatihan'/>"+ui.item.value+"&nbsp;<span class='label label-inverse'>Batch</span><input type='text' name='batch' class='input input-mini'>"
                    );
            $("#program").hide();
                }
                }
            });

            $('.remove_program').live('click', function() {
		$(this).parent().remove();
                $("#program").val('');
                $("#program").show();
		return false;
	    });

	   
        });
        
           $(document).ready(function() {
        $("#pencarian").hide();
    });
    </script>
    
    <script type="text/javascript">
$(function () {
    $("#tgl_awal").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#tgl_selesai").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
      
});

</script>

<script type="text/javascript">
 
    
$(document).ready(function() {
    
    $('#data_table').dataTable({
    	"lengthChange": false,
    	"oLanguage": {
		   "sSearch":"Pencarian Cepat",
		   "sZeroRecords": "Data tidak ada."
                   
		},
                dom: 'T<"clear">lfrtip',
                "oTableTools": {
    "sSwfPath": "../plc/assets/datatable/swf/ZeroClipboard.swf",
    "aButtons": [
                {
                    "sExtends": "xls",
                    "sFileName": "Laporan Monitoring Pembelajaran.xls"
                },
                {
                    "sExtends": "pdf",
                    "sFileName": "Laporan Monitoring Pembelajaran.pdf",
                    "sPdfOrientation": "landscape",
                    "sPdfSize": "A4",
                    "sPdfMessage": "",
                    "sTitle": "Laporan Monitoring Pembelajaran"
                },
                "print"
            ]
  }
	});
});

</script>