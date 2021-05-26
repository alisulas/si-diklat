<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<br>
            <div style="float: left">
            <?php echo $tambah_kegiatan?>
            <?php echo $lihat_kalender?>&nbsp;<?php echo $lihat_jadwal?><br>                
            </div>

            
            <div style="float: right">
             <form action="sarfas/index" method="POST">
     <select name="list" style="width:100px">
         <option value="name" selected>Pelatihan</option>
            <option value="kode">Kode</option>
     </select>
 <input type="text" name="cari" placeholder="Pencarian" />
 <button class="btn btn-primary" type="submit">Cari</button>&nbsp;<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>                
            </div>
 <br>
 <br>
        <?php echo $pagination;?>
    <?php echo $course;?>
    <?php echo $pagination;?>

<?php echo $modal_aktivitas_sarfas; ?>
<?php echo $modal_lihat_aktivitas_sarfas; ?>
<?php echo $add_memo_masuk; ?>
<?php echo $add_memo_keluar; ?>
<?php echo $location; ?>

            <div class="modal fade in" id="tambah_kegiatan" style="display:none;width: 32%;left: 50%;">
      <?php echo form_open($action);?>
		    <div class="modal-header">
                        <button class="close" data-dismiss="modal">x</button>
                        <h4>Tambah Kegiatan</h4>
			
		    </div>
		    <div class="modal-body">
                      
			<table class="table table-bordered table-condensed">
    <tr>
        <td>Jenis Kegiatan</td>
        <td>
            <select name="jenis">
                <option value="LDT">LDT</option>   
                <option value="Ad Hoc">Ad Hoc</option>   
                <option value="BPS/BPA">BPS/BPA</option>   
                <option value="GFT">GFT</option>   
                <option value="Workshop">Workshop</option>   
                <option value="Rapat">Rapat</option>   
                <option value="HSE">HSE</option>   
                <option value="Academy MNT">Academy MNT</option>   
                <option value="Academy Refinery">Academy Refinery</option>   
                <option value="Academy Upstream">Academy Upstream</option>   
                <option value="Academy Leadership">Academy Leadership</option>   
                <option value="Academy Support">Academy Support</option>   
                <option value="Lainnya">Lainnya</option>   
            </select>
        </td>
    </tr>
    <tr>
        <td>Nama Kegiatan</td>
        <td>
            	    <input type="text" name="activity" class="text"/>
        </td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>
                        <select name="kelas" id="kel">
                <?php echo $options_class;?>
            </select>
            <input type="text" id="other" name="other" class="text" placeholder="Lainnya">
        </td>
    </tr>
    <tr>
        <td>
            Tanggal Mulai
        </td>
                <td>
            	    <input type="text" id="date_start" name="start_date" class="text">
        </td>
    </tr>
    <tr>
        <td>
            Tanggal Selesai
        </td>
                <td>
            	    <input type="text" id="date_end" name="end_date" class="text" />
        </td>
    </tr>
    <tr>
        <td><input type='button' class="btn" id='jadwal_check' value='Check Availability'>
</td>
        <td><div id='result_availability'></div></td>
    </tr>
        <tr>
        <td>PIC</td>
        <td>
            	    <input type="text" name="pic" class="text" />
        </td>
    </tr>
    <tr>
        <td>Warna</td>
        <td>
<input name="color" class="color" value="66ff00">                
        </td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>
            <textarea name="ket"></textarea>                
        </td>
    </tr>

</table>
                        
		    </div>
		    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" style="float: left">Simpan</button>
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
    <?php form_close(); ?>
		</div>



<!--<script type="text/javascript">$("#color").modcoder_excolor({effect : 'zoom'}); </script>-->
<script type="text/javascript">
$(function () {
    $("#start_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#end_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#date_start").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
    $("#date_end").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });
});

</script>

<script type="text/javascript">


  $(document).ready(function() {
        
		var checking_html = '<img src="assets/img/loading_1.gif" /> Checking...';
		
		//when button is clicked
		$('#check_jadwal').click(function(){
			
				//else show the cheking_text and run the function to check
				$('#availability_result').html(checking_html);
				check_availability();
		});
		$('#jadwal_check').click(function(){
			
				//else show the cheking_text and run the function to check
				$('#result_availability').html(checking_html);
				availability_check();
		});
                $('#other').hide();
		$('#kel').click(function(){
			
        if ($('#kel').val()==19){
            $('#other').show();
        }else{
            $('#other').hide();
        }
		});
                
		
		
  });

//function to check username availability	
function check_availability(){
		
		//get the username
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		var kelas = $('#kelas').val();
		
		//use ajax to run the check
		$.post("<?php echo base_url(); ?>index.php/sarfas/check_jadwal", { start_date: start_date,end_date:end_date,kelas:kelas },
			function(result){
				//if the result is 1
				if(result == 1){
					//show that the username is available
					$('#availability_result').html('<span class="is_available"><b>Tersedia</b></span>');
				}else{
					//show that the username is NOT available
					$('#availability_result').html('<span class="is_not_available"><b>Tidak Tersedia</b></span>');
				}
                     
		});
                

}

function availability_check(){

		
		//get the username
		var date_start = $('#date_start').val();
		var date_end = $('#date_end').val();
		var kel = $('#kel').val();
		
		//use ajax to run the check
		$.post("<?php echo base_url(); ?>index.php/sarfas/jadwal_check", { date_start: date_start,date_end:date_end,kel:kel },
			function(result){
				//if the result is 1
				if(result == 1){
					//show that the username is available
					$('#result_availability').html('<span class="is_available"><b>Tersedia</b></span>');
				}else{
					//show that the username is NOT available
					$('#result_availability').html('<span class="is_not_available"><b>Tidak Tersedia</b></span>');
				}

            });

}
</script>

<style type='text/css'>

.is_available{
	color:green;
}
.is_not_available{
	color:red;
}
</style>

            