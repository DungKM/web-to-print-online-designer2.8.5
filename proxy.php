<?php
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$query = isset($_GET['query']) ? $_GET['query'] : '';
$input = json_decode(file_get_contents('php://input'), true);
$token = isset($input['api_key']) ? $input['api_key'] : '';

// Kiểm tra token
if (empty($token)) {
    echo json_encode(["error" => "API key is missing"]);
    exit;
}


// URL API của Freepik
$url = 'https://api.freepik.com/v1/icons?page=' . $page . '&query=' . urlencode($query);

// Gửi request đến Freepik API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'x-freepik-api-key: ' . $token, // Sử dụng token từ request
]);
$response = curl_exec($ch);

// Xử lý lỗi cURL
if (curl_errno($ch)) {
    echo json_encode(["error" => curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);
echo $response;
?>
