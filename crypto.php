#!/usr/bin/php
<?php

# let it running in background
# bash~$ php crypto.php &

function toFloat($str){
	return floatval(str_replace(",", ".", $str));
}

function main(){
	$btc = toFloat(file_get_contents("https://dolarhoje.com/bitcoin-hoje/cotacao.txt"));
	$eth = toFloat(file_get_contents("https://dolarhoje.com/ethereum/cotacao.txt"));
	$doge = toFloat(file_get_contents("https://dolarhoje.com/dogecoin-hoje/cotacao.txt"));
	$fp = fopen("crypto.db", "a+");
	fwrite($fp, $btc."|".$eth."|".$doge."|".time()."\n");
}

function run(){
	$repeat = 3600; // 1h
	$next = microtime(true) + $repeat;
	while(true){
		if(microtime(true) >= $next){
			main();
			$next = microtime(true) + $repeat;
		}
	}
}

run();

?>
