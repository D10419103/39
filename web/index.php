<?php
require_once('./LINEBotTiny.php');
require_once __DIR__ . '/../src/LINEBot.php';
require_once __DIR__ . '/../src/LINEBot/Response.php';
require_once __DIR__ . '/../src/LINEBot/Constant/Meta.php';
require_once __DIR__ . '/../src/LINEBot/MessageBuilder.php';
require_once __DIR__ . '/../src/LINEBot/Constant/MessageType.php';
require_once __DIR__ . '/../src/LINEBot/HTTPClient.php';
require_once __DIR__ . '/../src/LINEBot/HTTPClient/Curl.php';
require_once __DIR__ . '/../src/LINEBot/HTTPClient/CurlHTTPClient.php';
require_once __DIR__ . '/../src/LINEBot/MessageBuilder/ImageMessageBuilder.php';
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($channelAccessToken);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                	$m_message = $message['text']; $source=$event['source']; $idtype = $source['type'];  $id=$source['userId'];
                    $roomid=$source['roomId']; $groupid=$source['groupId'];
                    $pictureUrl=$message['pictureUrl'];$res = $bot->getProfile($id);$profile = $res->getJSONDecodedBody();
                    $displayName = $profile['displayName'];$pictureUrl=$profile['pictureUrl'];$statusMessage=$profile['statusMessage'];
                    
                    date_default_timezone_set('Asia/Taipei');
                    if($m_message=="安安" && $idtype=="room"){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $pictureUrl."\n"."姓名:".$displayName."\n"."userid: ".$id.$pictureUrl."\n"."roomid:".$roomid."\n"."time: ".date('Y-m-d h:i:sa')
                            ))));
                    }
                	else if($m_message=="安安" && $idtype=="group")
                	{
                		$client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => "姓名:".$displayName."\n"."userid: ".$id."\n"."groupid: ".$groupid."\n"."time: ".date('Y-m-d h:i:sa')
                            ))));
                	}
                    else if($m_message=="安安" && $idtype=="user"){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => "姓名:".$displayName."\n"."userid: ".$id."\n"."time: ".date('Y-m-d h:i:sa')
                            ))));
                    }
                    else if($m_message=="156"){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'template',
                                'altText' => 'Example confirm template',
                                'template' => array(
                                    'type' => 'confirm',
                                    'text' => $displayName.'你156cm嗎?',
                                    'actions' => array(
                                        array(
                                        'type' => 'message',
                                        'label' => '是',
                                        'text' => 'QQ'
                                         ),
                                        array(
                                        'type' => 'message',
                                        'label' => '否',
                                        'text' => 'NICE'
                                        )
                            ))))));
                    }else if($m_message=="1"){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'template',
                                'altText' => 'Example confirm template',
                                'template' => array(
                                    'type' => 'confirm',
                                    'text' => '請選擇日期',
                                    'actions' => array(
                                        array(
                                        'type' => 'datetimepicker',
                                        'label' => '請選擇',
                                        'data' => 'storeId=12345',
                                        'mode' => 'datetime',
                                        'initial' => '2018-01-01t00:00',
                                        'max' => '2020-12-30t00:00',
                                        'min' => '2017-01-01t00:00'
                                         ),
                                        array(
                                        'type' => 'message',
                                        'label' => '取消',
                                        'text' => '請使用看看'
                                        )
                            ))))));
                    }
                        else if($m_message=="2"){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'template', 
                                'altText' => 'Example buttons template',
                                'template' => array(
                                'type' => 'buttons',	
                                'title' => '選單',
                                'text' => '請選擇',
                                'actions' => array(
                                     array(
                                    'type' => 'message',
                                    'label' => '問候語',
                                    'text' => 'Hello world!'
                                ),
                                    array(
                                    'type' => 'message',
                                    'label' => '問候語',
                                    'text' => 'Hello world!'
                                 ),
                                    array(
                                    'type' => 'uri', 
                                    'label' => '德明財經科技大學首頁',
                                    'uri' => 'http://www.takming.edu.tw'
                             )
                            ))))));
                    }
                    else if($m_message=="3"){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'template', 
                'altText' => 'Example buttons template', 
                'template' => array(
                    'type' => 'carousel', // 類型 (旋轉木馬)
                    'columns' => array(
                        array(
                            'thumbnailImageUrl' => 'https://api.reh.tw/line/bot/example/assets/images/example.jpg',
                            'title' => 'Example Menu 1',
                            'text' => 'Description 1',
                            'actions' => array(
                                array(
                                    'type' => 'message',
                                    'label' => '問候語',
                                    'text' => 'Hello world!'
                                ),
                                array(
                                    'type' => 'message',
                                    'label' => 'Message example 1', 
                                    'text' => 'Message example 1'
                                ),
                                array(
                                    'type' => 'uri', 
                                    'label' => 'Uri example 1',
                                    'uri' => 'https://github.com/GoneTone/line-example-bot-php'
                                )
                            )
                        ),
                        array(
                            'thumbnailImageUrl' => 'https://api.reh.tw/line/bot/example/assets/images/example.jpg',
                            'title' => 'Example Menu 2',
                            'text' => 'Description 2',
                            'actions' => array(
                                array(
                                    'type' => 'message',
                                    'label' => '問候語',
                                    'text' => 'Hello world!'
                                ),
                                array(
                                    'type' => 'message',
                                    'label' => 'Message example 2', 
                                    'text' => 'Message example 2'
                                ),
                                array(
                                    'type' => 'uri',
                                    'label' => 'Uri example 2',
                                    'uri' => 'https://github.com/GoneTone/line-example-bot-php'
                                )
                            ))))))));                        
                    }
                    break;
                    case 'location':
                    $source=$event['source'];
                    $idtype = $source['type']; 
                    $id=$source['userId'];
                    $address=$message['address'];
                    $title=$message['title'];
                    $latitude=$message['latitude'];
                    $longitude=$message['longitude'];
                    if($address!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'location',
                                'title' => $title,
                                'address' => $address,
                                'latitude' => $latitude,
                                'longitude' => $longitude
                            ))));
                    }
                    break;  
                    case 'sticker':
                    $packageId=$message['packageId'];
                    $stickerId=$message['stickerId'];
                    if($stickerId!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'sticker',
                                'packageId' => $packageId,
                                'stickerId' => $stickerId
                            ))));
                    }
                    break;
                    case 'image':
                    $type=$message['type'];
                    $originalContentUrl=$message['originalContentUrl'];
                    $previewImageUrl=$message['previewImageUrl'];
                    if($type!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $type
                            ))));
                    }
                    break;
                    case 'video':
                    $type=$message['type'];
                    $originalContentUrl=$message['originalContentUrl'];
                    $previewImageUrl=$message['previewImageUrl'];
                    if($type!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $type.$originalContentUrl.$previewImageUrl
                            ))));
                    }
                    break;
                    case 'audio':
                    $type=$message['type'];
                    $originalContentUrl=$message['originalContentUrl'];
                    $duration=$message['duration'];
                    if($type!=""){
                        $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => $type.$originalContentUrl.$duration
                            ))));
                    }
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
