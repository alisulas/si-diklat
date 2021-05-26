<!-- FCK Editor -->
<script type="text/javascript" src="assets/editor/ckeditor.js"></script>
<script type="text/javascript" src="assets/editor/_samples/sample.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-button.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-transition.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Data Pekerja
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
          <?php echo $tabel; ?>
      </div>
    </div>
  </div>
  </div>
    
<?php echo form_open($action_nopek); ?>
<input type="text" name="nopek" class="text" value="" placeholder="Masukan Nopek">
<input type="submit" class="btn btn-primary" value="Cari">
<?php echo form_close(); ?>
<br>
<br>

<?php if (empty($nopek)) { ?>
 

<?php } else { ?>
<?php echo form_open($action); ?> 
<table class="table table-bordered">
    <tr>
        <td>Nopek</td>
        <td>
            <input type="hidden" name="nopek" value="<?php echo $nopek; ?>"><?php echo $nopek; ?>
        </td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>
            <input type="text" name="nama" value="<?php echo $nama; ?>">
        </td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>
            <input type="text" name="jabatan" value="<?php echo $jabatan; ?>">
        </td>
    </tr>
    <tr>
        <td>Due Date Cuti</td>
        <td>
            <input type="text" name="tgl_mulai_cuti" value="<?php echo $tgl_mulai; ?>" id="mulai"> s/d <input type="text" name="tgl_akhir_cuti" value="<?php echo $tgl_akhir; ?>" id="akhir">
        </td>
    </tr>
    <tr>
        <td>Cuti Tahun Ke</td>
        <td>
            <input type="text" name="tahun_ke" value="<?php echo $tahun_ke; ?>">
        </td>
    </tr>
    <tr>
        <td>Jumlah Hari</td>
        <td>
            <input type="text" name="total_hari" value="<?php echo $total_hari; ?>">
        </td>
    </tr>
    <tr>
        <td>Cuti Bersama</td>
        <td>
            <input type="text" name="cuti_bersama" value="<?php echo $cuti_bersama; ?>">
        </td>
    </tr>
    <tr>
        <td>Sisa Cuti</td>
        <td>
            <input type="text" name="sisa" value="<?php echo $sisa_cuti; ?>">
        </td>
    </tr>
</table>
<input type="submit" class="btn btn-primary" value="Ubah">
<?php echo form_close(); ?>
<?php } ?>


<script type="text/javascript">
   

$("#target").change(function () {
    var str = "";
    str += $("#sisa_cuti").val()-$(this).val();
    $("#hasil_target").val(str);

});




$(function () {
    $("#mulai").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#akhir").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#kembali").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>