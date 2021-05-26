<script type="text/javascript" src="assets/bootstrap/js/bootstrap-dropdown.js"></script>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <li>
                    <h3>
                        <a class="brand" href="fgt_induction">PCU</a>
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
               <li>
                    <a href="fgt_induction">
                        VIEW
                        <b class="icon-calendar icon-white"></b>
                    </a>        
                </li>
                
                <li>
                    <a href="fgt_induction/plan">
                        PLAN
                        <b class="icon-hand-right icon-white"></b>
                    </a>        
                </li>
                <li>
                    <a href="fgt_induction/list_do">
                        DO
                        <b class="icon-hand-right icon-white"></b>
                    </a>        
                </li>
                <li>
                    <a href="fgt_induction/list_check">
                        CHECK
                        <b class="icon-hand-right icon-white"></b>
                    </a>        
                </li>
                <li>
                    <a href="fgt_induction/list_action">
                        ACTION
                        <b class="icon-hand-right icon-white"></b>
                    </a>        
                </li>
                <li>
                    <a href="fgt_induction/list_result">
                        RESULT
                        <b class="icon-list icon-white"></b>
                    </a>        
                </li>
                
                           <li>
                    <a href="fgt_induction/list_support">
                        SUPPORT
                        <b class="icon-file  icon-white"></b>
                    </a>        
                </li>
                                         <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        REPORT
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="fgt_induction/list_report"><i class="icon-list-alt"></i> Pelatihan</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_induction/list_canceled"><i class="icon-list-alt"></i> Pelatihan batal</a></li>
                        
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