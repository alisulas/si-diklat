<script type='text/javascript' src='assets/js/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript' src='assets/bootstrap/js/bootstrap-tab.js'></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-modal.js"></script>
<script type="text/javascript" language="javascript" src="assets/js/swfobject.js"></script>
<div class="title">
Informasi Pelatihan
</div>
<br />
	    <div id='loading' style='display:none'>loading...</div>
	    <div id='calendar'></div>

<script type="text/javascript">
    $('#calendar').fullCalendar({
        			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
                        
                        buttonText: {
    today: 'Hari Ini',
    month: 'Bulanan',
    week: 'Mingguan',
    day: 'Harian'
   },
	    editable: false,
	    events: "<?php echo site_url();?>login/event",            
	    loading: function(bool) {
		    if (bool) $('#loading').show();
		    else $('#loading').hide();
	    }

    });
    
    
    
</script>
