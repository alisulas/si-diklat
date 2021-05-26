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
                        <i class="icon-list-alt icon-white"></i>Master Data
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="location/list_city"><i class="icon-list-alt"></i> Lokasi</a></li>
                        <li class="divider"></li>
                        <li><a href="laptop"><i class="icon-list-alt"></i> Laptop</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        <i class="icon-list-alt icon-white"></i>Learning Support
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="sarfas/list_pelatihan"><i class="icon-list-alt"></i> Sarfas Pelatihan</a></li>
                        <li class="divider"></li>
                        <li><a href="sarfas"><i class="icon-list-alt"></i> Jadwal Kelas TV</a></li>
                        <li class="divider"></li>
                        <li><a href="pkl/list_pkl"><i class="icon-list-alt"></i> Data PKL</a></li>
                        <li class="divider"></li>
                        <li><a href="sarfas/list_peminjaman_laptop"><i class="icon-list-alt"></i> Peminjaman Laptop</a></li>
                        <li class="divider"></li>
                        <li><a href="carpar/index_user"><i class="icon-list-alt"></i> CAR / PAR LS</a></li>
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
