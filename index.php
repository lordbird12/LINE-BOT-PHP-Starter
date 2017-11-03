<?php
    $access_token = "z/IrE9pxhr1t0nhLw6IZFDY2nRjyKOtGR30WQ0MwPhPoYzZvptufR8OG/ycTrR2WK+po6KWN+XNk6ibias/H31N6BKNriH1onxtDVOt//QWdYv+re6e12j5W8hvlmgs5U0XfqWF4ErOopSGkRRLI7gdB04t89/1O/w1cDnyilFU=";
   // Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			
			if($text == 'text'){
				$messages = [
					'type' => 'text',
					'text' => 'มีไรทักทำไม มีไรทักทำไมหุบปากเดียวนี้ลำคาญ'
				];
			}else if($text == 'sticker'){
				$messages = [
					  'type' => 'sticker',
					  'packageId' => '1',
					  'stickerId' => '1'
				];
			}else if($text == 'image'){
				$messages = [
					  'type' => 'image',
					  'originalContentUrl' => 'https://loveandlightportal.files.wordpress.com/2012/06/buddha-under-bodhi.jpg',
					  'previewImageUrl' => 'https://loveandlightportal.files.wordpress.com/2012/06/buddha-under-bodhi.jpg'
				];	
			}else if($text == 'video'){
				$messages = [
					  'type' => 'video',
					  'originalContentUrl' => 'https://www.w3schools.com/html/mov_bbb.mp4',
					  'previewImageUrl' => 'https://upload.wikimedia.org/wikipedia/commons/3/3b/Rabbit_in_montana.jpg'
				];	
			}else if($text == 'audio'){
				$messages = [
					  'type' => 'text',
					  'text' => 'หาไฟล์ไม่ได้'
				];	
			}else if($text == 'location'){
				$messages = [
					  'type' => 'location',
					  'title' => 'บ้านเราเอง',
					  'address' => 'หมู่บ้าน วัฒนา 69/83 หมู่ 4 ลำต้อยติ่ง หนองจอก กทม 10530',
					  'latitude' => '13.788683',
					  'longitude' => '100.866348'
				];	
			}else if($text == 'imagemap'){
				$messages = [
					  'type' => 'imagemap',
					  'baseUrl' => 'https://upload.wikimedia.org/wikipedia/commons/3/3b/Rabbit_in_montana.jpg',
					  'altText' => 'this is an imagemap',
					  'baseSize' => [
						"height": 1040,
      						"width": 1040  
				          ],
					  "actions"=> [
					      {
						  "type"=> "uri",
						  "linkUri"=> "https://dptf.com/",
						  "area"=> {
						      "x"=> 0,
						      "y"=> 0,
						      "width"=> 520,
						      "height"=> 1040
						  }
					      },
					      {
						  "type"=> "message",
						  "text"=> "hello",
						  "area"=> {
						      "x"=> 520,
						      "y"=> 0,
						      "width"=> 520,
						      "height"=> 1040
						  }
					      }
				];	
			}
			
			

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>
