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
                <li><a href="dashboard">Halaman Utama</a></li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        PND
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="course"><i class="icon-list-alt"></i> Daftar Program</a></li>
                        <li><a href="course/add"><i class="icon-plus"></i> Tambah Program</a></li>
                        <li class="divider"></li>
                        <li><a href="provider"><i class="icon-list-alt"></i> Daftar Provider</a></li>
                        <li><a href="provider/add"><i class="icon-plus"></i> Tambah Provider</a></li>
                        <li class="divider"></li>
                        <li><a href="trainer"><i class="icon-list-alt"></i> Daftar Pengajar</a></li>
                        <li><a href="trainer/add"><i class="icon-plus"></i> Tambah Pengajar</a></li>
                        <li class="divider"></li>
                        <li><a href="trainer/list_observasi"><i class="icon-list-alt"></i> Daftar Observasi</a></li>
                        <li><a href="trainer/add_observasi"><i class="icon-plus"></i> Tambah Observasi</a></li>
                    </ul>
                </li>

                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        CAR / PAR Report
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="carpar/index_user"><i class="icon-list-alt"></i> CAR / PAR P&D</a></li>
                        <li class="divider"></li>
                        <li><a href="carpar"><i class="icon-list-alt"></i> Daftar CAR / PAR Report</a></li>
                        <li class="divider"></li>
                        <li><a href="carpar/add_carpar"><i class="icon-plus"></i> Tambah CAR/PAR</a></li>

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
                        <li><a href="user/profile/<?php echo $this->session->userdata('user_id');?>" class="active">My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="login/logout" class="active">Logout</a></li>
                    </ul>
                </li>
		
	    </ul>
        </div>
    </div>
</div>