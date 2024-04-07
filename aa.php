<?php
$data = '{"username":"supervolk2"}';
$token = "eyJhbGciOiJSUzUxMiJ9.eyJodHRwczovL2hhc3VyYS5pby9qd3QvY2xhaW1zIjp7IngtaGFzdXJhLWRlZmF1bHQtcm9sZSI6InZhbmEtdXNlciIsIngtaGFzdXJhLWFsbG93ZWQtcm9sZXMiOlsicHVibGljIiwidmFuYS11c2VyIl0sIngtaGFzdXJhLXVzZXItaWQiOiJhNzRmOGE3NC1lN2Y1LTRiM2UtYTFkMy00MjVjYzU5MjIyMWMifSwid2FsbGV0X2FkZHJlc3MiOiIweDhkM2EzMjJDOERkMGE4MzdlNjBiMzhBRTFDMTU1ZDc3MTQyQjFGRjQiLCJpYXQiOjE3MTI1Mjg5NzYsImlzcyI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImF1ZCI6Imh0dHBzOi8vYXBpLnZhbmEuY29tLyIsImV4cCI6MTcxMzEzMzc3Niwic3ViIjoiYTc0ZjhhNzQtZTdmNS00YjNlLWExZDMtNDI1Y2M1OTIyMjFjIn0.ll19m-GC2H9o_EXJ87EeRtoZBmrAqJ7ncWEqlMl9BFicOnIEIQMDNCDIpqhK9p16l2VUSouMJ3CAyH5I9xWAfsA1aAex9sGB9ksaGIXQMk7C_ust7Z3Qv0Foa2V7XBaxjTYBeuDt7dy3gxzXJyLlQXELT0NTkr2Rc11olBtZTQHBGeGez4RFBDO_GCLm-mt6wgWo72uzr8RmjXHswJMHi184VutvG4h3KE0pdsKo8slQqv6tJtPvrF4SysR9IUkbUCb4AFgB7o1maw_5oGA60bI8qIuCv288LnB2ODT4PoOne22-SfbhHa53STqlFMwvsDGhmi1-2nHrXZGgdFCogA";


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
