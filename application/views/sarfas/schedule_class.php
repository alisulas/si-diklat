<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<style type="text/css">
.back {
    background-color: #DDDDDD;
    color: #000000;
    height: 3px;
    width: 1px;
}
.tinggi{
    height: 5px;
}
</style>
<?php

if ($this->session->userdata('user_id')==5) {
    ?>
<table width="100%">
            
            <tr>
                <td><?php // echo $tambah_kegiatan?></td>
                <td><input type="text" id="start_date" name="start_date" class="input-medium" placeholder="Tanggal Mulai"></td>
                <td><input type="text" id="end_date" name="end_date" class="input-medium" placeholder="Tanggal Selesai"></td>
                <td><select name="kelas" id="kelas" class="input-medium"><?php echo $options_class;?></select></td>
                <td><input type='button' class="btn" id='check_jadwal' value='Check Availability'></td>
       <td><div id='availability_result' style="width: 100px"></div></td>
                <td><div style="float: right"><?php echo $bulan_sekarang?> </div></td>
            </tr>
        </table>
        <?php
}
?>

<div style="overflow-x: scroll">
<table class="table table-bordered table-condensed">
    <tr class="back">
        <th rowspan="2">Gd</th>
        <th rowspan="2">Lt</th>
        <th rowspan="2"><center>Kelas</center></th>
        <th colspan="31"><center><?php echo $bulan; ?></center></th>
    </tr>
    <tr class="back">
        <th>01</th>
        <th>02</th>
        <th>03</th>
        <th>04</th>
        <th>05</th>
        <th>06</th>
        <th>07</th>
        <th>08</th>
        <th>09</th>
    <?php for($a=10;$a<=31;$a++){
      echo '<th>'.$a.'</th>';  
    } ?>
        
    </tr>
                <tr>
                            <td class="back">GL</td>
        <td class="back">I</td>
        <td class="back">Lab</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[18][$a].'">'.$kegiatan[18][$a].'</td>';
    } ?>
    </tr>
    <tr class="tinggi">
        <td class="back">GL</td>
        <td class="back">II</td>
        <td class="back">Enduro</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[1][$a].'">'.$kegiatan[1][$a].'</td>';  
    } ?>
        
    </tr>
        <tr>
        <td class="back">GL</td>
        <td class="back">II</td>
        <td class="back">Pertamax</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[2][$a].'">'.$kegiatan[2][$a].'</td>';
    } ?>
    </tr>
            <tr>
                        <td class="back">GL</td>
        <td class="back">II</td>
        <td class="back">Fastron</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[3][$a].'">'.$kegiatan[3][$a].'</td>';  
    } ?>
    </tr>
            <tr>
                        <td class="back">GL</td>
        <td class="back">II</td>
        <td class="back">Musicool</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[4][$a].'">'.$kegiatan[4][$a].'</td>';
    } ?>
    </tr>
            <tr>
        <td class="back">GL</td>
        <td class="back">II</td>
        <td class="back">Vigas</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[5][$a].'">'.$kegiatan[5][$a].'</td>';  
    } ?>
    </tr>
            <tr>
                        <td class="back">GL</td>
        <td class="back">II</td>
        <td class="back">Avtur</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[6][$a].'">'.$kegiatan[6][$a].'</td>'; 
    } ?>
    </tr>
            <tr>
        <td class="back">GL</td>
        <td class="back">III</td>
        <td class="back">Auditorium</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[7][$a].'">'.$kegiatan[7][$a].'</td>';
    } ?>
    </tr>
            <tr>
                        <td class="back">GL</td>
        <td class="back">IV</td>
        <td class="back">Prabumulih</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[8][$a].'">'.$kegiatan[8][$a].'</td>'; 
    } ?>
    </tr>
            <tr>
        <td class="back">GL</td>
        <td class="back">IV</td>
        <td class="back">Klayan</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[9][$a].'">'.$kegiatan[9][$a].'</td>';
    } ?>
    </tr>
            <tr>
        <td class="back">GL</td>
        <td class="back">IV</td>
        <td class="back">Sangatta</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[10][$a].'">'.$kegiatan[10][$a].'</td>';  
    } ?>
    </tr>
    
            <tr>
        <td class="back">GL</td>
        <td class="back">IV</td>
        <td class="back">Methanol</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[30][$a].'">'.$kegiatan[30][$a].'</td>';  
    } ?>
    </tr>
    
            <tr>
        <td class="back">GL</td>
        <td class="back">V</td>
        <td class="back">Mesran</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[31][$a].'">'.$kegiatan[31][$a].'</td>';  
    } ?>
    </tr>
    
            <tr>
        <td class="back">GL</td>
        <td class="back">VI</td>
        <td class="back">Meditran</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[32][$a].'">'.$kegiatan[32][$a].'</td>';  
    } ?>
    </tr>
    
            <tr>
        <td class="back">GL</td>
        <td class="back">VII</td>
        <td class="back">Elpiji</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[33][$a].'">'.$kegiatan[33][$a].'</td>';  
    } ?>
    </tr>
    
    <tr>
        <td class="back">GL</td>
        <td class="back">VIII</td>
        <td class="back"></td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[34][$a].'">'.$kegiatan[34][$a].'</td>';  
    } ?>
    </tr>
    
        <tr>
        <td class="back">GL</td>
        <td class="back">IX</td>
        <td class="back">Bio Solar</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[11][$a].'">'.$kegiatan[11][$a].'</td>';
    } ?>
    </tr>            
<!--            <tr>
        <td>Prospek Kelas 1</td>
    <?php // for($a=1;$a<=31;$a++){
   // echo '<td style="background-color:'.$class[11][$a].'">'.$kegiatan[11][$a].'</td>';
   // } ?>
    </tr>
            <tr>
        <td>Pprospek Kelas 2</td>
    <?php //for($a=1;$a<=31;$a++){
    //  echo '<td style="background-color:'.$class[12][$a].'">'.$kegiatan[12][$a].'</td>';
   // } ?>
    </tr>-->
            <tr>
                        <td class="back">TC</td>
        <td class="back">II</td>
        <td class="back">Kelas II TC</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[13][$a].'">'.$kegiatan[13][$a].'</td>'; 
    } ?>
    </tr>
            <tr>
        <td class="back">TC</td>
        <td class="back">III</td>
        <td class="back">Ashpalt</td>
    <?php for($a=1;$a<=31;$a++){
      echo '<td style="background-color:'.$class[14][$a].'">'.$kegiatan[14][$a].'</td>'; 
    } ?>
    </tr>
            <tr>
        <td class="back">TC</td>
        <td class="back">IV</td>
        <td class="back">Corpu 1</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[15][$a].'">'.$kegiatan[15][$a].'</td>';
    } ?>
    </tr>
            <tr>
        <td class="back">TC</td>
        <td class="back">IV</td>
        <td class="back">Propylene</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[16][$a].'">'.$kegiatan[16][$a].'</td>';
    } ?>
    </tr>
            <tr>
        <td class="back">TC</td>
        <td class="back">IV</td>
        <td class="back">Corpu 2</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[17][$a].'">'.$kegiatan[17][$a].'</td>';
    } ?>
    </tr>
    
            <tr>
        <td class="back">PSR</td>
        <td class="back">2</td>
        <td class="back">Borobudur</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[35][$a].'">'.$kegiatan[35][$a].'</td>';
    } ?>
    </tr>
    
        <tr>
        <td class="back">PSR</td>
        <td class="back">2</td>
        <td class="back">Mendut</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[36][$a].'">'.$kegiatan[36][$a].'</td>';
    } ?>
    </tr>
    
        <tr>
        <td class="back">PSR</td>
        <td class="back">3</td>
        <td class="back">Borobudur</td>
    <?php for($a=1;$a<=31;$a++){
     echo '<td style="background-color:'.$class[37][$a].'">'.$kegiatan[37][$a].'</td>';
    } ?>
    </tr>

</table>
</div>
<?php // echo $ket; ?>
<?php  echo $detail?>

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


