<p>
    <?php echo $this->session->flashdata('msg');?>
</p>
<?php echo form_open($action); ?>

<table class="table table-condensed">
    <tr>
        <td>Nopek</td>
        <td><input type="text" name="nopeg"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td><input type="text" name="nama"></td>
    </tr>
    <tr>
        <td>No.Telp / Hp / Ext</td>
        <td><input type="text" name="telp"></td>
    </tr>
    <tr>
        <td>Fungsi</td>
        <td><input type="text" name="fungsi"></td>
    </tr>
    <tr>
        <td>No Asset</td>
            <td class="left">
	    <table border="0" id="result">                
		<?php echo $laptop=null;?>
	    </table>
	    <a id="add_laptop" class="btn btn-mini btn-inverse">Tambah</a>
            <input type="text" id="laptop" style="display: none" placeholder="No Asset" onFocus="javascript:this.value=''">	   
            
        </td>
    </tr>
    <tr>
        <td>Perangkat Laptop</td>
        <td><input type="text" name="perangkat_laptop"></td>
    </tr>
    <tr>
        <td>Keperluan</td>
        <td><input type="text" name="keperluan"></td>
    </tr>
    <tr>
        <td>Tanggal Peminjaman</td>
        <td><input type="text" name="tgl_peminjaman" id="tgl_pinjam"> s/d <input type="text" name="tgl_kembali" id="tgl_kembali"></td>
    </tr>
    <tr>
        <td>Catatan</td>
        <td><input type="text" name="catatan"></td>
    </tr>
    <tr>
        <td><?php echo anchor('sarfas/list_peminjaman_laptop', 'Kembali', array('class'=>'btn')); ?>&nbsp;<input type="submit" value="Simpan" class="btn btn-primary"></td><td></td>
    </tr>
</table>

<?php echo form_close(); ?>

<script type="text/javascript">
$(function () {
    
    $("#tgl_pinjam").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});
$(function () {
    $("#tgl_kembali").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: 'yy-mm-dd',
            dateFormat: 'yy-mm-dd'
    });

});

</script>

<script type="text/javascript">
 
        $(this).ready( function() {
            $("#laptop").autocomplete({
                minLength: 1,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/laptop/lookup_laptop",
                        dataType: 'json',
                        type: 'POST',
                        data: req,
                        success:
                        function(data){
                            if(data.response =="true"){
                                add(data.message);
                            }
                        }
                    });
                },
            select:
                function(event, ui) {
                if(ui.item.id!=0)
                {
                    $("#result").append(
                    "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='laptop[]'/><a href='laptop/detail/"+ ui.item.id + "' target='_blank'>"+ ui.item.value + "</a>&nbsp;<a href='#' class='remove_laptop'><span class='label label-important'>Hapus</span></a>"
                    );
		    $("#laptop").hide();
		    $("#null_laptop").remove();
		    $("#add_laptop").show();
                }
                }
            });

            $('.remove_laptop').live('click', function() {
		$(this).parent().remove();
		return false;
	    });

	    $("#add_laptop").click(function(){
		$("#laptop").show();
                
		$("#add_laptop").hide();
	    });
        });
</script>