#!/usr/bin/php
<?php

# Gets a db file and your coins amount
# and generates the same table but with your total money (in reais)

const b = 0.01;  // bitcoin  amount
const e = 0.15;  // ethereum amount
const d = 200.0; // dogecoin amount

$db_file = "crypto.db"; //file with prices

if(!file_exists($db_file)) die("Couldn't find database file.");

$db = explode("\n", file_get_contents($db_file));
$parsed_db = [];

for($i=0;$i<count($db);$i++){
	if(strpos($db[$i],"|") == false) continue; //jump blank lines
	$data= explode("|", $db[$i]); // split on "|"
	$btc = number_format((float)$data[0], 2, '.', '');
	$eth = number_format((float)$data[1], 2, '.', '');
	$dog = number_format((float)$data[2], 2, '.', '');
	$time= $data[3];
	array_push($parsed_db, $btc."|".$eth."|".$dog.";".$time);
	echo date("d/m/Y H:i:s", $time)." | ".$btc." | ".$eth." | ".$dog." | R$".number_format($btc*b + $eth*e + $dog*d,2)."\n";
}
