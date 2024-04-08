<?php
$data = '{"username":"43gstw8l"}';
$token = "eyJhbGciOiJSUzUxMiJ9.eyJodHRwczovL2hhc3VyYS5pby9qd3QvY2xhaW1zIjp7IngtaGFzdXJhLWRlZmF1bHQtcm9sZSI6InZhbmEtdXNlciIsIngtaGFzdXJhLWFsbG93ZWQtcm9sZXMiOlsicHVibGljIiwidmFuYS11c2VyIl0sIngtaGFzdXJhLXVzZXItaWQiOiI1NzNkODViMy1mYTlmLTQ1ZjctOTdiYS01YTYyYjgzMzc0ZTIifSwid2FsbGV0X2FkZHJlc3MiOiIweDU5NjI4NTRFNjU1ODU5MGRhOTUyQTRGRUU0OTJBNDFkNkFiRjhhZDIiLCJpYXQiOjE3MTI1MzY0ODMsImlzcyI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImF1ZCI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImV4cCI6MTcxMzE0MTI4Mywic3ViIjoiNTczZDg1YjMtZmE5Zi00NWY3LTk3YmEtNWE2MmI4MzM3NGUyIn0.RqeZ3xadYl2E6uPhzvdyw3ZkMiPCM1EGrycLn_MqvRlw1mkR5rP8z-6uHYYan-3EGW900cJ_wZKHv2l0qQ60uoIRv0LwcWUX4cNjcn0sL1AmkQ59M1wZNySBO1MXFNqIUk0JQr-oDlLySPRBajKmNDoUyTj7GSbPcIsl3OHoWGv7KbpE1WwpekQv7uPlO2n2t-9pOmkEJr7MxyD5K9HLwafDmXJw0uCNiuk-Au2Sest9RPUlq3yBBknGR745HA4nJqio8nIIYV49HQy6j4UWfsBLNC49oSplK4pv9ZZkwD9bofYgmyhv7GGRZXnoIharF2nR72WU0H-O2AKTJAGzNA";


$headers = [
    "Host: api.vana.com",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0",
    "Accept: */*",
    "Accept-Language: en-US,en;q=0.5",
    "Referer: https://www.rdatadao.org/",
    "Authorization: Bearer ".$token,
    "Content-Type: application/json",
    "Content-Length: ".strlen($data),
    "Origin: https://www.rdatadao.org",
    "Sec-Fetch-Dest: empty",
    "Sec-Fetch-Mode: cors",
    "Sec-Fetch-Site: cross-site",
    "Te: trailers",
];

do {
    $response = curl("https://api.vana.com/api/v0/verification/reddit", $data, $headers);
    echo "Response: " . $response[1] . "\n";
    if (strpos($response[1], '"success":true,') !== false) {
        break;
    }
} while (true);


function curl($url, $post = 0, $httpheader = 0, $proxy = 0) { 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    if($post){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    if($httpheader){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    }
    if($proxy){
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch);
    if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
        $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        curl_close($ch);
        return array($header, $body);
    }
}
