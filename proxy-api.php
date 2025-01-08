<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php' );
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$query = isset($_GET['query']) ? $_GET['query'] : '';

$apikey = get_option( 'nbdesigner_flaticon_api_key', '' );

if( empty( $apikey ) ) {
    echo json_encode(["error" => "API key is missing"]);
    exit;
}

$url = 'https://api.freepik.com/v1/icons?page=' . $page . '&query=' . urlencode($query);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'x-freepik-api-key: ' . $apikey,
]);

$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>