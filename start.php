<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$aol = 0;
$gmx = 0;
$mahre = 0;
$help = 0;
$true = 0;
$false = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"- *Checking dear ✅
    You can leave the bot now or open another new window 💪*",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'Checked: '.$i,'callback_data'=>'fgf']],
                [['text'=>'On this user: '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
				[['text'=>"AOL : $aol",'callback_data'=>'fgjjjvf'],['text'=>"GMX : $gmx",'callback_data'=>'gdfgfd']],
                [['text'=>'valide: '.$true,'callback_data'=>'gj'],['text'=>'No Rest: '.$mahre,'callback_data'=>'lop']],
                [['text'=>'not valide: '.$false,'callback_data'=>'dghkf'],['text'=>'BlackList: '.$help,'callback_data'=>'gj']]
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false and !is_string($info)) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(live|hotmail|outlook|yahoo|Yahoo|yAhoo|aol|aOl|Aol|gmX|gMx|Gmx)\.(.*)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.') or strpos($mail,'outlook.') or strpos($mail,'live.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo')){
                                    $yahoo += 1;
                                } elseif(strpos($mail, 'aol')){
                                    $aol += 1;
                                } elseif(strpos($mail, 'gmx')){
                                    $gmx += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => ".𖡃. 𝒉𝒊 𝒉𝒖𝒏𝒕𝒆𝒓 ✅\n------------𝑥---------------𝑥-----------\n .☃️. اليوزر : [$usern](instagram.com/$usern)\n .📬. الايميل  : [$mail]\n .👥. المتابعين: $follow\n .👁. المتابعهم : $following\n .🖼. البوستات: $media\n------------𝑥---------------𝑥-----------\n• ➺ (BY :[ @vip188x ☕︎︎ ] ➺ CH :[ @vip177x ☕︎︎ ] >",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                                            [['text'=>'Checked: '.$i,'callback_data'=>'fgf']],
                                            [['text'=>'On this user: '.$user,'callback_data'=>'fgdfg']],
                                            [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                                            [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
			                            	[['text'=>"AOL : $aol",'callback_data'=>'fgjjjvf'],['text'=>"GMX : $gmx",'callback_data'=>'gdfgfd']],
                                            [['text'=>'valide: '.$true,'callback_data'=>'gj'],['text'=>'No Rest: '.$mahre,'callback_data'=>'lop']],
                                            [['text'=>'not valide: '.$false,'callback_data'=>'dghkf'],['text'=>'BlackList: '.$help,'callback_data'=>'gj']]
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                        $false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
          echo "BlackList - $mail\n";
        }
    } elseif(is_string($info)){
        bot('sendMessage',[
            'chat_id'=>$id,
            'text'=>"The account - `$screen`\n *It has been blocked from * scanning.",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                        [['text'=>'Transfer the list to another account','callback_data'=>'moveList&'.$screen]],
                        [['text'=>'delete account','callback_data'=>'del&'.$screen]]
                    ]    
            ]),
            'parse_mode'=>'markdown'
        ]);
        exit;
    } else {
        echo "Not Bussines - $user\n";
    }
    usleep(850000);
    $i++;
    file_put_contents($screen, str_replace($user, '', file_get_contents($screen)));
    file_put_contents($screen, preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", file_get_contents($screen)));
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'Checked: '.$i,'callback_data'=>'fgf']],
                    [['text'=>'On this user: '.$user,'callback_data'=>'fgdfg']],
                    [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                    [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
				    [['text'=>"AOL : $aol",'callback_data'=>'fgjjjvf'],['text'=>"GMX : $gmx",'callback_data'=>'gdfgfd']],
                    [['text'=>'valide: '.$true,'callback_data'=>'gj'],['text'=>'No Rest: '.$mahre,'callback_data'=>'lop']],
                    [['text'=>'not valide: '.$false,'callback_data'=>'dghkf'],['text'=>'BlackList: '.$help,'callback_data'=>'gj']]
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"The examination is over : ".explode(':',$screen)[0]]);

