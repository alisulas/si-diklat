<table class="table table-condensed">
    <tr>
        <td width="150">Kode</td>
        <td width="5">:</td>
        <td><?php echo $code; ?></td>
    </tr>    
    <tr>
        <td>Nama Pelatihan</td>
        <td>:</td>
        <td><?php echo $course_name; ?></td>
    </tr>    
    <tr>
        <td>Tanggal Pelaksanaan</td>
        <td>:</td>
        <td><?php echo $tgl_pelaksanaan; ?></td>
    </tr>    
    <tr>
        <td>Lokasi</td>
        <td>:</td>
        <td><?php echo $location; ?></td>
    </tr>    
    <tr>
        <td>Kursil</td>
        <td>:</td>
        <td><?php echo $kursil; ?></td>
    </tr>    
    <tr>
        <td>Provider</td>
        <td>:</td>
        <td><?php echo $provider; ?></td>
    </tr>    
    <tr>
        <td>Trainer</td>
        <td>:</td>
        <td><?php echo $trainer; ?></td>
    </tr>    
</table>

<?php echo anchor('course/index', 'Kembali', array('class'=>'btn btn-primary')); ?>