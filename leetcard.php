<?php
include 'memcache.php';
cache_init();

$card=cache_get('leetcard');
if (!$card){
	$curl=curl_init('https://leetcard.jacoblin.cool/thomastsoi?theme=light&font=Fauna%20One&ext=contest');
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
	curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
	curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,2);
	$card=curl_exec($curl);

	if ($card!=''){
		cache_set('leetcard',$card,1800);	
	}
}

header('Content-Type: image/svg+xml');
echo $card;

	