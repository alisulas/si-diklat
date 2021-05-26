<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<p>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<?php 
if ($this->session->userdata('user_id')==1 || $this->session->userdata('user_id')==2 || $this->session->userdata('user_id')==4){
    ?>
    <a href="course/edit_kursil/<?php echo $kursil['id']?>" class="btn btn-success"><i class="icon-wrench icon-white"></i> Edit Dokumen</a>
<?php
    }
?>
<a href="activity/edit/<?php echo $kursil['plc_course_id']?>" class="btn btn-info"><i class="icon-edit icon-white"></i> Lihat Kelengkapan</a>
<table class="table table-bordered table-condensed">
    <tr>
        <td width="10px">I.</td><td width="200px"><strong>Judul Program</strong></td><td><?php echo $program_title ?></td>
    </tr>
    <tr>
        <td width="10px">II.</td><td width="200px" colspan="2"><strong>Provider Pembelajaran</strong></td>
    </tr>
    <tr>
        <td></td><td>a.	Nama Perusahaan </td><td><?php echo $company ?></td>
    </tr>
    <tr>
        <td></td><td>b.	PIC </td><td><?php echo $pic ?></td>
    </tr>
    <tr>
        <td></td><td>c. Telp/HP </td><td><?php echo $phone ?></td>
    </tr>
    <tr>
        <td></td><td>d.	Fax </td><td><?php echo $fax ?></td>
    </tr>
    <tr>
        <td></td><td>e.	Email </td><td><?php echo $email ?></td>
    </tr>
    <tr>
        <td width="10px">III.</td><td width="200px" colspan="2"><strong>Tujuan</strong></td>
    </tr>
    <tr>
        <td></td><td colspan="2"><?php echo $kursil['purpose'] ?></td>
    </tr>
    <tr>
        <td width="10px">IV.</td><td width="200px" colspan="2"><strong>Sasaran / Output yang diharapkan</strong></td>
    </tr>
    <tr>
        <td></td><td colspan="2"><?php echo $kursil['objective'] ?></td>
    </tr>
    <tr>
        <td width="10px">V.</td><td width="200px" colspan="2"><strong>Lesson Plan </strong></td>
    </tr>
    <tr>
        <td></td><td colspan="2"><?php echo $kursil['lesson_plan'] ?></td>
    </tr>
    <tr>
        <td width="10px">VI.</td><td width="200px" colspan="2"><strong>Persyaratan</strong></td>
    </tr>
    <tr>
        <td></td><td>Persyaratan</td><td><?php echo $kursil['candidate_requirement'];?></td>
    </tr>
        <tr>
        <td></td><td>Estimasi Jumlah Peserta</td><td><?php echo $kursil['candidate_estimation'];?></td>
    </tr>
    <tr>
        <td width="10px">VII.</td><td width="200px" colspan="2"><strong>Tanggal Pelaksanaan</strong></td>
    </tr>
    <tr>
        <td></td><td>Mulai</td><td><?php echo $start_date;?></td>
    </tr>
        <tr>
        <td></td><td>Selesai</td><td><?php echo $end_date;?></td>
    </tr>
    <tr>
        <td width="10px">VIII.</td><td width="200px" colspan="2"><strong>Tempat Pelaksanaan </strong></td>
    </tr>
    <tr>
        <td></td><td>Lokasi</td><td><?php echo $location;?></td>
    </tr>
    <tr>
        <td width="10px">IX.</td><td width="200px" colspan="2"><strong>Anggaran Pelatihan /  Workshop</strong></td>
    </tr>
    <tr>
        <td></td><td colspan="2"><?php echo $kursil['budget'] ?></td>
    </tr>
    <tr>
        <td width="10px">X.</td><td width="200px" colspan="2"><strong>Data Pengajar</strong></td>
    </tr>
    <tr>
        <td></td><td colspan="2">
	    <table class="table table-bordered table-striped">
		<tr>
		    <td>No</td><td>Nama</td><td>Pengalaman</td><td>Sertifikasi</td>
		</tr>
		<?php echo $trainer ;?>
	    </table>
	</td>
    </tr>
    <tr>
        <td width="10px">XI.</td><td width="200px" colspan="2"><strong>Jadwal Pembelajaran</strong></td>
    </tr>
    <tr>
        <td></td>
	<td colspan="2" > 
	<?php echo $tambah_jadwal;?><br>  
        </td>
    </tr>
    <tr>
        <td></td>
	<td colspan="2" > 
	<?php echo $jadwal;?>   
	<?php echo $lihat_jadwal;?>   
        </td>
    </tr>

    </table>
<h5>Keterangan :</h5>
<table>
    <tr><td>1)</td><td>&nbsp;</td><td>Kursil dikirimkan bersama dengan Proposal minimal 20 hari kerja sebelum tanggal pelaksanaan</td></tr>
    <tr><td>2)</td><td>&nbsp;</td><td>Setelah dilakukan pengisian Kursil oleh Provider, maka PLC akan mengkajinya terlebih dahulu dan akan mengundang Provider untuk melakukan rapat koordinasi</td></tr>
    <tr><td>3)</td><td>&nbsp;</td><td>Apabila membutuhkan informasi lebih lanjut dapat menghubungi fungsi Planning & Development  Pertamina Learning Center melalui:</td></tr>
    <tr><td></td><td></td><td>
    <table>
	<tr><td>Riana Permatasari</td><td> 	: rpermata@pertamina.com</td></tr>
	<tr><td>Yudi Somantri</td><td>		: yudsm@pertamina.com</td></tr>
	<tr><td>Martino Faishal Saudi</td><td> 	: martino.saudi@pertamina.com</td></tr>
	<tr><td>Ghaisani Nabila</td><td>		: ghaisani.nabila@pertamina.com</td></tr>
	<tr><td>Muhammad Eriyo S</td><td>	: M.Eriyo@pertamina.com</td></tr>
    </table>
</td></tr>
</table>
</p>

<p>
    <a href="dashboard/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a>
</p>

<?php
function doc($var)
{
    if($var==1)
        return '<span style="color:green">Ada</span>';
    else
        return '<span style="color:red">Tidak Ada</span>';
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
    <a href="schedule/view/<?php echo $kursil['plc_course_id'];?>" class="btn btn-primary">Edit</a>
  </div>
</div>


<!-- Tambah Schedule-->
<div class="modal fade in" id="tambah_schedule" style="display:none;width: 30%;left: 30%;">
     <form method="POST" action="course/tambah_jadwal/<?php echo $kursil['plc_course_id'];?>">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tamabah Schedule Pembelajaran</h3>
  </div>
  <div class="modal-body">
    <p>Pelatihan : <strong><?php echo $program_title;?></strong></p>
   
    <table class="table table-condensed">
        <tr>
            <td>
                Tanggal 
            </td>
            <td>
                <input type="text" name="tanggal" id="tanggal">
            </td>
        </tr>
        <tr>
            <td>
                Waktu
            </td>
            <td>
                <input type="text" name="waktu">
            </td>
        </tr>
                <tr>
            <td>
                Kegiatan
            </td>
            <td>
                <input type="text" name="kegiatan">
            </td>
        </tr>
    </table>
    
  </div>
  <div class="modal-footer">
      <input type="submit" value="Simpan" class="btn btn-primary">
  </div>
</form>
</div>

<script type="text/javascript">
$(function () {
    $("#tanggal").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});

</script>