<?php
$access_token = 'pk8WQqZq+p1hOi5P5JOaSGwBWiJKf8XSyyg46TS9Uk9QPc5VB+umPMEVPzLsYgbJK+po6KWN+XNk6ibias/H31N6BKNriH1onxtDVOt//QVE+Xc6cHZfariSr8VTs3VYoB3jCzugcLzJmIeLS+TuOwdB04t89/1O/w1cDnyilFU=';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

if (curl_exec($ch) === FALSE) {
   die("Curl Failed: " . curl_error($curl));
} else {
   return curl_exec($curl);
}

curl_close($ch);

echo $result;
?>