<script type='text/javascript' src='assets/bootstrap/js/bootstrap-tab.js'></script>
<br />
<table class="table table-condensed">
    <tr><td width="150px"><h4>Nama Pelatihan</h4></td><td><h4>: <?php echo $course_name;?></h4></td></tr>
    <tr><td><h4>Tanggal</h4></td><td><h4>: <?php echo $this->editor->date_correct($start_date);?> - <?php echo $this->editor->date_correct($end_date);?></h4></td></tr>
</table>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Materi Pembelajaran</a></li>
    <li><a href="#tab2" data-toggle="tab">Fasilitator</a></li>
    <li><a href="#tab3" data-toggle="tab">Pelaksanaan Penunjang</a></li>
    <li><a href="#tab4" data-toggle="tab">Sarfas Pembelajaran</a></li>
    <li><a href="#tab5" data-toggle="tab">Safety Induction</a></li>
    <li><a href="#tab6" data-toggle="tab">Rekomendasi</a></li>
    <li><a href="#tab7" data-toggle="tab">Out bon</a></li>
    <li><a href="#tab8" data-toggle="tab">With Sarfas</a></li>
    <li><a href="#tab9" data-toggle="tab">Tanpa Sarfas</a></li>
  </ul>

  <div class="tab-content">
	<div class="tab-pane active" id="tab1">
            <h3>I. MATERI PEMBELAJARAN</h3>
	    <p>
	    <table class="table table-condensed table-bordered">
		<tr>
		    <th width="10px">No</th><th>Kriteria Penilaian</th><th width="80px">Total</th>
		</tr>

		<tr>
		    <td>1</td><td>Mudah dipahami</td><td><?php echo $totalfb1;?></td>
		</tr>

		<tr>
		    <td>2</td><td>Relevan dengan pekerjaan</td><td><?php echo $totalfb2;?></td>
		</tr>
		<tr>
		    <td>3</td><td>Manfaat Materi (pekerjaan/pribadi) </td><td><?php echo $totalfb3;?></td>
		</tr>
		<tr>
		    <td>4</td><td>Metode penyampaian</td><td><?php echo $totalfb4;?></td>
		</tr>
		<tr>
		    <td>5</td><td>Banyak hal baru diperoleh dari pelatihan ini</td><td><?php echo $totalfb5;?></td>
		</tr>

			<tr>
		<td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom1?></b></td>
		</tr>
		<tr>
                    <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom1, 2); ?></b></td>
		</tr>
		<tr>
		    <td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		</tr>
		<tr>
		    <td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		</tr>
		<tr>
		    <td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com1?>&nbsp;%</b></td>
		</tr>

		<tr>
		    <td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com1;?></td>
		</tr>
	    </table>
	    </p>
	</div>

	<div class="tab-pane" id="tab2">
            <h3>II. FASILITATOR / INSTRUKTUR</h3>
	    <p>

		<table class="table table-condensed table-bordered">
		    <tr>
			<th width="10px">No</th><th>Kriteria Penilaian</th><th width="80px">Total</th>
		    </tr>
		    <tr>
			<td>6</td><td>Menguasaan Materi</td><td><?php echo $totalfb6;?></td>
		    </tr>

		    <tr>
			<td>7</td><td>Sistematika penyajian</td><td><?php echo $totalfb7;?></td>
		    </tr>
		    <tr>
			<td>8</td><td>Gaya atau metode penyajian</td><td><?php echo $totalfb8;?></td>
		    </tr>
		    <tr>
			<td>9</td><td>Respon positif terhadap peserta</td><td><?php echo $totalfb9;?></td>
		    </tr>
		    <tr>
			<td>10</td><td>Pengaturan waktu</td><td><?php echo $totalfb10;?></td>
		    </tr>
			     <tr>
		    <td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom2?></b></td>
		    </tr>
		    <tr>
                        <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom2, 2)?></b></td>
		    </tr>
		    <tr>
			<td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com2?>&nbsp;%</b></td>
		    </tr>

		    <tr>
			<td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com2;?></td>
		    </tr>
		</table>
	    </p>
	</div>
	<div class="tab-pane" id="tab3">
            <h3>III. PELKSANAAN PEMBELAJARAN </h3>
	    <p>
		<table class="table table-condensed table-bordered">
		    <tr>
			<th width="10px">No</th><th>Kriteria Penilaian</th><th width="80px">Total</th>
		    </tr>
		    <tr>
			<td>11</td><td>Kesesuaian pelaksanaan dengan jadwal</td><td><?php echo $totalfb11;?></td>
		    </tr>
		    <tr>
			<td>12</td><td>Copy materi tersedia</td><td><?php echo $totalfb12;?></td>
		    </tr>
		    <tr>
			<td>13</td><td>Layanan petugas</td><td><?php echo $totalfb13;?></td>
		    </tr>
			    <tr>
		    <td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom3?></b></td>
		    </tr>
		    <tr>
                        <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom3, 2) ?></b></td>
		    </tr>
		    <tr>
			<td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com3?>&nbsp;%</b></td>
		    </tr>

		    <tr>
			<td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com3;?></td>
		    </tr>
		</table>
	    </p>
	</div>
	<div class="tab-pane" id="tab4">
            <h3>IV. SARANA DAN FASILITAS PEMBELAJARAN (Supporting Facilities)</h3>
	    <p>
		<table class="table table-condensed table-bordered">
		    <tr>
			<th width="10px">No</th><th>Kriteria Penilaian</th><th width="80px">Total</th>
		    </tr>
		    <tr>
			<td>14</td><td>Kualitas ruangan / kelas pembelajaran</td><td><?php echo $totalfb14;?></td>
		    </tr>
		    <tr>
			<td>15</td><td>Alat bantu pembelajaran (flipchart, LCD, ATK sound system)</td><td><?php echo $totalfb15;?></td>
		    </tr>
		    <tr>
			<td>16</td><td>Konsumsi (hygienis, rasa, jumlah, varias)</td><td><?php echo $totalfb16;?></td>
		    </tr>
		    <tr>
			<td>17</td><td>Kebersihan, pelayanan, Laundry, perlengkapan (khusus residensial)</td><td><?php echo $totalfb17;?></td>
		    </tr>
			     <tr>
		    <td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom4?></b></td>
		    </tr>
		    <tr>
                        <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom4, 2)?></b></td>
		    </tr>
		    <tr>
			<td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com4?>&nbsp;%</b></td>
		    </tr>

		    <tr>
			<td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com4;?></td>
		    </tr>
		</table>
	    </p>
	</div>
	<div class="tab-pane" id="tab5">
            <h3>V. SAFETY BRIEFING (INDUCTION)</h3>
	    <p>
		<table class="table table-condensed table-bordered">
		    <tr>
			<th width="10px">No</th><th>Kriteria Penilaian</th><th width="80px">Total</th>
		    </tr>
		    <tr>
			<td>18</td><td>safety induction dilaksanakan dengan jelas (prosedur evaluasi dan peralatan safety)</td><td><?php echo $totalfb18;?></td>
		    </tr>
			 <tr>
		    <td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom5?></b></td>
		    </tr>
		    <tr>
                        <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom5, 2)?></b></td>
		    </tr>
		    <tr>
			<td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com5?>&nbsp;%</b></td>
		    </tr>

		    <tr>
			<td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com5;?></td>
		    </tr>
		</table>
	    </p>
	</div>
	<div class="tab-pane" id="tab6">
            <h3>VI. REKOMENDASI PESERTA</h3>
	    <p>
		<table class="table table-condensed table-bordered">
		    <tr>
			<th width="10px">No</th><th>Kriteria Penilaian</th><th width="80px">Total</th>
		    </tr>
		    <tr>
			<td>19</td><td>Pelatihan ini perlu dilaksanakan secara rutin</td><td><?php echo $totalfb19;?></td>
		    </tr>
		    <tr>
			<td>20</td><td>Saya merekomendasikan pelatihan ini diikuti oleh peserta lain</td><td><?php echo $totalfb20;?></td>
		    </tr>
			     <tr>
		    <td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom6?></b></td>
		    </tr>
		    <tr>
                        <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom6, 2)?></b></td>
		    </tr>
		    <tr>
			<td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com6?>&nbsp;%</b></td>
		    </tr>

		    <tr>
			<td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com6;?></td>
		    </tr>
		</table>
	    </p>
	</div>
	<div class="tab-pane" id="tab7">
            <h3>VII. OUTBOUND</h3>
	    <p>
		<table class="table table-condensed table-bordered">
		    <tr>
			<th width="10px">No</th><th>Kriteria Penilaian</th><th  width="80px">Total</th>
		    </tr>
		    <tr>
			<th>I</th>
			<th colspan="2">KONSUMSI</th>
		    </tr>
		    <tr>
			<td>a</td><td>Jenis Makanan</td><td><?php echo $totalfb21;?></td>
		    </tr>
		    <tr>
			<td>b</td><td>Cara Penyajian</td><td><?php echo $totalfb22;?></td>
		    </tr>
		     <tr>
			<th>II</th>
			<th colspan="2">PENYELENGGARA</th>
		    </tr>
		    <tr>
			<td>a</td><td>Keramahan Panitia</td><td><?php echo $totalfb23;?></td>
		    </tr>
		    <tr>
			<td>b</td><td>Keramahan Fasilitator Lapangan</td><td><?php echo $totalfb24;?></td>
		    </tr>
		    <tr>
			<td>c</td><td>Kecakapan Fasilitator Lapangan</td><td><?php echo $totalfb25;?></td>
		    </tr>
		     <tr>
			<th>III</th>
			<th colspan="2">PERMAINAN</th>
		    </tr>
		    <tr>
			<td>a</td><td>Keamanan</td><td><?php echo $totalfb26;?></td>
		    </tr>
		    <tr>
			<td>b</td><td>Jenis Permainan</td><td><?php echo $totalfb27;?></td>
		    </tr>
		     <tr>
			<th>IV</th>
			<th colspan="2">JADWAL OUTBOUND</th>
		    </tr>
		    <tr>
			<td>a</td><td>Pengaturan Jadwal</td><td><?php echo $totalfb28;?></td>
		    </tr>
		    <tr>
			<td>b</td><td>Rentang Waktu Pelaksanaan Outbound</td><td><?php echo $totalfb29;?></td>
		    </tr>
		    <tr>
			<th>V</th>
			<th colspan="2">FASILITATOR KELAS (PSYKOLOG)</th>
		    </tr>
		    <tr>
			<td>a</td><td>Evaluasi dan Refleksi</td><td><?php echo $totalfb30;?></td>
		    </tr>
		    <tr>
			<td>b</td><td>Sikap Fasilitator Kelas</td><td><?php echo $totalfb31;?></td>
		    </tr>
			    <tr>
		    <td colspan="2"><b>Jumlah Nilai keseluruhan Peserta</b></td><td><b><?php echo $jumlahcom7?></b></td>
		    </tr>
		    <tr>
                        <td colspan="2"><b>Jumlah Nilai Rata - Rata</b></td><td><b><?php echo number_format($ratacom7, 2)?></b></td>
		    </tr>
		    <tr>
			<td colspan="2"> <b>Jumlah Peserta yang hadir </b></td><td><b><?php echo $jumlah_peserta?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Lbran. Evaluasi yang masuk </b></td><td><b><?php echo $jumlah_feedback?> Orang</b></td>
		    </tr>
		    <tr>
			<td colspan="2"><b> Prosentase Yang menilai </b></td><td><b><?php echo $prosentase_com7?>&nbsp;%</b></td>
		    </tr>

		    <tr>
			<td colspan="3"><b>Saran dan Komentar Peserta :</b><br><?php echo $com7;?></td>
		    </tr>
		</table>
	    </p>
	</div>
      <div class="tab-pane" id="tab8">
          <h3>REKAPITULASI KESELURUHAN PELAKSANAAN </h3>
	    <p>
            <table class="table table-condensed table-bordered">
                <tr>
                    <th width="10px">No</th><th>Kategori</th><th width="80px">Nilai</th>
                </tr>
                <tr>
                    <td>I</td><td>Materi Pembelajaran</td><td><?php echo $ratacom1;?></td>
                </tr>
                <tr>
                    <td>II</td><td>Fasilitator / Instruktur</td><td><?php echo $ratacom2;?></td>
                </tr>
                <tr>
                    <td>III</td><td>Pelaksanaan Pembelajaran</td><td><?php echo $ratacom3;?></td>
                </tr>
                <tr>
                    <td>IV</td><td>Sarana dan Fasilitas Pembelajaran</td><td><?php echo $ratacom4;?></td>
                </tr>
                <tr>
                    <td>V</td><td>Safety Induction</td><td><?php echo $ratacom5;?></td>
                </tr>
                <tr>
                    <td>VI</td><td>Rekomendasi Peserta </td><td><?php echo $ratacom6;?></td>
                </tr>
                <tr>
                    <td>VII</td><td>Business Games</td><td><?php echo number_format($ratacom7, 2);?></td>
                </tr>
                <tr>
                    <td colspan="2"><b>JUMLAH RATA-RATA </b></td><td><b> <?php $jumlahrata=$ratacom1+$ratacom2+$ratacom3+$ratacom4+$ratacom5+$ratacom6+$ratacom7;
                    $jumlah=$jumlahrata/7; echo number_format($jumlah, 2);?></b></td>
                </tr>
            </table>

      </div>
      <div class="tab-pane" id="tab9">
          <h3>REKAPITULASI KESELURUHAN PELAKSANAAN </h3>
	    <p>
            <table class="table table-condensed table-bordered">
                <tr>
                    <th width="10px">No</th><th>Kategori</th><th width="80px">Nilai</th>
                </tr>
                <tr>
                    <td>I</td><td>Materi Pembelajaran</td><td><?php echo $ratacom1;?></td>
                </tr>
                <tr>
                    <td>II</td><td>Fasilitator / Instruktur</td><td><?php echo $ratacom2;?></td>
                </tr>
                <tr>
                    <td>III</td><td>Pelaksanaan Pembelajaran</td><td><?php echo $ratacom3;?></td>
                </tr>
                <tr>
                    <td>IV</td><td>Safety Induction</td><td><?php echo $ratacom5;?></td>
                </tr>
                <tr>
                    <td>V</td><td>Rekomendasi Peserta </td><td><?php echo $ratacom6;?></td>
                </tr>
                <tr>
                    <td>VI</td><td>Business Games</td><td><?php echo number_format($ratacom7, 2);?></td>
                </tr>
                <tr>
                    <td colspan="2"> <b>JUMLAH RATA-RATA </b></td><td><b> <?php $jumlahrata=$ratacom1+$ratacom2+$ratacom3+$ratacom5+$ratacom6+$ratacom7;
                    $jumlah=$jumlahrata/6; echo number_format($jumlah, 2);?></b></td>
                </tr>
            </table>

      </div>
      
      
      
  </div>
</div>
<a class="btn" href="absen/detail/<?php echo $id_course ?>" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
<?php 
if ($this->session->userdata('user_id')==1){
    ?>
<a class="btn btn-danger" href="feedback/delete_fb_peserta/<?php echo $id_course ?>" data-original-title="" onclick="return confirm('Apakah Anda yakin akan menghapus data?')"><i class="icon-remove"></i> Delete</a>

<?php
}
?>
