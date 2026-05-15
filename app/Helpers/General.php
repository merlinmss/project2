<?php
use Illuminate\Support\Facades\Auth;

if (!function_exists('dropdownData')){
    function dropdownData($data,$value,$label,$label2='',$pHolder='') { $res =   [];
        if($pHolder != ''){ $res[''] = $pHolder; }
        if($data){ foreach($data as $row){ if($label2 != ''){ $res[$row->$value] = $row->$label.' '.$row->$label2; }else{ $res[$row->$value] = $row->$label; } } } return $res;
    }
 }
if (!function_exists('getDuration')){
    function getDuration($start,$end, $type=''){
        $startTime = $start; $endTime   = $end;
        $diff                           =   $startTime->diff($endTime);
        if($type != ''){ return $diff   ->  $type; }
        $duration                       =   $diff->i;
        if($diff->h > 0) { $duration    =   $duration+($diff->h*60); }
        if($diff->d > 0) { $duration    =   $duration+(($diff->d*24)*60); }
        return $duration;
    }
}
if (!function_exists('encryptString')){
    function encryptString($value){
        $key            =   env('ENCRYPT_KEY');
        $iv             =   substr(hash('sha256', 'agentic'), 0, 16);
        $encrypted      =   openssl_encrypt($value, 'AES-256-CBC', $key, 0, $iv);
        return $encrypted;
    }
}if (!function_exists('decryptString')){
    function decryptString($value){
        $key            =   env('ENCRYPT_KEY');
        $iv             =   substr(hash('sha256', 'agentic'), 0, 16);
        $decrypted      =   openssl_decrypt($value, 'AES-256-CBC', $key, 0, $iv);
        return $decrypted;
    }
}
if (!function_exists('encodeNumber')) {
    function encodeNumber($num)
    {
        $key = "Agentic@4321";
        $encrypted = openssl_encrypt($num, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
        return bin2hex($encrypted); // converts to letters and numbers only
    }
}if (!function_exists('decodeNumber')) {
    function decodeNumber($num)
    {
        $key = "Agentic@4321";
        $data = hex2bin($num);
        return openssl_decrypt($data, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    }
}
if (!function_exists('trimmedPhone')) {
    function trimmedPhone($num)
    {
        $phone          =   preg_replace('/\s+/', '', $num);
       // $last_nine      =   substr($cleanedPhone, -9);
        if($phone[0]    ==  0){ $phone = mb_substr($phone, 1); }
     //   $length         =   strlen($phone);
        return (int)$phone;
    }
}
if (!function_exists('createRandomString')) {
    function createRandomString($length){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}





