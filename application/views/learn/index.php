<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<div style="float: left">
<form action="learn/index" method="POST">
    <table>
        <tr>
            <td>Status Alert Pembayaran :</td>
            <td>
    <select name="alert" style="width: 120px">
    <option value="1">-</option>
    <option value="0">Belum Lengkap</option>
    <option value="-1">Expired</option>
    <option value="1">Waspada</option>
    <option value="31">Awas</option>
    <option value="61">Aman</option>
</select>
            </td>
        </tr>
        <tr>
            <td>Status Pekerja :</td>
            <td>
                <select name="pekerja" style="width: 120px">
    <option value="2">-</option>
    <option value="nama">Nama</option>
    <option value="nopek">Nopek</option>
    <option value="institusi">Institusi</option>
    <option value="direktorat">Direktorat</option>
</select>
    <input type="text" name="name" placeholder="Masukkan Pencarian" style="width: 100px"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button class="btn btn-primary" type="submit">cari</button>
                <?php echo anchor('learn', 'Lihat Semua', array('class'=>'btn btn-primary')); ?>
               
            </td>
        </tr>
    </table>
</form>
</div>

<div style="float: right">
    <table class="table table-striped">
        <tr><td><b>Laporan Data Pembayaran</b></td></tr>
        <tr>
            <td>
                <form action="learn/to_excel" method="POST">
<select name="month" style="width: 120px">
    <option value="0">Bulan</option>
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
<select name="year" style="width: 120px">
    <option value="0">Tahun</option>
    <option value="2012">2012</option>
    <option value="2013">2013</option>
    <option value="2014">2014</option>
    <option value="2015">2015</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    
</select>


<button class="btn btn-primary" type="submit">Download</button>
</form>
            </td>
        <tr>
            <td><b>Laporan Data Peserta</b></td>
        </tr>
        </tr>
        <tr><td><?php echo anchor('learn/to_excel_data_peserta', 'Download', array('class'=>'btn btn-success')); ?></td></tr>
    </table>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<?php 
if($this->session->userdata('fungsi')==4 || $this->session->userdata('fungsi')==1){
    echo '
	<a class="btn btn-success" href="learn/add">Tambah</a>
'; 
}
?>

<p>
    <?php echo $pagination;?>
    <br>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>

<?php echo $addpayment;?>
<?php echo $listpayment;?>
<script type="text/javascript">
$(function () {
    $("#pay_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});


</script>