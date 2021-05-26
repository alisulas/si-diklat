<?php echo form_open($action); ?>

<table class="table table-striped table-condensed table-bordered">
    <tr>
        <td>Username</td>
        <td><input type="text" name="username" value="<?php echo $user['username']; ?>"></td>
    </tr>
    <tr>
        <td>Ubah Password</td>
        <td><input type="text" name="password"></td>
    </tr>
        <tr>
            <td>Nopek</td>
        <td><input type="text" name="nopek" value="<?php echo $user['nopek']; ?>"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" value="<?php echo $user['nama']; ?>"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="email" value="<?php echo $user['email']; ?>"></td>
    </tr>
        <tr>
        <td>Fungsi</td>
        <td><select name="fungsi">
            <?php echo $fungsi; ?>
            </select></td>
    </tr>
        <tr>
        <td>Jabatan</td>
        <td><input type="text" name="jabatan" value="<?php echo $user['jabatan']; ?>"></td>
    </tr>
            <tr>
        <td>Telp/HP</td>
        <td><input type="text" name="hp" value="<?php echo $user['hp']; ?>"></td>
    </tr>
        <tr>
        <td>Role</td>
        <td>            
            <?php echo $role; ?>                
        </td>
    </tr>
    <tr>
        <td>Status</td>
        <td><?php echo cek_status($user['status']); ?></td>
    </tr>
</table>
<a class="btn" href="user" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
<input type="submit" class="btn btn-primary" value="Simpan">
<?php echo form_close(); ?>

<?php
function cek_status($id) {
    switch ($id) {
        case 0:
            $cek='<input type="radio" name="status" value="1">&nbsp;<span class="label label-info">Aktif</span><br><input  checked="true" type="radio" name="status" value="0">&nbsp;<span class="label label-important">Non Aktif</span>';
            break;
        case 1:
            $cek='<input type="radio" name="status" value="1" checked="true">&nbsp;<span class="label label-info">Aktif</span><br><input type="radio" name="status" value="0">&nbsp;<span class="label label-important">Non Aktif</span>';
            break;
        default:
            break;
    }
    return $cek;
}
?>