<?php
class RegistrationController extends ApiController{
	
	/**
	 * @Method		  :	POST
	 * @Params		  : firstname,lastname,email,password,image,device_type,device_token,created_at,updated_at,status
	 * @author        : Ankit Sompura
	 * @created		  :	May 28 2014
	 * @Modified by	  :
	 * @Comment		  : User Registration.
	**/
	
	public function objectToArray(&$object){
		$array=array();		
		foreach($object as $member=>$data)
		{
			$array[$member]=$data;
		}		
		return $array;
	}
	
	public function actionUserRegistration(){
		$response=array();
		//$regiData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$regiData = $this->objectToArray($myObject);
	    if(!isset($regiData['email']) && $regiData['email'] == '' ||
	    	!isset($regiData['user_type']) && $regiData['user_type'] == '' ||
	    	   !isset($regiData['device_type']) && $regiData['device_type'] == '' ||
			   !isset($regiData['device_token']) && $regiData['device_token'] == ''){
						$response['status'] = "0";
						$response['data'] = "Invalid Parameters Inserted.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}else{
						$userData = UserDetail::model()->find("email = '".strtolower($regiData['email'])."'  AND  status = 1");
						if($userData){
							// Update User Data
							$userId = $userData['user_id'];
							$model = $this->loadModel($userId, 'UserDetail');
							if($model->email == $regiData['email']){
								$response['status'] = "0";
								$response['data'] = "This Email Already Exists";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
						}else{
							// Insert User Data
							$model = new UserDetail();
							if(isset($regiData['auth_id']) && !empty($regiData['auth_id'])){
								$model->auth_id = $regiData['auth_id'];
							}else{
								$model->auth_id = '0';
							}
							if(isset($regiData['auth_provider']) && !empty($regiData['auth_provider'])){
								$model->auth_provider = $regiData['auth_provider'];
							}else{
								$model->auth_provider = 'normal';
							}
							if(isset($regiData['first_name']) && !empty($regiData['first_name'])){
								$model->first_name = $regiData['first_name'];
							}else{
								$model->first_name = '';
							}
							if(isset($regiData['last_name']) && !empty($regiData['last_name'])){
								$model->last_name = $regiData['last_name'];
							}else{
								$model->last_name = '';
							}
							if(isset($regiData['email']) && !empty($regiData['email'])){
								$model->email = strtolower($regiData['email']);
							}else{
								$model->email = '';
							}
							if(isset($regiData['phone']) && !empty($regiData['phone'])){
								$model->phone = $regiData['phone'];
							}else{
								$model->phone = '';
							}
							if(isset($regiData['password']) && !empty($regiData['password'])){
								$model->password = md5($regiData['password']);
							}else{
								$model->password = '';
							}
							if(isset($regiData['image']) && !empty($regiData['image'])){
								$model->image = $regiData['image'];
							}else{
								$model->image = '';
							}
							if(isset($regiData['device_type']) && !empty($regiData['device_type'])){
								$model->device_type = $regiData['device_type'];
							}else{
								$model->device_type = '';
							}
							if(isset($regiData['device_token']) && !empty($regiData['device_token'])){
								$model->device_token = $regiData['device_token'];
							}else{
								$model->device_token = '';
							}
							if(isset($regiData['location']) && !empty($regiData['location'])){
								$model->location = $regiData['location'];
							}else{
								$model->location = '';
							}
							if(isset($regiData['latitude']) && !empty($regiData['latitude'])){
								$model->latitude = $regiData['latitude'];
							}else{
								$model->latitude = '';
							}
							if(isset($regiData['longitude']) && !empty($regiData['longitude'])){
								$model->longitude = $regiData['longitude'];
							}else{
								$model->longitude = '';
							}
							if(isset($regiData['user_type']) && !empty($regiData['user_type'])){
								$model->user_type = $regiData['user_type'];
							}
							if($model->save(false)){
								$response['status'] = "1";
								$response['data'] = "Registration done successfully.";
								$response['user_id'] = ($model->user_id)?$model->user_id:'';
								$response['user_type'] = ($model->user_type)?$model->user_type:'';
								$response['auth_id'] = ($model->auth_id)?$model->auth_id:'';
								$response['auth_provider'] = ($model->auth_provider)?$model->auth_provider:'';
								$response['first_name'] = ($model->first_name)?$model->first_name:'';
								$response['last_name'] = ($model->last_name)?$model->last_name:'';
								$response['email'] = ($model->email)?$model->email:'';
								$response['device_type'] = ($model->device_type)?$model->device_type:'';
								$response['location'] = ($model->location)?$model->location:'';
								$response['latitude'] = ($model->latitude)?$model->latitude:'';
								$response['longitude'] = ($model->longitude)?$model->longitude:'';
								$response['device_token'] = ($model->device_token)?$model->device_token:'';
								//$response['image'] = ($model->image)? $model->image :Yii::app()->getBaseUrl(true)."/upload/user_image/images.jpg";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Invalid Parameters Inserted.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
					}
			}
	}
	
	/**
	 * @Method		  :	POST
	 * @Params		  : Username,Password
	 * @author        : Ankit Sompura
	 * @created		  :	May 28 2014
	 * @Modified by	  :
	 * @Comment		  : User Login.
	**/
	
	public function actionCheckLogin(){
		$response=array();
		//$loginData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$loginData = $this->objectToArray($myObject);
		if(!isset($loginData['email']) && $loginData['email'] == '' ||
		   !isset($loginData['password']) && $loginData['password'] == ''||
		   !isset($loginData['user_type']) && $loginData['user_type'] == ''||
		   !isset($loginData['device_token']) && $loginData['device_token'] == '' ){
				$response['status'] = "0";
				$response['data'] = "Invalid Parameters Inserted.";
		}else{
				//Check Login Data 
				$email = strtolower($loginData['email']);
				$password = md5($loginData['password']);
				$user_type=$loginData['user_type'];
				$model = UserDetail::model()->find("email = '".$email."' AND password = '".$password."' AND  user_type='".$user_type."'");
				if($model){
							$userId = $model['user_id'];
							$usermodel = $this->loadModel($userId, 'UserDetail');
							if(isset($loginData['latitude']) && !empty($loginData['latitude']) ||isset($loginData['longitude']) && !empty($loginData['longitude'])){
							$usermodel['latitude']=$loginData['latitude'];
							$usermodel['longitude']=$loginData['longitude'];
							}	
							if(isset($loginData['location']) && !empty($loginData['location'])){
							$usermodel['location']=$loginData['location'];
							}
							$usermodel['device_token']=$loginData['device_token'];
							$usermodel->save(false);
					$response['status'] = "1";
					$response['data'] = "Login Successfully.";
					$response['user_id'] = ($usermodel->user_id)?$usermodel->user_id:'';
					$response['user_type'] = ($usermodel->user_type)?$usermodel->user_type:'';
					$response['email'] = ($usermodel->email)?$usermodel->email:'';
					$response['device_type'] = ($usermodel->device_type)?$usermodel->device_type:'';
					$response['location'] = ($usermodel->location)?$usermodel->location:'';
					$response['latitude'] = ($usermodel->latitude)?$usermodel->latitude:'';
					$response['longitude'] = ($usermodel->longitude)?$usermodel->longitude:'';
					$response['phone'] = ($usermodel->phone)?$usermodel->phone:'';
					$response['device_settings'] = ($usermodel->device_settings)?$usermodel->device_settings:'';
					$response['device_token'] = ($usermodel->device_token)?$usermodel->device_token:'';
				}else{
					$response['status'] = "0";
					$response['data'] = "Invalid Email ID and Password.";
				}
				}
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}
	/**
	 * @Method		  :	POST
	 * @Params		  : firstname,lastname,email,password,image,device_type,device_token,created_at,updated_at,status,location
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : User Profile Update.
	**/
	
	public function actionEditProfile(){
		$response=array();
		//$editData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$editData = $this->objectToArray($myObject);
	    if(!isset($editData['user_id']) && $editData['user_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the user id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}else{
				$emailVerify = UserDetail::model()->find("email='".$editData['email']."' AND user_id NOT IN ('".$editData['user_id']."')");
			if($emailVerify){
								$response['status'] = "0";
								$response['data'] = "This Email Already Exists";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
			}else{
				$userData = UserDetail::model()->find("user_id = '".$editData['user_id']."'");
						if($userData){
							// Update User Data
							$userId = $userData['user_id'];
							$model = $this->loadModel($userId, 'UserDetail');
							if(isset($editData['email']) && !empty($editData['email'])){
								$model->email = strtolower($editData['email']);
							}
							if(isset($editData['phone']) && !empty($editData['phone'])){
								$model->phone = $editData['phone'];
							}
							if(isset($editData['password']) && !empty($editData['password'])){
								$model->password = md5($editData['password']);
							}
							if(isset($editData['location']) && !empty($editData['location'])){
								$model->location = $editData['location'];
							}
							if(isset($editData['latitude']) && !empty($editData['latitude'])){
								$model->latitude = $editData['latitude'];
							}else{
								$model->latitude = '';
							}
							if(isset($editData['longitude']) && !empty($editData['longitude'])){
								$model->longitude = $editData['longitude'];
							}else{
								$model->longitude = '';
							}
							if($model->save(false)){
								$response['status'] = "1";
								$response['data'] = "User Profile successfully updated.";
								$response['user_id'] = ($model->user_id)?$model->user_id:'';
								$response['auth_id'] = ($model->auth_id)?$model->auth_id:'';
								$response['auth_provider'] = ($model->auth_provider)?$model->auth_provider:'';
								$response['first_name'] = ($model->first_name)?$model->first_name:'';
								$response['last_name'] = ($model->last_name)?$model->last_name:'';
								$response['email'] = ($model->email)?$model->email:'';
								$response['phone'] = ($model->phone)?$model->phone:'';
								$response['device_type'] = ($model->device_type)?$model->device_type:'';
								$response['device_token'] = ($model->device_token)?$model->device_token:'';
								$response['location'] = ($model->location)?$model->location:'';
								$response['latitude'] = ($model->latitude)?$model->latitude:'';
								$response['longitude'] = ($model->longitude)?$model->longitude:'';
								$response['image'] = ($model->image)? $model->image :Yii::app()->getBaseUrl(true)."/upload/user_image/images.jpg";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Invalid Parameters Inserted.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
					}
			}
			}
	}

/**
	 * @Method		  :	POST
	 * @Params		  : device_settings,user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : User Push Settings.
	**/

public function actionUserSettings(){
		$response=array();
		$settingsData = json_decode(file_get_contents('php://input'), TRUE);
		//$myObject = json_decode($_POST['data']);
		//$settingsData = $this->objectToArray($myObject);
	    /*if(!isset($settingsData['device_settings']) && $settingsData['device_settings'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the device settings.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}*/
		if(!isset($settingsData['user_id']) && $settingsData['user_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the user id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		else{
			$userData = UserDetail::model()->find("user_id = '".$settingsData['user_id']."'");
						if($userData){
							// Update User settings
							$userId = $userData['user_id'];
							$model = $this->loadModel($userId, 'UserDetail');
							if(isset($settingsData['device_settings'])){
								$model->device_settings = $settingsData['device_settings'];
							}
						if(isset($settingsData['location_setting'])){
								$model->location_setting = $settingsData['location_setting'];
							}	
						if($model->save(false)){
								$response['status'] = "1";
								$response['data'] = "Settings successfully changed.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Invalid Parameters Inserted.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
		}
}
}
	/**
	 * @Method		  :	GET
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : User Details.
	**/
	public function actionGetUserDetails(){
		$user_id=$_REQUEST['user_id'];
		$response=array();
		$getarray=array();
	    if(!isset($user_id) && $user_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the user id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}else{
			$userData = UserDetail::model()->find("user_id = '".$user_id."'");
						if($userData){
							// Update User details
								$response['user_id'] = ($userData->user_id)?$userData->user_id:'';
								$response['auth_id'] = ($userData->auth_id)?$userData->auth_id:'';
								$response['auth_provider'] = ($userData->auth_provider)?$userData->auth_provider:'';
								$response['first_name'] = ($userData->first_name)?$userData->first_name:'';
								$response['last_name'] = ($userData->last_name)?$userData->last_name:'';
								$response['email'] = ($userData->email)?$userData->email:'';
								$response['phone'] = ($userData->phone)?$userData->phone:'';
								$response['device_type'] = ($userData->device_type)?$userData->device_type:'';
								$response['device_token'] = ($userData->device_token)?$userData->device_token:'';
								$response['location'] = ($userData->location)?$userData->location:'';
								$response['latitude'] = ($userData->latitude)?$userData->latitude:'';
								$response['longitude'] = ($userData->longitude)?$userData->longitude:'';	
						}
						if($response){
								$getarray['status'] = "1";
								$getarray['data'] =$response;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}
		}			
	}
		/**
	 * @Method		  :	POST
	 * @Params		  : offer_start_date,offer_end_date,offer_text,offer_price,offer_link.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Add Offers.
	**/
public function actionAddOffers(){
		$response=array();
		//$offerData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$offerData = $this->objectToArray($myObject);
		if(!isset($offerData['offer_text']) && $offerData['offer_text'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the offer text.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['offer_price']) && $offerData['offer_price'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the offer price.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['user_id']) && $offerData['user_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the user Id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['longitude']) && $offerData['longitude'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the longitude.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['latitude']) && $offerData['latitude'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the latitude.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}	
		
		else{
							// Insert Offer Data
							$model = new Offers();
							if(isset($offerData['offer_start_date']) && !empty($offerData['offer_start_date'])){
								$model->offer_start_date = $offerData['offer_start_date'];
							}else{
								$model->offer_start_date = '';
							}
							if(isset($offerData['offer_end_date']) && !empty($offerData['offer_end_date'])){
								$model->offer_end_date = $offerData['offer_end_date'];
							}else{
								$model->offer_end_date = '';
							}
							if(isset($offerData['offer_text']) && !empty($offerData['offer_text'])){
								$model->offer_text = $offerData['offer_text'];
							}else{
								$model->offer_text = '';
							}
							if(isset($offerData['offer_price']) && !empty($offerData['offer_price'])){
								$model->offer_price = $offerData['offer_price'];
							}else{
								$model->offer_price = '';
							}
							if(isset($offerData['offer_link']) && !empty($offerData['offer_link'])){
								$model->offer_link = $offerData['offer_link'];
							}else{
								$model->offer_link = '';
							}
							if(isset($offerData['image']) && !empty($offerData['image'])){
								$model->image = $offerData['image'];
							}else{
								$model->image = '';
							}
							if(isset($offerData['location']) && !empty($offerData['location'])){
								$model->location = $offerData['location'];
							}else{
								$model->location = '';
							}
							if(isset($offerData['no_of_deals']) && !empty($offerData['no_of_deals'])){
								$model->no_of_deals = $offerData['no_of_deals'];
							}else{
								$model->no_of_deals = '';
							}
							if(isset($offerData['user_id']) && !empty($offerData['user_id'])){
								$model->user_id = $offerData['user_id'];
							}
							if(isset($offerData['latitude']) && !empty($offerData['latitude'])){
								$model->latitude = $offerData['latitude'];
							}
							if(isset($offerData['longitude']) && !empty($offerData['longitude'])){
								$model->longitude = $offerData['longitude'];
							}
							if(isset($offerData['discount']) && !empty($offerData['discount'])){
								$model->discount = $offerData['discount'];
							}	
							if($model->save(false)){
									$userData = UserDetail::model()->findAll("user_id NOT IN ('".$offerData['user_id']."') AND device_settings=1");
								 	if($userData){
									$messageImage=$offerData['offer_text'].','.$offerData['image'];
									foreach($userData as $userinfo){
										$find_distance=round($this->distance($userinfo['latitude'], $userinfo['longitude'], $model->latitude, $model->longitude));
										if($find_distance<=20){
												if($userinfo['device_type']==2){
													$this->AndroidPushNotification($userinfo['device_token'],$messageImage);
												}elseif($userinfo['device_type']==1){
													$this->sendIphoneNotification($userinfo['device_token'],$messageImage);
												}
										}elseif($userinfo['location_setting']==2){
										    if($userinfo['device_type']==2){
												$this->AndroidPushNotification($userinfo['device_token'],$messageImage);
											}elseif($userinfo['device_type']==1){
												$this->sendIphoneNotification($userinfo['device_token'],$messageImage);
											}
									}
									}	
								} 
								 /*if($userData){
									$messageImage=$offerData['offer_text'].','.$offerData['image'];
									foreach($userData as $userinfo){
										if($userinfo['device_type']==2){
											$this->AndroidPushNotification($userinfo['device_token'],$messageImage);
										}elseif($userinfo['device_type']==1){
											$this->sendIphoneNotification($userinfo['device_token'],$messageImage);
										}
									}
									
								}*/
								$response['status'] = "1";
								$response['data'] = "Offers added successfully.";
								$response['offer_start_date'] = ($model->offer_start_date)?$model->offer_start_date:'';
								$response['offer_end_date'] = ($model->offer_end_date)?$model->offer_end_date:'';
								$response['offer_text'] = ($model->offer_text)?$model->offer_text:'';
								$response['offer_price'] = ($model->offer_price)?$model->offer_price:'';
								$response['offer_link'] = ($model->offer_link)?$model->offer_link:'';
								$response['offer_id'] = ($model->offer_id)?$model->offer_id:'';
								$response['location'] = ($model->location)?$model->location:'';
								$response['latitude'] = ($model->latitude)?$model->latitude:'';
								$response['longitude'] = ($model->longitude)?$model->longitude:'';
								$response['image'] = ($model->image)?$model->image:'';
								$response['no_of_deals'] = ($model->no_of_deals)?$model->no_of_deals:'';
								$response['discount'] = ($model->discount)?$model->discount:'';
								//$response['image'] = ($model->image)? $model->image :Yii::app()->getBaseUrl(true)."/upload/user_image/images.jpg";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Invalid Parameters Inserted.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
			}
	}


public function sendIphoneNotification($deviceToken,$message,$badge = false){
		
				$baseDir = YiiBase::getPathOfAlias('webroot') . '/SimplePush/';
	
				// Put your private key's passphrase here:
				$passphrase = 'Letsdoit@123';
				// Put your alert message here:
				if (file_exists($baseDir)) {
					//echo "file Exists";
				}
				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', $baseDir . 'ck.pem');
				stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
	 
				// Open a connection to the APNS server
				$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
				// $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
	
				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);
	
				//echo 'Connected to APNS' . PHP_EOL;
				// Create the payload body
				$body['aps'] = array('badge' => ($badge)?$badge+1:+1 ,'alert' => $message, 'sound' => 'default');
				// Encode the payload as JSON
				$payload = json_encode($body);
				// Build the binary notification
				$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
				// Send it to the server
				$result = fwrite($fp, $msg, strlen($msg));
				
				if (!$result) {
					
					
					//echo 'Message not delivered' . PHP_EOL;
					fclose($fp);
					return false;
				} else {
					//echo 'Message successfully delivered' . PHP_EOL;
					fclose($fp);
					return true;
				}
				return true;
	}
		public function AndroidPushNotification($deviceToken,$offerMessage){
		
				$api_key = 'AIzaSyDlX4kxn9ZjhJG3mwVV-peZ3kP3jqaHbow';
				$url = 'https://android.googleapis.com/gcm/send';
	
				$fields = array('registration_ids' => array($deviceToken), 'data' => array('message' => $offerMessage), );
				$headers = array('Authorization: key=' . $api_key, 'Content-Type: application/json');
	
				// 	Open connection
				$ch = curl_init();
	
				// Set the url, number of POST vars, POST data
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
				// 	Disabling SSL Certificate support temporarly
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
	
				// 	Execute post
				$result = curl_exec($ch);
				$resultArr = json_decode($result);
				// 	Close connection
				curl_close($ch);
	}
/**
	 * @Method		  :	POST
	 * @Params		  : offer_status,offer_id.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Offer Push Settings.
	**/

public function actionOfferSettings(){
		$response=array();
		//$offerData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$offerData = $this->objectToArray($myObject);
	    if(!isset($offerData['offer_status']) && $offerData['offer_status'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the device settings.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['offer_id']) && $offerData['offer_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the offer id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		else{
			$offers = Offers::model()->find("offer_id = '".$offerData['offer_id']."'");
			
						if($offers){
							// Update User settings
							$offerId = $offers['offer_id'];
							$model = $this->loadModel($offerId, 'Offers');
							if(isset($offerData['offer_status'])){
								$model->offer_status = $offerData['offer_status'];
							}
						
						if($model->save(false)){
								$response['status'] = "1";
								$response['data'] = "Offer Settings successfully changed.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Invalid Parameters Inserted.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
		}
}

}
/**
	 * @Method		  :	POST
	 * @Params		  : offer_id,user_id,payment_date,price,payment_status_message.
	 * @author        : Binal Thakkar
	 * @created		  :	August 11 2014
	 * @Modified by	  :
	 * @Comment		  : Payment.
	**/
public function actionPayment(){
		$response=array();
		//$paymentData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$paymentData = $this->objectToArray($myObject);
		
	    if(!isset($paymentData['offer_id']) && $paymentData['offer_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the Offer id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($paymentData['user_id']) && $paymentData['user_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the User id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($paymentData['payment_date']) && $paymentData['payment_date'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the Payment date.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($paymentData['price']) && $paymentData['price'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the price.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($paymentData['payment_status_message']) && $paymentData['payment_status_message'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the Payment status.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		else{
		
							$model = new Payment();
							if(isset($paymentData['offer_id']) && !empty($paymentData['offer_id'])){
								$model->offer_id = $paymentData['offer_id'];
							
							}
							if(isset($paymentData['user_id']) && !empty($paymentData['user_id'])){
								$model->user_id = $paymentData['user_id'];
							}
							if(isset($paymentData['payment_date']) && !empty($paymentData['payment_date'])){
								$model->payment_date = $paymentData['payment_date'];
							}
							if(isset($paymentData['price']) && !empty($paymentData['price'])){
								$model->price = $paymentData['price'];
							}
							if(isset($paymentData['payment_status_message']) && !empty($paymentData['payment_status_message'])){
								$model->payment_status_message = $paymentData['payment_status_message'];
							}
							
							if($model->save(false)){
								$response['status'] = "1";
								$response['data'] = "Payment data added successfully.";
								$response['offer_id'] = ($model->offer_id)?$model->offer_id:'';
								$response['user_id'] = ($model->user_id)?$model->user_id:'';
								$response['payment_date'] = ($model->payment_date)?$model->payment_date:'';
								$response['price'] = ($model->price)?$model->price:'';
								$response['payment_status_message'] = ($model->payment_status_message)?$model->payment_status_message:'';
								//$response['image'] = ($model->image)? $model->image :Yii::app()->getBaseUrl(true)."/upload/user_image/images.jpg";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Invalid Parameters Inserted.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
		
}

}	
/**
	 * @Method		  :	GET
	 * @Params		  : page_no.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Offers Available.
	**/
	public function actionOffersAvailable(){
		$response=array();
		$getarray=array();
		$units=$_REQUEST['distance'];
		$current_latitude=$_REQUEST['latitude'];
		$current_longitude=$_REQUEST['longitude'];
		if(empty($units)&& !isset($units)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the distance";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		if(empty($current_latitude)&& !isset($current_latitude)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the lattitude";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		if(empty($current_longitude)&& !isset($current_longitude)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the longitude";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		else{
		$page_number = (isset($_REQUEST['page']) && $_REQUEST['page']!='') ? $_REQUEST['page']:'';
		$limit = 10;
		 if(isset($_REQUEST['page']) && $_REQUEST['page'] == 1)
		  {
		   $offset = 0; 
		  }
		  else 
		  {
		   if(isset($_REQUEST['page']) && $_REQUEST['page'] != '1') {  
		    $offset = ($page_number*$limit) - 10; 
		     }
		     else{
		    $offset = 0;
		     }
		  }
		 $sql = "SELECT * FROM `offers`WHERE `no_of_deals` NOT IN(0) AND `offer_end_date`>= NOW() ORDER BY `offer_id` DESC LIMIT $offset,$limit";
		$command = Yii::app()->db->createCommand($sql);
		$model = $command->queryAll(); 
		
	   
						if($model){
							foreach($model as $offerData){
									$find_distance=round($this->distance($offerData['latitude'], $offerData['longitude'], $current_latitude, $current_longitude));
									if($find_distance<=$units){
									$response['offer_text'] = $offerData['offer_text'];
									$response['offer_link'] = $offerData['offer_link'];
									$response['image'] = $offerData['image'];
									$response['no_of_deals'] = $offerData['no_of_deals'];
									$response['offer_price'] = $offerData['offer_price'];
									$response['offer_start_date'] = $offerData['offer_start_date'];
									$response['offer_end_date'] = $offerData['offer_end_date'];
									$response['offer_id'] = $offerData['offer_id'];
									$response['latitude'] = $offerData['latitude'];
									$response['longitude'] = $offerData['longitude'];
									$response['discount'] = $offerData['discount'];
									$res['record'][]=$response;
									}
								}
								
						if($res){
								$getarray['status'] = "1";
								$getarray['data'] =$res;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}			
	}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}	
		}

	}
/**
	 * @Method		  :	GET
	 * @Params		  : page_no.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Previous Offers .
	**/
	public function actionPreviousOffers(){
		$response=array();
		$getarray=array();
		$units=$_REQUEST['distance'];
		$current_latitude=$_REQUEST['latitude'];
		$current_longitude=$_REQUEST['longitude'];
		if(empty($units)&& !isset($units)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the distance";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		if(empty($current_latitude)&& !isset($current_latitude)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the lattitude";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		if(empty($current_longitude)&& !isset($current_longitude)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the longitude";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		else{
		$page_number = (isset($_REQUEST['page']) && $_REQUEST['page']!='') ? $_REQUEST['page']:'';
		$limit = 10;
		 if(isset($_REQUEST['page']) && $_REQUEST['page'] == 1)
		  {
		   $offset = 0; 
		  }
		  else 
		  {
		   if(isset($_REQUEST['page']) && $_REQUEST['page'] != '1') {  
		    $offset = ($page_number*$limit) - 10; 
		     }
		     else{
		    $offset = 0;
		     }
		  }
		$sql = "SELECT * FROM `offers`WHERE (`offer_end_date`)<= NOW() ORDER BY `offer_id` DESC LIMIT $offset,$limit";
		$command = Yii::app()->db->createCommand($sql);
		$model = $command->queryAll(); 
		
	   
						if($model){
							foreach($model as $offerData){
									$find_distance=round($this->distance($offerData['latitude'], $offerData['longitude'], $current_latitude, $current_longitude));
									if($find_distance<=$units){
									$response['offer_text'] = $offerData['offer_text'];
									$response['offer_link'] = $offerData['offer_link'];
									$response['image'] = $offerData['image'];
									$response['no_of_deals'] = $offerData['no_of_deals'];
									$response['offer_price'] = $offerData['offer_price'];
									$response['offer_start_date'] = $offerData['offer_start_date'];
									$response['offer_end_date'] = $offerData['offer_end_date'];
									$response['offer_id'] = $offerData['offer_id'];
									$response['latitude'] = $offerData['latitude'];
									$response['longitude'] = $offerData['longitude'];
									$response['discount'] = $offerData['discount'];
									$res['record'][]=$response;
									}
								}
								
						if($res){
								$getarray['status'] = "1";
								$getarray['data'] =$res;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}			
	}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}	
		}
	}
	public function distance($latitude1, $longitude1, $latitude2, $longitude2){
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    return $miles;
	}
/**
	 * @Method		  :	Post
	 * @Params		  : email.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Forgot Password .
	**/
		public function actionForgotpassword(){
				$new_pass =  $this->random_string(9);  // generated 9 characters password
				$response = array();
				//$forgotPass = json_decode(file_get_contents('php://input'), TRUE);
				$myObject = json_decode($_POST['data']);
				$forgotPass = $this->objectToArray($myObject);
				if(!isset($forgotPass['email']) && $forgotPass['email'] == ''){
						
						$response['data'] = "Please pass the Email Id.";
						$response['status'] = "0";
				}else{
						//get user detail from email address
						$userModel = UserDetail::model()->find("email='".$forgotPass['email']."'");
						if($userModel){
								$id = $userModel['user_id'];
								$model = $this->loadModel($id,'UserDetail');
								$model->password = md5($new_pass);
								if($model->save(false)){
									$getMail=$this->sendForgotPasswordMail($model->email,$new_pass);
										if($getMail)
										{
											
											$response['data']='Mail Successfully Sent';
											$response['status']='1';
										}else{
											
											$response['data']='Error in sending mail';
											$response['status']='0';
										}
								}else{
									
									$response['data']='Error Storing Data';
									$response['status']='0';
								}
							
						}else{						
							
							$response['data']='The Email Id is not registered in our system.';
							$response['status']='0';
						}
					}	
				echo json_encode($response);
				return;
			}

	public function sendForgotPasswordMail($email,$newpassword)
	{
			$to = $email;
			$subject = "Yadeal Project App Forgot Password Request";
			$txt = "Dear User,\r\n\n";
			$txt .= "Your Password has been reset.\r\n\n";
			$txt .= "Email :: $email \r\n" ;
			$txt .= "NewPassword :: $newpassword" ;
			$headers = "yadeal@gmail.com";
				
		$mail=	mail($to,$subject,$txt,"From: $headers");
		return $mail;
	}
	function random_string($length) {
		$key = '';
		$keys = array_merge(range(0, 9), range('a', 'z'));

		for ($i = 0; $i < $length; $i++) {
			$key .= $keys[array_rand($keys)];
		}

		return $key;
	}
	/**
	 * @Method		  :	Post
	 * @Params		  : user_id,new Password,old password
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Change Password .
	**/
	public function actionChangePassword(){
		$response = array();
		//$changePass = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$changePass = $this->objectToArray($myObject);
		if(!isset($changePass['currentpassword']) || $changePass['currentpassword'] ==''){
			$response['data']['error']='Please pass the Current Password.';
			   $response['status']='0';
			}
		 if(!isset($changePass['newpassword']) || $changePass['newpassword'] == '' ){
		 	$response['data']['error']='Please pass the New Password.';
			   $response['status']='0';
		 	}
		   if(!isset($changePass['user_id']) || $changePass['user_id'] == ''){
				
				$response['data']['error']='Please pass the User Id.';
			   $response['status']='0';
			}
		else{
				//get user detail from email address
				$userModel = UserDetail::model()->find("user_id = '".$changePass['user_id']."' && password='".md5($changePass['currentpassword'])."'");
				if($userModel){
						$id = $userModel['user_id'];
						$model = $this->loadModel($id,'UserDetail');
						$model->password = md5($changePass['newpassword']);
						if($model->save(false)){
							$getMail=$this->sendChangePasswordMail($model->email,$changePass['currentpassword'],$changePass['newpassword']);
								if($getMail)
								{
									
									$response['data']='Mail Successfully Sent';
									$response['status']='1';
								}else{
									
									$response['data']='Error in sending mail';
									$response['status']='0';
								}
						}else{
							
							$response['data']='Error Storing Device Id';
							$response['status']='0';
						}
				}else{
					
							
							$response['data']='please Enter the correct Password';
							$response['status']='0';
				}
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				return;
		}
	}
	public function sendChangePasswordMail($email,$oldpassword,$newpassword){
			$to = $email;
			$subject = "yadeal App Change Password Request";
			$txt = "Dear user,\r\n\n";
			$txt .= "Your Password has been Change.\r\n\n";
			$txt .= "Email :: $email \r\n" ;
			$txt .= "New Password :: $newpassword" ;
			$headers = "Yadeal@gmail.com";
				
		$getMail=	mail($to,$subject,$txt,"From: $headers");
		return $getMail;
	}
			/**
	 * @Method		  :	GET
	 * @Params		  : offer_id.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : to get offer count.
	**/
	public function actionOfferCount(){
		$offer_id=$_REQUEST['offer_id'];
		$getarray=array();
	    if(!isset($offer_id) && $offer_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the offer id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}else{
			$offerData = Offers::model()->find("offer_id = '".$offer_id."'");
						if($offerData){
							$response['no_of_deals']=$offerData['no_of_deals'];
						}
						if($response){
								$getarray['status'] = "1";
								$getarray['data'] =$response;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}
		}			
	}
			/**
	 * @Method		  :	POST
	 * @Params		  : offer_id,no_of_deals.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : to get offer count.
	**/
	public function actionChnageOfferCount(){
		//$changeCount = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$changeCount = $this->objectToArray($myObject);
			if(!isset($changeCount['offer_id']) || $changeCount['offer_id'] ==''){
					$response['data']['error']='Please pass the offer id.';
					   $response['status']='0';
					}
				 if(!isset($changeCount['no_of_deals']) || $changeCount['no_of_deals'] == '' ){
				 	$response['data']['error']='Please pass no of deals .';
					   $response['status']='0';
				 	}
		else{
			$offerData = Offers::model()->find("offer_id = '".$changeCount['offer_id']."'");
						if($offerData){
						$id = $offerData['offer_id'];
						$model = $this->loadModel($id,'Offers');
						$model->no_of_deals=$offerData['no_of_deals']- $changeCount['no_of_deals'];
						if($model->save(false))
						{
								$getarray['status'] = "1";
								$getarray['no_of_deals'] =$model->no_of_deals;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}
		}			
	}
	}
	
/**
	 * @Method		  :	GET
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	September 3rd 2014
	 * @Modified by	  :
	 * @Comment		  : to get list of offers of a particular user
	**/
	public function actionOfferList(){
		$user_id=$_REQUEST['user_id'];
		$getarray=array();
		$res=array();
	    if(!isset($user_id) && $user_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the user id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}else{
			$offerList = Offers::model()->findAll("user_id = '".$user_id."' ORDER BY `offer_start_date` DESC");
						if($offerList){
							foreach($offerList as $offerData){
								$response['no_of_deals']=$offerData['no_of_deals'];
								$response['offer_text'] = $offerData['offer_text'];
								$response['user_id'] = $offerData['user_id'];
								$response['offer_link'] = $offerData['offer_link'];
								$response['image'] = $offerData['image'];
								$response['location'] = $offerData['location'];
								$response['offer_status'] = $offerData['offer_status'];
								$response['no_of_deals'] = $offerData['no_of_deals'];
								$response['offer_price'] = $offerData['offer_price'];
								$response['offer_start_date'] = $offerData['offer_start_date'];
								$response['offer_end_date'] = $offerData['offer_end_date'];
								$response['latitude'] = $offerData['latitude'];
								$response['longitude'] = $offerData['longitude'];
								$response['offer_id'] = $offerData['offer_id'];
								$response['discount'] = $offerData['discount'];
								$res[]=$response;
								}
						}
						if($res){
								$getarray['status'] = "1";
								$getarray['data'] =$res;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No Offers found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}
		}			
	}
			/**
	 * @Method		  :	GET
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	September 3rd 2014
	 * @Modified by	  :
	 * @Comment		  : to null the device token.
	**/
	public function actionLogout(){
	$user_id=$_REQUEST['user_id'];
   if(!isset($user_id) && $user_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the user id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}else{
			$userModel = UserDetail::model()->find("user_id = '".$user_id."'");
						if($userModel){
						$id = $userModel['user_id'];
						$model = $this->loadModel($id,'UserDetail');
						$model->device_token=0;
						if($model->save(false))
						{
								$getarray['status'] = "1";
								$getarray['device_token'] =$model->device_token;
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}else{
								$getarray['status'] = "0";
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}
		}			
	}
	}
}