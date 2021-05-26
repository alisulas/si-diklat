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
                        LDT
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <!--  <li><a href="learn"><i class="icon-list-alt"></i> Tugas Belajar</a></li>
                        <li><a href="learn/add"><i class="icon-plus"></i> Tambah Tugas Belajar</a></li>
                        <li class="divider"></li>
-->
                        <li><a href="tln"><i class="icon-list-alt"></i> Data TLN</a></li>
                        <li><a href="libur"><i class="icon-list-alt"></i> Data Hari Libur (SLA)</a></li>
                        <li class="divider"></li>
                        <li><a href="ldp/index_tagihan"><i class="icon-list-alt"></i> Daftar LDP</a></li>
                        <li><a href="ldp/add_tagihan"><i class="icon-plus"></i> Tambah LDP</a></li>
                        <li><a href="mandatory"><i class="icon-list-alt"></i> Mandatory</a></li>
                        <li><a href="mandatory/add"><i class="icon-plus"></i> Tambah Mandatory</a></li>
                    </ul>
                </li>

                <li class="dropdown" id="menu1">
                    <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">
                        CAR / PAR Report
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="carpar/index_user"><i class="icon-list-alt"></i> CAR / PAR P&D</a></li>
 

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
