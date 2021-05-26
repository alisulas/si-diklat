<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<script type='text/javascript' src='assets/bootstrap/js/bootstrap-tab.js'></script>


<?php echo form_open_multipart($action); ?>
<div class="tabbable">
    <ul class="nav nav-tabs">

        <li class="active"><a href="#tab1" data-toggle="tab">PENDAFTARAN</a></li>
        <li><a href="#tab2" data-toggle="tab">PEMBAYARAN</a></li>
        <li><a href="#tab3" data-toggle="tab">PERTANGGUNG JAWABAN</a></li>
        <li><a href="#tab4" data-toggle="tab">STATUS TLN</a></li>
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <table class="table table-bordered table-condensed">
                <h3>PENDAFTARAN</h3>
                <tr>
                    <td>Permintaan Dari</td>
                    <td><?php echo $permintaan_dari; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Permintaan</td>
                    <td>
                        <input type="text" name="tgl_permintaan" class="text input-small" id="tgl_permintaan"
                               value="<?php echo (set_value('tgl_permintaan')) ?
                                       set_value('tgl_permintaan') : $tln['tgl_permintaan']; ?>" />
                               <?php echo form_error('tgl_permintaan'); ?>
                    </td>
                </tr>     
               <tr>
                    <td>Memo Permintaan</td>
                    <td>
                        <div class="btn-group" data-toggle-name="memo_permintaan" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('memo_permintaan')">Ada</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('memo_permintaan')">Tidak Ada</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="memo_permintaan" value="<?php
                               echo (set_value('memo_permintaan')) ?
                                       set_value('memo_permintaan') : $tln['memo_permintaan'];
                               ?>"  id="memo_permintaan"/>
                    </td>
                </tr>
                <tr>
                    <td>Persetujuan HR BP</td>
                    <td>
                        <div class="btn-group" data-toggle-name="persetujuan_hrbp" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('persetujuan_hrbp')">Disetujui</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('persetujuan_hrbp')">Tidak Disetujui</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="persetujuan_hrbp" value="<?php
                               echo (set_value('persetujuan_hrbp')) ?
                                       set_value('persetujuan_hrbp') : $tln['persetujuan_hrbp'];
                               ?>"  id="persetujuan_hrbp"/>
                    </td>
                </tr>
                <tr>
                    <td>Persetujuan HR BP VIA</td>
                    <td>
                     <?php echo $persetujuan_hrbp_via; ?>                       
                    </td>
                </tr>
                <tr>
                    <td>Terima Permintaan VIA</td>
                    <td>
                     <?php echo $terima_permintaan_via; ?>                       
                    </td>
                </tr>
                <tr>
                    <td>Perencanaan</td>
                    <td>
                        <?php echo $perencanaan; ?>
                    </td>
                </tr> 
                <tr>
                    <td>Nilai Kemampuan Bahasa Inggris</td>
                    <td>
                        <div class="btn-group" data-toggle-name="ket_toeic" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('ket_toeic')">Memenuhi</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('ket_toeic')">Tidak Memenuhi</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="ket_toeic" value="<?php
                               echo (set_value('ket_toeic')) ?
                                       set_value('ket_toeic') : $tln['ket_toeic'];
                               ?>"  id="ket_toeic"/>
                        <input type="text" name="nilai_toeic" class="text" placeholder="Nilai Toeic"
                               value="<?php echo (set_value('nilai_toeic')) ?
                                       set_value('nilai_toeic') : $tln['nilai_toeic']; ?>" />
                               <?php echo form_error('nilai_toeic'); ?>
                    </td>
                </tr> 
                 <tr>
                    <td>Tanggal Pelaksanaan</td>
                    <td>
                        <input type="text" name="tgl_mulai_tln" class="text" id="tgl_mulai_tln"
                               value="<?php echo (set_value('tgl_mulai_tln')) ?
                                       set_value('tgl_mulai_tln') : $tln['tgl_mulai_tln']; ?>" />
                               <?php echo form_error('tgl_mulai_tln'); ?>
                        &nbsp;s/d&nbsp;
                        <input type="text" name="tgl_akhir_tln" class="text" id="tgl_akhir_tln"
                               value="<?php echo (set_value('tgl_akhir_tln')) ?
                                       set_value('tgl_akhir_tln') : $tln['tgl_akhir_tln']; ?>" />
                               <?php echo form_error('tgl_akhir_tln'); ?>
                    </td>
                </tr> 
                <tr>
                    <td>SPD</td>
                    <td>
                        <div class="btn-group" data-toggle-name="spd" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('spd')">Ada</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('spd')">Tidak Ada</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="spd" value="<?php
                               echo (set_value('spd')) ?
                                       set_value('spd') : $tln['spd'];
                               ?>"  id="spd"/> 
                        <br>
                        Tanggal Berangkat : <input type="text" name="spd_berangkat" class="text" id="spd_berangkat"
                               value="<?php echo (set_value('spd_berangkat')) ?
                                       set_value('spd_berangkat') : $tln['spd_berangkat']; ?>" />
                               <?php echo form_error('spd_berangkat'); ?>&nbsp;
                               
                        Tanggal Pulang : <input type="text" name="spd_pulang" class="text" id="spd_pulang"
                               value="<?php echo (set_value('spd_pulang')) ?
                                       set_value('spd_pulang') : $tln['spd_pulang']; ?>" />
                               <?php echo form_error('spd_pulang'); ?>
                    </td>
                    
                </tr>  
                   <tr>
                    <td>Tanggal Konfirmasi ke Provider</td>
                    <td>
                        <input type="text" name="tgl_konfirmasi_provider" class="text" id="tgl_konfirmasi_provider"
                               value="<?php echo (set_value('tgl_konfirmasi_provider')) ?
                                       set_value('tgl_konfirmasi_provider') : $tln['tgl_konfirmasi_provider']; ?>" />
                               <?php echo form_error('tgl_konfirmasi_provider'); ?>
                    </td>
                </tr>
                   <tr>
                    <td>Tanggal Dokumen/Persyaratan Peserta TLN Lengkap</td>
                    <td>
                        <input type="text" name="tgl_dokumen_lengkap" class="text" id="tgl_dokumen_lengkap"
                               value="<?php echo (set_value('tgl_dokumen_lengkap')) ?
                                       set_value('tgl_dokumen_lengkap') : $tln['tgl_dokumen_lengkap']; ?>" />
                               <?php echo form_error('tgl_dokumen_lengkap'); ?>
                    </td>
                </tr>
                   <tr>
                    <td>Tanggal Registrasi</td>
                    <td>
                        <input type="text" name="tgl_registrasi" class="text" id="tgl_registrasi"
                               value="<?php echo (set_value('tgl_registrasi')) ?
                                       set_value('tgl_registrasi') : $tln['tgl_registrasi']; ?>" />
                               <?php echo form_error('tgl_registrasi'); ?>
                    </td>
                </tr> 
                <tr>
                    <td width="250px">Registrasi VIA</td>
                    <td>
  <?php echo $reg_via ;?>
                    </td>
                </tr>
               <tr>
                    <td width="250px">Nama Peserta TLN</td>
                    <td>
                        <input type="text" name="nama" class="text "
                               value="<?php echo (set_value('nama')) ?
                                       set_value('nama') : $tln['nama']; ?>" />
                               <?php echo form_error('nama'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Nomor Pekerja</td>
                    <td>
                        <input type="text" name="nopek" class="text "
                               value="<?php echo (set_value('nopek')) ?
                                       set_value('nopek') : $tln['nopek']; ?>" />
                               <?php echo form_error('nopek'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Direktorat / Fungsi</td>
                    <td>
                        <?php 
                            echo $direktorat;                                                  
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Lembaga</td>
                    <td>
                        <input type="text" name="lembaga" class="text "
                               value="<?php echo (set_value('lembaga')) ?
                                       set_value('lembaga') : $tln['lembaga']; ?>" />
                               <?php echo form_error('lembaga'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Judul</td>
                    <td>
                        <input type="text" name="judul" class="text "
                               value="<?php echo (set_value('judul')) ?
                                       set_value('judul') : $tln['judul']; ?>" />
                               <?php echo form_error('judul'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Contact Person</td>
                    <td>
                        <input type="text" name="kontak" class="text "
                               value="<?php echo (set_value('kontak')) ?
                                       set_value('kontak') : $tln['kontak']; ?>" />
                               <?php echo form_error('kontak'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="email" class="text"
                               value="<?php echo (set_value('email')) ?
                                       set_value('email') : $tln['email']; ?>" />
                               <?php echo form_error('email'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Lokasi Negara</td>
                    <td>
                        <input type="text" name="lokasi" class="text"
                               value="<?php echo (set_value('lokasi')) ?
                                       set_value('lokasi') : $tln['lokasi']; ?>" />
                               <?php echo form_error('lokasi'); ?>
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
                        <input type="text" name="tgl_inv_masuk" class="text input-medium" id="tgl_inv_masuk"
                               value="<?php echo (set_value('tgl_inv_masuk')) ?
        set_value('tgl_inv_masuk') : $tln['tgl_inv_masuk']; ?>" />
<?php echo form_error('tgl_inv_masuk'); ?>
                    </td>
    </tr>
               <tr>
                    <td width="250px">Mekanisme Pembayaran</td>
                    <td>
  <?php echo $mekanisme_pembayaran ;?>
                    </td>
                </tr>
                
                <tr>
                    <td width="250px">No Invoice</td>
                    <td>
                        <input type="text" name="no_inv" class="text input-medium"
                               value="<?php echo (set_value('no_inv')) ?
        set_value('no_inv') : $tln['no_inv']; ?>" />
<?php echo form_error('no_inv'); ?>
                    </td>
                </tr> 
                <tr>
                    <td>Jumlah Invoice / Reimburse</td>
                
                    <td> 
                        <input type="text" placeholder="Mata Uang" name="keu_currency" class="text input-small"
                               value="<?php echo (set_value('keu_currency')) ?
        set_value('keu_currency') : $tln['keu_currency']; ?>" />
<?php echo form_error('keu_currency'); ?>
                        
                        <input type="text" placeholder="Jumlah" name="inv_jumlah" class="text input-small"
                               value="<?php echo (set_value('inv_jumlah')) ?
        set_value('inv_jumlah') : $tln['inv_jumlah']; ?>" />
<?php echo form_error('keu_inv_jumlah'); ?>
                    </td>
                </tr>
 
                <tr>
                    <td>Letter of Guarantee ke Provider</td>
                    <td>
                        <div class="btn-group" data-toggle-name="log_provider" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('log_provider')">Ada</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('log_provider')">Tidak Ada</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="log_provider" value="<?php
                               echo (set_value('log_provider')) ?
                                       set_value('log_provider') : $tln['log_provider'];
                               ?>"  id="log_provider"/>
                    </td>
                </tr>
                <tr>
                    <td>Tgl Memo Pembayaran Ke LS</td>
                    <td>
                        <input type="text" name="tgl_terima_ls" class="text input-medium" id="tgl_terima_ls"
                               value="<?php echo (set_value('tgl_terima_s')) ?
        set_value('tgl_terima_ls') : $tln['tgl_terima_ls']; ?>" />
<?php echo form_error('tgl_terima_ls'); ?>
                    </td>
                </tr>
                    <tr>
                    <td>Surat Perintah (SP)</td>
                    <td>
                        <div class="btn-group" data-toggle-name="sp" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('sp')">Ada</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('sp')">Tidak Ada</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="sp" value="<?php
        echo (set_value('sp')) ?
        set_value('sp') : $tln['sp'];
?>"  id="sp"/>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pembuatan SP</td>
                    <td>
                        <input type="text" name="tgl_pembuatan_sp" class="text input-medium" id="tgl_pembuatan_sp"
                               value="<?php echo (set_value('tgl_pembuatan_sp')) ?
        set_value('tgl_pembuatan_sp') : $tln['tgl_pembuatan_sp']; ?>" />
<?php echo form_error('tgl_pembuatan_sp'); ?>
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
                        <input type="text" name="tgl_pengiriman_reminder" class="text input-medium" id="tgl_pengiriman_reminder"
                               value="<?php echo (set_value('tgl_pengiriman_reminder')) ?
        set_value('tgl_pengiriman_reminder') : $tln['tgl_pengiriman_reminder']; ?>" />
<?php echo form_error('tgl_pengiriman_reminder'); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>Bukti Kehadiran</td>
                    <td>
                        <?php
                 if ($bkt=='edit') {
                     ?>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Absensiedit" <?php cek_bk('Absensi',$bukti_kehadiran)?>>&nbsp;Absensi<br>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Sertifikat" <?php cek_bk('Sertifikat',$bukti_kehadiran)?>>&nbsp;Sertifikat<br>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Name Tag" <?php cek_bk('Name Tag',$bukti_kehadiran)?>>&nbsp;Name Tag<br>
                        <?php
                 }  else{ ?>
                       
                        <input type="checkbox" name="bukti_kehadiran[]" value="Absensi" >&nbsp;Absensi<br>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Name Tag" >&nbsp;Name Tag<br>
                        <input type="checkbox" name="bukti_kehadiran[]" value="Sertifikat" >&nbsp;Sertifikat<br>
                    <?php 
                 }
                        ?>

                    </td>
                </tr>
             <tr>
                    <td>Feedback</td>
                    <td>
                        <div class="btn-group" data-toggle-name="feedback" data-toggle="buttons-radio">
                            <button type="button" class="btn btn-info" value="1" onclick="changeVal('feedback')">Ada</button>
                            <button type="button" class="btn btn-info" value="0" onclick="changeVal('feedback')">Tidak Ada</button>
                        </div>
                        <span id="msg_act8"></span>
                        <input type="hidden" name="feedback" value="<?php
        echo (set_value('feedback')) ?
        set_value('feedback') : $tln['feedback'];
?>"  id="sp"/>
                    </td>
                </tr> 
                <tr>
                    <td>Tanggal Diterima Dokumen PJB Lengkap</td>
                    <td>
                        <input type="text" name="tgl_terima_dokumen" class="text input-medium" id="tgl_terima_dokumen"
                               value="<?php echo (set_value('tgl_terima_dokumen')) ?
        set_value('tgl_terima_dokumen') : $tln['tgl_terima_dokumen']; ?>" />
<?php echo form_error('tgl_terima_dokumen'); ?>
                    </td>
                </tr>
               <tr>
                    <td>Tanggal Dokumen PJB diterima LS</td>
                    <td>
                        <input type="text" name="tgl_dokumen_ls" class="text input-medium" id="tgl_dokumen_ls"
                               value="<?php echo (set_value('tgl_dokumen_ls')) ?
        set_value('tgl_dokumen_ls') : $tln['tgl_dokumen_ls']; ?>" />
<?php echo form_error('tgl_dokumen_ls'); ?>
                    </td>
                </tr>
            </table>   
        </div>
        <div class="tab-pane" id="tab4">
            <table class="table table-bordered table-condensed">
                <h3>STATUS TLN</h3>
                <tr>
                    <td>Status Pelaksanaan TLN</td>
                    <td><?php echo $status_pelaksanaan_tln; ?></td>
                </tr>
               <tr>
                    <td>Keterangan Pelaksanaan TLN</td>
                    <td>
                        <?php echo $this->editor->textarea('ket_pelaksanaan_tln',$tln['ket_pelaksanaan_tln']); ?>
                    </td>
                </tr>
             
            </table>   
        </div>
    </div>    

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">PENDAFTARAN</a></li>
        <li><a href="#tab2" data-toggle="tab">PEMBAYARAN</a></li>
        <li><a href="#tab3" data-toggle="tab">PERTANGGUNG JAWABAN</a></li>
        <li><a href="#tab4" data-toggle="tab">STATUS TLN</a></li>
    </ul>
    
</div>



<div class="form-actions">
<a href="tln/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a>&nbsp;<button class="btn btn-primary" type="submit">Simpan</button> 
</div>

<?php echo form_close(); ?>

<?php
 function cek_bk($bkt,$bukti_kehadiran) {
          
     for ($b=0;$b<count($bukti_kehadiran);$b++){
                    if ($bukti_kehadiran[$b]==$bkt) {
                        echo  'checked="checked"';
                    }   
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
        $("#spd_berangkat").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
        });
        $("#spd_pulang").datepicker({
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