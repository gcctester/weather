<?php
$url = 'https://www.baidu.com';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER);
$content = curl_exec($ch);
curl_close($ch);
echo $content;
?>
