<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
    <form action="carpar/index_user" method="POST">
        <select name="list">
          
            <option value="nama_program">Nama Program</option>
            <option value="Tempat">Tempat</option>
        </select>
 <input type="text" name="cari" placeholder="Masukan Pencarian" />
 <button class="btn btn-primary" type="submit">Cari</button>&nbsp;<button class="btn btn-primary" type="submit">Lihat Semua</button>
</form>

<p>
    <?php echo $pagination;?>
    <?php echo $content;?>
    <?php echo $pagination;?>
</p>