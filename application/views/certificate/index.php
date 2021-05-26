<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>

<span style="float: right"><?php echo $download;?>&nbsp;<?php echo $excel;?></span>
<form action="certificate/index" method="POST">
Filter By :
<select name="month">
    <option value="0">All</option>
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
<select name="status">
    <option value="all">All</option>
    <option value="-1">Expired</option>
    <option value="30">Waspada</option>
    <option value="80">Awas</option>
    <option value="100">Aman</option>
    <option value="un">Unlimited</option>
</select>
<button class="btn btn-primary" type="submit">filter</button>
</form>

<p>
    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>

<?php 
if($this->session->userdata('user_id')==2){
    ?>
	<a class="btn btn-primary" href="certificate/add">Tambah Sertifikat</a>

<?php
}
?>
