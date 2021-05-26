<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<script type='text/javascript' src='assets/bootstrap/js/bootstrap-tab.js'></script>

<div class="tabbable">
  <ul class="nav nav-tabs">

        <li class="active"><a href="#tab1" data-toggle="tab">PENDAFTARAN</a></li>
        <li><a href="#tab2" data-toggle="tab">PEMBAYARAN</a></li>
        <li><a href="#tab3" data-toggle="tab">PERTANGGUNG JAWABAN</a></li>
        <li><a href="#tab4" data-toggle="tab">STATUS TLN</a></li>
        <li><a href="#tab5" data-toggle="tab">SLA</a></li>
    </ul>
 
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <table class="table table-bordered table-condensed">
                <h3>PENDAFTARAN</h3>
                <tr>
                    <td>Permintaan Dari</td>
                    <td><?php echo $tln['permintaan_dari']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Permintaan</td>
                    <td>         
                               <?php echo $tln['tgl_permintaan']; ?>
                    </td>
                </tr>     
               <tr>
                    <td>Memo Permintaan</td>
                    <td>
                        <?php cek_ada($tln['memo_permintaan']) ?>                       
                    </td>
                </tr>
                <tr>
                    <td>Persetujuan HR BP</td>
                    <td>
                        <?php cek_ada($tln['persetujuan_hrbp']) ?>
                    </td>
                </tr>
                    <tr>
                    <td>Persetujuan HR BP VIA</td>
                    <td>
                     <?php echo $tln['persetujuan_hrbp_via']; ?>                       
                    </td>
                </tr>
                <tr>
                    <td>Terima Permintaan VIA</td>
                    <td>
                     <?php echo $tln['terima_permintaan_via']; ?>                       
                    </td>
                </tr>
                <tr>
                    <td>Perencanaan</td>
                    <td>
                        <?php echo $tln['perencanaan']; ?>
                    </td>
                </tr> 
                <tr>
                    <td>Nilai Kemampuan Bahasa Inggris</td>
                    <td>
                        <?php cek_ada($tln['ket_toeic']) ?>
                        <input type="text" name="nilai_toeic" class="text"
                               value="<?php echo (set_value('nilai_toeic')) ?
                               set_value('nilai_toeic') : $tln['nilai_toeic']; ?>" disabled/>
                               
                    </td>
                </tr>  
                
                 <tr>
                    <td>Tanggal Pelaksanaan</td>
                    <td>        
                     <?php echo $this->editor->date_correct($tln['tgl_mulai_tln']).' s/d '.$this->editor->date_correct($tln['tgl_akhir_tln']); ?>
                    </td>
                </tr>
                <tr>
                    <td>SPD</td>
                    <td>
                        <?php cek_ada($tln['spd']) ?><br>
                        Tanggal Berangkat : <?php echo $tln['spd_berangkat']; ?><br>
                        Tanggal Pulang : <?php echo $tln['spd_pulang']; ?>
                    </td>
                </tr>  
                   <tr>
                    <td>Tanggal Konfirmasi ke Provider</td>
                    <td>
                               <?php echo $tln['tgl_konfirmasi_provider']; ?>
                    </td>
                </tr>
                   <tr>
                    <td>Tanggal Dokumen/Persyaratan Peserta TLN Lengkap</td>
                    <td>
                               <?php echo $tln['tgl_dokumen_lengkap']; ?>
                    </td>
                </tr>
                   <tr>
                    <td>Tanggal Registrasi</td>
                    <td>
                               <?php echo $tln['tgl_registrasi']; ?>
                    </td>
                </tr> 
                <tr>
                    <td width="250px">Registrasi VIA</td>
                    <td>
  <?php echo $tln['reg_via'] ;?>
                    </td>
                </tr>
               <tr>
                    <td width="250px">Nama Peserta TLN</td>
                    <td>
                
                               <?php echo $tln['nama']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Pekerja</td>
                    <td>
                 
                               <?php echo $tln['nopek']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Direktorat / Fungsi</td>
                    <td>
                        <?php 
                            echo $tln['direktorat'];                                                  
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Lembaga</td>
                    <td>
                    
                               <?php echo $tln['lembaga']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td>
              
                               <?php echo $tln['judul']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Contact Person</td>
                    <td>
             
                               <?php echo $tln['kontak']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
           
                               <?php echo $tln['email']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Lokasi Negara</td>
                    <td>
          
                               <?php echo $tln['lokasi']; ?>
                    </td>
                </tr>                            
            </table>    
        </div>
       <div class="tab-pane" id="tab2">
            <table class="table table-bordered table-condensed">
              <h3>PEMBAYARAN</h3>
              <tr>
                    <td>Tanggal Invoice Masuk</td>
                    <td>

<?php echo $tln['tgl_inv_masuk']; ?>
                    </td>
    </tr>
               <tr>
                    <td width="250px">Mekanisme Pembayaran</td>
                    <td>
  <?php echo $tln['mekanisme_pembayaran'] ;?>
                    </td>
                </tr>
  
                <tr>
                    <td width="250px">No Invoice</td>
                    <td>
<?php echo $tln['no_inv']; ?>
                    </td>
                </tr> 
                <tr>
                    <td>Jumlah Invoice / Reimburse</td>
                
                    <td>
                        
<?php echo $tln['keu_currency'];?>
                                                

<?php echo $tln['inv_jumlah']; ?>
                    </td>
                </tr>
 
                <tr>
                    <td>Letter of Guarantee ke Provider</td>
                    <td>
                        <?php cek_ada($tln['log_provider']) ?>
                    </td>
                </tr>
                <tr>
                    <td>Tgl Memo Pembayaran Ke LS</td>
                    <td>

<?php echo $tln['tgl_terima_ls']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Surat Perintah (SP)</td>
                    <td>
                        <?php cek_ada($tln['sp']) ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pembuatan SP</td>
                    <td>
   
<?php echo $tln['tgl_pembuatan_sp']; ?>
                    </td>
                </tr>

            </table>
        </div>

        <div class="tab-pane" id="tab3">
            <table class="table table-bordered table-condensed">
                <h3>PERTANGGUNGJAWABAN</h3>
                <tr>
                    <td>Tanggal Pengiriman Reminder PJB ke Peserta</td>
                    <td>
                 
<?php echo $tln['tgl_pengiriman_reminder']; ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Bukti Kehadiran</td>
                    <td>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Absensi" <?php cek_bk('Absensi',$bukti_kehadiran)?>>Absensi<br>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Name Tag" <?php cek_bk('Name Tag',$bukti_kehadiran)?>>Name Tag<br>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Sertifikat" <?php cek_bk('Sertifikat',$bukti_kehadiran)?>>Sertifikat<br>
                    </td>
                </tr>
             <tr>
                    <td>Feedback</td>
                    <td>
                        <?php cek_ada($tln['feedback']) ?>
                    </td>
                </tr> 
                <tr>
                    <td>Tanggal Diterima Dokumen PJB Lengkap</td>
                    <td>
                   
<?php echo $tln['tgl_terima_dokumen']; ?>
                    </td>
                </tr>
               <tr>
                    <td>Tanggal Dokumen PJB diterima LS</td>
                    <td>
<?php echo $tln['tgl_dokumen_ls']; ?>
                    </td>
                </tr>
            </table>   
        </div>
        
        <div class="tab-pane" id="tab4">
            <table class="table table-bordered table-condensed">
                <h3>STATUS TLN</h3>
                <tr>
                    <td>Status Pelaksanaan TLN</td>
                    <td><?php echo $tln['status_pelaksanaan_tln']; ?></td>
                </tr>
               <tr>
                    <td>Keterangan Pelaksanaan TLN</td>
                    <td>
    
<?php echo $tln['ket_pelaksanaan_tln']; ?>
                    </td>
                </tr>
            </table>
    </div>
        <div class="tab-pane" id="tab5">
            <table class="table table-bordered table-condensed">
                <h3>SLA</h3>
                <tr>
                    <td>SLA Registrasi</td>
                    <td><?php echo $sla1; ?></td>
                </tr>
                <tr>
                    <td>SLA Pembayaran</td>
                    <td><?php echo $sla2; ?></td>
                </tr>
            </table>
    </div>
    </div> 
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">PERMINTAAN</a></li>
        <li><a href="#tab2" data-toggle="tab">PEMBAYARAN</a></li>
        <li><a href="#tab3" data-toggle="tab">PERTANGGUNG JAWABAN</a></li>
        <li><a href="#tab4" data-toggle="tab">STATUS TLN</a></li>
        <li><a href="#tab5" data-toggle="tab">SLA</a></li>
    </ul>
    
</div>



<div class="form-actions">
    <a href="tln/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a> 
</div>



<?php
 function cek_bk($bkt,$bukti_kehadiran) {
          
     for ($b=0;$b<count($bukti_kehadiran);$b++){
                    if ($bukti_kehadiran[$b]==$bkt) {
                        echo  'checked="checked"';
                    }   
            }      
}
 
function cek_ada($dat) {
    if ($dat==1) {
        echo '<span class="label label-info">Ada</span>';
    }  else {
        echo '<span class="label label-important">Tidak Ada</span>';
    }
}

    
    function cek_memenuhi($dat) {
    if ($dat==1) {
        echo '<span class="label label-info">Memenuhi</span>';
    }  else {
        echo '<span class="label label-important">Tidak Memenuhi</span>';
    }    
    }

?>

<script type="text/javascript">
    $(function () {
        $("#tgl_permintaan").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_mulai_tln").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_akhir_tln").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_konfirmasi_provider").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_dokumen_lengkap").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_registrasi").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_inv_masuk").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_terima_ls").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
       $("#tgl_terima_dokumen").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#tgl_pembuatan_sp").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
    
        $("#tgl_pengiriman_reminder").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
               $("#tgl_dokumen_ls").datepicker({
            changeMonth: true,  
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
     
    });
    $(document).ready(function(){
$('#box1').hide();
$('#box2').hide();
$('#box3').hide();
$("#thechoices").change(function(){
if(this.value == 'all')
{$("#boxes").children().show();}
else
{$("#" + this.value).show().siblings().hide();}
});

$("#thechoices").change();
});

function change(id) {
document.getElementById("chk_reg_via").value = id
}

</script>