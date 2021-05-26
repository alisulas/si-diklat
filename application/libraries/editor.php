<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of editor
 *
 * @author Administrator
 */
class Editor {

    protected $ci;

    // Constructor
    function __construct() {
        $this->_ci = &get_instance();
        $this->_ci->load->model('mdl_learn');
        $this->_ci->load->model('mdl_sertifikat');
        $this->_ci->load->model('mdl_jadwal');
        $this->_ci->load->model('mdl_sarfas');
        $this->_ci->load->model('mdl_peserta_induction');
        $this->_ci->load->model('mdl_dashboard');
        $this->_ci->load->model('mdl_learning_days');
        $this->_ci->load->model('mdl_location');
        $this->_ci->load->model('mdl_laptop');
    }

    // Default Template
    function textarea($name, $value = null) {
        $js = '<script type="text/javascript">$().ready(function() {
		$(\'textarea.tinymce_' . $name . '\').tinymce({
		    // Location of TinyMCE script
		    script_url : \'' . base_url() . 'assets/js/tm/tiny_mce.js\',

		    // General options
		    theme : "advanced",
		    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

		    // Theme options
		    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect",
		    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image",
		    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,fullscreen",
		    theme_advanced_toolbar_location : "top",
		    theme_advanced_toolbar_align : "left",
		    theme_advanced_statusbar_location : "bottom",
		    theme_advanced_resizing : false,
		});
	    });</script>';
        return $js . '<textarea name="' . $name . '" class="tinymce_' . $name . '" style="width: 100%;height: 300px;">' . $value . '</textarea>';
    }

    // Alert templates
    function alert_ok($var) {
        return '<div class="alert alert-success"><a class="close" data-dismiss="alert">&times;</a>' . $var . '</div>';
    }

    function alert_info($var) {
        return '<div class="alert alert-info"><a class="close" data-dismiss="alert">&times;</a>' . $var . '</div>';
    }

    function alert_error($var) {
        return '<div class="alert alert-error"><a class="close" data-dismiss="alert">&times;</a>' . $var . '</div>';
    }

    function alert_warning($var) {
        return '<div class="alert alert-warning"><a class="close" data-dismiss="alert">&times;</a>' . $var . '</div>';
    }

    // Date Correction
    function date_correct($var) {
        if ($var == 0) {
            return '-';
        } else {
            $date = date('d M Y', strtotime($var));
            return $date;
        }
    }

    // Upload functionality

    function upload_input2($id, $val, $action) {
        $uploadpath = "";
        $uploadpath = str_ireplace($_SERVER['DOCUMENT_ROOT'], "", realpath($_SERVER['SCRIPT_FILENAME']));
        $uploadpath = str_ireplace("index.php", "", $uploadpath);
        $button = form_open_multipart('upload/index') . '<input type="file" name="' . $id . '" id="' . $id . '"/><input type="hidden" name="' . $id . '" value="' . $val . '" />
		    <a href="javascript:$(\'#' . $id . '\').uploadifyUpload();" class="btn">Upload</a>' . form_close();
        $button.= "<script type=\"text/javascript\" language=\"javascript\">
			$(document).ready(function()
			{
				$(\"#$id\").uploadify({
							uploader: '" . base_url() . "application/uploadify/uploadify.swf',
							script: '" . base_url() . "application/uploadify/uploadify.php',
							cancelImg: '" . base_url() . "application/uploadify/cancel.png',
							folder: '" . $uploadpath . "assets/uploads',
							scriptAccess: 'always',
							multi: true,
							'onError' : function(a, b, c, d){
								if(d.status=404)
									alert('Could not find upload script');
								else if(d.type === \"HTTP\")
									alert('error'+d.type+\": \"+d.info);
								else if(d.type === \"File Size\")
									alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
								else
									alert('error'+d.type+\": \"+d.text);
							},
							'onComplete' : function(event,queueID,fileObj,response,data){
									$.post('" . site_url('activity/edit/' . $action) . "',{filearray: response},function(info){ $(\"#info-$id\").append(info);});
							},
							'onAllComplete' : function(event,data){

							}
						    });
			});
		    </script>";
        return $button;
    }

    function upload_input($id, $course_id) {

        $button = form_open_multipart('upload/index') . '<div id="div-' . $id . '"><input type="file" name="' . $id . '" id="btn-upload-' . $id . '"/>
		    <a href="javascript:$(\'#btn-upload-' . $id . '\').uploadify(\'upload\');" class="btn" id="btn-do-upload-' . $id . '">Upload</a>' . form_close() . '</div>';
        $button .="<script type=\"text/javascript\" language=\"javascript\">
			$(document).ready(function()
			    {
			    $(\"#btn-upload-$id\").uploadify({
				height:22,
				swf:'" . base_url() . "assets/up/uploadify.swf',
				uploader:'" . base_url() . "application/uploadify/uploadify.php',
				width:80,
				multi:true,
				auto: false,
				buttonText: '<i class=\"icon icon-upload icon-white\"></i> Select',
				'onUploadStart' : function(){
					$(\"#pub_$id\").remove();
					$(\"#info-$id\").append(\"<img src='assets/img/loading.gif' width='16px' id='img_$id'/>\");
				},
				'onUploadSuccess' : function(file){
					$.ajax({
					    url: '" . site_url('activity/upload_file/' . $course_id . '/' . $id) . "',
					    type: 'POST',
					    dataType: 'json',
					    data: {fileName: file.name}
					}).done(function(data){
					    window.location.reload();
					});
				}
			    });
			});
		    </script>";
        return $button;
    }

    function modal_aktifitas($i, $view, $label_kursil, $kelengkapan, $label_kelengkapan, $peserta, $label_peserta) {
        return '<div class="modal fade in" id="aktifitas' . $i . '" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Aktifitas Pelatihan</h3>
		    </div>
		    <div class="modal-body">
			<table class="table table-condensed">
			    <tr><th>Aktifitas</th><th>Action</th><th>Status</th></tr>
			    <tr><td>Pelatihan</td><td>' . $view . '</td><td>' . $label_kursil . '</td></tr>		   
			    <tr><td>Peserta</td><td>' . $peserta . '</td><td>' . $label_peserta . '</td></tr>
                            <tr><td>Kelengkapan</td><td>' . $kelengkapan . '</td><td>' . $label_kelengkapan . '</td></tr>
			</table>
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
    function modal_aktivitas_sarfas($id) {
        return '<div class="modal fade in" id="modal_aktivitas_sarfas'.$id.'" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Aktifitas Sarfas</h3>
		    </div>
		    <div class="modal-body">
<form action="sarfas/add_aktivitas/'.$id.'" method="POST">
			<table class="table table-condensed">
			    <tr><td colspan="2">ATK</td></tr>
			    <tr><td>Tgl Permintaan</td><td><input type="text" name="atk_permintaan" id="atk_permintaan_'.$id.'"></td></tr>
			    <tr><td>Tgl Realisasi</td><td><input type="text" name="atk_realisasi" id="atk_realisasi_'.$id.'"></td></tr>
			    <tr><td>ATK ?</td><td><select name="atk_tidak_ada"><option value="-" selected="selected">-</option><option value="no">Ada</option><option value="yes">Tidak Ada</option></select></td></tr>
			    <tr><td colspan="2">HK</td></tr>
			    <tr><td>Tgl Permintaan</td><td><input type="text" name="hk_permintaan" id="hk_permintaan_'.$id.'"></td></tr>
			    <tr><td>Tgl Realisasi</td><td><input type="text" name="hk_realisasi" id="hk_realisasi_'.$id.'"></td></tr>
			    <tr><td>HK</td><td><select name="hk_tidak_ada"><option value="-" selected="selected">-</option><option value="no">Ada</option><option value="yes">Tidak Ada</option></select></td></tr>
			    <tr><td colspan="2">Resident</td></tr>
			    <tr><td>Tgl Permintaan</td><td><input type="text" name="res_permintaan" id="res_permintaan_'.$id.'"></td></tr>
			    <tr><td>Tgl Realisasi</td><td><input type="text" name="res_realisasi" id="res_realisasi_'.$id.'"></td></tr>
			    <tr><td>Resident</td><td><select name="res_tidak_ada"><option value="-" selected="selected">-</option><option value="no">Ada</option><option value="yes">Tidak Ada</option></select></td></tr>
			    <tr><td colspan="2">Non Resident</td></tr>
			    <tr><td>Tgl Permintaan</td><td><input type="text" name="nonres_permintaan" id="nonres_permintaan_'.$id.'"></td></tr>
			    <tr><td>Tgl Realisasi</td><td><input type="text" name="nonres_realisasi" id="nonres_realisasi_'.$id.'"></td></tr>
			    <tr><td>Non Resident</td><td><select name="nonres_tidak_ada"><option value="-" selected="selected">-</option><option value="no">Ada</option><option value="yes">Tidak Ada</option></select></td></tr>
			    <tr><td colspan="2">IT</td></tr>
			    <tr><td>Tgl Permintaan</td><td><input type="text" name="it_permintaan" id="it_permintaan_'.$id.'"></td></tr>
			    <tr><td>Tgl Realisasi</td><td><input type="text" name="it_realisasi" id="it_realisasi_'.$id.'"></td></tr>
			    <tr><td>ATK</td><td><select name="it_tidak_ada"><option value="-" selected="selected">-</option><option value="no">Ada</option><option value="yes">Tidak Ada</option></select></td></tr>                            
			</table>
                        <button class="btn btn-primary" type="submit">Submit</button>
</form>    
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>
                
<script type="text/javascript">
$(function () {
    $("#atk_permintaan_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#atk_realisasi_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#hk_permintaan_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#hk_realisasi_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#res_permintaan_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#res_realisasi_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#nonres_permintaan_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#nonres_realisasi_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#it_permintaan_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#it_realisasi_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>
                ';
    }
    function modal_lihat_aktivitas_sarfas($id) {
    $atk_permintaan= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->atk_permintaan;    
    $atk_realisasi= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->atk_realisasi;    
    $hk_permintaan= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->hk_permintaan;    
    $hk_realisasi= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->hk_realisasi;    
    $res_permintaan= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->res_permintaan;    
    $res_realisasi= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->res_realisasi;    
    $nonres_permintaan= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->nonres_permintaan;    
    $nonres_realisasi= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->nonres_realisasi;    
    $it_permintaan= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->it_permintaan;    
    $it_realisasi= $this->_ci->mdl_sarfas->get_aktivitas_by_course($id)->row()->it_realisasi;    
        return '<div class="modal fade in" id="modal_lihat_aktivitas_sarfas'.$id.'" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Aktifitas Sarfas</h3>
		    </div>
		    <div class="modal-body">
			<table class="table table-condensed">
			    <tr><td colspan="2">ATK</td></tr>
			    <tr><td>Tgl Permintaan</td><td>'.$atk_permintaan.'</td></tr>
			    <tr><td>Tgl Realisasi</td><td>'.$atk_realisasi.'</td></tr>
			    
			    <tr><td colspan="2">HK</td></tr>
			    <tr><td>Tgl Permintaan</td><td>'.$hk_permintaan.'</td></tr>
			    <tr><td>Tgl Realisasi</td><td>'.$hk_realisasi.'</td></tr>
			    
			    <tr><td colspan="2">Resident</td></tr>
			    <tr><td>Tgl Permintaan</td><td>'.$res_permintaan.'</td></tr>
			    <tr><td>Tgl Realisasi</td><td>'.$res_realisasi.'</td></tr>
			    
			    <tr><td colspan="2">Non Resident</td></tr>
			    <tr><td>Tgl Permintaan</td><td>'.$nonres_permintaan.'</td></tr>
			    <tr><td>Tgl Realisasi</td><td>'.$nonres_realisasi.'</td></tr>
			    
			    <tr><td colspan="2">IT</td></tr>
			    <tr><td>Tgl Permintaan</td><td>'.$it_permintaan.'</td></tr>
			    <tr><td>Tgl Realisasi</td><td>'.$it_realisasi.'</td></tr>
			                             
			</table>
                   
</form>    
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>
                ';
    }

    function modal_cancel($id, $ket_cancel) {
        return '<div class="modal fade in" id="cancel' . $id . '" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Alasan</h3>
		    </div>
		    <div class="modal-body">
			' . $ket_cancel . '
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
    
        function detail_kegiatan($id, $kegiatan,$class,$pic,$warna,$ket,$tanggal) {
            if ($this->_ci->session->userdata('user_id')==5) {
                $hapus='<a href="sarfas/delete_kegiatan/'.$id.'" class="btn btn-danger" style="float:left">Hapus</a>';
                $edit='<a href="sarfas/edit_kegiatan/'.$id.'" class="btn btn-success" style="float:left">Edit</a>';
            }else{
                $hapus='';
                $edit='';
            }
        return '<div class="modal fade in" id="detail'.$id.'" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
                        <center><h4>Informasi Ruangan</h4></center>
		    </div>
		    <div class="modal-body">
			<table class="table table-bordered table-condensed table-striped">
                        <tr>
                        <td>Kegiatan</td><td>:</td><td>'.$kegiatan.'</td>
                            </tr>
                            <tr>
                        <td>Ruangan</td><td>:</td><td>'.$class.'</td>
</tr> 
<tr>
<td>PIC</td><td>:</td><td>'.$pic.'</td>
    </tr>
<tr>
<td>Warna</td><td>:</td><td style="background-color:'.$warna.'"></td>
    </tr>
<tr>
<td>Keterangan</td><td>:</td><td>'.$ket.'</td>
    </tr>
<tr>
<td>Tanggal</td><td>:</td><td>'.$tanggal.'</td>
    </tr>
                        </table>
		    </div>
		    <div class="modal-footer">
                    
			'.$hapus.$edit.'
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
        function detail_course($id, $course_name,$location,$start_date,$end_date) {
                            if ($this->_ci->mdl_sarfas->get_class_by_id($location)->num_rows()==0) {
                    $lokasi='';
                }else{
                  $lokasi=  $this->_ci->mdl_sarfas->get_class_by_id($location)->row()->class_name;
                }
                    if (empty($this->_ci->mdl_dashboard->get_kursil_by($id)->row()->candidate_estimation)){
             $target_peserta='Belum di isi';
         }else{
             $target_peserta=$this->_ci->mdl_dashboard->get_kursil_by($id)->row()->candidate_estimation.' Orang';
         }
         
         if($this->_ci->mdl_dashboard->get_peserta_by_course($id)==0){
             $jumlah_peserta='Belum dimasukan';
         }else{
             $jumlah_peserta=$this->_ci->mdl_dashboard->get_peserta_by_course($id).' Orang';
         }
        return '<div class="modal fade in" id="detail'.$id.'" style="display:none;width: 35%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
<center><h4>Informasi Pelatihan</h4></center>		    
</div>
		    <div class="modal-body">
			<table class="table table-striped">
    <tr><td>Nama Program</td><td>:</td><td>'.$course_name.'</td></tr>
    <tr><td>Tempat Pelaksanaan</td><td>:</td><td>'.$lokasi.'</td></tr>
    <tr><td>Tanggal Pelaksanaan</td><td>:</td><td>'.$this->date_correct($start_date).' &nbsp; <b>s/d</b> &nbsp;'.$this->date_correct($end_date).'</td></tr>
    <tr><td>Target Peserta</td><td>:</td><td>'.$target_peserta.'</td></tr>
    <tr><td>Jumlah Peserta Masuk</td><td>:</td><td>'.$jumlah_peserta.'</td></tr>

</table>
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
    
    
    function modal_info_cancel($id, $ket_cancel,$file_cancel) {
        return '<div class="modal fade in" id="info_cancel' . $id . '" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Alasan</h3>
		    </div>
		    <div class="modal-body">
			' . $ket_cancel . '<br>
                            '.$file_cancel.'
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }

    function modal_popupcancel($id) {
        return '<div class="modal fade in" id="popup' . $id . '" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Alasan</h3>
		    </div>
		    <div class="modal-body">
			<form action="dashboard/cancel/' . $id . '" method="POST"><textarea name="ket" style="width: 260px;"></textarea><br><br><button class="btn btn-primary" type="submit">Submit</button></form>
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }

    function modal_add_memo($id,$status) {
        return '<div class="modal fade in" id="add_memo'.$id .$status. '" style="display:none;width: 20%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal"><i class="icon-remove"></i></button>
			<h3>Upload Memo</h3>
		    </div>
		    <div class="modal-body">
			<form action="sarfas/add_memo/'.$id.'/'.$status.'" method="POST" enctype="multipart/form-data"><input type="file" name="upload_memo">
<button class="btn btn-primary" type="submit">Tambah Memo</button>                            
</form>		    
</div>
		</div>';
    }
    
        function course_cancel($id) {
        return '<div class="modal fade in" id="popup' . $id . '" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Alasan</h3>
		    </div>
		    <div class="modal-body">
			<form action="course/cancel/' . $id . '" method="POST"><textarea name="ket" style="width: 260px;"></textarea><br><br><button class="btn btn-primary" type="submit">Submit</button></form>
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }

    function modal_tln_cancel($id) {
        return '<div class="modal fade in" id="cancel' . $id . '" style="display:none;width: 30%;left: 60%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Alasan</h3>
		    </div>
		    <div class="modal-body">
			<form action="tln/cancel/' . $id . '" method="POST" enctype="multipart/form-data"><textarea name="ket" style="width: 260px;"></textarea><br><br>
<input type="file" name="memo">                            
<button class="btn btn-primary" type="submit">Submit</button></form>
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }

    function modal_payment($id) {
        return '
<div class="modal fade in" id="addpayment' . $id . '" style="display:none; width: 420px">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">x</button>
    <h3>Tambah Pembayaran</h3>
    <form action="learn/add_payment/' . $id . '" method="POST">
    <table class="table table-bordered table-condensed">
    <tr>
        <td>Jenis Pembayaran</td>
        <td>
            <select name="type">
                <option>Deposit Fee</option>
                <option>Tuition Fee</option>
                <option>Allowance</option>
            </select>
        </td>
    </tr>
    <tr>
        <td valign="top">Tanggal Pembayaran <span style="color:red">*</span></td>
        <td>
                    <input type="text" name="payment_date" id="pay_date_'.$id.'" >
  </td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td>
            <select name="currency" style="width:60px">
                <option value="ALL ">ALL</option>
                <option value="AFN ">AFN</option>
                <option value="ARS ">ARS</option>
                <option value="AWG ">AWG</option>
                <option value="AUD ">AUD</option>
                <option value="AZN ">AZN</option>
                <option value="BSD ">BSD</option>
                <option value="BBD ">BBD</option>
                <option value="BYR ">BYR</option>
                <option value="BZD ">BZD</option>
                <option value="BMD ">BMD</option>
                <option value="BOB ">BOB</option>
                <option value="BAM ">BAM</option>
                <option value="BWP ">BWP</option>
                <option value="BGN ">BGN</option>
                <option value="BRL ">BRL</option>
                <option value="BND ">BND</option>
                <option value="KHR ">KHR</option>
                <option value="CAD ">CAD</option>
                <option value="KYD ">KYD</option>
                <option value="CLP ">CLP</option>
                <option value="CNY ">CNY</option>
                <option value="COP ">COP</option>
                <option value="CRC ">CRC</option>
                <option value="HRK ">HRK</option>
                <option value="CUP ">CUP</option>
                <option value="CZK ">CZK</option>
                <option value="DKK ">DKK</option>
                <option value="DOP ">DOP</option>
                <option value="XCD ">XCD</option>
                <option value="EGP ">EGP</option>
                <option value="SVC ">SVC</option>
                <option value="EEK ">EEK</option>
                <option value="EUR ">EUR</option>
                <option value="FKP ">FKP</option>
                <option value="FJD ">FJD</option>
                <option value="GHC ">GHC</option>
                <option value="GIP ">GIP</option>
                <option value="GTQ ">GTQ</option>
                <option value="GGP ">GGP</option>
                <option value="GYD ">GYD</option>
                <option value="HNL ">HNL</option>
                <option value="HKD ">HKD</option>
                <option value="HUF ">HUF</option>
                <option value="ISK ">ISK</option>
                <option value="INR ">INR</option>
                <option value="IDR ">IDR</option>
                <option value="IRR ">IRR</option>
                <option value="IMP ">IMP</option>
                <option value="ILS ">ILS</option>
                <option value="JMD ">JMD</option>
                <option value="JPY ">JPY</option>
                <option value="JEP ">JEP</option>
                <option value="KZT ">KZT</option>
                <option value="KPW ">KPW</option>
                <option value="KRW ">KRW</option>
                <option value="KGS ">KGS</option>
                <option value="LAK ">LAK</option>
                <option value="LVL ">LVL</option>
                <option value="LBP ">LBP</option>
                <option value="LRD ">LRD</option>
                <option value="LTL ">LTL</option>
                <option value="MKD ">MKD</option>
                <option value="MYR ">MYR</option>
                <option value="MUR ">MUR</option>
                <option value="MXN ">MXN</option>
                <option value="MNT ">MNT</option>
                <option value="MZN ">MZN</option>
                <option value="NAD ">NAD</option>
                <option value="NPR ">NPR</option>
                <option value="ANG ">ANG</option>
                <option value="NZD ">NZD</option>
                <option value="NIO ">NIO</option>
                <option value="NGN ">NGN</option>
                <option value="KPW ">KPW</option>
                <option value="NOK ">NOK</option>
                <option value="OMR ">OMR</option>
                <option value="PKR ">PKR</option>
                <option value="PAB ">PAB</option>
                <option value="PYG ">PYG</option>
                <option value="PEN ">PEN</option>
                <option value="PHP ">PHP</option>
                <option value="PLN ">PLN</option>
                <option value="QAR ">QAR</option>
                <option value="RON ">RON</option>
                <option value="RUB ">RUB</option>
                <option value="SHP ">SHP</option>
                <option value="SAR ">SAR</option>
                <option value="RSD ">RSD</option>
                <option value="SCR ">SCR</option>
                <option value="SGD ">SGD</option>
                <option value="SBD ">SBD</option>
                <option value="SOS ">SOS</option>
                <option value="ZAR ">ZAR</option>
                <option value="KRW ">KRW</option>
                <option value="LKR ">LKR</option>
                <option value="SEK ">SEK</option>
                <option value="CHF ">CHF</option>
                <option value="SRD ">SRD</option>
                <option value="SYP ">SYP</option>
                <option value="TWD ">TWD</option>
                <option value="THB ">THB</option>
                <option value="TTD ">TTD</option>
                <option value="TRY ">TRY</option>
                <option value="TRL ">TRL</option>
                <option value="TVD ">TVD</option>
                <option value="UAH ">UAH</option>
                <option value="GBP ">GBP</option>
                <option value="USD ">USD</option>
                <option value="UYU ">UYU</option>
                <option value="UZS ">UZS</option>
                <option value="VEF ">VEF</option>
                <option value="VND ">VND</option>
                <option value="YER ">YER</option>
                <option value="ZWD ">ZWD</option>

            </select>
            <input type="text" name="cost" style="width:150px">
        </td>
    </tr>
</table>
<button class="btn btn-primary" type="submit">Save changes</button>
</form>
  </div>
  <div class="modal-body">
                          

  </div>
  
</div>
<script type="text/javascript">
$(function () {
    $("#pay_date_'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: \'yy-mm-dd\',
            dateFormat: \'yy-mm-dd\'
    });
});


</script>
';
    }

    function modal_list_payment($id) {

        $q = $this->_ci->mdl_learn->get_by_learn_id($id)->result_array();
        $i = 0;
        $tabel = '';
        foreach ($q as $row) {
            if ($row['status'] == 0) {
                if ($this->_ci->session->userdata('fungsi')==3){
                $status = anchor('learn/update_payment/' . $row['id'], '<span class="label label-important">Bayar</span>', array('rel' => 'tooltip', 'title' => 'Ubah Status Pembayaran'));                    
                }else{
                  $status = '<span class="label label-important">Bayar</span>';  
                }
            } else {
                $status = '<span class="label label-success">Lunas</span>';
            }
            
if ($this->_ci->session->userdata('fungsi')==3){
            $delete = anchor('learn/delete_payment/'.$row['id'],'<span class="label label-inverse">Hapus</span>', array('rel' => 'tooltip', 'title' => 'Hapus Status Pembayaran'));
}else{
            $delete = '<span class="label label-inverse">Hapus</span>';
}
            $payment_date = $this->date_correct($row['payment_date']);
            
            $cost= explode(' ', $row['cost']);
            setlocale(LC_MONETARY, 'en_US.UTF-8');
            $tabel .='
<tr><td>' . $row['type'] . '</td><td>' . $payment_date . '</td><td>' .$cost[0].' '.$this->formatMoney($cost[1]). '</td><td>' . $status . '</td><td>'.$delete.'</td></tr>    
';
        }
        return '
<div class="modal fade in" id="listpayment' . $id . '" style="display:none; width: 600px">
  <div class="modal-header">
   <h3 align="center">Data Pembayaran</h3>
  </div>
  <div class="modal-body">
       <table class="table table-bordered table-striped">
	<tr>
	    <th>Jenis Pembayaran</th><th>Tanggal</th><th>Jumlah</th><th>Status</th>
	</tr>
   ' . $tabel . '
       </table>
  </div>
  <div class="modal-footer">
  <a href="#" class="btn" data-dismiss="modal">Close</a>

</div>             
</div>             
';
    }
    
  // Currency Function  
    function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 
    
    function modal_jadwal($id_course,$tanggal) {
       $jad = $this->_ci->mdl_jadwal->get_jadwal_by_course($id_course,$tanggal)->result_array();
       
       
       $tabel='';
       foreach ($jad as $row) {
           if (!$row['trainer']==0){
           $nama_trainer = $this->_ci->mdl_trainer->get_by_id($row['trainer'])->row()->name;
           $trainer = anchor('trainer/detail/'.$row['trainer'], $nama_trainer, array('rel'=>'tooltip','title'=>'Lihat Detail Trainer'));               
           }else{
               $trainer=' ';
           }
           
           $hapus = anchor('jadwal/delete/'.$id_course.'/'.$row['id'], 'Hapus', array('rel'=>'tooltip','title'=>'Hapus Jadwal','class'=>'label label-info'));
           $tabel .='<tr><td>'.$row['waktu'].'</td><td>'.$row['kegiatan'].'</td><td>'.$trainer.'</td><td>'.$hapus.'</td></tr>';
       }
                   return '
<div class="modal fade in" id="lihat_jadwal'.$tanggal.'" style="display:none; width: 700px">
  <div class="modal-header">
   <h3 align="center">Jadwal Pembelajaran</h3>
  </div>
  <div class="modal-body">
  <span class="label label-success">Tanggal : '.$this->date_correct($tanggal).'</span>
  
       <table class="table table-bordered table-striped">
	<tr>
	    <th style="width:15%">Waktu</th><th>Materi</th><th style="width:25%">Trainer</th><th style="width:5%">Ket</th>
	</tr>
   ' . $tabel . '
       </table>
  </div>
  <div class="modal-footer">
  <a href="#" class="btn" data-dismiss="modal">Close</a>

</div>             
</div>             
';
       
       
    }
    
    
        function modal_sertifikat_jabatan($id) {

        $q = $this->_ci->mdl_sertifikat->get_jabatan_by_id($id)->row()->sertifikat;
        $ex_sertifikat= explode('#',$q);
        
        $i = 0;
        $tabel = '';
        foreach ($ex_sertifikat as $row) {
        $kode=$this->_ci->mdl_sertifikat->get_sertifikat_jabatan_by_id($row[$i])->row()->kode;    
        $name=$this->_ci->mdl_sertifikat->get_sertifikat_jabatan_by_id($row[$i])->row()->name;  
            $tabel .='
<tr><td>' . $kode . '</td><td>' . $name . '</td></tr>    
';
        }
        return '
<div class="modal fade in" id="sertifikat_jabatan' . $id . '" style="display:none; width: 500px">
  <div class="modal-header">
   <h3 align="center">Data Sertifikat</h3>
  </div>
  <div class="modal-body">
       <table class="table table-bordered table-striped">
	<tr>
	    <th>Kode</th><th>Nama Sertifikat</th>
	</tr>
   ' . $tabel . '
       </table>
  </div>
  <div class="modal-footer">
  <a href="#" class="btn" data-dismiss="modal">Close</a>

</div>             
</div>             
';
    }
    
        
        function modal_sertifikat($id,$id_pekerja) {

        $q = $this->_ci->mdl_sertifikat->get_jabatan_by_id($id)->row()->sertifikat;
        $ex_sertifikat= explode('#',$q);
        
        $i = 0;
        $tabel = '';
                $ket='';
        foreach ($ex_sertifikat as $row) {
        $id_sertifikat=$this->_ci->mdl_sertifikat->get_sertifikat_jabatan_by_id($row[$i])->row()->id;    
        $kode=$this->_ci->mdl_sertifikat->get_sertifikat_jabatan_by_id($row[$i])->row()->kode;    
        $name=$this->_ci->mdl_sertifikat->get_sertifikat_jabatan_by_id($row[$i])->row()->name;
        $sertifikat = $this->_ci->mdl_sertifikat->get_sertifikat_by_pekerja($id_pekerja)->result_array();
        $id_jabatan= $this->_ci->mdl_sertifikat->get_pekerja_by_id($id_pekerja)->row()->plc_jabatan_id;

        $cek_kode=$this->_ci->mdl_sertifikat->get_sertifikat_by_kode($id_pekerja,$kode);
        
if ($cek_kode->num_rows()==0){
    if($this->_ci->session->userdata('user_id')==2 || $this->_ci->session->userdata('user_id')==1){
          $ket = anchor('sertifikat/insert_sertifikasi_jabatan/'.$id_pekerja.'/'.$id_sertifikat,'<span class="label label-important">Belum di Ambil</span>', array('rel' => 'tooltip', 'title' => 'Ambil Sertifikasi'));       
    }else{
                 $ket = '<span class="label label-important">Belum di Ambil</span>';
    }
     
    
}else{
    if($this->_ci->session->userdata('user_id')==2 || $this->_ci->session->userdata('user_id')==1){
           $ket = anchor('sertifikat/edit_sertifikat/'.$cek_kode->row()->id,'<span class="label label-info">'.$this->date_correct($cek_kode->row()->waktu).'</span>', array('rel' => 'tooltip', 'title' => 'Ubah Sertifikasi')).'&nbsp;'.anchor('sertifikat/sendmail/'.$cek_kode->row()->id.'/'.$id_jabatan,'<span class="label label-success">Kirim Email</span>', array('rel' => 'tooltip', 'title' => 'Kirim Email'));            
    }else{
            $ket = '<span class="label label-info">'.$this->date_correct($cek_kode->row()->waktu).'</span> &nbsp; <span class="label label-success">Kirim Email</span>';           
    }


}
        
            $tabel .='
<tr><td>' . $kode . '</td><td>' . $name . '</td><td>'.$ket.'</td></tr>    
';
        
            
        }
        return '
<div class="modal fade in" id="sertifikat' . $id . '" style="display:none; width: 500px">
  <div class="modal-header">
   <h3 align="center">Data Sertifikat</h3>
  </div>
  <div class="modal-body">
       <table class="table table-bordered table-striped">
	<tr>
	    <th>Kode</th><th>Nama Sertifikat</th><th>Keterangan</th>
	</tr>
   ' . $tabel . '
       </table>
  </div>
  <div class="modal-footer">
  <a href="#" class="btn" data-dismiss="modal">Close</a>

</div>             
</div>             
';
    }
    
function hitung_sla( $tgl_awal, $tgl_akhir, $tgl_libur){
$awal_tgl = strtotime( $tgl_awal );
$akhir_tgl = strtotime( $tgl_akhir );

foreach ( $tgl_libur as & $harilibur ) {
$harilibur = strtotime ( $harilibur );
}

$waktu_temp = $awal_tgl ;
$tag='';
while( $waktu_temp < $akhir_tgl ) {
$hari_temp = date( 'D' , $waktu_temp );
if (!( $hari_temp == 'Sun' ) && !( $hari_temp == 'Sat' ) && ! in_array ( $waktu_temp, $tgl_libur )) {

$hari_temp = date( 'd', $waktu_temp );
$tag .= $hari_temp.'#';

}
$waktu_temp = strtotime ( '+1 day' , $waktu_temp );

}
$jumlah=explode('#',$tag);
return count($jumlah)-1;
//return $hari_kerja;
}


        function view_ld($id) {
            
        $nopek=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->nopek;
        $name=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->name;
        $personnel_area=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->personnel_area;
        $company_code=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->company_code;
        $id_position=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->id_position;
        $position_name=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->position_name;
        $cost_ctr=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->cost_ctr;
        $cost_center=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->cost_center;
        $start_date=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->start_date;
        $end_date=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->end_date;
        $education=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->education;
        $location=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->location;
        $country=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->country;
        $certification=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->certification;
        $duration=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->duration;
        $training_name=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->training_name;
        $departemen=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->departemen;
        $tw=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->tw;
        
        return '<div class="modal fade in" id="view_ld'.$id . '" style="display:none;width: 40%;left: 50%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Detail Learning Days</h3>
		    </div>
		    <div class="modal-body">
		<table class="table table-bordered table-condensed table-striped">
    <tr>
        <td style="width: 100px">Nopek</td><td>'.$nopek.'</td>
    </tr>    
    <tr>
        <td>Nama</td><td>'.$name.'</td>
    </tr>    
    <tr>
        <td>Personel Area</td><td>'.$personnel_area.'</td>
    </tr>    
    <tr>
        <td>Company Code</td><td>'.$company_code.'</td>
    </tr>    
    <tr>
        <td>ID Position</td><td>'.$id_position.'</td>
    </tr>    
    <tr>
        <td>Jabatan</td><td>'.$position_name.'</td>
    </tr>    
    <tr>
        <td>Cost Ctr</td><td>'.$cost_ctr.'</td>
    </tr>    
    <tr>
        <td>Cost Center</td><td>'.$cost_center.'</td>
    </tr>    
    <tr>
        <td>Tanggal</td><td>'.$this->date_correct($start_date).' s/d '.$this->date_correct($end_date).'</td>
    </tr>    
    <tr>
        <td>Pendidikan</td><td>'.$education.'</td>
    </tr>    
    <tr>
        <td>Lokasi</td><td>'.$location.'</td>
    </tr>    
    <tr>
        <td>Negara</td><td>'.$country.'</td>
    </tr>    
    <tr>
        <td>Sertifikasi</td><td>'.$certification.'</td>
    </tr>    
    <tr>
        <td>Durasi</td><td>'.$duration.'</td>
    </tr>    
    <tr>
        <td>Nama Pelatihan</td><td>'.$training_name.'</td>
    </tr>    
    <tr>
        <td>Departemen</td><td>'.$departemen.'</td>
    </tr>    
    <tr>
        <td>Triwulan</td><td>'.$tw.'</td>
    </tr>    
</table>	
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
    
    
        function edit_ld($id,$offset) {
            
        $nopek=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->nopek;
        $name=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->name;
        $personnel_area=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->personnel_area;
        $company_code=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->company_code;
        $id_position=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->id_position;
        $position_name=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->position_name;
        $cost_ctr=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->cost_ctr;
        $cost_center=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->cost_center;
        $start_date=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->start_date;
        $end_date=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->end_date;
        $education=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->education;
        $location=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->location;
        $country=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->country;
        $certification=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->certification;
        $duration=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->duration;
        $training_name=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->training_name;
        $departemen=$this->_ci->mdl_learning_days->get_ld_by_id($id)->row()->departemen;
        
        return '<div class="modal fade in" id="edit_ld'.$id . '" style="display:none;width: 40%;left: 50%;">
               <form action="learning_days/edit_ld/'.$id.'/'.$offset.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Learning Days</h3>
		    </div>
		    <div class="modal-body">

		<table class="table table-bordered table-condensed table-striped">
    <tr>
        <td style="width: 100px">Nopek</td><td>'.$nopek.'</td>
    </tr>    
    <tr>
        <td>Nama</td><td>'.$name.'</td>
    </tr>    
    <tr>
        <td>Personel Area</td><td>'.$personnel_area.'</td>
    </tr>    
    <tr>
        <td>Company Code</td><td>'.$company_code.'</td>
    </tr>    
    <tr>
        <td>ID Position</td><td>'.$id_position.'</td>
    </tr>    
    <tr>
        <td>Jabatan</td><td>'.$position_name.'</td>
    </tr>    
    <tr>
        <td>Cost Ctr</td><td>'.$cost_ctr.'</td>
    </tr>    
    <tr>
        <td>Cost Center</td><td>'.$cost_center.'</td>
    </tr>    
    <tr>
        <td>Tanggal</td><td><input type="text" class="text input-small" name="start_date" id="start_date'.$id.'" value="'.$start_date.'"> s/d <input type="text" class="text input-small" id="end_date'.$id.'" name="end_date" value="'.$end_date.'"></td>
    </tr>    
    <tr>
        <td>Pendidikan</td><td><input type="text" name="education" value="'.$education.'"></td>
    </tr>    
    <tr>
        <td>Lokasi</td><td><input type="text" name="location" value="'.$location.'"></td>
    </tr>    
    <tr>
        <td>Negara</td><td><input type="text" name="country" value="'.$country.'"></td>
    </tr>    
    <tr>
        <td>Sertifikasi</td><td><input type="text" name="certification" value="'.$certification.'"></td>
    </tr>    
    <tr>
        <td>Durasi</td><td><input type="text" name="duration" value="'.$duration.'"></td>
    </tr>    
    <tr>
        <td>Nama Pelatihan</td><td><input type="text" name="training_name" value="'.$training_name.'"></td>
    </tr>    
    <tr>
        <td>Departemen</td><td><input type="text" name="departemen" value="'.$departemen.'"></td>
    </tr>    
</table>
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
                
<script type="text/javascript">
$(function () {
    $("#start_date'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#end_date'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>

';
    }
        function view_pekerja($id) {
            
        $nopek=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->nopek;
        $plc_jabatan_id=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->id_position;
        $name=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->nama;
        $tgl_lahir=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->tgl_lahir;
        $cost_ctr=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->cost_center_code;
        $cost_center=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->cost_center_name;
        $jabatan=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->position;
        $company_code=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->company_code;
        $personel_area=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->personnel_area;
        $sub_area=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->personnel_sub_area;
        $employee_group=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->employee_group;
        $employee_subgroup=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->employee_sub_group;
        $direktorat=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->direktorat;
        $fungsi=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->fungsi;
        $divisi=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->divisi;
        $departemen=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->departemen;
        
        return '<div class="modal fade in" id="view_pekerja'.$id . '" style="display:none;width: 40%;left: 50%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Detail Pekerja Days</h3>
		    </div>
		    <div class="modal-body">
		<table class="table table-bordered table-condensed table-striped">
    <tr>
        <td style="width: 100px">Nopek</td><td>'.$nopek.'</td>
    </tr>    
    <tr>
        <td>Id Jabatan </td><td>'.$plc_jabatan_id.'</td>
    </tr>    
    <tr>
        <td>Nama</td><td>'.$name.'</td>
    </tr>    
    <tr>
        <td>Tgl Lahir</td><td>'.$this->date_correct($tgl_lahir).'</td>
    </tr>    
    <tr>
        <td>Cost Ctr</td><td>'.$cost_ctr.'</td>
    </tr>    
    <tr>
        <td>Cost Center</td><td>'.$cost_center.'</td>
    </tr>    
    <tr>
        <td>Jabatan</td><td>'.$jabatan.'</td>
    </tr>    
    <tr>
        <td>Company Code</td><td>'.$company_code.'</td>
    </tr>    
    <tr>
        <td>Personel Area</td><td>'.$personel_area.'</td>
    </tr>    
    <tr>
        <td>Sub Area</td><td>'.$sub_area.'</td>
    </tr>    
    <tr>
        <td>Employee Group</td><td>'.$employee_group.'</td>
    </tr>    
    <tr>
        <td>Employee SubGroup</td><td>'.$employee_subgroup.'</td>
    </tr>   
    <tr>
        <td>Direktorat</td><td>'.$direktorat.'</td>
    </tr>    
    <tr>
        <td>Fungsi</td><td>'.$fungsi.'</td>
    </tr>    
    <tr>
        <td>Departemen</td><td>'.$departemen.'</td>
    </tr>    
    
</table>	
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
        
        function edit_pekerja($id,$offset) {
        $nopek=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->nopek;
        $plc_jabatan_id=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->id_position;
        $name=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->nama;
        $tgl_lahir=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->tgl_lahir;
        $cost_ctr=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->cost_center_code;
        $cost_center=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->cost_center_name;
        $jabatan=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->position;
        $company_code=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->company_code;
        $personel_area=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->personnel_area;
        $sub_area=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->personnel_sub_area;
        $employee_group=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->employee_group;
        $employee_subgroup=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->employee_sub_group;
        $direktorat=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->direktorat;
        $fungsi=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->fungsi;
        $divisi=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->divisi;
        $departemen=$this->_ci->mdl_pekerja->get_pekerja_by_id($id)->row()->departemen;
       
        return '<div class="modal fade in" id="edit_pekerja'.$id . '" style="display:none;width: 40%;left: 50%;">
               <form action="pekerja/edit/'.$id.'/'.$offset.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Data Pekerja</h3>
		    </div>
		    <div class="modal-body">

		<table class="table table-bordered table-condensed table-striped"> 
                    <tr>
        <td>Nopek</td><td><input type="text" name="nopek" value="'.$nopek.'"></td>
    </tr>
        <tr>
        <td>Id Jabatan</td><td><input type="text" name="plc_jabatan_id" value="'.$plc_jabatan_id.'"></td>
    </tr>
        <tr>
        <td>Nama </td><td><input type="text" name="name" value="'.$name.'"></td>
    </tr>
    <tr>
        <td>Tanggal Lahir</td><td><input type="text" class="text input-small" name="tgl_lahir" id="tgl_lahir'.$id.'" value="'.$tgl_lahir.'"></td>
    </tr>    
    <tr>
        <td>Cost Ctr</td><td><input type="text" name="cost_ctr" value="'.$cost_ctr.'"></td>
    </tr>    
    <tr>
        <td>Cost Center</td><td><input type="text" name="cost_center" value="'.$cost_center.'"></td>
    </tr>    
    <tr>
        <td>Jabatan</td><td><input type="text" name="jabatan" value="'.$jabatan.'"></td>
    </tr>    
    <tr>
        <td>Company Code </td><td><input type="text" name="company_code" value="'.$company_code.'"></td>
    </tr>    
    <tr>
        <td>Personel Area</td><td><input type="text" name="personel_area" value="'.$personel_area.'"></td>
    </tr>    
    <tr>
        <td>Sub Area</td><td><input type="text" name="sub_aea" value="'.$sub_area.'"></td>
    </tr>    
    <tr>
        <td>Employee Group</td><td><input type="text" name="employee_group" value="'.$employee_group.'"></td>
    </tr>    
    <tr>
        <td>Employee Sub Group</td><td><input type="text" name="employee_subgroup" value="'.$employee_subgroup.'"></td>
    </tr>    
    <tr>
        <td>Direktorat</td><td><input type="text" name="direktorat" value="'.$direktorat.'"></td>
    </tr>
    <tr>
        <td>Fungsi</td><td><input type="text" name="direktorat" value="'.$fungsi.'"></td>
    </tr>
    <tr>
        <td>Divisi</td><td><input type="text" name="direktorat" value="'.$divisi.'"></td>
    </tr>
    <tr>
        <td>Departemen</td><td><input type="text" name="direktorat" value="'.$departemen.'"></td>
    </tr>
</table>
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
                
<script type="text/javascript">
$(function () {
    $("#tgl_lahir'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>

';
    }
    
    
       function edit_peserta($id) {
       $nopek=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->nopek;
       $id_trans_pelatihan=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->id_trans_pelatihan;
        $name=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->nama_pekerja;
        $cost_ctr=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->cost_center_code;
        $cost_center=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->cost_center_name;
        $jabatan=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->position;
        $company_code=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->company_code;
        $direktorat=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->direktorat;
        $fungsi=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->fungsi;
        $divisi=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->divisi;
        $departemen=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->departemen;
        $email=$this->_ci->mdl_peserta->get_peserta_by_id($id)->row()->email;        
       
        return '<div class="modal fade in" id="edit_peserta'.$id . '" style="display:none;width: 40%;left: 50%;">
               <form action="peserta/edit_peserta/'.$id.'/'.$id_trans_pelatihan.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Data Peserta</h3>
		    </div>
		    <div class="modal-body">

		<table class="table table-bordered table-condensed table-striped"> 
                    <tr>
        <td>Nopek</td><td><input type="text" name="nopek" value="'.$nopek.'"></td>
    </tr>
        
        <tr>
        <td>Nama </td><td><input type="text" name="nama_pekerja" value="'.$name.'"></td>
    </tr>    
    <tr>
        <td>Cost Ctr</td><td><input type="text" name="cost_center_code" value="'.$cost_ctr.'"></td>
    </tr>    
    <tr>
        <td>Cost Center</td><td><input type="text" name="cost_center_name" value="'.$cost_center.'"></td>
    </tr>    
    <tr>
        <td>Jabatan</td><td><input type="text" name="position" value="'.$jabatan.'"></td>
    </tr>    
    <tr>
        <td>Company Code </td><td><input type="text" name="company_code" value="'.$company_code.'"></td>
    </tr>    
     <tr>
        <td>Direktorat</td><td><input type="text" name="direktorat" value="'.$direktorat.'"></td>
    </tr>
    <tr>
        <td>Fungsi</td><td><input type="text" name="fungsi" value="'.$fungsi.'"></td>
    </tr>
    <tr>
        <td>Divisi</td><td><input type="text" name="divisi" value="'.$divisi.'"></td>
    </tr>
    <tr>
        <td>Departemen</td><td><input type="text" name="departemen" value="'.$departemen.'"></td>
    </tr>
     <tr>
        <td>Email</td><td><input type="text" name="email" value="'.$email.'"></td>
    </tr>
</table>
<button class="btn btn-success" type="submit">Ubah</button> <a href="peserta/delete/'.$id.'/'.$id_trans_pelatihan.'" class="btn btn-danger">Hapus</a>&nbsp;<a href="#" class="btn" data-dismiss="modal">Keluar</a>
		    </div>
                    </form>
		</div>
                
<script type="text/javascript">
$(function () {
    $("#tgl_lahir'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>

';
    }
    
    function history_peserta($nopek,$tgl) {
    $peserta=$this->_ci->mdl_peserta_induction->get_by_nopek($nopek)->result_array();
    $tabel='';
    foreach ($peserta as $row) {
      $tgl_mulai=  $this->_ci->mdl_fgt_pelatihan->get_by_id($row['id_trans_pelatihan'])->row()->tgl_mulai; 
      $tgl_selesai=  $this->_ci->mdl_fgt_pelatihan->get_by_id($row['id_trans_pelatihan'])->row()->tgl_selesai;
      $kd_pelatihan=  $this->_ci->mdl_fgt_pelatihan->get_by_id($row['id_trans_pelatihan'])->row()->kd_pelatihan;
      $judul= $this->_ci->mdl_pelatihan->get_by_id($kd_pelatihan)->row()->judul;
      if ($tgl_mulai>=date('Y-m-d G:i:s')) {
        $tabel.='<tr><td>'.$judul.'</td><td>'.$this->date_correct($tgl_mulai).'</td><td>'.$this->date_correct($tgl_selesai).'</td></tr>';  
      }               
    }
        
    return '<div class="modal fade in" id="history_peserta'.$nopek.'" style="display:none;">
               
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Rencana Pelatihan Peserta</h3>
		    </div>
		    <div class="modal-body">
                    <table class="table table-bordered table-striped">
	<tr>
	    <th>Nama Pelatihan</th><th>Tgl Mulai</th><th>Tgl Selesai</th>
	</tr>
   ' . $tabel . '
       </table>
    <a href="#" class="btn" data-dismiss="modal">Keluar</a>
		    </div>
                    
		</div>
';    
    }
    
           function edit_peserta_induction($id) {
        $nopek=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->nopek;
        $id_fgt_induction=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->id_fgt_induction;
        $name=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->nama_pekerja;
        $cost_ctr=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->cost_center_code;
        $cost_center=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->cost_center_name;
        $jabatan=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->position;
        $company_code=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->company_code;
        $direktorat=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->direktorat;
        $fungsi=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->fungsi;
        $divisi=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->divisi;
        $departemen=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->departemen;
        $email=$this->_ci->mdl_peserta_induction->get_peserta_by_id($id)->row()->email;        
       
        return '<div class="modal fade in" id="edit_peserta_induction'.$id . '" style="display:none;width: 40%;left: 50%;">
               <form action="peserta_induction/edit_peserta/'.$id.'/'.$id_fgt_induction.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Data Peserta</h3>
		    </div>
		    <div class="modal-body">

		<table class="table table-bordered table-condensed table-striped"> 
                    <tr>
        <td>Nopek</td><td><input type="text" name="nopek" value="'.$nopek.'"></td>
    </tr>
        
        <tr>
        <td>Nama </td><td><input type="text" name="nama_pekerja" value="'.$name.'"></td>
    </tr>    
    <tr>
        <td>Cost Ctr</td><td><input type="text" name="cost_center_code" value="'.$cost_ctr.'"></td>
    </tr>    
    <tr>
        <td>Cost Center</td><td><input type="text" name="cost_center_name" value="'.$cost_center.'"></td>
    </tr>    
    <tr>
        <td>Jabatan</td><td><input type="text" name="position" value="'.$jabatan.'"></td>
    </tr>    
    <tr>
        <td>Company Code </td><td><input type="text" name="company_code" value="'.$company_code.'"></td>
    </tr>    
     <tr>
        <td>Direktorat</td><td><input type="text" name="direktorat" value="'.$direktorat.'"></td>
    </tr>
    <tr>
        <td>Fungsi</td><td><input type="text" name="fungsi" value="'.$fungsi.'"></td>
    </tr>
    <tr>
        <td>Divisi</td><td><input type="text" name="divisi" value="'.$divisi.'"></td>
    </tr>
    <tr>
        <td>Departemen</td><td><input type="text" name="departemen" value="'.$departemen.'"></td>
    </tr>
     <tr>
        <td>Email</td><td><input type="text" name="email" value="'.$email.'"></td>
    </tr>
</table>
<button class="btn btn-success" type="submit">Ubah</button> <a href="peserta_induction/delete/'.$id.'/'.$id_fgt_induction.'" class="btn btn-danger">Hapus</a>&nbsp;<a href="#" class="btn" data-dismiss="modal">Keluar</a>
		    </div>
                    </form>
		</div>
                
<script type="text/javascript">
$(function () {
    $("#tgl_lahir'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>

';
    }
    
    function history_peserta_induction($nopek,$tgl) {
    $peserta=$this->_ci->mdl_peserta_induction->get_by_nopek($nopek)->result_array();
    $tabel='';
    foreach ($peserta as $row) {
      $tgl_mulai=  $this->_ci->mdl_fgt_induction->get_by_id($row['id_fgt_induction'])->row()->tgl_mulai; 
      $tgl_selesai=  $this->_ci->mdl_fgt_induction->get_by_id($row['id_fgt_induction'])->row()->tgl_selesai;
      $kd_pelatihan=  $this->_ci->mdl_fgt_induction->get_by_id($row['id_fgt_induction'])->row()->kd_pelatihan;
      $judul= $this->_ci->mdl_pelatihan->get_by_id($kd_pelatihan)->row()->judul;
      if ($tgl_mulai>=date('Y-m-d G:i:s')) {
        $tabel.='<tr><td>'.$judul.'</td><td>'.$this->date_correct($tgl_mulai).'</td><td>'.$this->date_correct($tgl_selesai).'</td></tr>';  
      }               
    }
        
    return '<div class="modal fade in" id="history_peserta'.$nopek.'" style="display:none;">
               
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Rencana Pelatihan Peserta</h3>
		    </div>
		    <div class="modal-body">
                    <table class="table table-bordered table-striped">
	<tr>
	    <th>Nama Pelatihan</th><th>Tgl Mulai</th><th>Tgl Selesai</th>
	</tr>
   ' . $tabel . '
       </table>
    <a href="#" class="btn" data-dismiss="modal">Keluar</a>
		    </div>
                    
		</div>
';    
    }
    
    
    
        function edit_manager($id) {
            
        $name=$this->_ci->mdl_pekerja->get_manager_by_id($id)->row()->name;
        
        return '<div class="modal fade in" id="edit_manager'.$id . '" style="display:none;width: 23%;left: 50%;">
               <form action="pekerja/edit_manager/'.$id.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Data Manager</h3>
		    </div>
		    <div class="modal-body">
<input type="text" name="name" value="'.$name.'">
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>

';
    }
    
    function tambah_lokasi($id,$offset) {    
            $opt_class=$this->_ci->mdl_sarfas->get_class();
            $options_class='';
            foreach ($opt_class->result_array() as $row_class) {
                $options_class.='<option value="'.$row_class['class_name'].'">'.$row_class['class_name'].'</option>';
            }
        
            return '<div class="modal fade in" id="tambah_lokasi'.$id . '" style="display:none;width: 20%;left: 50%;">
               <form action="sarfas/tambah_lokasi/'.$id.'/'.$offset.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Tambah Lokasi</h3>
		    </div>
		    <div class="modal-body">

		<select name ="location" id="i_n_r_reason'.$id.'">
                '.$options_class.'
                
            </select>
            <input id="other_reason'.$id.'" name="other" type="text" placeholder="Masukan nama Hotel/Kantor/Kota" />
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
                
<script type="text/javascript">
        $(function(){
            //initially hide the textbox
            $("#other_reason'.$id.'").hide();
            $("#i_n_r_reason'.$id.'").change(function() {
              if($(this).find("option:selected").val() == "19"){
                $("#other_reason'.$id.'").show();
              }else{
                $("#other_reason'.$id.'").hide();
              }
            });

            $("#i_n_r_reason'.$id.'").load(function() {
              if($(this).find("option:selected").val() == "19"){
                $("#other_reason'.$id.'").show();
              }else{
                $("#other_reason'.$id.'").hide();
              }
            });
            $("#othe_reason'.$id.'").keyup(function(ev){
                  var othersOption = $("#i_n_r_reason'.$id.'").find("option:selected");
                  if(othersOption.val() == "19"){
                    ev.preventDefault();
                    //change the selected drop down text
                    $(othersOption).html($("#other_reason'.$id.'").val()); 


                  } 
            });
        });
    </script>

';    
    }
    
    
        function view_hsetc($id) {
            
        $kode=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->kode;
        $no_sertifikat=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->no_sertifikat;
        $judul_pelatihan=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->judul_pelatihan;
        $lokasi=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->lokasi;
        $tgl_mulai=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->tgl_mulai;
        $tgl_selesai=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->tgl_selesai;
        $durasi=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->durasi;
        $nopek=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->nopek;
        $nama=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->nama;
        $fungsi=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->fungsi;
        $unit_asal=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->unit_asal;
        $direktorat=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->direktorat;
        
        return '<div class="modal fade in" id="view_hsetc'.$id . '" style="display:none;width: 40%;left: 50%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Detail Pelatihan HSETC</h3>
		    </div>
		    <div class="modal-body">
		<table class="table table-bordered table-condensed table-striped">
    <tr>
        <td style="width: 100px">Kode</td><td>'.$kode.'</td>
    </tr>    
    <tr>
        <td>No Sertifikat</td><td>'.$no_sertifikat.'</td>
    </tr>    
    <tr>
        <td>Judul Pelatihan</td><td>'.$judul_pelatihan.'</td>
    </tr>    
    <tr>
        <td>Lokasi</td><td>'.$lokasi.'</td>
    </tr>    
    <tr>
        <td>Tanggal Pelaksanaan</td><td>'.$this->date_correct($tgl_mulai).' s/d '.$this->date_correct($tgl_selesai).'</td>
    </tr>    
    <tr>
        <td>Durasi</td><td>'.$durasi.'</td>
    </tr>    
    <tr>
        <td>Nopek</td><td>'.$nopek.'</td>
    </tr>    
    <tr>
        <td>Nama</td><td>'.$nama.'</td>
    </tr>     
    <tr>
        <td>Fungsi</td><td>'.$fungsi.'</td>
    </tr>    
    <tr>
        <td>Unit Asal</td><td>'.$unit_asal.'</td>
    </tr>    
    <tr>
        <td>Direktorat</td><td>'.$direktorat.'</td>
    </tr>    
</table>	
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
    
        function detail_laptop($id) {
            
        $nopeg=$this->_ci->mdl_sarfas->get_laptop_by($id)->row()->nopeg;
        $nama=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->nama;
        $telp=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->telp;
        $fungsi=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->fungsi;
        $laptop=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->id_laptop;
        $perangkat_laptop=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->perangkat_laptop;
        $keperluan=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->keperluan;
        $tgl_peminjaman= $this->date_correct($this->_ci->mdl_sarfas->get_laptop_by($id)->row()->tgl_peminjaman);
        $tgl_kembali= $this->date_correct($this->_ci->mdl_sarfas->get_laptop_by($id)->row()->tgl_kembali);
        $tgl_pengembalian= $this->date_correct($this->_ci->mdl_sarfas->get_laptop_by($id)->row()->tgl_pengembalian);
        $catatan=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->catatan;        
        
        $ex_laptop=  explode("#", $laptop);
        $list='';
        for ($i=0;$i<count($ex_laptop);$i++){
            $list.=  anchor('laptop/detail/'.$ex_laptop[$i], $this->_ci->mdl_laptop->get_by_id($ex_laptop[$i])->row()->no_asset, array('class'=>'label label-info','target'=>'_blank')).' ';  
        }
        
        return '<div class="modal fade in" id="detail_laptop'.$id.'" style="display:none;width: 40%;left: 50%;">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Detail Peminjaman Laptop</h3>
		    </div>
		    <div class="modal-body">
		<table class="table table-bordered table-condensed table-striped">
    <tr>
        <td style="width: 150px">Nopeg</td><td>'.$nopeg.'</td>
    </tr>    
    <tr>
        <td>Nama</td><td>'.$nama.'</td>
    </tr>    
    <tr>
        <td>No Telp</td><td>'.$telp.'</td>
    </tr>    
    <tr>
        <td>Fungsi</td><td>'.$fungsi.'</td>
    </tr>
    <tr>
    <td>Laptop</td>
    <td>'.$list.'</td>
    </tr>
    <tr>
        <td>Perangkat Laptop</td><td>'.$perangkat_laptop.'</td>
    </tr>    
    <tr>
        <td>Keperluan</td><td>'.$keperluan.'</td>
    </tr>    
    <tr>
        <td>Tanggal Peminjaman</td><td>'.$tgl_peminjaman.' - '.$tgl_kembali.'</td>
    </tr>    
    <tr>
        <td>Tanggal Pengembalian</td><td>'.$tgl_pengembalian.'</td>
    </tr>    
    <tr>
        <td>Catatan</td><td>'.$catatan.'</td>
    </tr>    
</table>	
		    </div>
		    <div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
		</div>';
    }
    
            function edit_laptop($id) {
            
        $nopeg=$this->_ci->mdl_sarfas->get_laptop_by($id)->row()->nopeg;
        $nama=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->nama;
        $telp=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->telp;
        $fungsi=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->fungsi;
        $laptop=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->id_laptop;
        $perangkat_laptop=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->perangkat_laptop;
        $keperluan=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->keperluan;
        $tgl_peminjaman= $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->tgl_peminjaman;
        $tgl_kembali= $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->tgl_kembali;
        $tgl_pengembalian= $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->tgl_pengembalian;
        $catatan=  $this->_ci->mdl_sarfas->get_laptop_by($id)->row()->catatan;        
        
        $ex_laptop=  explode("#", $laptop);
        $list='';
        for ($i=0;$i<count($ex_laptop);$i++){
            $list.=  anchor('laptop/detail/'.$ex_laptop[$i], $this->_ci->mdl_laptop->get_by_id($ex_laptop[$i])->row()->no_asset, array('class'=>'label label-info','target'=>'_blank')).' ';  
        }
        
        return '<div class="modal fade" id="edit_laptop'.$id.'" tabindex="-1" role="dialog" style="display:none;width: 40%;left: 50%;top:40%">
<form action="sarfas/update_peminjaman_laptop/'.$id.'" method="POST">
<div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Peminjaman Laptop</h3>
		    </div>
		    <div class="modal-body">

<table class="table table-bordered table-condensed table-striped">
    <tr>
        <td style="width: 100px">Nopeg</td><td><input type="text" name="nopeg" value="'.$nopeg.'"></td>
    </tr>    
    <tr>
        <td>Nama</td><td><input type="text" name="nama" value="'.$nama.'"></td>
    </tr>    
    <tr>
        <td>No Telp</td><td><input type="text" name="telp" value="'.$telp.'"></td>
    </tr>    
    <tr>
        <td>Fungsi</td><td><input type="text" name="fungsi" value="'.$fungsi.'"></td>
    </tr>    
        <tr>
        <td>Tanggal Peminjaman</td><td><input type="text" class="input-small" id="tgl_pinjam'.$id.'" name="tgl_peminjaman" value="'.$tgl_peminjaman.'"> s/d <input type="text"  class="input-small" id="tgl_kembali'.$id.'" name="tgl_kembali" value="'.$tgl_kembali.'"></td>
    </tr>    
    <tr>
        <td>Tanggal Pengembalian</td>
        <td><input type="text" class="input-small" id="tgl_pengembalian'.$id.'" name="tgl_pengembalian" value="'.$tgl_pengembalian.'"></td>
    </tr> 
    <tr>
        <td>Laptop</td><td>'.$list.'</td>
    </tr>        
    <tr>
        <td>Perangkat Laptop</td><td><input type="text" name="perangkat_laptop" value="'.$perangkat_laptop.'"></td>
    </tr>    
    <tr>
        <td>Keperluan</td><td><input type="text" name="keperluan" value="'.$keperluan.'"></td>
    </tr>       
    <tr>
        <td>Catatan</td><td><input type="text" name="catatan" value="'.$catatan.'"></td>
    </tr>    
</table>	

		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
 <script type="text/javascript">
$(function () {
    $("#tgl_pinjam'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#tgl_kembali'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#tgl_pengembalian'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>               


';
    }
    
    
        function edit_hsetc($id,$offset) {
            
        $kode=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->kode;
        $no_sertifikat=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->no_sertifikat;
        $judul_pelatihan=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->judul_pelatihan;
        $lokasi=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->lokasi;
        $tgl_mulai=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->tgl_mulai;
        $tgl_selesai=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->tgl_selesai;
        $durasi=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->durasi;
        $nopek=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->nopek;
        $nama=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->nama;
        $fungsi=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->fungsi;
        $unit_asal=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->unit_asal;
        $direktorat=$this->_ci->mdl_learning_hsetc->get_ld_by_id($id)->row()->direktorat;
        
        return '<div class="modal fade in" id="edit_hsetc'.$id . '" style="display:none;width: 40%;left: 50%;">
               <form action="learning_hsetc/edit_hsetc/'.$id.'/'.$offset.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Pelatihan HSETC</h3>
		    </div>
		    <div class="modal-body">

		<table class="table table-bordered table-condensed table-striped">    
    <tr>
        <td>Kode</td><td><input type="text" name="kode" value="'.$kode.'"></td>
    </tr>    
    <tr>
        <td>No Sertifikat</td><td><input type="text" name="no_sertifikat" value="'.$no_sertifikat.'"></td>
    </tr>    
    <tr>
        <td>Judul Pelatihan</td><td><input type="text" name="judul_pelatihan" value="'.$judul_pelatihan.'"></td>
    </tr>
        <tr>
        <td>Lokasi</td><td><input type="text" name="lokasi" value="'.$lokasi.'"></td>
    </tr>
    <tr>
        <td>Tanggal</td><td><input type="text" class="text input-small" name="tgl_mulai" id="start_date'.$id.'" value="'.$tgl_mulai.'"> s/d <input type="text" class="text input-small" id="end_date'.$id.'" name="tgl_selesai" value="'.$tgl_selesai.'"></td>
    </tr>    
    <tr>
        <td>Durasi</td><td><input type="text" name="durasi" value="'.$durasi.'"></td>
    </tr>    
    <tr>
        <td>Nopek</td><td><input type="text" name="nopek" value="'.$nopek.'"></td>
    </tr>    
    <tr>
        <td>Nama</td><td><input type="text" name="nama" value="'.$nama.'"></td>
    </tr>    
    <tr>
        <td>Fungsi</td><td><input type="text" name="fungsi" value="'.$fungsi.'"></td>
    </tr>    
    <tr>
        <td>Unit Asal</td><td><input type="text" name="unit_asal" value="'.$unit_asal.'"></td>
    </tr>    
    <tr>
        <td>Direktorat</td><td><input type="text" name="direktorat" value="'.$direktorat.'"></td>
    </tr>    
</table>
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
                
<script type="text/javascript">
$(function () {
    $("#start_date'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
    $("#end_date'.$id.'").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd"
    });
});

</script>

';
    }
    
    function add_uang_saku($id) {
       return '<div class="modal fade in" id="add_uang_saku'.$id . '" style="display:none;width: 30%;left: 50%;">
               <form action="sarfas/add_uang_saku/'.$id.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Tambah Uang Saku</h3>
		    </div>
		    <div class="modal-body">

		<table class="table table-bordered table-condensed table-striped">    
    <tr>
        <td>Dasar</td><td>Rp. <input type="text" class="input input-medium" name="us_dasar"></td>
    </tr>    
    <tr>
        <td>Rek. Atas Nama</td><td><input type="text" name="us_an"></td>
    </tr>    
    <tr>
        <td>No Rekening</td><td><input type="text" name="us_norek"></td>
    </tr>    
    <tr>
        <td>Bank</td><td><input type="text" name="us_bank"></td>
    </tr>
        <tr>
        <td>Cabang</td><td><input type="text" name="us_cabang"></td>
    </tr>
</table>
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
';
    }

    
        function lihat_uang_saku($id,$us_dasar,$us_pph,$us_diterimakan,$us_an,$us_norek,$us_bank,$us_cabang) {
       return '<div class="modal fade in" id="lihat_uang_saku'.$id . '" style="display:none;width: 30%;left: 50%;">
<form action="sarfas/update_uang_saku/'.$id.'" method="POST">		   
<div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Detail Uang Saku</h3>
		    </div>
		    <div class="modal-body">
		<table class="table table-bordered table-condensed table-striped">    
    <tr>
        <td>Dasar</td><td>Rp. <input type="text" class="input input-medium" name="us_dasar" value="'.$us_dasar.'"></td>
    </tr>    
    <tr>
        <td>PPH(6%)</td><td>Rp. <input type="text" class="input input-medium" name="us_pph" value="'.$us_pph.'"></td>
    </tr>    
    <tr>
        <td>Diterimakan</td><td>Rp. <input type="text" class="input input-medium" name="us_diterimakan" value="'.$us_diterimakan.'"></td>
    </tr>    
    <tr>
        <td>Rek. Atas Nama</td><td> <input type="text" class="input input-medium" name="us_an" value="'.$us_an.'"></td>
    </tr>    
    <tr>
        <td>No Rekening</td><td> <input type="text" class="input input-medium" name="us_norek" value="'.$us_norek.'"></td>
    </tr>    
    <tr>
        <td>Bank</td><td> <input type="text" class="input input-medium" name="us_bank" value="'.$us_bank.'"></td>
    </tr>
        <tr>
        <td>Cabang</td><td> <input type="text" class="input input-medium" name="us_cabang" value="'.$us_cabang.'"></td>
    </tr>
</table>
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Edit</button><a href="#" class="btn" data-dismiss="modal">Close</a>
		    </div>
                    </form>
		</div>
';
    }
    
    function edit_location($id) {
       $lokasi=$this->_ci->mdl_location->get_city_by_id($id)->row()->nama;
      $ket=$this->_ci->mdl_location->get_city_by_id($id)->row()->ket;
       
        return '<div class="modal fade in" id="edit_location'.$id . '" style="display:none;width: 30%;left: 50%;">
               <form action="location/edit_city/'.$id.'" method="POST">
		    <div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Edit Data Pekerja</h3>
		    </div>
		    <div class="modal-body">
      <table>
          <tr>
              <td>Lokasi</td><td><input type="text" name="nama" value="'.$lokasi.'"></td>
          </tr>
          <tr><td>Keterangan</td><td><input type="text" name="ket" value="'.$ket.'"></td></tr>
      </table>
		    </div>
		    <div class="modal-footer">
<button class="btn btn-primary" type="submit">Simpan</button> <a href="#" class="btn" data-dismiss="modal">Keluar</a>
		    </div>
                    </form>
		</div>

';
    }
    
    
       function conv_bulan($bln) {
        switch ($bln) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;

            default:
                return 'Error';
                break;
        }
    }
    

}

/* End of file editor.php */
/* Location: ./application/libraries/editor.php */