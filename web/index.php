<?php
$access_token ='WI8f+ot/+7IJffBJATgfi1+rnNYCW+RGm1u2SRg2sdOLw2Y0+4gbdJsmh0zmUdtZNvx595o+hvI3XYeFQk66EVpl1mWwDDJOlKRecD6mc8gES9hnbAH+SOcrxw3QWmrmvQPI0WxrXMwB8EVOXPx4FwdB04t89/1O/w1cDnyilFU=';
//define('TOKEN', '你的Channel Access Token');
$receive = json_decode(file_get_contents("php://input"));
$text = $receive->events[0]->message->text;
$type = $receive->events[0]->source->type;
$post_data = [
  "replyToken" => $reply_token,
  if ($type == "room")
	{
		// 多人聊天 讀取房間id
		$from = $json_string->events[0]->source->roomId;
	} 
	else if ($type == "group")
	{
		// 群組 讀取群組id
		$from = $json_string->events[0]->source->groupId;
	}
	else
	{
		// 一對一聊天 讀取使用者id
		$from = $json_string->events[0]->source->userId;
	}
];
$content_type = $receive->events[0]->message->type;
$header = ["Content-Type: application/json", "Authorization: Bearer {" . $channel_access_token . "}"];
	reply($content_type, $text);

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$access_token
));


$result = curl_exec($ch);
curl_close($ch);
?>
