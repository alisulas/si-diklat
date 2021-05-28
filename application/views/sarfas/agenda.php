<html lang="en">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="3600">
    <title>Monitoring Pembelajaran | Pertamina Corporate University</title>
    <link rel="shortcut icon" href="favicon.ico" />

    <link type="text/css" href="assets/bootstrap/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/bootstrap/bootstrap-responsive.css" rel="stylesheet">
    <link type="text/css" href="assets/css/style.css" rel="stylesheet" />
    <link type="text/css" href="assets/up/uploadify.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/jquery.fileupload-ui.css" rel="stylesheet" />
    <link rel='stylesheet' type='text/css' href='assets/js/fullcalendar/fullcalendar.css' />
    <link rel='stylesheet' type='text/css' href='assets/js/fullcalendar/fullcalendar.print.css' media='print' />

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

    <!--scripts-->
    <script type="text/javascript" src="assets/bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/tm/jquery.tinymce.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap-transition.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap-tooltip.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/google-code-prettify/prettify.js"></script>
    <script type="text/javascript" src="assets/js/sisfo.js"></script>
    <script type="text/javascript" src="assets/js/jquery.totemticker.js"></script>
    <script type="text/javascript" src="assets/js/jquery.totemticker.min.js"></script>
    <style type="text/css">
    #vertical-ticker {
        height: 400px;
        overflow: hidden;
        margin: 0;
        padding: 0;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .4);
        list-style: none;
    }

    .judul {
        font-size: 26px;
        font-weight: bold;
        line-height: 100%;
        font-family: Helvetica Neue, times, serif;
        color: #0E4B9D;
    }

    .tempat {
        font-size: 20px;
        font-weight: bold;
        font-family: Helvetica Neue, times, serif;
        color: #FB000C;
    }

    .tanggal {
        font-size: 20px;
        font-weight: bold;
        font-family: Helvetica Neue, times, serif;
        color: #3B9611;
    }

    .na {
        overflow: visible;
    }

    #vertical-ticker li {
        padding: 20px 20px;
        display: block;
        background: #efefef;
        color: #333;
        border-bottom: 1px solid #ddd;
        text-align: center;

    }
    </style>
    <script type="text/javascript">
    $(function() {
        $('#vertical-ticker').totemticker({
            row_height: '130px', // Height of each ticker row in PX
            next: '#ticker-next', // ID of next button or link
            previous: '#ticker-previous', // ID of previous button or link
            stop: '#stop', // ID of stop button or link
            start: '#start', // ID of start button or link
            mousestop: false, // Stop while mouse is hovers over it
            speed: 500, // Speed of transition animation (ms)
            interval: 3000, // Time between change (ms)
            max_items: 4 // Maximum items to display 
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Create two variable with the names of the months and days in an array
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ];
        var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

        // Create a newDate() object
        var newDate = new Date();
        // Extract the current date from Date object
        newDate.setDate(newDate.getDate());
        // Output the day, date, month and year    
        $('#Date').html(dayNames[newDate.getDay()] + ", " + newDate.getDate() + ' ' + monthNames[newDate
            .getMonth()] + ' ' + newDate.getFullYear());

        setInterval(function() {
            // Create a newDate() object and extract the seconds of the current time on the visitor's
            var seconds = new Date().getSeconds();
            // Add a leading zero to seconds value
            $("#sec").html((seconds < 10 ? "0" : "") + seconds);
        }, 1000);

        setInterval(function() {
            // Create a newDate() object and extract the minutes of the current time on the visitor's
            var minutes = new Date().getMinutes();
            // Add a leading zero to the minutes value
            $("#min").html((minutes < 10 ? "0" : "") + minutes);
        }, 1000);

        setInterval(function() {
            // Create a newDate() object and extract the hours of the current time on the visitor's
            var hours = new Date().getHours();
            // Add a leading zero to the hours value
            $("#hours").html((hours < 10 ? "0" : "") + hours);
        }, 1000);

    });
    </script>
    <style type="text/css">
    @font-face {
        font-family: 'BebasNeueRegular';
        src: url('assets/font/BebasNeue-webfont.eot');
        src: url('assets/font/BebasNeue-webfont.eot?#iefix') format('embedded-opentype'),
            url('assets/font/BebasNeue-webfont.woff') format('woff'),
            url('assets/font/BebasNeue-webfont.ttf') format('truetype'),
            url('assets/font/BebasNeue-webfont.svg#BebasNeueRegular') format('svg');
        font-weight: normal;
        font-style: normal;

    }

    .clock {
        margin-bottom: -25px;
    }

    #Date {
        color: #0E4B9D;
        font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
        font-size: 20px;
        text-align: right;
    }

    ul {
        color: #FB000C;
        margin-top: -9px;
        padding: 0px;
        list-style: none;
        text-align: right;
    }

    ul li {
        display: inline;
        font-size: 3em;
        text-align: center;
        font-family: 'BebasNeueRegular', Arial, Helvetica, sans-serif;
    }

    #point {
        position: relative;
        -moz-animation: mymove 1s ease infinite;
        -webkit-animation: mymove 1s ease infinite;
        padding-left: 10px;
        padding-right: 10px;
    }

    @-webkit-keyframes mymove {
        0% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }

        50% {
            opacity: 0;
            text-shadow: none;
        }

        100% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }
    }


    @-moz-keyframes mymove {
        0% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }

        50% {
            opacity: 0;
            text-shadow: none;
        }

        100% {
            opacity: 1.0;
            text-shadow: 0 0 20px #00c6ff;
        }
    }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="row">
            <!-- Header -->
            <div class="span10 logo">
                <a href="<?php echo site_url(); ?>"><img src="assets/img/logo-pcu.png" height="60" /></a>
            </div>
            <div class="nav pull-right">
                <!--
		   <div class="clock">
                       <div id="Date"></div><br>
<ul>
	<li id="hours"> </li>
    <li id="point">:</li>
    <li id="min"> </li>
    <li id="point">:</li>
    <li id="sec"> </li>
</ul>

</div>
      -->
            </div>

        </div>

        <div class="row">
            <div class="span12">
                <div class="na">
                    <div class="navbar-inner">
                        <h1 style="text-align:center;color: #fff">This Week's Events ku</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <div class="content">
                    <h1>Coba bro</h1>

                    <?php
                    foreach ($fieldku as $field) {
                        echo $field;
                    } ?>


                    <?php // echo "Tanggal ".date("Y-m-d",strtotime('monday this week')).' S/D  Tanggal'.date("Y-m-d",strtotime('sunday this week')); 
                    ?>
                    <p style="font-size: 15px">
                        <!-- <marquee direction="up" scrollamount="1" height="400px"> -->
                        <?php // echo $course;
                        ?>
                    <ul id="vertical-ticker">
                        <?php echo $list; ?>

                    </ul>
                </div>
            </div>
            <div class="clear"></div>


        </div>


    </div>
</body>

</html>