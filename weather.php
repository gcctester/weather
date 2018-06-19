<?php

function requestByKey()
{
        //准备请求参数
        $key ="4bacfd8a6535436a852513b54416e28b";
        $location = "汕头";
        $curlPost = "key=".$key."&location=".urlencode($location);
        //初始化请求链接
        $req=curl_init();
        //设置请求链接
        curl_setopt($req, CURLOPT_URL,'https://free-api.heweather.com/s6/weather/now?'.$curlPost);
        //设置超时时长(秒)
        curl_setopt($req, CURLOPT_TIMEOUT,3);
        //设置链接时长
        curl_setopt($req, CURLOPT_CONNECTTIMEOUT,10);
        //设置头信息
        $headers=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
        curl_setopt($req, CURLOPT_HTTPHEADER, $headers);
        
        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, false);
        //curl_exec()执行结果不直接输出，以字符串返回
        curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
        
        $data = curl_exec($req);
        curl_close($req);
        return $data;
}

$run = include 'switch.php';
if(!$run) die("process abort");

$data =  json_decode(requestByKey());
$HeWeather6 = $data->HeWeather6;
$loc = $HeWeather6[0]->update->loc."\t";
$cond_txt = $HeWeather6[0]->now->cond_txt."\t";
$tmp = $HeWeather6[0]->now->tmp."\n";

$status = $HeWeather6[0]->status;
$time = 60*60;
if($status == "ok")
{
    $pf = fopen("weather.log", "a");
    fwrite($pf, $loc);
    fwrite($pf, $cond_txt);
    fwrite($pf, $tmp);
    fclose();
}
else
{
    $time = 60;
}

$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
file_get_contents($url);

?>
