<?php
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"filename.xlsx\"");
header("Cache-Control: max-age=0");


echo $content;
?>
