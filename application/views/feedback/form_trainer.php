<!-- FCK Editor -->
<script type="text/javascript" src="assets/js/tm/jquery.tinymce.js"></script>

	<!--// load jQuery Plug-ins //-->
	<script type="text/javascript" src="assets/autosum/jquery.field.js"></script>
	<script type="text/javascript" src="assets/autosum/jquery.calculation.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<table class="table table-bordered table-condensed">
    <tr>
        <td>Nama Instruktur</td><td>: <?php echo $trainer_name ?></td>
    </tr>
    <tr>
        <td>Materi Yang Disampaikan</td><td>: <?php echo $course_name ;?></td>
    </tr>
    <tr>
        <td>Hari / Tanggal</td><td>: <?php echo $start_date;?> - <?php echo $end_date;?></td>
    </tr>
</table>

 <form action="<?php echo $action?>" method="post">
        <div style="overflow-x: scroll">
            <input type="hidden" name="course_id" value="<?php echo $course_id?>">
            <input type="hidden" name="trainer_id" value="<?php echo $trainer_id?>">
            <input type="hidden" name="jumlahpeserta" value="<?php echo $jumlahpeserta?>">
<table class="table table-condensed table-bordered">
    <tr>
        <th rowspan="2">No</th><th rowspan="2">Kriteria Penilaian</th><th colspan="<?php echo $jumlahpeserta ?>">Jumlah Peserta Pelatihan</th>
    </tr>
    <tr>
        
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<th>'.$i.'</th>';   
        }?>
        <th>Total</th>
    </tr>
    
    <tr>
        <td>1</td><td>Penguasaan Materi</td>
        <?php for ($i= 1; $i<= $jumlahpeserta; $i++) {
           
     echo '<td><input type="text" name="ft1_'.$i.'" class="input input-mini ft1" style="width:15px" ></td>';   
        }      
        echo '<td><span class="totalft1"></span></td>';        
        ?>
        
    </tr>
        
    <tr>
        <td>2</td><td>Sistematika Penyajian</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="ft2_'.$i.'" class="input input-mini ft2" style="width:15px"></td>';   
        
        }
        echo '<td><span class="totalft2"></span></td>';
        ?>
          
    </tr>
    <tr>
        <td>3</td><td>Gaya / Metoda Penyajian </td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="ft3_'.$i.'" class="input input-mini ft3" style="width:15px"></td>';   
        }
         echo '<td><span class="totalft3"></span></td>';
        ?>
    </tr>
    <tr>
        <td>4</td><td>Kecepatan / Pengaturan Waktu </td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="ft4_'.$i.'" class="input input-mini ft4" style="width:15px"></td>';   
        }
         echo '<td><span class="totalft4"></span></td>';
        ?>
    </tr>
    <tr>
        <td>5</td><td>Respon Terhadap Peserta </td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="ft5_'.$i.'" class="input input-mini ft5" style="width:15px"></td>';   
        }
         echo '<td><span class="totalft5"></span></td>';
        ?>
    </tr>
    <tr>
        <td>6</td><td>Contoh - Contoh </td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="ft6_'.$i.'" class="input input-mini ft6" style="width:15px"></td>';   
        }
         echo '<td><span class="totalft6"></span></td>';
        ?>
    </tr>
    <tr>
        <td>7</td><td>Diskusi</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="ft7_'.$i.'" class="input input-mini ft7" style="width:15px"></td>';   
        }
         echo '<td><span class="totalft7"></span></td>';
        ?>
    </tr>
    <tr>
        
        <td colspan="<?php echo 3+$jumlahpeserta;?>">
            <b>Komentar / Saran </b><br>
    <?php echo $this->editor->textarea("com");?>  
        </td>
    </tr>
</table>
            
</div>
        <div class="form-actions">
            <a class="btn" href="feedback"><i class="icon-hand-left"></i> Cancel</a>
    <button class="btn btn-primary" type="submit">Save changes</button>
</div>
    </form>


        <script type="text/javascript">
	$(document).ready(
		function (){
			

			// automatically update the "#totalSum" field every time
			// the values are changes via the keyup event
			$("input[name^=fb]").sum("keyup", "#fbSum");
			
			
		}
	);
            
            $.fn.sumValues = function() {
	var sum = 0; 
	this.each(function() {
		if ( $(this).is(':input') ) {
			var val = $(this).val();
		} else {
			var val = $(this).text();
		}
		sum += parseFloat( ('0' + val).replace(/[^0-9-\.]/g, ''), 10 );
	});
	return sum;
};


$(document).ready(function() {
	$('input.ft1').bind('keyup', function() {
		$('span.totalft1').html( $('input.ft1').sumValues() );
	});
        
        $('input.ft2').bind('keyup', function() {
		$('span.totalft2').html( $('input.ft2').sumValues() );
	});
        $('input.ft3').bind('keyup', function() {
		$('span.totalft3').html( $('input.ft3').sumValues() );
	});
        $('input.ft4').bind('keyup', function() {
		$('span.totalft4').html( $('input.ft4').sumValues() );
	});
        $('input.ft5').bind('keyup', function() {
		$('span.totalft5').html( $('input.ft5').sumValues() );
	});
        $('input.ft6').bind('keyup', function() {
		$('span.totalft6').html( $('input.ft6').sumValues() );
	});
        $('input.ft7').bind('keyup', function() {
		$('span.totalft7').html( $('input.ft7').sumValues() );
	});
});
	
	</script>
        
       