<?php
date_default_timezone_set('Asia/Tehran');
$date = new DateTime("now", new DateTimeZone('Asia/Tehran') );
echo strtotime(strftime("2020-5-31"))+43200;
echo "</br></br>";
echo strtotime(strftime("2020-5-31 24:00:00"));
echo "</br></br>";
echo strtotime(strftime("2020-6-1"));
echo "</br></br>";
echo strtotime($date->format('Y-m-d H:i:s'));
echo "</br></br>";
echo time();
