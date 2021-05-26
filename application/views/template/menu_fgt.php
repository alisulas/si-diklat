<script type="text/javascript" src="assets/bootstrap/js/bootstrap-dropdown.js"></script>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <li>
                    <h3>
                        <a class="brand" href="fgt_pelatihan">PCU</a>
                    </h3>
                </li>
                
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        Master Data
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="pelatihan"><i class="icon-list-alt"></i> Pelatihan</a></li>             
                        <li class="divider"></li>
                        <li><a href="provider"><i class="icon-list-alt"></i> Provider</a></li>
                        <li class="divider"></li>
                        <li><a href="trainer"><i class="icon-list-alt"></i> Pengajar</a></li>
                        <li class="divider"></li>
                        <li><a href="pekerja"><i class="icon-list-alt"></i> Pekerja</a></li>
                        <li class="divider"></li>
                        <li><a href="observer"><i class="icon-list-alt"></i> Observer</a></li>
                        <li class="divider"></li>
                        <li><a href="location/list_city"><i class="icon-list-alt"></i> Lokasi</a></li>
                        
                    </ul>
                </li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        FGT
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                     <li>
                    <a href="fgt_pelatihan">
                        <b class="icon-calendar"></b> View
                    </a>        
                </li>
                <li class="divider"></li>
                <li>
                    <a href="fgt_pelatihan/plan">
                        <b class="icon-hand-right"></b> Plan
                    </a>        
                </li>
                <li class="divider"></li>
                <li>
                    <a href="fgt_pelatihan/list_do">
                        <b class="icon-hand-right"></b> Do
                    </a>        
                </li>
                <li class="divider"></li>
                <li>
                    <a href="fgt_pelatihan/list_check">
                        <b class="icon-hand-right"></b> Check
                    </a>        
                </li>
                <li class="divider"></li>
                <li>
                    <a href="fgt_pelatihan/list_action">
                        <b class="icon-hand-right"></b> Action
                    </a>        
                </li>
                <li class="divider"></li>
                 <li>
                    <a href="fgt_pelatihan/list_support">
                        <b class="icon-file"></b> Support
                    </a>        
                </li>
                <li class="divider"></li>
                <li>
                    <a href="fgt_pelatihan/list_report">
                        <b class="icon-list-alt"></b> Report
                    </a>        
                </li>
                <li class="divider"></li>
                <li>
                    <a href="fgt_pelatihan/list_canceled">
                        <b class="icon-list"></b> Canceled
                    </a>        
                </li>   
                    </ul>
                </li>
               
            </ul>
	    <ul class="nav pull-right">
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        <?php echo $this->session->userdata('user_name');?>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="divider"></li>
                        <li><a href="user/profile/<?php echo $this->session->userdata('user_id');?>" class="active">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="login/logout" class="active">Logout</a></li>
                    </ul>
                </li>
		
	    </ul>
        </div>
    </div>
</div>