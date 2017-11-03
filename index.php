<?php
    $access_token = "z/IrE9pxhr1t0nhLw6IZFDY2nRjyKOtGR30WQ0MwPhPoYzZvptufR8OG/ycTrR2WK+po6KWN+XNk6ibias/H31N6BKNriH1onxtDVOt//QWdYv+re6e12j5W8hvlmgs5U0XfqWF4ErOopSGkRRLI7gdB04t89/1O/w1cDnyilFU=";
    $url = 'https://api.line.me/v1/oauth/verify';

	$headers = array('Authorization: Bearer ' . $access_token);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	echo $result;
?>