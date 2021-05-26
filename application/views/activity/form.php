<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<!--
<script type="text/javascript" src="application/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
-->
<script type="text/javascript" src="assets/up/jquery.uploadify-3.1.min.js"></script>
<script type="text/javascript" language="javascript" src="assets/js/swfobject.js"></script>
<p>
    <?php echo $this->session->flashdata('msg'); ?>
</p>

<h3>Detail Pelatihan</h3>
<table class="table table-condensed">
    <tr>
        <td width="200">Kode Pelatihan</td><td>
            <?php echo $course_code; ?>
            <input type="hidden" name="course_id" value="<?php echo $course_id ?>" />
        </td>
    </tr>
    <tr>
        <td>Nama Pelatihan</td><td><?php echo $course_name ?></td>
    </tr>
    <tr>
        <td>Tempat Pelaksanaan</td><td><?php echo $course_location ?></td>
    </tr>
    <tr>
        <td>Tanggal Program</td><td><?php echo $start_date . " - " . $end_date; ?></td>
    </tr>
</table>

<h3>Kelengkapan</h3>
<?php echo form_open();?>
<table class="table table-bordered table-condensed table-striped">
    <tr>
        <th>No</th><th>Aktifitas</th><th width="130px">Check</th><th>Ket.</th><th width="100px">Update Terakhir</th>
    </tr>
    <tr>
        <td>1</td><td>Memo / Email calon Peserta (RKAP3) dari Renbang</td>
	<td id="cont-act1">
	    <?php echo $upload_act1;?>
	</td>
	<td id="info-act1"><?php echo $info_act1;?></td>
        <td><?php echo $date_update;?></td>
    </tr>
    <tr>
        <td>2</td><td>Jadwal Program</td>
        <td>
            <a href="jadwal/view/<?php echo $course_id;?>" class="btn btn-info" target="_blank"><i class="icon-search icon-white"></i> Lihat Jadwal</a>
        </td>
	<td></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>3</td><td>Nama Pengajar</td>
        <td>
	    <a class="btn btn-info" data-toggle="modal" href="#pengajar" ><i class="icon-user icon-white"></i> Daftar Pengajar</a>
	</td>
	<td></td>
	<td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>4</td><td>Nama Provider</td>
        <td id="cont-act4">
	    <?php echo $provider;?>
	</td>
	<td></td>
	<td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>5</td><td>Memo / Email Pencalonan Peserta dari User</td>
        <td  id="cont-act5">
            <?php echo $upload_act5;?>
        </td>
	<td id="info-act5"><?php echo $info_act5;?></td>
        <td><?php echo $date_update;?></td>
    </tr>


    <tr>
        <td>6</td><td>Memo/Nota Sarfas</td>
        <td  id="cont-act6">
            <?php echo $upload_act6;?>
        </td>
	<td id="info-act6"><?php echo $info_act6;?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>7</td><td>Memo Uang Muka</td>
        <td  id="cont-act22">
            <?php echo $upload_act22;?>
        </td>
	<td id="info-act22"><?php echo $info_act22;?></td>
        <td><?php echo $date_update;?></td>
    </tr>
    <tr>
        <td>8</td><td>Memo/Surat/Fax Pangilan Calon Peserta & Pengajar, Perjanjian / Penawaran Provider (bila ada)</td>
        <td  id="cont-act7">
            <?php echo $upload_act7;?>
        </td>
	<td id="info-act7"><?php echo $info_act7;?></td>
        <td><?php echo $date_update;?></td>
    </tr>
    <tr>
        <td>9</td><td>Persiapan Program</td>
        <td>
	<div class="btn-group" data-toggle-name="act8" data-toggle="buttons-radio">
	    <button type="button" class="btn btn-info" value="1" onclick="changeVal('act8')">Ada</button>
	    <button type="button" class="btn btn-info" value="0" onclick="changeVal('act8')">Belum Ada</button>
	</div>
	<span id="msg_act8"></span>
            <input type="hidden" name="act8" value="<?php
                   echo (set_value('act8')) ?
                           set_value('act8') : $activity['act8'];?>"  id="act8"/>
        </td>
	<td id="ket_act8"><?php echo ket($activity['act8'],'act8');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>10</td><td>Surat Perintah</td>
        <td>
            <?php echo $upload_act9;?>
        </td>
	<td id="info-act9"><?php echo $info_act9;?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>11</td><td>Daftar Hadir dan Form Biodata</td>
        <td>
            <a class="btn btn-info" data-toggle="modal" href="#peserta" ><i class="icon-user icon-white"></i> Daftar Peserta</a>
        </td>
	<td></td>
	<td></td>
    </tr>

    <tr>
        <td>12</td><td>Materi Ajar</td>
        <td>
            <?php echo $upload_act11;?>
        </td>
	<td id="info-act9"><?php echo $info_act11;?></td>
	<td><?php echo $date_update;?></td>
    </tr>
    <tr>
        <td>13</td><td>Flashdisk/CD berisi Materi Ajar untuk Peserta</td>
        <td>
	    <div class="btn-group" data-toggle-name="act12" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act12')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act12')">Belum Ada</button>
	    </div>
	    <span id="msg_act12"></span>
		<input type="hidden" name="act12" value="<?php
		       echo (set_value('act12')) ?
			       set_value('act12') : $activity['act12'];?>" id="act12"/>
        </td>
	<td id="ket_act12"><?php echo ket($activity['act12'],'act12');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>14</td><td>Form Rating Pengajar</td>
        <td>
            <div class="btn-group" data-toggle-name="act13" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act13')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act13')">Belum Ada</button>
	    </div>
	    <span id="msg_act13"></span>
            <input type="hidden" name="act13" value="<?php
                   echo (set_value('act13')) ?
                           set_value('act13') : $activity['act13'];?>" id="act13"/>
        </td>
	<td id="ket_act13"><?php echo ket($activity['act13'],'act13');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>15</td><td>Form Upan Balik Program dari Peserta</td>
        <td>
            <div class="btn-group" data-toggle-name="act14" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act14')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act14')">Belum Ada</button>
	    </div>
	    <span id="msg_act14"></span>
            <input type="hidden" name="act14" value="<?php
                   echo (set_value('act14')) ?
                           set_value('act14') : $activity['act14'];?>" id="act14"/>
        </td>
	<td id="ket_act14"><?php echo ket($activity['act14'],'act14');?></td>
        <td><?php echo $date_update;?></td>
    </tr>


    <tr>
        <td>16</td><td>Rekap Rating Pengajar</td>
        <td>
            <div class="btn-group" data-toggle-name="act15" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act15')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act15')">Belum Ada</button>
	    </div>
	    <span id="msg_act15"></span>
            <input type="hidden" name="act15" value="<?php
                   echo (set_value('act15')) ?
                           set_value('act15') : $activity['act15'];?>" id="act15"/>
        </td>
	<td id="ket_act15"><?php echo ket($activity['act15'],'act15');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>17</td><td>Rekap Umpan Balik Program dari Peserta</td>
        <td>
            <div class="btn-group" data-toggle-name="act16" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act16')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act16')">Belum Ada</button>
	    </div>
	    <span id="msg_act16"></span>
            <input type="hidden" name="act16" value="<?php
                   echo (set_value('act16')) ?
                           set_value('act16') : $activity['act16'];?>" id="act16"/>
        </td>
	<td id="ket_act16"><?php echo ket($activity['act16'],'act16');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>18</td><td>Rekap Peringkat dan Nilai Peserta</td>
        <td>
	    <div class="btn-group" data-toggle-name="act17" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act17')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act17')">Belum Ada</button>
	    </div>
	    <span id="msg_act17"></span>
            <input type="hidden" name="act17" value="<?php
                   echo (set_value('act17')) ?
                           set_value('act17') : $activity['act17'];?>" id="act17"/>
        </td>
	<td id="ket_act17"><?php echo ket($activity['act17'],'act17');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>19</td><td>Penyiapan Sertifikat (Mandotary Program dan eLearning)</td>
        <td>
            <div class="btn-group" data-toggle-name="act18" data-toggle="buttons-radio">
		<button type="button" class="btn btn-info" value="1" onclick="changeVal('act18')">Ada</button>
		<button type="button" class="btn btn-info" value="0" onclick="changeVal('act18')">Belum Ada</button>
	    </div>
	    <span id="msg_act18"></span>
            <input type="hidden" name="act18" value="<?php
                   echo (set_value('act18')) ?
                           set_value('act18') : $activity['act18'];?>" id="act18"/>
        </td>
	<td id="ket_act18"><?php echo ket($activity['act18'],'act18');?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>20</td>
        <td>
            Penutupan <br>
            a. Laporan Pelaksanaan <br>
            b. Peringkat dan Nilai Peserta <br>
            c. Hadiah Peringkat Terbaik
        </td>
        <td  id="cont-act19">
            <?php echo $upload_act19;?>
        </td>
	<td id="info-act19"><?php echo $info_act19;?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>21</td><td>Mengirim Hasil Umpan Balik Ke Renbang</td>
        <td  id="cont-act20">
	    <?php echo $upload_act20;?>
        </td>
	<td id="info-act20"><?php echo $info_act20;?></td>
        <td><?php echo $date_update;?></td>
    </tr>

    <tr>
        <td>22</td><td>Pertanggungjawaban (Copy SPD, Copy Daftar hadir Peserta dan Pengajar, Copy Kuitansi, Copy Surat Perintah, Berita Acara dan Invoice,dll)-(Bila ada)</td>
        <td  id="cont-act21">
	    <?php echo $upload_act21;?>
        </td>
	<td id="info-act21"><?php echo $info_act21;?></td>
        <td><?php echo $date_update;?></td>
    </tr>
</table>
<?php echo form_close();?>

<a href="course/index" class="btn"><i class="icon icon-hand-left"></i> Kembali</a>


<div class="modal fade in" id="pengajar" style="display:none">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Daftar Pengajar</h3>
  </div>
  <div class="modal-body">
    <p>
    <table class="table table-bordered table-striped">
	<tr>
	    <th>No</th><th>Nama</th><th>Pengalaman</th><th>Sertifikat</th>
	</tr>
	<?php echo $trainer;?>
    </table>
    </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>
<div class="modal fade in" id="peserta" style="display:none">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Daftar Peserta</h3>
  </div>
  <div class="modal-body">
    <p>
    <table class="table table-bordered table-striped">
	<tr>
	    <th>Nama</th><th>Nopek</th><th>Direktorat</th>
	</tr>
	<?php echo $peserta;?>
    </table>
    <b>    Jumlah Peserta : <?php echo $jumlah_peserta ?> &nbsp; Orang</b>
    </p>
  </div>
  <div class="modal-footer">
      <a class="btn btn-info"  href="peserta/view/<?php echo $course_id;?>" ><i class="icon-pencil icon-white" align="left"></i> Tambah Peserta</a>
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>

<script type="text/javascript">
    $(function () {
        $("#date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
    });

</script>

<script type="text/javascript">
function addFile(id){
    $.ajax({
	type:'POST',
	url: '<?php echo site_url('activity/edit_upload');?>',
	data : {val : id,courseId : <?php echo $course_id;?>},
	success :
	    function(info){
		$('#mytab').append('<tr><td>'+info+'</td></tr>');
	    }
    });
}
</script>

<script type="text/javascript">
function changeVal(id)
{
    $("#s-ok-"+id).remove();
    var dataId = "<?php echo $course_id;?>";
    var fieldId = id;
    var valId=0;
    var dataChange = $("input#"+id).val();
    if(dataChange==1){valId=0}else if(dataChange==0){valId=1}
    var send=$.ajax({
	url: "<?php echo base_url(); ?>index.php/activity/update_one/<?php echo $course_id;?>",
	dataType: "json",
	type: "POST",
	data: {dataVal : dataId+"#"+fieldId+"#"+valId },
	beforeSend : function(){
	    $("#pub_"+id).remove();
	    $("#ket_"+id).append("<img src='assets/img/loading.gif' width='16px' id='img_"+id+"'/>");
	}
    });
    send.done(function(data){
	$("#msg_"+id).fadeIn('slow', function() {
	    $(this).append("<span class='label label-success' id='s-ok-"+id+"'>Data telah tersimpan</span>");
	    $("#img_"+id).remove();
	    if(data.valueInput==1)
	    {
		$("#ket_"+id).append("<img src='assets/img/publish.png' id='pub_"+id+"'/>");
	    } else if(data.valueInput==0){
		$("#ket_"+id).append("<img src='assets/img/unpublish.png' id='pub_"+id+"'/>");
	    }
	});
    });

}
</script>

<script type="text/javascript">
$(function() {
    $('#file_upload').uploadify({
	'swf':'<?php echo base_url();?>assets/up/uploadify.swf',
	'uploader':'<?php echo base_url();?>assets/up/uploadify.php'
    });
});
</script>

<script type="text/javascript">
function editUpload(id)
{
    $('#cont-'+id).empty();
    $.ajax({
	type:'POST',
	url: '<?php echo site_url('activity/edit_upload');?>',
	data : {val : id,courseId : <?php echo $course_id;?>},
	success :
	    function(info){
		$('#cont-'+id).append(info);
	    }
    });
}
</script>
<?php
function ket($var,$id=null)
{
    if($var==1)
    {
	return '<img src="assets/img/publish.png" id="pub_'.$id.'"/>';
    } else if ($var==0)
    {
	return '<img src="assets/img/unpublish.png" id="pub_'.$id.'"/>';
    }
}
?>

<div class="modal fade in" id="schedule" style="display:none;width: 85%;left: 30%;">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Schedule Pembelajaran</h3>
  </div>
  <div class="modal-body">
    <p>Pelatihan : <strong><?php echo $program_title;?></strong></p>
    <h3>Minggu ke-1</h3>
    <p>
	<?php echo $week1;?>
    </p>
    <h3>Minggu ke-2</h3>
    <p>
	<?php echo $week2;?>
    </p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>