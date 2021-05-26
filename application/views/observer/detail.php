<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<p>
<?php 
echo $edit;
?>
<table class="table table-bordered table-condensed">
    <tr>
        <td>Nama</td><td colspan="4"><?php echo $observer['nama'] ?></td>
    </tr>
    <tr>
        <td>Alamat</td><td colspan="4"><?php echo $observer['alamat'] ?></td>
    </tr>
    <tr>
        <td>Telp</td><td colspan="4"><?php echo $observer['telp']; ?></td>
    </tr>
    <tr>
        <td>Fax</td><td colspan="4"><?php echo $observer['fax'] ?></td>
    </tr>
    <tr>
        <td>Email</td><td colspan="4"><?php echo $observer['email'] ?></td>
    </tr>
</table>
</p>

<p>
    <a href="observer/index" class="btn"><i class="icon-hand-left"></i> Kembali ke list</a>
</p>