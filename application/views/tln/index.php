<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
    <?php echo $tambah; ?><br>
    <a href="libur" class="btn btn-mini btn-info" target="_blank">Data Hari libur (SLA)</a><br><br>
    
<span style="float: right"><?php echo $excel;?></span>
<form action="tln/index" method="POST">
<strong>Cari Berdasarkan : </strong>
<select name="month" class="input input-small">
    <option value="0">-Bulan-</option>
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">Maret</option>
    <option value="4">April</option>
    <option value="5">Mei</option>
    <option value="6">Juni</option>
    <option value="7">Juli</option>
    <option value="8">Agustus</option>
    <option value="9">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
</select>
<select name="tahun" class="input input-small">
    <option value="0">-Tahun-</option>
    <option value="2012">2012</option>
    <option value="2013">2013</option>
    <option value="2013">2014</option>
    <option value="2013">2015</option>
    <option value="2013">2016</option>
</select>
<select name="status" class="input-medium">
    <option value="0">-Status Pelaksanaan-</option>
    <option value="Siap Dilaksanakan">Siap Dilaksanakan</option>
    <option value="Sudah Dilaksanankan">Sudah Dilaksanankan</option>
    <option value="Pending Dokumen">Pending Dokumen</option>
    <option value="Batal">Batal</option>
    <option value="Reschedule">Reschedule</option>
</select>
<input type="text" name="nopek" placeholder="NOPEK" class="input-small"/>
<input type="text" name="nama" placeholder="NAMA" class="input-small"/>
<input type="text" name="judul" placeholder="JUDUL" class="input-small"/>
<button class="btn btn-primary" type="submit">cari</button>
<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>

<p>
 
    <?php echo $pagination; ?>
    <?php echo $content;?> 
    <?php echo $pagination; ?>

</p>


 <div class="modal fade in" id="upload" style="display:none; width: 250px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Upload Data</h3>
  </div>
  <div class="modal-body">
<?php echo form_open_multipart('tln/do_upload');?>

<input type="file" name="userfile" size="20" />

<input type="submit" value="Upload" />
<?php echo form_error('userfile');?>
<?php echo form_close();?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Close</a>
  </div>
</div>



