<script type="text/javascript" src="assets/bootstrap/js/bootstrap-dropdown.js"></script>
<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav">
                <li>
                    <h3>
                        <a class="brand" href="">PCU</a>
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
                        P&D
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="carpar/index_user"><i class="icon-list-alt"></i> CAR / PAR P&D</a></li>
                        <li class="divider"></li>
                        <li><a href="carpar"><i class="icon-list-alt"></i> Daftar CAR / PAR Report</a></li>
                        
                    </ul>
                </li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        LDT
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="learn"><i class="icon-list-alt"></i> Tugas Belajar</a></li>
                        <li class="divider"></li>
                        <li><a href="tln"><i class="icon-list-alt"></i> Data TLN</a></li>
                        <li><a href="libur"><i class="icon-list-alt"></i> Data Hari Libur (SLA)</a></li>
                        <li class="divider"></li>
                        <li><a href="ldp/index_tagihan"><i class="icon-list-alt"></i> Data LDP</a></li>
                        <li><a href="mandatory"><i class="icon-list-alt"></i> Mandatory</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        FGT
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="fgt_pelatihan"><i class="icon-list-alt"></i> View</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_pelatihan/plan"><i class="icon-list-alt"></i> Plan</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_pelatihan/list_do"><i class="icon-list-alt"></i> Do</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_pelatihan/list_check"><i class="icon-list-alt"></i> Check</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_pelatihan/list_action"><i class="icon-list-alt"></i> Action</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_pelatihan/list_result"><i class="icon-list-alt"></i> Result</a></li>             
                        <li class="divider"></li>
                        <li><a href="fgt_pelatihan/list_report"><i class="icon-list-alt"></i> Report</a></li>             
                        
                    </ul>
                </li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        LS
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="sarfas"><i class="icon-list-alt"></i> Sarfas</a></li>
                        <li><a href="sarfas/gl_front"><i class="icon-list-alt"></i> GL</a></li>
                        <li><a href="sarfas/list_pkl"><i class="icon-list-alt"></i> Data PKL</a></li>
                        <li><a href="sarfas/list_peminjaman_laptop"><i class="icon-list-alt"></i> Peminjaman Laptop</a></li>
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