<?php echo form_open($action); ?>

<table class="table table-striped table-condensed table-bordered">
    <tr>
        <td>Username</td>
        <td><input type="text" name="username"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="text" name="password"></td>
    </tr>
        <tr>
            <td>Nopek</td>
        <td><input type="text" name="nopek"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><input type="text" name="nama"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" name="email"></td>
    </tr>
        <tr>
        <td>Fungsi</td>
        <td><select name="fungsi">
            <?php echo $fungsi; ?>
            </select></td>
    </tr>
        <tr>
        <td>Jabatan</td>
        <td><input type="text" name="jabatan"></td>
    </tr>
            <tr>
        <td>Telp/HP</td>
        <td><input type="text" name="hp"></td>
    </tr>
        <tr>
        <td>Role</td>
        <td>
            <select name="role">
                <option value="1">Group 1</option>
                <option value="2">Group 2</option>
                <option value="3">Group 3</option>
                <option value="4">Group 4</option>
                <option value="5">Group 5</option>
            </select> 
        </td>
    </tr>
    <tr>
        <td>Status</td>
        <td><input type="radio" name="status" value="1" checked="true">&nbsp;<span class="label label-info">Aktif</span><br><input type="radio" name="status" value="0">&nbsp;<span class="label label-important">Non Aktif</span></td>
    </tr>
</table>
<a class="btn" href="user" data-original-title=""><i class="icon-hand-left"></i> Kembali ke list</a>
<input type="submit" class="btn btn-primary" value="Simpan">
<?php echo form_close(); ?>