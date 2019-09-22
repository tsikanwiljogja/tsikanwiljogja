<?php

namespace App\Http\Controllers;

use App\ss;
use DB;
use Illuminate\Http\Request;
use Telegram;

class TelegramBotController extends Controller
{
	
	//get user information	
    public function getMe() 
    {
    	$response = Telegram::getMe();

		$botId = $response->getId();
		$firstName = $response->getFirstName();
		$username = $response->getUsername();

		dd($firstName);
    }

    //manual get updates
    public function getUpdates()
    {
    	//get chat from user manual
    	$response = Telegram::getUpdates();
    	//dd($response);
  
    }


    //cek manual send photo 
    public function sendPhoto()
    {
    	//update data form data base
  //   	$picture_name = DB::table('sses')->where('update_id','778635423')->value('picture_name');

  //   	$response = Telegram::sendPhoto([
		// 	'reply_to_message_id' => '146',
		//   	'chat_id' => '151616740', 
		//   	'photo' => '../public/'.$picture_name.'.jpeg'
		// ]);
    }

    //set on webhook
    public function setWebhook()
    {
    	$response = Telegram::setWebhook(['url' => 'https://aaansee.serveo.net/bot/public/aaansetiawantsikanwiljogja14017brikanwiljogja/webhook']);
    	dd ($response);
    }


    //set off webhook
    public function removeWebhook()
    {
    	$response = Telegram::removeWebhook();
    	dd($response);
    }


    //Memblasa Pesan Via Webhook
    public function balasPesan()
    {
    	//get chats updates from user
    	$updates = Telegram::getWebhookUpdates();
    	
    	//define each chat from user
    	$update_id = $updates->getUpdate_id();
	    $chat_id = $updates->getMessage()->getChat()->getId();
	    $message_id = $updates->getMessage()->getMessage_id();
	    $username = $updates->getMessage()->getChat()->getUsername();
	    $text = $updates->getMessage()->getText();
		
		//manual Command Handling
		if ($text == '/start') {
			//sending message into user 
			$response = Telegram::sendMessage([
				'reply_to_message_id' => $message_id,
			  	'chat_id' => $chat_id, 
			  	'text' => 'Hallo semua nama saya ANU, saya adalah BOT yang di kelola oleh TSI KANWIL JOGJA. Saya masih memiliki fungsi yang sangat terbatas, dan masih dalam proses pengembangan agar menjadi BOT yang bisa membantu meringankan pekerjaan.'
			]);
		}

		else if ($text == '/gg') {

			//captire website using this api API FLASH
			$params = http_build_query(array(
			    "access_key" => "0dd7c511c93a452db604467b45ed8aa8",
			    "url" => "https://www.facebook.com/aaansee",
			));

			//generate url and convert into JPG file
			$image_data = file_get_contents("https://api.apiflash.com/v1/urltoimage?" . $params);

			//save file in public direcoru
			file_put_contents("$message_id$chat_id.jpeg", $image_data);

			ss::create([
	    		'update_id' =>  $updates->getUpdate_id(),
	    		'message_id' => $updates->getMessage()->getMessage_id(),
	    		'chat_id' => $updates->getMessage()->getChat()->getId(),
	    		'username' => $updates->getMessage()->getChat()->getUsername(),
	    		'picture_name' => $updates->getMessage()->getMessage_id().$updates->getMessage()->getChat()->getId()

	    	]);

	    	$data_user = DB::table('sses')->where('update_id','$update_id')->value('picture_name');

	    	$response = Telegram::sendPhoto([
	    		'reply_to_message_id' => $updates->getMessage()->getMessage_id(),
	    		'chat_id' => $updates->getMessage()->getChat()->getId(),
	    		'photo' => '../public/'.$updates->getMessage()->getMessage_id().$updates->getMessage()->getChat()->getId().'.jpeg'
	    	]);
			
		}
			
    }
}
