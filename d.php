<?php

$dates = array();
$dates[] = time();

for ($i = 1; $i < 60; $i++) { $dates[] = strtotime("+{$i} days"); }


$html = NULL;

foreach ($dates as $date) { $dates .= "<option value='" . date('Ymd', $date) . "'>" . date('d F Y', $date) . "</option>"; }

$html = "<select id='dates'>{$dates}</select>";

echo $html; 

?>