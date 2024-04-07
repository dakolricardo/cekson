<?php
$data = '{"username":"7haytaal"}';
$token = "eyJhbGciOiJSUzUxMiJ9.eyJodHRwczovL2hhc3VyYS5pby9qd3QvY2xhaW1zIjp7IngtaGFzdXJhLWRlZmF1bHQtcm9sZSI6InZhbmEtdXNlciIsIngtaGFzdXJhLWFsbG93ZWQtcm9sZXMiOlsicHVibGljIiwidmFuYS11c2VyIl0sIngtaGFzdXJhLXVzZXItaWQiOiIyODg5NTI3ZC03Y2UyLTQyODMtOWMxZC02NTJhMzZjODAzYjEifSwid2FsbGV0X2FkZHJlc3MiOiIweEZjNEM5ZUExM0Q2N2FmQ2I2MjQwMWRjMTM0OWY3N2Q2ZjQ5QTE1M2QiLCJpYXQiOjE3MTI1Mjk2OTAsImlzcyI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImF1ZCI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImV4cCI6MTcxMzEzNDQ5MCwic3ViIjoiMjg4OTUyN2QtN2NlMi00MjgzLTljMWQtNjUyYTM2YzgwM2IxIn0.XwALECEiuHNAwPkA_MKvJtjpXVEi0QmuNgLgJ4WWQD6XEnuDrs2Zvv8x-yrU_imdGfEVTBqU0N-4V3KR8cvTzJhYMe8zcvsuCTVEZPBhZrMS6aLw1vVzg0hb09aIXLmpcTLPuKHnXcL5Kkhb3cqzJitY6u7YMs8YQV_QvJBpbRP-n3XgT0yoIAKibqaF98CUIOY3C8RPb2_ubgBkFiirsRkBWg8lklVEkoRyDCkl2NuPJ_nfjGX-s_LOH72otrV-Pjnzy0N8RAv4xWHbRvzmvb_LfO3FEzo0j0qJAj0lNAJzRW0-5aHb_WK8KFVqR-d4ojycK46sd8wGaZHBRRgkLA";


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
