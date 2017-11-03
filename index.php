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
			
			$img_url = "https://cdn.shopify.com/s/files/1/0379/7669/products/sampleset2_1024x1024.JPG?v=1458740363";
			$outputText = new LINE\LINEBot\MessageBuilder\ImageMessageBuilder($img_url, $img_url);

			// Build message to reply back
// 			$messages = [
// 				'type' => 'text',
// 				'text' => 'มีไรทักทำไม มีไรทักทำไมหุบปากเดียวนี้ลำคาญ',
// 				'packageId' => '4',
// 				'stickerId' => '300'
// 			];
			
			$messages = [
				  "type": "template",
				  "altText": "this is a confirm template",
				  "template": {
				      "type": "confirm",
				      "text": "Are you sure?",
				      "actions": [
					  {
					    "type": "message",
					    "label": "Yes",
					    "text": "yes"
					  },
					  {
					    "type": "message",
					    "label": "No",
					    "text": "no"
					  }
				      ]
				  }
				];

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
