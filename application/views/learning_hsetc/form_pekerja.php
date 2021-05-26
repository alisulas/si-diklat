<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
 <a href="#nonpekerja" data-toggle="modal"> <button class="btn btn-success" type="submit">Tambah NonPekerja</button></a>
 <br>
     <?php echo form_open($action);?>
<table class="table table-bordered table-condensed">
    <tr>
        <td>Data Pekerja</td>
        <td class="left">
	    <table class="table table-bordered table-striped" id="result">
		<?php echo $pekerja=null;?>
	    </table>
	    <a id="add_pekerja" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="pekerja" style="display: none" placeholder="Masukkan nopek"/>

	    <?php echo form_error('pekerja');?>
	</td>
    </tr>
    
    <tr>
	<td valign="top">Kode</td>
	<td class="left">
	    <input type="text" name="kode" class="text"/>
	    <?php echo form_error('kode');?>
	</td>
    </tr>
        <tr>
	<td valign="top">No Sertifikat</td>
	<td class="left">
	    <input type="text" name="no_sertifikat" class="text"/>
	    <?php echo form_error('no_sertifikat');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Judul Pelatihan</td>
	<td class="left">
	    <input type="text" name="judul_pelatihan" class="text"/>
	    <?php echo form_error('judul_pelatihan');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Lokasi</td>
	<td class="left">
	    <input type="text" name="lokasi" class="text"/>
	    <?php echo form_error('lokasi');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left">
	    <input type="text" name="tgl_mulai" class="text input-small" id="start_date"/> -
            <input type="text" name="tgl_selesai" class="text input-small" id="end_date"/>
	</td>
    </tr>
    
    <tr>
	<td valign="top">Durasi</td>
	<td class="left">
	    <input type="text" name="durasi" class="text" id="durasi"/>
	    <?php echo form_error('durasi');?>
	</td>
    </tr>
    
</table>

<div class="form-actions">
<a class="btn" href="learning_days" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
    <button class="btn btn-primary" type="submit">Tambahkan</button>
</div>
<?php echo form_close();?>



<div class="modal fade in" id="nonpekerja" style="display:none; width: 500px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tambah Data NonPekerja</h3>
  </div>
  <div class="modal-body">

      <?php echo form_open($action_nonpekerja);?>
<table class="table table-bordered table-condensed">    
    <tr>
	<td valign="top">Kode</td>
	<td class="left">
	    <input type="text" name="kode" class="text"/>
	    <?php echo form_error('kode');?>
	</td>
    </tr>
        <tr>
	<td valign="top">No Sertifikat</td>
	<td class="left">
	    <input type="text" name="no_sertifikat" class="text"/>
	    <?php echo form_error('no_sertifikat');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Judul Pelatihan</td>
	<td class="left">
	    <input type="text" name="judul_pelatihan" class="text"/>
	    <?php echo form_error('judul_pelatihan');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Lokasi</td>
	<td class="left">
	    <input type="text" name="lokasi" class="text"/>
	    <?php echo form_error('lokasi');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Tanggal Pelaksanaan</td>
	<td class="left">
	    <input type="text" name="tgl_mulai" class="text input-small" id="tgl_mulai"/> -
            <input type="text" name="tgl_selesai" class="text input-small" id="tgl_selesai"/>
	</td>
    </tr>
    
    <tr>
	<td valign="top">Durasi</td>
	<td class="left">
	    <input type="text" name="durasi" class="text" id="duration"/>
	    <?php echo form_error('durasi');?>
	</td>
    </tr>
    <tr>
	<td valign="top">Nopek</td>
	<td class="left">
	    <input type="text" name="nopek" class="text"/>
	    <?php echo form_error('nopek');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Nama</td>
	<td class="left">
	    <input type="text" name="nama" class="text"/>
	    <?php echo form_error('nama');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Fungsi</td>
	<td class="left">
	    <input type="text" name="fungsi" class="text"/>
	    <?php echo form_error('fungsi');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Unit Asal</td>
	<td class="left">
	    <input type="text" name="unit_asal" class="text"/>
	    <?php echo form_error('unit_asal');?>
	</td>
    </tr>
        <tr>
	<td valign="top">Direktorat</td>
	<td class="left">
	    <input type="text" name="direktorat" class="text"/>
	    <?php echo form_error('direktorat');?>
	</td>
    </tr>
    
</table>

<div class="form-actions">
    <button class="btn btn-primary" type="submit">Tambahkan</button>
</div>
<?php echo form_close();?>
      
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>



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
    $("#tgl_mulai").datepicker({
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
        $(this).ready( function() {
            $("#pekerja").autocomplete({
                minLength: 5,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/learning_hsetc/lookup_pekerja",
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

    //alert(e.keyCode);
    if(event.keyCode == 13) {
                     $("#result").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='pekerja[]'/>"+ui.item.id+" "+ ui.item.value + "<a href='#' class='remove_pekerja'><i class='icon-remove'></i></a></td><tr>"
                    );
  
    }
    		    $("#pekerja").val('');

                }
                }
            });

            $('.remove_pekerja').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_pekerja").click(function(){
		$("#pekerja").show();
		$("#add_pekerja").hide();
	    });
        });
</script>

<script type="text/javascript">
    $("#durasi").focus(function () {
         // Here are the two dates to compare
var date1 = $("#start_date").val();
var date2 = $("#end_date").val();

// First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
date1 = date1.split('-');
date2 = date2.split('-');

// Now we convert the array to a Date object, which has several helpful methods
date1 = new Date(date1[0], date1[1], date1[2]);
date2 = new Date(date2[0], date2[1], date2[2]);

// We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
date1_unixtime = parseInt(date1.getTime() / 1000);
date2_unixtime = parseInt(date2.getTime() / 1000);

// This is the calculated difference in seconds
var timeDifference = date2_unixtime - date1_unixtime;

// in Hours
var timeDifferenceInHours = timeDifference / 60 / 60;

// and finaly, in days :)
var timeDifferenceInDays = timeDifferenceInHours  / 24;
$("#durasi").val(timeDifferenceInDays+1);
    });
    
    $("#duration").focus(function () {
         // Here are the two dates to compare
var date1 = $("#tgl_mulai").val();
var date2 = $("#tgl_selesai").val();

// First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
date1 = date1.split('-');
date2 = date2.split('-');

// Now we convert the array to a Date object, which has several helpful methods
date1 = new Date(date1[0], date1[1], date1[2]);
date2 = new Date(date2[0], date2[1], date2[2]);

// We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
date1_unixtime = parseInt(date1.getTime() / 1000);
date2_unixtime = parseInt(date2.getTime() / 1000);

// This is the calculated difference in seconds
var timeDifference = date2_unixtime - date1_unixtime;

// in Hours
var timeDifferenceInHours = timeDifference / 60 / 60;

// and finaly, in days :)
var timeDifferenceInDays = timeDifferenceInHours  / 24;
$("#duration").val(timeDifferenceInDays+1);
    });
    

</script>