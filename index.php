<?php

$timeout = "1";
$services = array();

$services[] = array("port" => "80",       "service" => "session.minecraft.net",                  "ip" => "session.minecraft.net") ;
$services[] = array("port" => "80",       "service" => "authserver.mojang.com",                  "ip" => "authserver.mojang.com") ;
$services[] = array("port" => "80",       "service" => "textures.minecraft.net",                  "ip" => "textures.minecraft.net") ;
$services[] = array("port" => "80",       "service" => "api.mojang.com",                  "ip" => "api.mojang.com") ;
$services[] = array("port" => "80",       "service" => "minecraft.net",                  "ip" => "minecraft.net") ;
$services[] = array("port" => "80",       "service" => "account.mojang.com",                  "ip" => "account.mojang.com") ;

$data .= "[";
foreach ($services  as $service) {
	if($service['ip']==""){
	   $service['ip'] = "localhost";
	}
	$data .= "{".json_encode($service['service']).":";

	$fp = @fsockopen($service['ip'], $service['port'], $errno, $errstr, $timeout);
	if (!$fp) {
		$data .= json_encode("red")."},";
	} else {
		$data .= json_encode("green")."},";
		fclose($fp);
	}

}
$data .= "}]";
header('Content-type: application/json; charset=UTF-8');
echo str_replace(",}]", "]", $data);

?>