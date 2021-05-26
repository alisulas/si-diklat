<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename, $stream=FALSE) 
{
    require_once("dompdf/dompdf_config.inc.php");
    spl_autoload_register('DOMPDF_autoload');
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
 $dompdf->set_paper("A4");
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        $CI =& get_instance();
        $CI->load->helper('file');
        if($filename=='sertifikasi'){
        write_file("./assets/uploads/certificate/$filename.pdf", $dompdf->output());            
        }elseif($filename=='course'){
        write_file("./assets/uploads/course/$filename.pdf", $dompdf->output());
        }elseif($filename=='tln'){
        write_file("./assets/uploads/tln/$filename.pdf", $dompdf->output());
        }

    }
}
