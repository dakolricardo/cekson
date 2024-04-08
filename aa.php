<?php
$data = '{"username":"76hsso8l"}';
$token = "eyJhbGciOiJSUzUxMiJ9.eyJodHRwczovL2hhc3VyYS5pby9qd3QvY2xhaW1zIjp7IngtaGFzdXJhLWRlZmF1bHQtcm9sZSI6InZhbmEtdXNlciIsIngtaGFzdXJhLWFsbG93ZWQtcm9sZXMiOlsicHVibGljIiwidmFuYS11c2VyIl0sIngtaGFzdXJhLXVzZXItaWQiOiI2NjIwZDU1Zi0zOWIxLTQxOGItOTYyMi1kYTY3OWJjNGUxOTAifSwid2FsbGV0X2FkZHJlc3MiOiIweEM2ODkyYzJENkRhMkZCZTA5YzFFMDM4QTNlODJBODUzRjk2OTk0ZWMiLCJpYXQiOjE3MTI1MzUwMTEsImlzcyI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImF1ZCI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImV4cCI6MTcxMzEzOTgxMSwic3ViIjoiNjYyMGQ1NWYtMzliMS00MThiLTk2MjItZGE2NzliYzRlMTkwIn0.Uad0Q5x2wLhEFeAEKa6ovMgqyDVG2sDZ_YqA2YoxPviEu1l9AEbVIa62D79O2_08qkbCwSG1IvSCnkYSJxIJDHqwYKmSAc03124amxQLIMMSJUnrEbJ1ATxvpsJnpkBKMFqkN3cUR2Y1gae9dOPDRLot4b1ETIWPaNohCPtXkEQ4apLL9B6FUIFUzx6WYC0raBLNCIABDGB64CvBY3sGAhz_ZNR0DSs8kr4T8eI-uIoxgjXhFkCSFRQifyYJZwbQBNNaj09XeOqCvAtgTgpD3SA_Qm0WfoNe8M0X9SqXe3encykbzvZlS_jalUc0QnHG02CLIRdGhZ5Bh4lUfXIKRQ";


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
