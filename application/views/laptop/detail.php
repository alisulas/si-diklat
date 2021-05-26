<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<table class="table table-condensed">
    <tr>
        <td>Username</td><td>: <?php echo $user['username']; ?></td>
    </tr>
    <tr>
        <td>Nopek</td><td>: <?php echo $user['nopek']; ?></td>
    </tr>
    <tr>
        <td>Nama</td><td>: <?php echo $user['nama']; ?></td>
    </tr>
    <tr>
        <td>Email</td><td>: <?php echo $user['email']; ?></td>
    </tr>
    <tr>
        <td>Fungsi</td><td>: <?php echo $fungsi; ?></td>
    </tr>
    <tr>
        <td>Jabatan</td><td>: <?php echo $user['jabatan']; ?></td>
    </tr>
    <tr>
        <td>Telp/HP</td><td>: <?php echo $user['hp']; ?></td>
    </tr>
    <tr>
        <td>Role</td><td>: <?php echo $role; ?></td>
    </tr>
    <tr>
        <td>Login Terakhir</td><td>: <?php echo date('l, d M Y, G:i:s', strtotime($user['last_login'])); ?></td>
    </tr>
</table>
<h3>Ubah Password</h3><br>
<?php echo form_open($action); ?>
<span class="label label-info">Password Lama : </span>&nbsp;<input type="password" name="old_password">&nbsp;
<span class="label label-success">Password Baru : </span>&nbsp;<input type="password" name="new_password">
<input type="submit" value="Simpan" class="btn btn-success">
    <?php echo form_close(); ?><br>
<a class="btn" href="dashboard" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>