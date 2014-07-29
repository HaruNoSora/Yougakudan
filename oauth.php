<?php 

session_start(); 

class oauth 
{ 
 public function __construct($consumer_key = NULL,$consumer_secret = NULL,$access_token = NULL,$access_token_secret = NULL) 
 { 
  $this->oauth_callback = "oob"; 
  if(isset($consumer_key,$consumer_secret)) 
  { 
   $this->oauth_consumer_key = $_SESSION["consumer_key"] = $consumer_key; 
   $this->oauth_consumer_secret = $_SESSION["consumer_secret"] = $consumer_secret; 
  } 
  else 
  { 
   $this->oauth_consumer_key = $_SESSION["consumer_key"]; 
   $this->oauth_consumer_secret = $_SESSION["consumer_secret"]; 
  } 
  if(isset($access_token,$access_token_secret)) 
  { 
   $this->oauth_token = $_SESSION["access_token"] = $access_token; 
   $this->oauth_token_secret = $_SESSION["access_token_secret"] = $access_token_secret; 
  } 
  else if(isset($_SESSION["access_token"],$_SESSION["access_token_secret"])) 
  { 
   $this->oauth_token = $_SESSION["access_token"]; 
   $this->oauth_token_secret = $_SESSION["access_token_secret"]; 
  } 
  else 
  { 
   $this->oauth_token = NULL; 
   $this->oauth_token_secret = NULL; 
  } 
  $this->oauth_verifier = NULL; 
 } 
 public function oauth($param = NULL) 
 { 
  if(isset($param["oauth_verifier"])) 
  { 
   $this->oauth_verifier = $param["oauth_verifier"]; 
   $response = $this->curl("POST","https://api.twitter.com/oauth/access_token"); 
  } 
  else if(isset($param["username"],$param["password"])) 
  { 
   $param["x_auth_mode"] = "client_auth"; 
   $param["x_auth_username"] = $param["username"]; 
   $param["x_auth_password"] = $param["password"]; 
   $response = $this->curl("POST","https://api.twitter.com/oauth/access_token",$param); 
  } 
  else 
  { 
   $response = $this->curl("POST","https://api.twitter.com/oauth/request_token"); 
  } 
  foreach(explode("&",$response) as $val) 
  { 
   $param = explode("=",$val); 
   $token[$param[0]] = $param[1]; 
  } 
  $_SESSION["access_token"] = $token["oauth_token"]; 
  $_SESSION["access_token_secret"] = $token["oauth_token_secret"]; 
  return $token; 
 } 
 public function request($method,$api,$param = NULL) 
 { 
  $response = $this->curl($method,"https://api.twitter.com/1.1/" . $api . ".json",$param); 
  return json_decode($response); 
 } 
 public function multi_request($method,$api,$param = NULL) 
 { 
  if(isset($param)) 
  { 
   return $this->curl_multi($method,"https://api.twitter.com/1.1/" . $api . ".json",$param); 
  } 
  else 
  { 
   foreach($api as $val) 
   { 
    $urls[] = "https://api.twitter.com/1.1/" . $val . ".json"; 
   } 
   return $this->curl_multi($method,$urls); 
  } 
 } 
 private function curl($method,$url,$param = NULL) 
 { 
  $array["oauth_callback"] = $this->oauth_callback; 
  $array["oauth_consumer_key"] = $this->oauth_consumer_key; 
  $array["oauth_nonce"] = md5(uniqid(mt_rand())); 
  $array["oauth_signature_method"] = "HMAC-SHA1"; 
  $array["oauth_timestamp"] = time(); 
  $array["oauth_token"] = $this->oauth_token; 
  $array["oauth_verifier"] = $this->oauth_verifier; 
  $array["oauth_version"] = "1.0"; 
  $signature_array = $array; 
  if(isset($param)) 
  { 
   foreach($param as $key => $val) 
   { 
    $signature_array[$key] = $val; 
   } 
   ksort($signature_array); 
  } 
  $signature_base_string = ""; 
  foreach($signature_array as $key => $val) 
  { 
   $signature_base_string .= $key . "=" . rawurlencode($val) . "&"; 
  } 
  $signature_base_string = substr($signature_base_string,0,-1); 
  $signature_base_string = $method . "&" . rawurlencode($url) . "&" . rawurlencode($signature_base_string); 
  $signing_key = rawurlencode($this->oauth_consumer_secret) . "&" . rawurlencode($this->oauth_token_secret); 
  $array["oauth_signature"] = base64_encode(hash_hmac("sha1",$signature_base_string,$signing_key,true)); 
  $http_header = "Authorization:OAuth "; 
  foreach($array as $key => $val) 
  { 
   $http_header .= $key . "=\"" . rawurlencode($val) . "\","; 
  } 
  $http_header = substr($http_header,0,-1); 
  if(isset($param)) 
  { 
   $url .= "?" . http_build_query($param); 
  } 
  $curl = curl_init(); 
  curl_setopt($curl,CURLOPT_URL,$url); 
  if($method === "POST") 
  { 
   curl_setopt($curl,CURLOPT_POST,true); 
   curl_setopt($curl,CURLOPT_POSTFIELDS,$param); 
  } 
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true); 
  curl_setopt($curl,CURLOPT_HTTPHEADER,array($http_header,"Content-Length:","Expect:")); 
  $response = curl_exec($curl); 
  curl_close($curl); 
  return $response; 
 } 
 private function curl_multi($method,$urls,$params = NULL) 
 { 
  $curl_multi = curl_multi_init(); 
  if(isset($params)) 
  { 
   foreach($params as $i => $param) 
   { 
    $url = $urls; 
    $array = array(); 
    $array["oauth_consumer_key"] = $this->oauth_consumer_key; 
    $array["oauth_nonce"] = md5(uniqid(mt_rand())); 
    $array["oauth_signature_method"] = "HMAC-SHA1"; 
    $array["oauth_timestamp"] = time(); 
    $array["oauth_token"] = $this->oauth_token; 
    $array["oauth_version"] = "1.0"; 
    $signature_array = $array; 
    if(isset($param)) 
    { 
     foreach($param as $key => $val) 
     { 
      $signature_array[$key] = $val; 
     } 
     ksort($signature_array); 
    } 
    $signature_base_string = ""; 
    foreach($signature_array as $key => $val) 
    { 
     $signature_base_string .= $key . "=" . rawurlencode($val) . "&"; 
    } 
    $signature_base_string = substr($signature_base_string,0,-1); 
    $signature_base_string = $method . "&" . rawurlencode($url) . "&" . rawurlencode($signature_base_string); 
    $signing_key = rawurlencode($this->oauth_consumer_secret) . "&" . rawurlencode($this->oauth_token_secret); 
    $array["oauth_signature"] = base64_encode(hash_hmac("sha1",$signature_base_string,$signing_key,true)); 
    $http_header = "Authorization:OAuth "; 
    foreach($array as $key => $val) 
    { 
     $http_header .= $key . "=\"" . rawurlencode($val) . "\","; 
    } 
    $http_header = substr($http_header,0,-1); 
    if(isset($param)) 
    { 
     $url .= "?" . http_build_query($param); 
    } 
    $curl[$i] = curl_init(); 
    curl_setopt($curl[$i],CURLOPT_URL,$url); 
    if($method === "POST") 
    { 
     curl_setopt($curl[$i],CURLOPT_POST,true); 
     curl_setopt($curl[$i],CURLOPT_POSTFIELDS,$param); 
    } 
    curl_setopt($curl[$i],CURLOPT_RETURNTRANSFER,true); 
    curl_setopt($curl[$i],CURLOPT_HTTPHEADER,array($http_header,"Content-Length:","Expect:")); 
    curl_multi_add_handle($curl_multi,$curl[$i]); 
   } 
   $active = NULL; 
   do 
   { 
    curl_multi_exec($curl_multi,$active); 
   } 
   while($active > 0); 
   foreach($curl as $val) 
   { 
    $response[] = json_decode(curl_multi_getcontent($val)); 
    curl_multi_remove_handle($curl_multi,$val); 
   }  
   curl_multi_close($curl_multi); 
   return $response; 
  } 
  else 
  { 
   foreach($urls as $i => $url) 
   { 
    $array = array(); 
    $array["oauth_consumer_key"] = $this->oauth_consumer_key; 
    $array["oauth_nonce"] = md5(uniqid(mt_rand())); 
    $array["oauth_signature_method"] = "HMAC-SHA1"; 
    $array["oauth_timestamp"] = time(); 
    $array["oauth_token"] = $this->oauth_token; 
    $array["oauth_version"] = "1.0"; 
    $signature_array = $array; 
    $signature_base_string = ""; 
    foreach($signature_array as $key => $val) 
    { 
     $signature_base_string .= $key . "=" . rawurlencode($val) . "&"; 
    } 
    $signature_base_string = substr($signature_base_string,0,-1); 
    $signature_base_string = $method . "&" . rawurlencode($url) . "&" . rawurlencode($signature_base_string); 
    $signing_key = rawurlencode($this->oauth_consumer_secret) . "&" . rawurlencode($this->oauth_token_secret); 
    $array["oauth_signature"] = base64_encode(hash_hmac("sha1",$signature_base_string,$signing_key,true)); 
    $http_header = "Authorization:OAuth "; 
    foreach($array as $key => $val) 
    { 
     $http_header .= $key . "=\"" . rawurlencode($val) . "\","; 
    } 
    $http_header = substr($http_header,0,-1); 
    $curl[$i] = curl_init(); 
    curl_setopt($curl[$i],CURLOPT_URL,$url); 
    if($method === "POST") 
    { 
     curl_setopt($curl[$i],CURLOPT_POST,true); 
    } 
    curl_setopt($curl[$i],CURLOPT_RETURNTRANSFER,true); 
    curl_setopt($curl[$i],CURLOPT_HTTPHEADER,array($http_header,"Content-Length:","Expect:")); 
    curl_multi_add_handle($curl_multi,$curl[$i]); 
   } 
   $active = NULL; 
   do 
   { 
    curl_multi_exec($curl_multi,$active); 
   } 
   while($active > 0); 
   foreach($curl as $val) 
   { 
    $response[] = json_decode(curl_multi_getcontent($val)); 
    curl_multi_remove_handle($curl_multi,$val); 
   }  
   curl_multi_close($curl_multi); 
   return $response; 
  } 
 } 
} 

?>