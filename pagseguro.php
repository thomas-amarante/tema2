<?php

$pedido = preg_replace('/[^[:alnum:]-]/','',$_POST["idPedido"]);

$data['token'] = '8FDC81B6A9544EAB99B706D2411CE2E4';
$data['email'] = 'thomasferreiraa@gmail.com';
$data['currency'] = 'BRL';
$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = 'Pedido de teste '.$pedido;
$data['itemAmount1'] = '299.00';
$data['reference'] = $pedido;

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml= curl_exec($curl);

curl_close($curl);

$xml= simplexml_load_string($xml);

echo $xml -> code;

?>