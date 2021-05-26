<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?php echo base_url();?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />        
<meta http-equiv="refresh" content="3600">
        <title>Monitoring Pembelajaran | Pertamina Corporate University</title>
	<link rel="shortcut icon" href="favicon.ico" />

	<link type="text/css" href="assets/bootstrap/bootstrap.css" rel="stylesheet">
        <link type="text/css" href="assets/bootstrap/bootstrap-responsive.css" rel="stylesheet">
        <link type="text/css" href="assets/css/style.css" rel="stylesheet" />
        <link type="text/css" href="assets/up/uploadify.css" rel="stylesheet" />
        <link type="text/css" href="assets/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
        <link type="text/css" href="assets/css/jquery.fileupload-ui.css" rel="stylesheet" />
	<link rel='stylesheet' type='text/css' href='assets/js/fullcalendar/fullcalendar.css' />
	<link rel='stylesheet' type='text/css' href='assets/js/fullcalendar/fullcalendar.print.css' media='print' />
	
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

        <!--scripts-->
        <script type="text/javascript" src="assets/bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/tm/jquery.tinymce.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap-transition.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap-tooltip.js"></script>
        <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/google-code-prettify/prettify.js"></script>
        <script type="text/javascript" src="assets/js/sisfo.js"></script>
<script type="text/javascript" src="assets/js/modcoder_excolor/jquery.modcoder.excolor.js"></script>
<script type="text/javascript" src="assets/js/jscolor/jscolor.js"></script>
    </head>
    <body>
        <div class="container" id="container">
            <div class="row">
                <!-- Header -->
                <div class="span10 logo">
                    <a href="<?php echo site_url();?>"><img src="assets/img/logo-pcu.png" height="60"/></a>
                </div>
		<div class="nav pull-right">
		<div class="span2">
		    <?php if($this->session->userdata('is_login')){?>
			Anda Login sebagai <h2><?php echo $this->session->userdata('fungsi_name');?></h2>
		    <?php }?>
		</div> 
		</div>
            </div>

            <div class="row">
                <div class="span12">
                    <?php echo $_menu;?>
                </div>
            </div>
	    <?php if($this->session->userdata('is_login1')){?>
	    <div class="row">
		<div class="span12">
		    <div class="breadcrumb">
			<?php echo set_breadcrumb(); ?>
		    </div>
		</div>
	    </div>
	    <?php }?>
            <div class="row">
                <div class="span12">
                    <div class="content">
			
			<div class="title" align='center'>
			    <?php echo $title;?>
			</div>
                        <?php echo $_content;?>
                    </div>
                </div>
                               <div class="clear"></div>
                
                <div class="span12">
                    <div class="ptmn-line">
                    <div class="col-left">
                        <div class="ptmn-red-hr">
                        </div>
                    </div>
                    <div class="col-middle">
                        <div class="ptmn-green-hr">
                        </div>
                    </div>
                    <div class="col-right">
                        <div class="ptmn-blue-hr">
                        </div>
                    </div>
                </div>
                    <p class="footer">
                    <span style="float: left">Direkomendasikan menggunakan Browser &nbsp;<a href="<?php echo site_url(); ?>assets/firefox/Firefox.exe">Firefox &nbsp; <span class="label label-warning">Download Disini</span></a></span>                        
                        Tracking And Monitoring PCU &copy; <?php echo date('Y');?></p></div>
            </div>
        </div>
    </body>
</html>