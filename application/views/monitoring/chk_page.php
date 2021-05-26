<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>

<table class="table table-striped">
    
       <tr>
        <td width="150"><b>Kode Program</b></td><td>: <?php echo $kode; ?></td>
    </tr>
    <tr>
        <td><b>Judul Program</b></td><td>: <?php echo $judul; ?></td>
    </tr>
    <tr>
        <td><b>Tempat Pelaksanaan</b></td><td>: <?php echo $tempat; ?></td>
    </tr>
    <tr>
        <td><b>Tanggal Pelaksanaan</b></td><td>: <?php echo $tanggal; ?></td>
    </tr>
    <tr>
        <td><b>Sifat</b></td><td>: <?php echo $sifat; ?></td>
    </tr>
   
</table>
<table class="table">
    
    <tr style="background-color: #FFE7A1">
        <td><h4>P&D</h4></td><td>Update Terakhir</td>
    </tr>
    <?php echo $memo_permintaan; ?>
    <?php echo $kursil; ?>
    <?php echo $pengajar; ?>
    <?php echo $ub_program; ?>
    <?php echo $ub_trainer; ?>
    <?php echo $observasi; ?>
    <?php echo $carpar; ?>
    <tr style="background-color: #FFE7A1">
        <td><h4>FGT</h4></td><td>Update Terakhir</td>
    </tr>
    <?php echo $memo_sarfas; ?>
    <?php echo $berkas_tagihan; ?>
    <?php echo $surat_perintah; ?>
    <?php echo $persiapan_program; ?>
    <?php echo $pelaksanaan_program; ?>
    <?php echo $data_peserta; ?>
    <?php echo $laporan_program; ?>
    <?php echo $permintaan_umk; ?>
    <?php echo $rekap_honorarium; ?>
    <?php echo $bantuan_mengajar; ?>
    <?php echo $pelaksanaan_pelatihan; ?>
    <tr style="background-color: #FFE7A1">
        <td><h4>LS</h4></td><td>Update Terakhir</td>
    </tr>
    <?php echo $berkas_pr; ?>
    <?php echo $berkas_po; ?>
    <?php echo $sp_pembayaran; ?>
    <?php echo $pjumk; ?>
    <?php echo $spumk; ?>
    <?php echo $berkas_pj; ?>
    <?php echo $bon_umk; ?>

</table>

<div class="modal fade in" id="memo_permintaan" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_memo_permintaan; ?>
                        </table><br>
<form action="monitoring/upload_file/<?php echo $id_course; ?>/memo_permintaan/1" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">

</div>
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
</form>		    

</div>

<div class="modal fade in" id="kursil" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_kursil; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/kursil/1" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    

</div>

<div class="modal fade in" id="pengajar" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Update Pengajar</h3>
		    </div>
		    <div class="modal-body">

                        <form action="monitoring/update_trainer/<?php echo $id_course; ?>" method="POST" enctype="multipart/form-data">
                        <table class="table table-striped">
                            <?php // echo $file_pengajar; ?>
                                   <tr>
	<td class="left">
	    <table class="table table-bordered table-striped" id="result">
		<?php echo $trainer;?>
	    </table>
	    <a id="add_trainer" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="trainer" style="display: none" placeholder="Masukkan nama trainer"/>

	    <?php echo form_error('trainer');?>
	</td>
    </tr>
                        </table>
                            <?php echo anchor('trainer/add', 'Tambah Data Pengajar', array('class'=>'btn btn-success','target'=>'_blank')); ?>
</div>                            
    <div class="modal-footer">
        <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
</div>

<div class="modal fade in" id="ub_program" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                                                <div class="label label-warning">Upload hanya 1 berkas file</div>
                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_ub_program; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/ub_program/1" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
</div>

<div class="modal fade in" id="ub_trainer" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_ub_trainer; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/ub_trainer/1" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="observasi" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                          <div class="label label-warning">Upload hanya 1 berkas file</div>                      
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_observasi; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/observasi/1" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
</div>

<div class="modal fade in" id="carpar" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                          <div class="label label-warning">Upload hanya 1 berkas file</div>                      
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_carpar; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/carpar/1" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    </div>

<div class="modal fade in" id="memo_sarfas" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_memo_sarfas; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/memo_sarfas/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    </div>

<div class="modal fade in" id="berkas_tagihan" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                          <div class="label label-warning">Upload hanya 1 berkas file</div>                      
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_berkas_tagihan; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/berkas_tagihan/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="surat_perintah" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_surat_perintah; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/surat_perintah/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="persiapan_program" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_persiapan_program; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/persiapan_program/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="pelaksanaan_program" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_pelaksanaan_program; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/pelaksanaan_program/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="data_peserta" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_data_peserta; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/data_peserta/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="laporan_program" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_laporan_program; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/laporan_program/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="permintaan_umk" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_permintaan_umk; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/permintaan_umk/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="rekap_honorarium" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_rekap_honorarium; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/rekap_honorarium/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="bantuan_mengajar" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_bantuan_mengajar; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/bantuan_mengajar/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="pelaksanaan_pelatihan" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_pelaksanaan_pelatihan; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/pelaksanaan_pelatihan/2" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="berkas_pr" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_berkas_pr; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/berkas_pr/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="berkas_po" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_berkas_po; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/berkas_po/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="sp_pembayaran" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_sp_pembayaran; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/sp_pembayaran/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="pjumk" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_pjumk; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/pjumk/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="spumk" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_spumk; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/spumk/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    </div>

<div class="modal fade in" id="berkas_pj" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                        <div class="label label-warning">Upload hanya 1 berkas file</div>                        
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_berkas_pj; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/berkas_pj/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<div class="modal fade in" id="bon_umk" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload File</h3>
		    </div>
		    <div class="modal-body">
                         <div class="label label-warning">Upload hanya 1 berkas file</div>                       
                        <table class="table table-striped">
                            <tr><td>File</td><td>Update Terakhir</td></tr>
                            <?php echo $file_bon_umk; ?>
                        </table><br>
                        <form action="monitoring/upload_file/<?php echo $id_course; ?>/bon_umk/3" method="POST" enctype="multipart/form-data"><input type="file" name="upload_file">
</div>                            
    <div class="modal-footer">
                <button style="float: left" class="btn" data-dismiss="modal">Keluar</button>
    <button class="btn btn-primary" type="submit">Simpan</button>  
    </div>
                        </form>		    
                    </div>

<a class="btn" href="course/index" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>

<script type="text/javascript">
        $(this).ready( function() {
            $("#trainer").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/course/lookup",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='trainer[]'/>"+ ui.item.value + "<a href='#' class='remove_trainer'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#trainer").hide();
		    $("#null_trainer").remove();
		    $("#add_trainer").show();
                }
                }
            });

            $('.remove_trainer').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_trainer").click(function(){
		$("#trainer").show();
		$("#add_trainer").hide();
	    });
        });
</script>