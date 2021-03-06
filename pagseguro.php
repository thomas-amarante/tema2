<?php

session_name('sessionuser');
session_start();

$pedido = preg_replace('/[^[:alnum:]-]/','',$_POST["idPedido"]); // recebe por post o id do pedido salvo no banco de dados. Nesse momento o banco de dados já possui um pedido a esper de atualização de status
$valor = $_SESSION["VALOR"];

// dados para a compra do cliente
$data['token'] = '8FDC81B6A9544EAB99B706D2411CE2E4'; // token de ambiente de teste - Sandbox
$data['email'] = 'thomasferreiraa@gmail.com'; // email usado para todos os ambientes
$data['currency'] = 'BRL';
$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = 'Reserva de local '.$pedido;
$data['itemAmount1'] = $valor;
$data['reference'] = $pedido; // referencia que liga o pedido salvo no banco de dados com o pedido do pagseguro - é o mais importenta atributo dessa página
$data['redirectURL']= 'https://acheiquadras.000webhostapp.com/pedido_finalizado.php';
$data['notificationURL']= 'https://acheiquadras.000webhostapp.com/notificacao.php';

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout'; // url para uso da lightbox em ambiente de teste - Sandbox

$data = http_build_query($data);

$curl = curl_init($url);
//biblioteca CURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
$xml= curl_exec($curl);

curl_close($curl);

$xml= simplexml_load_string($xml);

var_dump($xml);

echo $xml -> code;

?>