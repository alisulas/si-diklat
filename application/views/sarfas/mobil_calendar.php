<link rel="stylesheet" href="assets/eventcalendar/css/eventCalendar.css">
<link rel="stylesheet" href="assets/eventcalendar/css/eventCalendar_theme_responsive.css">
<script src="assets/eventcalendar/js/jquery.eventCalendar.js" type="text/javascript"></script>

<table style="width: 100%">
    <tr>
        <td style="width: 25%">

            <h3>Mobil 1</h3>
            <div id="eventCalendar1"></div>



            <script>
            $(document).ready(function() {
                $("#eventCalendar1").eventCalendar({
                    eventsjson: "<?php echo site_url(); ?>sarfas/get_mobil/1", // link to events json
                    eventsScrollable: true
                });
            });
            </script>

        </td>
        <td style="width: 25%">

            <h3>Mobil 2</h3>
            <div id="eventCalendar2"></div>
            <script>
            $(document).ready(function() {
                $("#eventCalendar2").eventCalendar({
                    eventsjson: '<?php echo site_url(); ?>sarfas/get_mobil/2',
                    eventsScrollable: true
                });
            });
            </script>

        </td>
        <td style="width: 25%">


            <h3>Mobil 3</h3>
            <div id="eventCalendar3"></div>



            <script>
            $(document).ready(function() {
                $("#eventCalendar3").eventCalendar({
                    eventsjson: '<?php echo site_url(); ?>sarfas/get_mobil/3', // link to events json
                    eventsScrollable: true
                });
            });
            </script>

        </td>
        <td style="width: 25%">


            <h3>Mobil 4</h3>
            <div id="eventCalendar4"></div>

            <script>
            $(document).ready(function() {
                $("#eventCalendar4").eventCalendar({
                    eventsjson: '<?php echo site_url(); ?>sarfas/get_mobil/4',
                    eventsScrollable: true
                });
            });
            </script>

        </td>
    </tr>
</table>

<script type="text/javascript">
$(function() {
    $("#start_date").datepicker({
        changeMonth: true,
        changeYear: true,
        altFormat: 'yy-mm-dd',
        dateFormat: 'yy-mm-dd'
    });

});
</script>