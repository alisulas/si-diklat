<?php echo form_open_multipart($action); ?>
<table class="table table-condensed">
    <tr>
        <td>Nama Peserta</td>
        <td><input type="text" name="nama" value="<?php echo $tb['nama'] ?>"></td>
        <td>Email Pertamina</td>
        <td><input type="text" name="email_pertamina" value="<?php echo $tb['email_pertamina'] ?>"></td>
    </tr>
    <tr>
      <td>Nomor Pekerja</td>
      <td><input type="text" name="nopek" value="<?php echo $tb['nopek'] ?>"></td>
      <td>Email Pribadi</td>
      <td><input type="text" name="email_pribadi"  value="<?php echo $tb['email_pribadi'] ?>"></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td><input type="text" name="keterangan" value="<?php echo $tb['keterangan'] ?>"></td>
      <td>Alamat di Indonesia</td>
      <td><input type="text" name="alamat_indonesia" value="<?php echo $tb['alamat_indonesia'] ?>"></td>
    </tr>
    <tr>
      <td>Yudisium</td>
      <td><input type="text" name="yudisium" value="<?php echo $tb['yudisium'] ?>"></td>
      <td>Alamat di Luar Negeri</td>
      <td><input type="text" name="alamat_ln" value="<?php echo $tb['alamat_ln'] ?>"></td>
    </tr>
    <tr>
      <td colspan="2">Awal Program</td>
    </tr>
    <tr>
      <td>Direktorat/Fungsi Level/AP</td>
      <td><input type="text" name="awal_fungsi" value="<?php echo $tb['awal_fungsi'] ?>"></td>
      <td>Nomor Paspor</td>
      <td><input type="text" name="paspor_no" value="<?php echo $tb['paspor_no'] ?>"></td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td><input type="text" name="awal_jabatan" value="<?php echo $tb['awal_jabatan'] ?>"></td>
      <td>Masa Berlaku Paspor</td>
      <td><input type="text" name="paspor_berlaku" id="datepicker" value="<?php echo $tb['paspor_berlaku'] ?>"></td>
    </tr>
    <tr>
      <td colspan="2">Saat Ini</td>
    </tr>
    <tr>
    <td>Direktorat/Fungsi Level/AP</td>
    <td><input type="text" name="skr_fungsi" value="<?php echo $tb['skr_fungsi'] ?>"></td>
    <td>No Tlp/HP Luar Negeri</td>
    <td><input type="text" name="no_telp_ln" value="<?php echo $tb['no_telp_ln'] ?>"></td>
    </tr>
    <tr>
    <td>Jabatan</td>
    <td><input type="text" name="skr_jabatan" value="<?php echo $tb['skr_jabatan'] ?>"></td>
    <td>Kontak Indonesia</td>
    <td><input type="text" name="kontak_indonesia" value="<?php echo $tb['kontak_indonesia'] ?>"></td>
    </tr>
    <tr>
    <td>TPA</td><td><input type="text" name="tpa" value="<?php echo $tb['tpa'] ?>"></td>
    <td>CP universitas</td><td><input type="text" name="cp_universitas" value="<?php echo $tb['cp_universitas'] ?>"></td>
    </tr>
    <tr>
    <td>TOEFL/IELTS</td><td><input type="text" name="toefl" value="<?php echo $tb['toefl'] ?>"></td>
    <td>Email Universitas</td><td><?php echo $email_universitas; ?></td>
    </tr>
    <tr>
    <td>Psikotest</td>
    <td><?php echo $psikotest; ?></td>
    <td>Masa Study</td>
    <td><input type="text" name="masa_study_awal" class="input input-small" id="datepicker1" value="<?php echo $tb['masa_study_awal'] ?>"> s/d <input type="text" name="masa_study_akhir"  value="<?php echo $tb['masa_study_akhir'] ?>" class="input input-small" id="datepicker2"></td>
    </tr>
    <tr>
    <td>Mdeical Check Up</td>
    <td><input type="text" name="mcu" value="<?php echo $tb['mcu'] ?>"></td>
    <td>Status Keberangkatan</td>
    <td><?php echo $status_keberangkatan; ?></td>
    </tr>
    <tr>
    <td>Program Tugas Belajar</td>
    <td><input type="text" name="program_tugas_belajar" value="<?php echo $tb['program_tugas_belajar'] ?>"></td>
    <td>Keterangan Lulus</td>
    <td><?php echo $ket_lulus; ?></td>
    </tr>
    <tr>
    <td>Lokasi</td>
    <td><?php echo $lokasi; ?></td>
    <td>Ijazah/SKL</td><td><input type="file" name="ijazah"><input type="hidden" value="<?php echo $tb['ijazah'] ?>"></td>
    </tr>
    <tr>
    <td>Jenjang Pendidikan</td>
    <td><?php echo $jenjang_pendidikan; ?></td>
    <td>IPK/GPA </td>
    <td>
      <div class="input_fields_wrap">
        <?php echo $semester; ?>

  </div>
  <button class=" btn btn-mini btn-info add_field_button">Tambah</button>
    </td>
    </tr>
    <tr>
    <td>Bidang Pendidikan</td>
    <td><input type="text" name="bidang_pendidikan" value="<?php echo $tb['bidang_pendidikan'] ?>"></td>
    <td>GPA/IPK Akhir</td><td><input type="text" name="ipk_akhir" value="<?php echo $tb['ipk_akhir'] ?>"></td>
    </tr>
    <tr>
    <td>Program - Jurusan</td>
    <td><input type="text" name="jurusan" value="<?php echo $tb['jurusan'] ?>"></td>
    <td>GPA/IPK (eqv scale 4)</td>
    <td><input type="text" name="ipk" value="<?php echo $tb['ipk'] ?>"></td>
    </tr>
    <tr>
    <td>Universitas</td>
    <td><input type="text" name="universitas" value="<?php echo $tb['universitas'] ?>"></td>
    </tr>
</table>
<div class="form-actions">
    <button class="btn btn-primary" type="submit">Simpan</button>&nbsp;<?php echo anchor('tugas_belajar/index', 'kembali', array('class'=>'btn')) ?>
</div>
<?php echo form_close();?>

<script type="text/javascript">
$(function () {
    $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#datepicker1").datepicker({
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
});

</script>

<script type="text/javascript">
$(document).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(wrapper).append('<div>Semester \
          <select name="smt_no[]" class="input input-small">\
            <option value="1">1</option>\
            <option value="2">2</option>\
            <option value="3">3</option>\
            <option value="4">4</option>\
            <option value="5">5</option>\
            <option value="6">6</option>\
            <option value="7">7</option>\
            <option value="8">8</option>\
            <option value="9">9</option>\
            <option value="10">10</option>\
          </select><input type="text" name="smt_ipk[]" class="input input-small"/>\
           <a href="#" class="btn btn-mini btn-danger remove_field">Hapus</a></div>'); //add input box
      }
  });

  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
  })
});
</script>
