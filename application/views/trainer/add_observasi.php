<?php echo form_open_multipart($action); ?>
<table>
    <tr>
        <td>
            Nama Pengajar &nbsp;
        </td>
        <td>
         <div id="result">		
	    </div>
	    <a id="add_trainer" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="trainer" style="display: none" placeholder="Masukkan nama trainer"/>
        </td>
    </tr>
    <tr>
        <td>
            Nama Program &nbsp;
        </td>
        <td>
         <div id="result_program">		
	    </div>
	    <a id="add_program" class="btn btn-mini btn-inverse">Tambah</a>
	    <input type="text" id="program" style="display: none" placeholder="Masukkan nama program"/>
        </td>
    </tr>
</table>

<table class="table table-striped">
    <tr>
        <td style="background-color: #3baae3"><b>PELATIHAN</b></td>
        <td style="background-color: #3baae3"><b>Status</b></td>
        <td style="background-color: #3baae3"><b>Catatan</b></td>
    </tr>
    
    <tr>
        <td>Pengajar datang tepat waktu untuk melakukan set-up</td>
        <td><input type="radio" name="obs1" value="Ya">Ya &nbsp;<input type="radio" name="obs1" value="Tidak">Tidak</td>
        <td><input type="text" name="cat1"></td>
    </tr>
    
    <tr>
        <td>Spanduk pelatihan tersedia dan tertulis dengan benar</td>
        <td><input type="radio" name="obs2" value="Ya">Ya &nbsp;<input type="radio" name="obs2" value="Tidak">Tidak</td>
        <td><input type="text" name="cat2"></td>
    </tr>
    
    <tr>
        <td>Pengaturan ruangan pelatihan sudah sesuai dengan aturan yang disetujui</td>
        <td><input type="radio" name="obs3" value="Ya">Ya &nbsp;<input type="radio" name="obs3" value="Tidak">Tidak</td>
        <td><input type="text" name="cat3"></td>
    </tr>
    
    <tr>
        <td>Pengaturan coffee break dan makan siang sudah dikonfirmasikan dengan perwakilan dari tempat pelatihan?</td>
        <td><input type="radio" name="obs4" value="Ya">Ya &nbsp;<input type="radio" name="obs4" value="Tidak">Tidak</td>
        <td><input type="text" name="cat4"></td>
    </tr>
    
    <tr>
        <td>Materi dan Handout pelatihan tersedia dan tersusun rapi di atas meja peserta</td>
        <td><input type="radio" name="obs5" value="Ya">Ya &nbsp;<input type="radio" name="obs5" value="Tidak">Tidak</td>
        <td><input type="text" name="cat5"></td>
    </tr>
    
    <tr>
        <td>ATK pelatihan tersedia dan tersusun rapi di atas meja peserta</td>
        <td><input type="radio" name="obs6" value="Ya">Ya &nbsp;<input type="radio" name="obs6" value="Tidak">Tidak</td>
        <td><input type="text" name="cat6"></td>
    </tr>
    
    <tr>
        <td>Peralatan presentasi (LCD, Laptop, Kabel koneksi sudah diperiksa dengan baik</td>
        <td><input type="radio" name="obs7" value="Ya">Ya &nbsp;<input type="radio" name="obs7" value="Tidak">Tidak</td>
        <td><input type="text" name="cat7"></td>
    </tr>
    
    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>DISKUSI KELOMPOK DAN PERMAINAN</b></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan arahan tugas kelompok</td>
        <td><input type="radio" name="obs8" value="Ya">Ya &nbsp;<input type="radio" name="obs8" value="Tidak">Tidak</td>
        <td><input type="text" name="cat8"></td>
    </tr>
    
    <tr>
        <td>Pengajar terlibat dalam diskusi kelompok</td>
        <td><input type="radio" name="obs9" value="Ya">Ya &nbsp;<input type="radio" name="obs9" value="Tidak">Tidak</td>
        <td><input type="text" name="cat9"></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan tujuan dan instruksi cara bermain dengan jelas</td>
        <td><input type="radio" name="obs10" value="Ya">Ya &nbsp;<input type="radio" name="obs10" value="Tidak">Tidak</td>
        <td><input type="text" name="cat10"></td>
    </tr>

    <tr>
        <td colspan="3" style="background-color: #3baae3"><b>PELAKSANAAN PELATIHAN</b></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan pendahuluan dan latar belakang topik materi dengan efektif</td>
        <td><input type="radio" name="obs11" value="Ya">Ya &nbsp;<input type="radio" name="obs11" value="Tidak">Tidak</td>
        <td><input type="text" name="cat11"></td>
    </tr>
    
    <tr>
        <td>Pengajar menanyakan dan mencatat harapan peserta terhadap pelatihan</td>
        <td><input type="radio" name="obs12" value="Ya">Ya &nbsp;<input type="radio" name="obs12" value="Tidak">Tidak</td>
        <td><input type="text" name="cat12"></td>
    </tr>
    
    <tr>
        <td>Pengajar mampu menjelaskan ide dan konsep utama materi pelatihan</td>
        <td><input type="radio" name="obs13" value="Ya">Ya &nbsp;<input type="radio" name="obs13" value="Tidak">Tidak</td>
        <td><input type="text" name="cat13"></td>
    </tr>
    
    <tr>
        <td>Pengajar berbicara dengan alunan dan intonasi suara yang tepat</td>
        <td><input type="radio" name="obs14" value="Ya">Ya &nbsp;<input type="radio" name="obs14" value="Tidak">Tidak</td>
        <td><input type="text" name="cat14"></td>
    </tr>
    
    <tr>
        <td>Pengajar berinteraksi dengan peserta dan mampu menimbulkan antusiasme pembelajaran</td>
        <td><input type="radio" name="obs15" value="Ya">Ya &nbsp;<input type="radio" name="obs15" value="Tidak">Tidak</td>
        <td><input type="text" name="cat15"></td>
    </tr>
    
    <tr>
        <td>Pengajar memberikan contoh kasus dan berbagi pengalaman yang sesuai dengan materi</td>
        <td><input type="radio" name="obs16" value="Ya">Ya &nbsp;<input type="radio" name="obs16" value="Tidak">Tidak</td>
        <td><input type="text" name="cat16"></td>
    </tr>
    
    <tr>
        <td>Pengajar dapat menjawab pertanyaan yang diajukan oleh peserta</td>
        <td><input type="radio" name="obs17" value="Ya">Ya &nbsp;<input type="radio" name="obs17" value="Tidak">Tidak</td>
        <td><input type="text" name="cat17"></td>
    </tr>
    
    <tr>
        <td>Pengajar dapat membawakan materi pembelajaran sesuai dengan jadwal yang ditetapkan</td>
        <td><input type="radio" name="obs18" value="Ya">Ya &nbsp;<input type="radio" name="obs18" value="Tidak">Tidak</td>
        <td><input type="text" name="cat18"></td>
    </tr>
    
        <tr>
        <td colspan="3" style="background-color: #3baae3"><b>KOMPETENSI DAN KUALIFIKASI PENGAJAR</b></td>
    </tr>
    
    <tr>
        <td>Pengajar memiliki ilmu pengetahuan dan ketrampilan yang tepat untuk mengajarkan materi pembelajaran</td>
        <td><input type="radio" name="obs19" value="Ya">Ya &nbsp;<input type="radio" name="obs19" value="Tidak">Tidak</td>
        <td><input type="text" name="cat19"></td>
    </tr>
    
    <tr>
        <td>Pengajar dapat menggunakan alat bantu pembelajaran dengan aktif</td>
        <td><input type="radio" name="obs20" value="Ya">Ya &nbsp;<input type="radio" name="obs20" value="Tidak">Tidak</td>
        <td><input type="text" name="cat20"></td>
    </tr>
    <tr>
        <td colspan="3"><input type="submit" class="btn btn-success" value="Simpan"></td>
    </tr>  
</table>
    
<?php echo form_close(); ?>
            
            <script type="text/javascript">
        $(this).ready( function() {
            $("#trainer").autocomplete({
                minLength: 4,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/course/lookup",
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
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='trainer'/>"+ ui.item.value + "<a href='#' class='remove_trainer'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#trainer").hide();
		    $("#null_trainer").remove();
                }
                }
            });

            $('.remove_trainer').live('click', function() {
		$(this).parent().remove();
                $("#add_trainer").show();
		return false;
	    });

	    $("#add_trainer").click(function(){
		$("#trainer").show();
                $("#trainer").val('');
		$("#add_trainer").hide();
	    });
        });
        
</script>

<script type="text/javascript">
       $(this).ready( function() {
            $("#program").autocomplete({
                minLength: 4,
                source:
                function(req, add){
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/course/lookup_course",
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
                    $("#result_program").append(
                        "<tr><td><input type='hidden' value='"+ ui.item.id + "' name='program'/>"+ ui.item.value + "<a href='#' class='remove_program'><i class='icon-remove'></i></a></td><tr>"
                    );
		    $("#program").hide();
		    $("#null_program").remove();
                }
                }
            });

            $('.remove_program').live('click', function() {
		$(this).parent().remove();
                $("#add_program").show();
		return false;
	    });

	    $("#add_program").click(function(){
		$("#program").show();
		$("#program").val('');
		$("#add_program").hide();
	    });
        });
</script>