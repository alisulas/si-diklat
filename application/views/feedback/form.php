<!-- FCK Editor -->
<script type="text/javascript" src="assets/js/tm/jquery.tinymce.js"></script>

	<!--// load jQuery Plug-ins //-->
	<script type="text/javascript" src="assets/autosum/jquery.field.js"></script>
	<script type="text/javascript" src="assets/autosum/jquery.calculation.js"></script>
<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
 <form action="<?php echo $action?>" method="post">
        
            <input type="hidden" name="course_id" value="<?php echo $course_id?>"> 
             <div style="overflow-x: scroll">
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
        <td>1</td><td>Mudah dipahami</td>
        <?php for ($i= 1; $i<= $jumlahpeserta; $i++) {
           
     echo '<td><input type="text" name="fb1_'.$i.'" class="input input-mini fb1" style="width:15px" ></td>';   
        }      
        echo '<td><span class="totalfb1"></span></td>';        
        ?>
        
    </tr>
        
    <tr>
        <td>2</td><td>Relevan dengan pekerjaan</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb2_'.$i.'" class="input input-mini fb2" style="width:15px"></td>';   
        
        }
        echo '<td><span class="totalfb2"></span></td>';
        ?>
          
    </tr>
    <tr>
        <td>3</td><td>Manfaat Materi (pekerjaan/pribadi) </td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb3_'.$i.'" class="input input-mini fb3" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb3"></span></td>';
        ?>
    </tr>
    <tr>
        <td>4</td><td>Metode penyampaian</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb4_'.$i.'" class="input input-mini fb4" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb4"></span></td>';
        ?>
    </tr>
    <tr>
        <td>5</td><td>Bangak hal baru diperoleh dari pelatihan ini</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb5_'.$i.'" class="input input-mini fb5" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb5"></span></td>';
        ?>
    </tr>

    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com1");?>        
        </td><td></td>
    </tr>
    </table>
    </div>
             <div style="overflow-x: scroll">
                 <table class="table table-bordered table-condensed">
    <tr>
        <td>6</td><td>Menguasaan Materi</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb6_'.$i.'" class="input input-mini fb6" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb6"></span></td>';
        ?>
    </tr>
        
    <tr>
        <td>7</td><td>Sistematika penyajian</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb7_'.$i.'" class="input input-mini fb7" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb7"></span></td>';
        ?>
    </tr>
    <tr>
        <td>8</td><td>Gaya atau metode penyajian</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb8_'.$i.'" class="input input-mini fb8" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb8"></span></td>';
        ?>
    </tr>
    <tr>
        <td>9</td><td>Respon positif terhadap peserta</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb9_'.$i.'" class="input input-mini fb9" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb9"></span></td>';
        ?>
    </tr>
    <tr>
        <td>10</td><td>Pengaturan waktu</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb10_'.$i.'" class="input input-mini fb10" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb10"></span></td>';
        ?>
    </tr>
    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com2");?>        
        </td><td></td>
    </tr>
                 </table>
             </div>
            <div style="overflow-x: scroll">
                <table class="table table-bordered table-condensed">
    <tr>
        <td>11</td><td>Kesesuaian pelaksanaan dengan jadwal</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb11_'.$i.'" class="input input-mini fb11" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb11"></span></td>';
        ?>
    </tr>
    <tr>
        <td>12</td><td>Copy materi tersedia</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb12_'.$i.'" class="input input-mini fb12" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb12"></span></td>';
        ?>
    </tr>
    <tr>
        <td>13</td><td>Layanan petugas</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb13_'.$i.'" class="input input-mini fb13" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb13"></span></td>';
        ?>
    </tr>
    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com3");?>        
        </td><td></td>
    </tr>
                </table>
            </div>
            <div style="overflow-x: scroll">
                <table class="table table-bordered table-condensed">
    <tr>
        <td>14</td><td>Kualitas ruangan / kelas pembelajaran</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb14_'.$i.'" class="input input-mini fb14" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb14"></span></td>';
        ?>
    </tr>
    <tr>
        <td>15</td><td>Alat bantu pembelajaran (flipchart, LCD, ATK sound system)</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb15_'.$i.'" class="input input-mini fb15" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb15"></span></td>';
        ?>
    </tr>
    <tr>
        <td>16</td><td>Konsumsi (hygienis, rasa, jumlah, varias)</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb16_'.$i.'" class="input input-mini fb16" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb16"></span></td>';
        ?>
    </tr>
    <tr>
        <td>17</td><td>Kebersihan, pelayanan, Laundry, perlengkapan (khusus residensial)</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb17_'.$i.'" class="input input-mini fb17" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb17"></span></td>';
        ?>
    </tr>
    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com4");?>        
        </td><td></td>
    </tr>
                </table>
            </div>
             <div style="overflow-x: scroll">
                 <table class="table table-bordered table-condensed"> 
    <tr>
        <td>18</td><td>safety induction dilaksanakan dengan jelas (prosedur evaluasi dan peralatan safety)</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb18_'.$i.'" class="input input-mini fb18" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb18"></span></td>';
        ?>
    </tr>
    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com5");?>        
        </td><td></td>
    </tr>
                 </table>
             </div>
             <div style="overflow-x: scroll"> 
                 <table class="table table-bordered table-condensed"> 
    <tr>
        <td>19</td><td>Pelatihan ini perlu dilaksanakan secara rutin</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb19_'.$i.'" class="input input-mini fb19" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb19"></span></td>';
        ?>
    </tr>
    <tr>
        <td>20</td><td>Saya merekomendasikan pelatihan ini diikuti oleh peserta lain</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb20_'.$i.'" class="input input-mini fb20" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb20"></span></td>';
        ?>
    </tr>
    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com6");?>        
        </td><td></td>
    </tr>
                 </table>
             </div>
             <div style="overflow-x: scroll"> 
                 <table class="table table-bordered table-condensed"> 
    <tr>
        <th>I</th>
        <th colspan="<?php echo 2+$jumlahpeserta;?>">KONSUMSI</th>
    </tr>
    <tr>
        <td>a</td><td>Jenis Makanan</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb21_'.$i.'" class="input input-mini fb21" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb21"></span></td>';
        ?>
    </tr>
    <tr>
        <td>b</td><td>Cara Penyajian</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb22_'.$i.'" class="input input-mini fb22" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb22"></span></td>';
        ?>
    </tr>
     <tr>
        <th>II</th>
        <th colspan="<?php echo 2+$jumlahpeserta;?>">PENYELENGGARA</th>
    </tr>
    <tr>
        <td>a</td><td>Keramahan Panitia</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb23_'.$i.'" class="input input-mini fb23" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb23"></span></td>';
        ?>
    </tr>
    <tr>
        <td>b</td><td>Keramahan Fasilitator Lapangan</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb24_'.$i.'" class="input input-mini fb24" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb24"></span></td>';
        ?>
    </tr>
    <tr>
        <td>c</td><td>Kecakapan Fasilitator Lapangan</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb25_'.$i.'" class="input input-mini fb25" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb25"></span></td>';
        ?>
    </tr>
     <tr>
        <th>III</th>
        <th colspan="<?php echo 2+$jumlahpeserta;?>">PERMAINAN</th>
    </tr>
    <tr>
        <td>a</td><td>Keamanan</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb26_'.$i.'" class="input input-mini fb26" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb26"></span></td>';
        ?>
    </tr>
    <tr>
        <td>b</td><td>Jenis Permainan</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb27_'.$i.'" class="input input-mini fb27" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb27"></span></td>';
        ?>
    </tr>
     <tr>
        <th>IV</th>
        <th colspan="<?php echo 2+$jumlahpeserta;?>">JADWAL OUTBOUND</th>
    </tr>
    <tr>
        <td>a</td><td>Pengaturan Jadwal</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb28_'.$i.'" class="input input-mini fb28" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb28"></span></td>';
        ?>
    </tr>
    <tr>
        <td>b</td><td>Rentang Waktu Pelaksanaan Outbound</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb29_'.$i.'" class="input input-mini fb29" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb29"></span></td>';
        ?>
    </tr>
    <tr>
        <th>V</th>
        <th colspan="<?php echo 2+$jumlahpeserta;?>">FASILITATOR KELAS (PSYKOLOG)</th>
    </tr>
    <tr>
        <td>a</td><td>Evaluasi dan Refleksi</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb30_'.$i.'" class="input input-mini fb30" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb30"></span></td>';
        ?>
    </tr>
    <tr>
        <td>b</td><td>Sikap Fasilitator Kelas</td>
        <?php for ($i = 1; $i <= $jumlahpeserta; $i++) {
     echo '<td><input type="text" name="fb31_'.$i.'" class="input input-mini fb31" style="width:15px"></td>';   
        }
         echo '<td><span class="totalfb31"></span></td>';
        ?>
    </tr>
    <tr>
        <td colspan="<?php echo 2+$jumlahpeserta;?>">
    <?php echo $this->editor->textarea("com7");?>        
        </td><td></td>
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
	$('input.fb1').bind('keyup', function() {
		$('span.totalfb1').html( $('input.fb1').sumValues() );
	});
        
        $('input.fb2').bind('keyup', function() {
		$('span.totalfb2').html( $('input.fb2').sumValues() );
	});
        $('input.fb3').bind('keyup', function() {
		$('span.totalfb3').html( $('input.fb3').sumValues() );
	});
        $('input.fb4').bind('keyup', function() {
		$('span.totalfb4').html( $('input.fb4').sumValues() );
	});
        $('input.fb5').bind('keyup', function() {
		$('span.totalfb5').html( $('input.fb5').sumValues() );
	});
        $('input.fb6').bind('keyup', function() {
		$('span.totalfb6').html( $('input.fb6').sumValues() );
	});
        $('input.fb7').bind('keyup', function() {
		$('span.totalfb7').html( $('input.fb7').sumValues() );
	});
        $('input.fb8').bind('keyup', function() {
		$('span.totalfb8').html( $('input.fb8').sumValues() );
	});
        $('input.fb9').bind('keyup', function() {
		$('span.totalfb9').html( $('input.fb9').sumValues() );
	});
        $('input.fb10').bind('keyup', function() {
		$('span.totalfb10').html( $('input.fb10').sumValues() );
	});
        $('input.fb11').bind('keyup', function() {
		$('span.totalfb11').html( $('input.fb11').sumValues() );
	});
        $('input.fb12').bind('keyup', function() {
		$('span.totalfb12').html( $('input.fb12').sumValues() );
	});
        $('input.fb13').bind('keyup', function() {
		$('span.totalfb13').html( $('input.fb13').sumValues() );
	});
        $('input.fb14').bind('keyup', function() {
		$('span.totalfb14').html( $('input.fb14').sumValues() );
	});
        $('input.fb15').bind('keyup', function() {
		$('span.totalfb15').html( $('input.fb15').sumValues() );
	});
        $('input.fb16').bind('keyup', function() {
		$('span.totalfb16').html( $('input.fb16').sumValues() );
	});
        $('input.fb17').bind('keyup', function() {
		$('span.totalfb17').html( $('input.fb17').sumValues() );
	});
        $('input.fb18').bind('keyup', function() {
		$('span.totalfb18').html( $('input.fb18').sumValues() );
	});
        $('input.fb19').bind('keyup', function() {
		$('span.totalfb19').html( $('input.fb19').sumValues() );
	});
        $('input.fb20').bind('keyup', function() {
		$('span.totalfb20').html( $('input.fb20').sumValues() );
	});
        $('input.fb21').bind('keyup', function() {
		$('span.totalfb21').html( $('input.fb21').sumValues() );
	});
        $('input.fb22').bind('keyup', function() {
		$('span.totalfb22').html( $('input.fb22').sumValues() );
	});
        $('input.fb23').bind('keyup', function() {
		$('span.totalfb23').html( $('input.fb23').sumValues() );
	});
        $('input.fb24').bind('keyup', function() {
		$('span.totalfb24').html( $('input.fb24').sumValues() );
	});
        $('input.fb25').bind('keyup', function() {
		$('span.totalfb25').html( $('input.fb25').sumValues() );
	});
        $('input.fb26').bind('keyup', function() {
		$('span.totalfb26').html( $('input.fb26').sumValues() );
	});
        $('input.fb27').bind('keyup', function() {
		$('span.totalfb27').html( $('input.fb27').sumValues() );
	});
        $('input.fb28').bind('keyup', function() {
		$('span.totalfb28').html( $('input.fb28').sumValues() );
	});
        $('input.fb29').bind('keyup', function() {
		$('span.totalfb29').html( $('input.fb29').sumValues() );
	});
        $('input.fb30').bind('keyup', function() {
		$('span.totalfb30').html( $('input.fb30').sumValues() );
	});
        $('input.fb31').bind('keyup', function() {
		$('span.totalfb31').html( $('input.fb31').sumValues() );
	});
});
	
	</script>
        
       