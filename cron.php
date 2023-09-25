<?php

$url = 'https://alter.reviverepossivel.com/BQB/BQB_ultima_leitura.rule?sys=FFF';

$options = array(
    CURLOPT_RETURNTRANSFER => true,   // return web page
    CURLOPT_HEADER         => false,  // don't return headers
    CURLOPT_FOLLOWLOCATION => true,   // follow redirects
    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
    CURLOPT_ENCODING       => "",     // handle compressed
    CURLOPT_USERAGENT      => "test", // name of client
    CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
    CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
    CURLOPT_TIMEOUT        => 120,    // time-out on response
); 

$ch = curl_init($url);
curl_setopt_array($ch, $options);

$content  = curl_exec($ch);
curl_close($ch);

if(substr($content,0,15) == 'Erro na leitura'){

    echo "Erro na leitura";

    $urlBOT = 'https://api.telegram.org/bot6206885895:AAHt6bMOOzJb4kny1ngWREN5rbB9VsKlt6U/sendMessage?chat_id=-904703165&text='.urlencode($content);

    $chBOT = curl_init($urlBOT);
    
    $contentBOT  = curl_exec($chBOT);
    if (curl_errno($chBOT)) { 
        print curl_error($chBOT); 
    } 
    
    curl_close($chBOT);
    
    echo $contentBOT;

}elseif($content == 'OK'){

    echo "OK";

}elseif($content == '3 erros seguidos'){

    echo "3 erros seguidos";

}else{

    echo "falha";

    $urlBOT = 'https://api.telegram.org/bot6206885895:AAHt6bMOOzJb4kny1ngWREN5rbB9VsKlt6U/sendMessage?chat_id=-904703165&text=Sistema%20com%20falha%20nao%20especificada';

    $chBOT = curl_init($urlBOT);
    
    $contentBOT  = curl_exec($chBOT);
    if (curl_errno($chBOT)) { 
        print curl_error($chBOT); 
    } 
    
    curl_close($chBOT);
    
    echo $contentBOT;
    
    header("HTTP/1.1 500 Internal Server Error");
    
}