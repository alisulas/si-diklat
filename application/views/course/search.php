<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<span style="float: right"><?php echo $excel;?></span>
<select>
    <option>Pilih Pencarian</option>        
    <option id="bulan">Bulan</option>        
    <option id="nama">Nama</option>        
    <option id="tempat">Tempat</option>        
</select>

<form action="course/search" method="POST">
<table id="bul">
    <tr>
        <td>Bulan</td><td>Tahun</td><td></td>
    </tr>
    <tr>
        <td>
<select name="month">
    <option value="0">All</option>
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">Maret</option>
    <option value="04">April</option>
    <option value="05">Mei</option>
    <option value="06">Juni</option>
    <option value="07">Juli</option>
    <option value="08">Agustus</option>
    <option value="09">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
</select>            
        </td>
        <td>
<select name="year">
    <option value="0">All</option>
    <option value="2013">2013</option>
    <option value="2014">2014</option>
</select>            
        </td>
        <td><button class="btn btn-primary" type="submit">Cari</button></td>
    </tr>
</table>
    
    <table id="nam">
    <tr>
        <td>Nama Program </td>
    </tr>
    <tr>
        <td><input type="text" name="course_name" placeholder="Masukkan nama pelatihan" /><button class="btn btn-primary" type="submit">Cari</button></td>
    </tr>
    </table>
    
    <table id="tmp">
    <tr>
        <td>Tempat Pelaksanaan </td>
    </tr>
    <tr>
        <td><input type="text" name="location" placeholder="Masukkan Tempat pelatihan" /><button class="btn btn-primary" type="submit">Cari</button></td>
    </tr>
</table>
<hr>
<button class="btn btn-info" type="submit">Refresh</button>
</form>

<p>
    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>

<script>
$(document).ready(function(){
    $("#bul").hide();
    $("#nam").hide();
    $("#tmp").hide();
    
  $("#bulan").click(function(){
    $("#bul").show();
    $("#nam").hide();
    $("#tmp").hide();
  });
  $("#nama").click(function(){
    $("#bul").hide();
    $("#nam").show();
    $("#tmp").hide();
  });
  $("#tempat").click(function(){
    $("#bul").hide();
    $("#nam").hide();
    $("#tmp").show();
  });
});
</script>


