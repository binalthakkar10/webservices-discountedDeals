<?php
date_default_timezone_set("Asia/Kolkata");

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
							if(isset($regiData['username']) && !empty($regiData['username'])){
								$model->username = $regiData['username'];
							}else{
								$model->username = '';
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
								$model->location = '-1';
							}
							if(isset($regiData['country']) && !empty($regiData['country'])){
								$model->country = $regiData['country'];
							}else{
								$model->country = '-1';
							}
							if(isset($regiData['state']) && !empty($regiData['state'])){
								$model->state = $regiData['state'];
							}else{
								$model->state = '-1';
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
								$response['username'] = ($model->username)?$model->username:'';
								$response['first_name'] = ($model->first_name)?$model->first_name:'';
								$response['last_name'] = ($model->last_name)?$model->last_name:'';
								$response['email'] = ($model->email)?$model->email:'';
								$response['device_type'] = ($model->device_type)?$model->device_type:'';
								$response['location'] = ($model->location)?$model->location:'';
								$response['country'] = ($model->country)?$model->country:'';
								$response['state'] = ($model->state)?$model->state:'';
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
		$loginData = json_decode(file_get_contents('php://input'), TRUE);
		//$myObject = json_decode($_POST['data']);
		//$loginData = $this->objectToArray($myObject);
		if(!isset($loginData['user_type']) && $loginData['user_type'] == '' ||
			!isset($loginData['device_token']) && $loginData['device_token'] == ''){
				$response['status'] = "0";
				$response['data'] = "Please pass the user type with device token.";
		}else{
			if(isset($loginData['auth_id']) && !empty($loginData['auth_id']) || 
				isset($loginData['auth_provider']) && !empty($loginData['auth_provider'])){
								$authid = $loginData['auth_id'];
								$authprovider = $loginData['auth_provider'];
								$user_type=$loginData['user_type'];
								$model = UserDetail::model()->find("auth_id = '".$authid."' AND auth_provider = '".$authprovider."' AND user_type='".$user_type."'");
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
								}else{
										$response['status'] = "0";
										$response['data'] = "Error in Login .";	
								}
			}else{
				
				if(!isset($loginData['email']) && $loginData['email'] == ''){
					$response['status'] = "0";
					$response['data'] = "Please pass the email id.";
					}
				if(!isset($loginData['password']) && $loginData['password'] == ''){
					$response['status'] = "0";
					$response['data'] = "Please pass the Password.";
					}else{ 
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
							}else{
										$response['status'] = "0";
										$response['data'] = "Error in Login .";
							}
						}
					}
							if($usermodel){
										$response['status'] = "1";
										$response['data'] = "Login Successfully.";
										$response['user_id'] = ($usermodel->user_id)?$usermodel->user_id:'';
										$response['user_type'] = ($usermodel->user_type)?$usermodel->user_type:'';
										$response['email'] = ($usermodel->email)?$usermodel->email:'';
										$response['first_name'] = ($usermodel->first_name)?$usermodel->first_name:'';
										$response['last_name'] = ($usermodel->last_name)?$usermodel->last_name:'';
										$response['image'] = ($usermodel->image)? $usermodel->image :'';
										$response['device_type'] = ($usermodel->device_type)?$usermodel->device_type:'';
										$response['location'] = ($usermodel->location)?$usermodel->location:'';
										$city_name= City::model()->find("city_id='".$response['location']."'");
										$response['city_name'] = $city_name['city_name'];
										$response['country'] = ($usermodel->country)?$usermodel->country:'';
										$country_name= Country::model()->find("country_id='".$response['country']."'");
										$response['country_name'] = $country_name['country_name'];
										$response['state'] = ($usermodel->state)?$usermodel->state:'';
										$response['latitude'] = ($usermodel->latitude)?$usermodel->latitude:'';
										$response['longitude'] = ($usermodel->longitude)?$usermodel->longitude:'';
										$response['phone'] = ($usermodel->phone)?$usermodel->phone:'';
										$response['device_settings'] = ($usermodel->device_settings)?$usermodel->device_settings:'';
										$response['device_token'] = ($usermodel->device_token)?$usermodel->device_token:'';	
							}else{
										$response['status'] = "0";
										$response['data'] = "Error in Login .";
							}
						
									
		}							
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response);
		exit();
	}
/**
	 * @Method		  :	POST
	 * @Params		  : Username,Password
	 * @author        : Ankit Sompura
	 * @created		  :	May 28 2014
	 * @Modified by	  :
	 * @Comment		  : User Login.
	**/
	
	public function actionSocialLogin(){
		$response=array();
		$loginData = json_decode(file_get_contents('php://input'), TRUE);
		//$myObject = json_decode($_POST['data']);
		//$loginData = $this->objectToArray($myObject);
		if(!isset($loginData['auth_id']) && $loginData['auth_id'] == '' ||
		    !isset($loginData['auth_provider']) && $loginData['auth_provider'] == '' ){
				$response['status'] = "0";
				$response['data'] = "Invalid Parameters Inserted.";
		}else{
				//Check Login Data 
				$auth_id = $loginData['auth_id'];
				$auth_provider=$loginData['auth_provider'];
				$model = UserDetail::model()->find("auth_id = '".$auth_id."' AND auth_provider = '".$auth_provider."'");
				if($model){
						$response['status'] = "1";
						$response['data'] = "Record found.";	
				}else{
					$response['status'] = "0";
					$response['data'] = "No Record found.";
				}
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
	}
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
							if(isset($editData['country']) && !empty($editData['country'])){
								$model->country = $editData['country'];
							}else{
								$model->country = '';
							}
							if(isset($editData['state']) && !empty($editData['state'])){
								$model->state = $editData['state'];
							}else{
								$model->state = '';
							}
							if(isset($editData['first_name']) && !empty($editData['first_name'])){
								$model->first_name = $editData['first_name'];
							}else{
								$model->first_name = '';
							}
							if(isset($editData['last_name']) && !empty($editData['last_name'])){
								$model->last_name = $editData['last_name'];
							}else{
								$model->last_name = '';
							}
							if(isset($editData['image']) && !empty($editData['image'])){
								$model->image = $editData['image'];
							}else{
								$model->image = '';
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
								$city_name= City::model()->find("city_id='".$response['location']."'");
								$response['city_name'] = $city_name['city_name'];
								$response['country'] = ($model->country)?$model->country:'';
								$country_name= Country::model()->find("country_id='".$response['country']."'");
								$response['country_name'] = $country_name['country_name'];
								$response['state'] = ($model->state)?$model->state:'';
								$response['latitude'] = ($model->latitude)?$model->latitude:'';
								$response['longitude'] = ($model->longitude)?$model->longitude:'';
								$response['image'] = ($model->image)? $model->image :'';
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
		//$settingsData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$settingsData = $this->objectToArray($myObject);
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
								$response['country'] = ($userData->country)?$userData->country:'';
								$response['latitude'] = ($userData->latitude)?$userData->latitude:'';
								$response['longitude'] = ($userData->longitude)?$userData->longitude:'';
								$response['image'] = ($userData->image)?$userData->image:'';	
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
	date_default_timezone_set('Europe/Oslo');
		$response=array();
		//$offerData = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$offerData = $this->objectToArray($myObject);
		if(!isset($offerData['offer_name']) && $offerData['offer_name'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the offer name.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
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
		if(!isset($offerData['address1']) && $offerData['address1'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the your address 1.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['country']) && $offerData['country'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the your Country.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['location']) && $offerData['location'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the your location/City.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		if(!isset($offerData['currency_id']) && $offerData['currency_id'] == ''){
						$response['status'] = "0";
						$response['data'] = "Please pass the currency_id.";
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
							if(isset($offerData['offer_name']) && !empty($offerData['offer_name'])){
								$model->offer_name = $offerData['offer_name'];
							}else{
								$model->offer_name = '';
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
							
							if(isset($offerData['address1']) && !empty($offerData['address1'])){
								$model->address1 = $offerData['address1'];
							}else{
								$model->address1 = '';
							}
							if(isset($offerData['address2']) && !empty($offerData['address2'])){
								$model->address2 = $offerData['address2'];
							}else{
								$model->address2 = '';
							}
							if(isset($offerData['country']) && !empty($offerData['country'])){
								$model->country = $offerData['country'];
							}else{
								$model->country = '';
							}
							if(isset($offerData['state']) && !empty($offerData['state'])){
								$model->state = $offerData['state'];
							}else{
								$model->state = '';
							}	
							if(isset($offerData['no_of_deals']) && !empty($offerData['no_of_deals'])){
								$model->no_of_deals = $offerData['no_of_deals'];
								$model->latest_deal_count=$offerData['no_of_deals'];
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
							if(isset($offerData['cat_id']) && !empty($offerData['cat_id'])){
								$model->cat_id = $offerData['cat_id'];
							}	
							if(isset($offerData['phone']) && !empty($offerData['phone'])){
								$model->phone = $offerData['phone'];
							}
							if(isset($offerData['currency_id']) && !empty($offerData['currency_id'])){
								$model->currency_id = $offerData['currency_id'];
								
							}	
						
							if($model->save(false)){
								$response['status'] = "1";
								$response['data'] = "Offers added successfully.";
								$response['offer_start_date'] = ($model->offer_start_date)?$model->offer_start_date:'';
								$response['offer_end_date'] = ($model->offer_end_date)?$model->offer_end_date:'';
								$response['offer_name'] = ($model->offer_name)?$model->offer_name:'';
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
								$response['phone'] = ($model->phone)?$model->phone:'';
								$response['currency_id'] = ($model->currency_id)?$model->currency_id:'';
								$catName= Currency::model()->find("currency_id='".$model->currency_id."'");
								$response['currency_name'] = ($catName['currency_name'])?$catName['currency_name']:'';
								/* Get category name from cat_id */
								$catData = Category::model()->find("cat_id='".$model->cat_id."'");
								$response['cat_name'] = ($catData['cat_name'])?$catData['cat_name']:'';
								$response['address1'] = ($model->address1)?$model->address1:'';
								$response['address2'] = ($model->address2)?$model->address2:'';
								$response['country'] = ($model->country)?$model->country:'';
								$response['state'] = ($model->state)?$model->state:'';
								
								$city_name= City::model()->find("city_id='".$response['location']."'");
								$response['city_name'] = $city_name['city_name'];
								
								$country_name= Country::model()->find("country_id='".$response['country']."'");
								$response['country_name'] = $country_name['country_name'];
								
								$response['final_price'] = ($model->offer_price - ($response['offer_price'] * ($offerData['discount']/100)));
								
									$userData = UserDetail::model()->findAll("user_id NOT IN ('".$offerData['user_id']."') AND device_settings = '1' AND device_token NOT IN ('0')");
								 	foreach($userData as $userinfo){
								 		if($userinfo['device_type']=='2'){
											$this->AndroidPushNotification($userinfo['device_token'],$response);
										}else{
											$this->sendIphoneNotification($userinfo['device_token'],$response,$response['offer_name']);
										}
									}	
									//$messageImage=$offerData['offer_text'].','.$offerData['image'];
									
										/*$find_distance=round($this->distance($userinfo['latitude'], $userinfo['longitude'], $model->latitude, $model->longitude));
										if($find_distance <= 20){
												if($userinfo['device_type']==2){
													$this->AndroidPushNotification($userinfo['device_token'],$response);
											
												}elseif($userinfo['device_type']==1){
													$this->sendIphoneNotification($userinfo['device_token'],$response);
												}
										}elseif($userinfo['location_setting']==2){
										    if($userinfo['device_type']==2){
												$this->AndroidPushNotification($userinfo['device_token'],$response);
												
											}elseif($userinfo['device_type']==1){
												$this->sendIphoneNotification($userinfo['device_token'],$response);
											}
										}*/
										
									
								
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


public function sendIphoneNotification($deviceToken,$message,$offerName,$badge=false){
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
				$body['aps'] = array(
					'alert' => $offerName,
					'sound' => 'default',
					'message'=> $message,
					'badge'		=> 1
					);
				
				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);
	
				//echo 'Connected to APNS' . PHP_EOL;
				// Create the payload body
				//$body['aps'] = array('badge' => ($badge)?$badge+1:+1 ,'alert' => $message, 'sound' => 'default');
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

			$api_key = "AIzaSyCfFXk-Z7aSvq9faL5v1cBp1W4aHt5gEoo";
			$url = 'https://android.googleapis.com/gcm/send';
			$fields = array(
				'registration_ids' => array($deviceToken),
				'data' =>array('message'=>$offerMessage),
			);
			$headers = array(
				'Authorization: key=' . $api_key ,
				'Content-Type: application/json'
			);

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
		$type=$_REQUEST['type'];
		$location=$_REQUEST['location'];
		$cat_id=$_REQUEST['cat_id'];
		if(empty($type)&& !isset($type)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the type";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		else{
		$page_number = (isset($_REQUEST['page']) && $_REQUEST['page']!='') ? $_REQUEST['page']:'';
		$limit = 30;
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
		 
		  
				$engArray=$categoryLangData = Category::model()->findAll("parent_id=1");
				$a =array();
				 foreach ($engArray as $key) {
				  $a[]= $key['cat_id'];
   					}
				$norArray=$categoryLangData = Category::model()->findAll("parent_id=10");
				$b=array();
				foreach ($norArray as $key1) {
				  $b[]= $key1['cat_id'];
   					}
				
				
				if($cat_id>=2 && $cat_id<=8 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $a);
				}elseif($cat_id>=11 && $cat_id<=17 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $b);
				}
				
   				
				
				$q = mysql_query("SELECT NOW() as now");
				$row = mysql_fetch_array($q);
				$dt_obj = new DateTime($row['now'], new DateTimeZone('Europe/Oslo')); 
				$datetime = $this->objectToArray($dt_obj);
			    $currenttime = $datetime['date'];
			if($type==1){
								if(empty($location)&& !isset($location)){
										$getarray['status'] = "0";
										$getarray['data'] = "Please pass the location";
										header('Content-Type: application/json; charset=utf-8');
										echo json_encode($getarray);
										exit();
									}
								if(empty($cat_id)&& !isset($cat_id)){
										$getarray['status'] = "0";
										$getarray['data'] = "Please pass the category id";
										header('Content-Type: application/json; charset=utf-8');
										echo json_encode($getarray);
										exit();
									}
							if($cat_id==9 || $cat_id==18){
								
							$sql = "SELECT * FROM `offers`WHERE `latest_deal_count`> 0 AND `offer_end_date`>= '".$currenttime."' AND location = '".$location."' ORDER BY `offer_start_date` DESC LIMIT $offset,$limit";	
							}else{
							$sql = "SELECT * FROM `offers`WHERE `latest_deal_count`> 0 AND `offer_end_date`>= '".$currenttime."' AND location = '".$location."' AND (cat_id= '". $a[$te]."' OR cat_id= '". $b[$te]."')
									ORDER BY `offer_start_date` DESC LIMIT $offset,$limit";	
							}			
				
					$command = Yii::app()->db->createCommand($sql);
					$model = $command->queryAll(); 
			}elseif($type==2){
				
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
				if(empty($cat_id)&& !isset($cat_id)){
										$getarray['status'] = "0";
										$getarray['data'] = "Please pass the category id";
										header('Content-Type: application/json; charset=utf-8');
										echo json_encode($getarray);
										exit();
									}
							if($cat_id==9 || $cat_id==18){
								 $sql = "SELECT *, ( 3959 * acos( cos( radians($current_latitude) ) * cos( radians(latitude) ) * cos( radians(longitude) - radians($current_longitude) ) + sin( radians($current_latitude) ) * sin( radians(latitude) ) ) ) AS distance FROM offers
								WHERE `latest_deal_count` > 0 AND  `offer_end_date`>= '".$currenttime."' 
								HAVING distance <= $units 
				 				ORDER BY `offer_start_date` DESC LIMIT  $offset,$limit";
							}else{
								 $sql = "SELECT *, ( 3959 * acos( cos( radians($current_latitude) ) * cos( radians(latitude) ) * cos( radians(longitude) - radians($current_longitude) ) + sin( radians($current_latitude) ) * sin( radians(latitude) ) ) ) AS distance FROM offers
							WHERE `latest_deal_count` > 0 AND  `offer_end_date`>= '".$currenttime."' AND (cat_id= '". $a[$te]."' OR cat_id= '". $b[$te]."') 
							HAVING distance <= $units 
			 				ORDER BY `offer_start_date` DESC LIMIT  $offset,$limit";
							}				
							$command = Yii::app()->db->createCommand($sql);
							$model = $command->queryAll();
				
			}else{
								$getarray['status'] = "0";
								$getarray['data'] = "please pass type 1 or 2";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
			}	   
			if($model){
								foreach($model as $offerData){
									$response['offer_text'] = $offerData['offer_text'];
									$response['offer_name'] = $offerData['offer_name'];
									$response['offer_link'] = $offerData['offer_link'];
									$response['image'] = $offerData['image'];
									/* Get category name from cat_id */
									$catData = Category::model()->find("cat_id='".$offerData['cat_id']."'");
									$response['cat_name'] = ($catData['cat_name'])?$catData['cat_name']:'';
									
									$catName = Currency::model()->find("currency_id='".$offerData['currency_id']."'");
									$response['currency_id'] = $offerData['currency_id'];
									$response['currency_name'] = ($catName->currency_name)?$catName->currency_name:'';
									$response['no_of_deals'] = $offerData['latest_deal_count'];
									$response['offer_price'] = $offerData['offer_price'];
									$response['discount'] = $offerData['discount'];
									$response['final_price'] = $offerData['offer_price']-($response['offer_price'] * ($offerData['discount']/100));
									$response['offer_start_date'] = date("d M Y h:i:s",strtotime($offerData['offer_start_date']));
									$response['offer_end_date'] = date("d M Y h:i:s",strtotime($offerData['offer_end_date']));
									$response['offer_id'] = $offerData['offer_id'];
									$response['latitude'] = $offerData['latitude'];
									$response['longitude'] = $offerData['longitude'];
									$response['location'] = $offerData['location'];
									
									$city_name= City::model()->find("city_id='".$response['location']."'");
									$response['city_name'] = $city_name['city_name'];
									
								    $response['country'] = $offerData['country'];
									$country_name= Country::model()->find("country_id='".$response['country']."'");
									$response['country_name'] = $country_name['country_name'];
									
									$response['phone'] = $offerData['phone'];
                                    $response['address1'] = $offerData['address1'];
			                        $response['address2'] = $offerData['address2'];
                                    
                                    $response['state'] = $offerData['state'];
									$res['record'][]=$response;
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
		$type=$_REQUEST['type'];
		$cat_id=$_REQUEST['cat_id'];
		$location=$_REQUEST['location'];
		if(empty($type)&& !isset($type)){
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the type";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
		}
		else{
		$page_number = (isset($_REQUEST['page']) && $_REQUEST['page']!='') ? $_REQUEST['page']:'';
		$limit = 30;
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
		  
		  $engArray=$categoryLangData = Category::model()->findAll("parent_id=1");
				$a =array();
				 foreach ($engArray as $key) {
				  $a[]= $key['cat_id'];
   					}
				$norArray=$categoryLangData = Category::model()->findAll("parent_id=10");
				$b=array();
				foreach ($norArray as $key1) {
				  $b[]= $key1['cat_id'];
   					}
   				
				
				if($cat_id>=2 && $cat_id<=8 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $a);
				}elseif($cat_id>=11 && $cat_id<=17 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $b);
				}

				$q = mysql_query("SELECT NOW() as now");
				$row = mysql_fetch_array($q);
				$dt_obj = new DateTime($row['now'], new DateTimeZone('Europe/Oslo')); 
				$datetime = $this->objectToArray($dt_obj);
			    $currenttime = $datetime['date'];
			if($type==1){
						if(empty($location)&& !isset($location)){
												$getarray['status'] = "0";
												$getarray['data'] = "Please pass the location";
												header('Content-Type: application/json; charset=utf-8');
												echo json_encode($getarray);
												exit();
						}
							if(empty($cat_id)&& !isset($cat_id)){
										$getarray['status'] = "0";
										$getarray['data'] = "Please pass the category id";
										header('Content-Type: application/json; charset=utf-8');
										echo json_encode($getarray);
										exit();
									}
							if($cat_id==9 || $cat_id==18){
										$sql = "SELECT * FROM `offers`WHERE (`offer_end_date`<= '".$currenttime."' OR latest_deal_count = 0) AND location = '".$location."' ORDER BY `updated_date` DESC LIMIT $offset,$limit";				
										
							}else{
								$sql = "SELECT * FROM `offers`WHERE (`offer_end_date`<= '".$currenttime."' OR latest_deal_count = 0)   AND (cat_id= '". $a[$te]."' OR cat_id= '". $b[$te]."')  AND location = '".$location."' ORDER BY `updated_date` DESC LIMIT $offset,$limit";
														
							}		
				
				$command = Yii::app()->db->createCommand($sql);
				$model = $command->queryAll(); 
			}elseif($type==2){
				
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

					if(empty($cat_id)&& !isset($cat_id)){
										$getarray['status'] = "0";
										$getarray['data'] = "Please pass the category id";
										header('Content-Type: application/json; charset=utf-8');
										echo json_encode($getarray);
										exit();
									}
							if($cat_id==9 || $cat_id==18){
								$sql = "SELECT *, ( 3959 * acos( cos( radians($current_latitude) ) * cos( radians(latitude) ) * cos( radians(longitude) - radians($current_longitude) ) + sin( radians($current_latitude) ) * sin( radians(latitude) ) ) ) AS distance FROM offers
										WHERE (`offer_end_date`<= '".$currenttime."' OR latest_deal_count = 0)
										HAVING distance <= $units 
 										ORDER BY `updated_date` DESC  LIMIT  $offset,$limit";									
							}else{
								$sql = "SELECT *, ( 3959 * acos( cos( radians($current_latitude) ) * cos( radians(latitude) ) * cos( radians(longitude) - radians($current_longitude) ) + sin( radians($current_latitude) ) * sin( radians(latitude) ) ) ) AS distance FROM offers
										WHERE `(offer_end_date`<= '".$currenttime."' OR latest_deal_count = 0 )AND (cat_id= '". $a[$te]."' OR cat_id= '". $b[$te]."') 
										HAVING distance <= $units 
 										ORDER BY `updated_date` DESC  LIMIT  $offset,$limit";
							}

				$command = Yii::app()->db->createCommand($sql);
				$model = $command->queryAll();
			}else{
								$getarray['status'] = "0";
								$getarray['data'] = "please pass type 1 or 2";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
			}	   
			if($model){
								foreach($model as $offerData){
										$response['offer_text'] = $offerData['offer_text'];
									$response['offer_name'] = $offerData['offer_name'];
									$response['offer_link'] = $offerData['offer_link'];
									$response['image'] = $offerData['image'];
									/* Get category name from cat_id */
									$catData = Category::model()->find("cat_id='".$offerData['cat_id']."'");
									$response['cat_name'] = ($catData['cat_name'])?$catData['cat_name']:'';
									$catName = Currency::model()->find("currency_id='".$offerData['currency_id']."'");
									$response['currency_id'] = $offerData['currency_id'];
									$response['currency_name'] = ($catName->currency_name)?$catName->currency_name:'';
									$response['no_of_deals'] = $offerData['latest_deal_count'];
									$response['offer_price'] = $offerData['offer_price'];
									$response['discount'] = $offerData['discount'];
									$response['final_price'] = $offerData['offer_price']-($response['offer_price'] * ($offerData['discount']/100));
									$response['offer_start_date'] = date("d M Y h:i:s",strtotime($offerData['offer_start_date']));
									$response['offer_end_date'] = date("d M Y h:i:s",strtotime($offerData['offer_end_date']));
									$response['offer_id'] = $offerData['offer_id'];
									$response['latitude'] = $offerData['latitude'];
									$response['longitude'] = $offerData['longitude'];
									$response['location'] = $offerData['location'];
									
									$city_name= City::model()->find("city_id='".$response['location']."'");
									$response['city_name'] = $city_name['city_name'];
									
								    $response['country'] = $offerData['country'];
									$country_name= Country::model()->find("country_id='".$response['country']."'");
									$response['country_name'] = $country_name['country_name'];
									
									$response['phone'] = $offerData['phone'];
                                    $response['address1'] = $offerData['address1'];
			                        $response['address2'] = $offerData['address2'];
                                    $response['state'] = $offerData['state'];
									$res['record'][]=$response;
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
							$response['no_of_deals']=$offerData['latest_deal_count'];
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
	 * @Method		  :	GET
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	September 3rd 2014
	 * @Modified by	  :
	 * @Comment		  : to get list of offers of a particular user
	**/
	public function actionOfferList(){
		$user_id=$_REQUEST['user_id'];
		$cat_id=$_REQUEST['cat_id'];
		$getarray=array();
		$res=array();
	    if(!isset($user_id) && $user_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the user id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		  if(!isset($cat_id) && $cat_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the category id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
		}
		else{
			
					if($cat_id==9 || $cat_id==18){
						$offerList = Offers::model()->findAll("user_id = '".$user_id."' ORDER BY `offer_start_date` DESC");
					}else{
						$engArray=$categoryLangData = Category::model()->findAll("parent_id=1");
						$a =array();
						 foreach ($engArray as $key) {
						  $a[]= $key['cat_id'];
		   					}
						$norArray=$categoryLangData = Category::model()->findAll("parent_id=10");
						$b=array();
						foreach ($norArray as $key1) {
						  $b[]= $key1['cat_id'];
		   					}
		   				
						if($cat_id>=2 && $cat_id<=8 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $a);
				}elseif($cat_id>=11 && $cat_id<=17 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $b);
				}
						
						$offerList = Offers::model()->findAll("user_id = '".$user_id."' AND (cat_id= '". $a[$te]."' OR cat_id= '". $b[$te]."')  ORDER BY `offer_start_date` DESC");
					}
			
						if($offerList){
							foreach($offerList as $offerData){
							$response['offer_text'] = $offerData['offer_text'];
									$response['offer_name'] = $offerData['offer_name'];
									$response['offer_link'] = $offerData['offer_link'];
									$response['image'] = $offerData['image'];
											/* Get category name from cat_id */
									$catData = Category::model()->find("cat_id='".$offerData['cat_id']."'");
									$response['cat_name'] = ($catData['cat_name'])?$catData['cat_name']:'';
									$catName = Currency::model()->find("currency_id='".$offerData['currency_id']."'");
									$response['currency_id'] = $offerData['currency_id'];
									$response['currency_name'] = ($catName->currency_name)?$catName->currency_name:'';
									$response['no_of_deals'] = $offerData['latest_deal_count'];
									$response['offer_price'] = $offerData['offer_price'];
									$response['discount'] = $offerData['discount'];
									$response['final_price'] = $offerData['offer_price']-($response['offer_price'] * ($offerData['discount']/100));
									$response['offer_start_date'] = date("d M Y h:i:s",strtotime($offerData['offer_start_date']));
									$response['offer_end_date'] = date("d M Y h:i:s",strtotime($offerData['offer_end_date']));
									$response['offer_id'] = $offerData['offer_id'];
									$response['latitude'] = $offerData['latitude'];
									$response['longitude'] = $offerData['longitude'];
									$response['location'] = $offerData['location'];
									
									$city_name= City::model()->find("city_id='".$response['location']."'");
									$response['city_name'] = $city_name['city_name'];
									
								    $response['country'] = $offerData['country'];
									$country_name= Country::model()->find("country_id='".$response['country']."'");
									$response['country_name'] = $country_name['country_name'];
									
									$response['phone'] = $offerData['phone'];
                                    $response['address1'] = $offerData['address1'];
			                        $response['address2'] = $offerData['address2'];
                                    $response['state'] = $offerData['state'];
									
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

			/**
	 * @Method		  :	GET
	 * @Params		  : 
	 * @author        : Binal Thakkar
	 * @created		  :	september 10 2014
	 * @Modified by	  :
	 * @Comment		  : to City List
	**/
	public function actionGetCityList(){
		$getarray=array();
		$res=array();
		
				$q = mysql_query("SELECT NOW() as now");
				$row = mysql_fetch_array($q);
				$dt_obj = new DateTime($row['now'], new DateTimeZone('Europe/Oslo')); 
				$datetime = $this->objectToArray($dt_obj);
			    $currenttime = $datetime['date'];
		
			//$sql = "SELECT DISTINCT(`location`),COUNT(location)AS count FROM `offers` WHERE `offer_end_date`>= '".$currenttime."' AND `latest_deal_count`> 0 GROUP BY `location`";
				$sql=("SELECT DISTINCT(offers.`location`),COUNT(offers.location)AS count ,city.* FROM `offers` JOIN city ON offers.`location` = city.city_id WHERE  offers.`offer_end_date`>= '".$currenttime."' AND offers.`latest_deal_count`> 0 GROUP BY `location`");
				$command = Yii::app()->db->createCommand($sql);
				$offerData = $command->queryAll(); 
						if($offerData){
							foreach($offerData as $offerCity){
								$response['city_id']=$offerCity['city_id'];
								$response['city_name']=$offerCity['city_name'];
								$response['count']=$offerCity['count'];
								$res[]=$response;
							}
						}
						if($res){
								$getarray['status'] = "1";
								$getarray['city'] =$res;
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
	/**
	 * @Method		  :	GET
	 * @Params		  : 
	 * @author        : Binal Thakkar
	 * @created		  :	september 10 2014
	 * @Modified by	  :
	 * @Comment		  : Searching
	**/
	public function actionSearching(){
		$getarray=array();
		$res=array();
		$location=$_REQUEST['location'];
		$price=$_REQUEST['price'];
		$offer_name=$_REQUEST['offer_name'];
			if(!empty($location)|| !empty($price) || !empty($offer_name)){
				$offers = Offers::model()->findAll("location='".$location."' OR offer_price='".$price."' OR offer_text='".$offer_name."'");
			}
						if($offers){
							foreach($offers as $offerData){
								$response['no_of_deals']=$offerData['no_of_deals'];
								$response['offer_name'] = $offerData['offer_name'];
								$response['offer_text'] = $offerData['offer_text'];
								$response['user_id'] = $offerData['user_id'];
								$response['offer_link'] = $offerData['offer_link'];
								$response['image'] = $offerData['image'];
								$catName = Currency::model()->find("currency_id='".$offerData['currency_id']."'");
								$response['currency_id'] = $offerData['currency_id'];
								$response['currency_name'] = ($catName->currency_name)?$catName->currency_name:'';
								$response['location'] = $offerData['location'];
								$response['offer_status'] = $offerData['offer_status'];
								$response['no_of_deals'] = $offerData['latest_deal_count'];
								$response['offer_price'] = $offerData['offer_price'];
								$response['offer_start_date'] = date("d M Y h:i:s",strtotime($offerData['offer_start_date']));
								$response['offer_end_date'] = date("d M Y h:i:s",strtotime($offerData['offer_end_date']));
								$response['latitude'] = $offerData['latitude'];
								$response['longitude'] = $offerData['longitude'];
								$response['offer_id'] = $offerData['offer_id'];
								$response['discount'] = $offerData['discount'];
								$response['address1'] = $offerData['address1'];
								$response['address2'] = $offerData['address2'];
								$response['country'] = $offerData['country'];
								$response['state'] = $offerData['state'];
								$res[]=$response;
							}
						}
						if($res){
								$getarray['status'] = "1";
								$getarray['location'] =$res;
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

	/**
	 * @Method		  :	Post
	 * @Params		  : user_id,offer_id.
	 * @author        : Binal Thakkar
	 * @created		  :	September 12 2014
	 * @Modified by	  :
	 * @Comment		  : buy the deal
	**/
	// public function actionBuyDeal(){
  		// //$buyDeal = json_decode(file_get_contents('php://input'), TRUE);
		// $myObject = json_decode($_POST['data']);
		// $buyDeal = $this->objectToArray($myObject);
			// if(!isset($buyDeal['offer_id']) || $buyDeal['offer_id'] ==''){
					// $response['data']['error']='Please pass the offer id.';
					// $response['status']='0';
					// header('Content-Type: application/json; charset=utf-8');
					// echo json_encode($response);
				// exit();
					// }
				 // if(!isset($buyDeal['user_id']) || $buyDeal['user_id'] == '' ){
				 	// $response['data']['error']='Please User Id .';
					   // $response['status']='0';
					  // header('Content-Type: application/json; charset=utf-8');
					// echo json_encode($response);
					// exit();
				 	// }
				 // if(!isset($buyDeal['no_of_deals']) || $buyDeal['no_of_deals'] == '' ){
				 	// $response['data']['error']='Please pass no of deals .';
					   // $response['status']='0';
				 	// } 
// 				 
				// else{
// 					
						// $offerData = Offers::model()->find("offer_id = '".$buyDeal['offer_id']."' AND latest_deal_count > 0");
						// if($offerData){
						// $id = $offerData['offer_id'];
						// $model1 = $this->loadModel($id,'Offers');
						// $model1->latest_deal_count=$offerData['latest_deal_count']- $buyDeal['no_of_deals'];
							// $model = new DealUser();
// 							
							// if(isset($buyDeal['offer_id']) && !empty($buyDeal['offer_id'])){
								// $model->offer_id = $buyDeal['offer_id'];
							// }
							// if(isset($buyDeal['user_id']) && !empty($buyDeal['user_id'])){
								// $model->user_id = $buyDeal['user_id'];
							// }
							// if($model->save(false) && $model1->save(false)){
								// $userData = UserDetail::model()->find("user_id = '".$buyDeal['user_id']."' AND device_settings=1");
								// //$offerData = Offers::model()->find("offer_id = '".$buyDeal['offer_id']."'");
								// if(isset($userData) && !empty($userData)){
									// $message="Congratulation you got the deal...";
									// if($userData['device_type']==2){
											// $this->AndroidPushNotification($userData['device_token'],$message);
										// }elseif($userData['device_type']==1){
													// $this->sendIphoneNotification($userData['device_token'],$message);
										// }
								// }
// 								
								// $response['status'] = "1";
								// $response['data'] = "Deal successfully bought.";
								// header('Content-Type: application/json; charset=utf-8');
								// echo json_encode($response);
								// exit();
							// }else{
								// $response['status'] = "0";
								// $response['data'] = "Fail to buy the deal";
								// header('Content-Type: application/json; charset=utf-8');
								// echo json_encode($response);
								// exit();
							// }
// 										
		// }else{
								// $response['status'] = "0";
								// $response['data'] = "Deal not found.";
								// header('Content-Type: application/json; charset=utf-8');
								// echo json_encode($response);
								// exit();
							// }
	// }
	// }
		public function actionBuyDeal(){
  		//$buyDeal = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$buyDeal = $this->objectToArray($myObject);
			if(!isset($buyDeal['offer_id']) || $buyDeal['offer_id'] ==''){
					$response['data']['error']='Please pass the offer id.';
					$response['status']='0';
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
				exit();
					}
				 if(!isset($buyDeal['user_id']) || $buyDeal['user_id'] == '' ){
				 	$response['data']['error']='Please User Id .';
					   $response['status']='0';
					  header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();
				 	}
				 if(!isset($buyDeal['price']) || $buyDeal['price'] == '' ){
				 	$response['data']['error']='Please pass payment price.';
					   $response['status']='0';
				 	} 
				 	if(!isset($buyDeal['payment_status']) || $buyDeal['payment_status'] == '' ){
				 	$response['data']['error']='Please pass payment_status .';
					   $response['status']='0';
				 	} 
					if(!isset($buyDeal['payment_date']) || $buyDeal['payment_date'] == '' ){
				 	$response['data']['error']='Please pass payment_date .';
					   $response['status']='0';
				 	} 
				 
				else{
					
						$offerData = Offers::model()->find("offer_id = '".$buyDeal['offer_id']."' AND latest_deal_count > 0");
						if($offerData){
						$id = $offerData['offer_id'];
						$model1 = $this->loadModel($id,'Offers');
						$model1->latest_deal_count=$offerData['latest_deal_count']- $buyDeal['no_of_deals'];
							$model = new DealUser();
							
							if(isset($buyDeal['offer_id']) && !empty($buyDeal['offer_id'])){
								$model->offer_id = $buyDeal['offer_id'];
							}
							if(isset($buyDeal['user_id']) && !empty($buyDeal['user_id'])){
								$model->user_id = $buyDeal['user_id'];
							}
							if($model->save(false) && $model1->save(false)){			
								
							$modelPayment = new Payment();
							if(isset($buyDeal['offer_id']) && !empty($buyDeal['offer_id'])){
								$modelPayment->offer_id = $buyDeal['offer_id'];
							}
							if(isset($buyDeal['user_id']) && !empty($buyDeal['user_id'])){
								$modelPayment->user_id = $buyDeal['user_id'];
							}
							if(isset($buyDeal['payment_date']) && !empty($buyDeal['payment_date'])){
								$modelPayment->payment_date =date("Y-m-d H:i:s",strtotime($buyDeal['payment_date']));
							}
							if(isset($buyDeal['price']) && !empty($buyDeal['price'])){
								$modelPayment->price = $buyDeal['price'];
							}
							if(isset($buyDeal['payment_status']) && !empty($buyDeal['payment_status'])){
								$modelPayment->payment_status = $buyDeal['payment_status'];
							}
								$payment=$modelPayment->save(false);
								$userData = UserDetail::model()->find("user_id = '".$buyDeal['user_id']."' AND device_settings=1");
								//$offerData = Offers::model()->find("offer_id = '".$buyDeal['offer_id']."'");
								if(isset($userData) && !empty($userData) && !empty($payment)){
									$message="Congratulation you got the deal...";
									if($userData['device_type']==2){
											$this->AndroidPushNotification($userData['device_token'],$message);
										}elseif($userData['device_type']==1){
													$this->sendIphoneNotification($userData['device_token'],$message);
										}
								}
								
								$response['status'] = "1";
								$response['data'] = "Deal successfully bought.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}else{
								$response['status'] = "0";
								$response['data'] = "Fail to buy the deal";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
								exit();
							}
										
		}else{
								$response['status'] = "0";
								$response['data'] = "Deal not found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($response);
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
	/*public function actionChnageOfferCount(){
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
						$model->latest_deal_count=$offerData['latest_deal_count']- $changeCount['no_of_deals'];
						if($model->save(false))
						{
								$getarray['status'] = "1";
								$getarray['no_of_deals'] =$model->latest_deal_count;
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
	}*/
/**
	 * @Method		  :	Post
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	September 12 2014
	 * @Modified by	  :
	 * @Comment		  : particular users deals.
	**/
	public function actionUserDeals(){
		$getarray=array();
		$res=array();
  		$user_id=$_REQUEST['user_id'];
		$cat_id=$_REQUEST['cat_id'];
				 if(!isset($user_id) || $user_id == '' ){
				 	$response['data']['error']='Please User Id .';
					$response['status']='0';
					header('Content-Type: application/json; charset=utf-8');
					echo json_encode($response);
					exit();   
				 	}
				 	  if(!isset($cat_id) && $cat_id == ''){
						$response['status'] = "0";
						$response['data'] = "Please Pass the category id.";
						header('Content-Type: application/json; charset=utf-8');
						echo json_encode($response);
						exit();
					}
				 	else{
				 		if($cat_id==9 || $cat_id==18){
				 				$sql = "SELECT offers.*,deal_user.* FROM `offers` JOIN 
				 				deal_user ON offers.`offer_id`= deal_user.`offer_id` 
				 				WHERE deal_user.`user_id`= $user_id  ORDER BY offers.`offer_id` DESC";
				 		}else{
				 			
							$engArray=$categoryLangData = Category::model()->findAll("parent_id=1");
							$a =array();
							 foreach ($engArray as $key) {
							  $a[]= $key['cat_id'];
			   					}
							$norArray=$categoryLangData = Category::model()->findAll("parent_id=10");
							$b=array();
							foreach ($norArray as $key1) {
							  $b[]= $key1['cat_id'];
			   					}
			   				
							if($cat_id>=2 && $cat_id<=8 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $a);
				}elseif($cat_id>=11 && $cat_id<=17 && $cat_id!=9 && $cat_id!=18){
					$te = array_search($cat_id, $b);
				}
							
				 			$sql = "SELECT offers.*,deal_user.* FROM `offers` JOIN 
				 				deal_user ON offers.`offer_id`= deal_user.`offer_id` 
				 				WHERE deal_user.`user_id`= $user_id  AND (cat_id= '". $a[$te]."' OR cat_id= '". $b[$te]."') ORDER BY offers.`offer_id` DESC";
				 		}
				 		
						$command = Yii::app()->db->createCommand($sql);
						$offerDetail = $command->queryAll();
						
						//$deal=DealUser::model()->findAll("user_id = '".$user_id."'");
						
							if($offerDetail){
								foreach($offerDetail as $offerData){
								/*$offerData = Offers::model()->find("offer_id = '".$userDeals['offer_id']."'");
							
								if($offerData)
								{*/
								$response['user_id']=$user_id;		
								$response['no_of_deals']=$offerData['no_of_deals'];
								$response['offer_name'] = $offerData['offer_name'];
								$response['offer_text'] = $offerData['offer_text'];
								$response['user_id'] = $offerData['user_id'];
								$response['offer_link'] = $offerData['offer_link'];
								$response['image'] = $offerData['image'];
											/* Get category name from cat_id */
								$catData = Category::model()->find("cat_id='".$offerData['cat_id']."'");
								$response['cat_name'] = ($catData['cat_name'])?$catData['cat_name']:'';
								$catName = Currency::model()->find("currency_id='".$offerData['currency_id']."'");
								$response['currency_id'] = $offerData['currency_id'];
								$response['currency_name'] = ($catName->currency_name)?$catName->currency_name:'';
								$response['location'] = $offerData['location'];
								
								$city_name= City::model()->find("city_id='".$response['location']."'");
								$response['city_name'] = $city_name['city_name'];
									
							    $response['country'] = $offerData['country'];
								$country_name= Country::model()->find("country_id='".$response['country']."'");
								$response['country_name'] = $country_name['country_name'];
								
								$response['offer_status'] = $offerData['offer_status'];
								$response['no_of_deals'] = $offerData['no_of_deals'];
								$response['offer_price'] = $offerData['offer_price'];
								$response['discount'] = $offerData['discount'];
								$response['final_price'] = $offerData['offer_price']-($response['offer_price'] * ($offerData['discount']/100));
								$response['offer_start_date'] = date("d M Y h:i:s",strtotime($offerData['offer_start_date']));
								$response['offer_end_date'] = date("d M Y h:i:s",strtotime($offerData['offer_end_date']));
								$response['latitude'] = $offerData['latitude'];
								$response['longitude'] = $offerData['longitude'];
								$response['offer_id'] = $offerData['offer_id'];
								$response['address1'] = $offerData['address1'];
								$response['address2'] = $offerData['address2'];
								$response['state'] = $offerData['state'];
								$response['phone'] = $offerData['phone'];
								$res[]=$response;
								}
							//}	
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
										
		}
	}
	/**
	 * @Method		  :	GET
	 * @Params		  : 
	 * @author        : Binal Thakkar
	 * @created		  :	September 22 2014
	 * @Modified by	  :
	 * @Comment		  : to get category list.
	**/
	/*public function actionCategoryList(){
		$getarray=array();
		$res=array();
			$categoryData = Category::model()->findAll();
						if($categoryData){
							foreach($categoryData as $catogoryList){
								$response['cat_id']=$catogoryList['cat_id'];
								$response['cat_name']=$catogoryList['cat_name'];
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
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}		
	}*/
	
		public function actionCategoryList(){
		$getarray=array();
		$res=array();
			$cat_language=$_REQUEST['cat_language'];
			$categoryLangData = Category::model()->find('cat_name="'.$cat_language.'"');
			if(isset($categoryLangData)&& !empty($categoryLangData)){
						$categoryData = Category::model()->findAll('parent_id="'.$categoryLangData['cat_id'].'"');
					if($categoryData){
							foreach($categoryData as $catogoryList){
								$response['cat_id']=$catogoryList['cat_id'];
								$response['cat_name']=$catogoryList['cat_name'];
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
								$getarray['data'] = "No data found.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
						}	
			}else{
								$getarray['status'] = "0";
								$getarray['data'] = "Please pass the English OR Norway.";
								header('Content-Type: application/json; charset=utf-8');
								echo json_encode($getarray);
								exit();
			}
						
	}
	/**
	 * @Method		  :	GET
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	August 9 2014
	 * @Modified by	  :
	 * @Comment		  : Currency.
	**/
	public function actionGetCurrencyCode(){
		$response=array();
		$getarray=array();
		
			$currency = Currency::model()->findAll();
						if($currency){
							foreach($currency as $currencyCode){
								$currencyName['currency_id']=$currencyCode['currency_id'];
								$currencyName['currency_name']=$currencyCode['currency_name'];
								$response[]=$currencyName;
							}
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
		/**
	 * @Method		  :	GET
	 * @Params		  : user_id.
	 * @author        : Binal Thakkar
	 * @created		  :	October 14 2014
	 * @Modified by	  :
	 * @Comment		  : City withState.
	**/
	public function actionCityState(){

		$res = array();
	 	$response=array();
	 	$getDepartmentData = array();
		$countryData = Country::model()->findAll();
		foreach ($countryData as $countryDetail){
			$res['country_id'] = $countryDetail['country_id'];
			  $res['country_name'] = $countryDetail['country_name'];
			  $cityData = City::model()->findAll('country_id = "'.$countryDetail['country_id'].'"');
			  $getSubcategory = array();
			  foreach ($cityData as $cityDetails){
			  	$city['city_id'] = $cityDetails['city_id'];
			  	 $city['city_name'] = $cityDetails['city_name'];
				 $getSubcategory[]=$city;
			  }
			  $res['city'] = $getSubcategory;
			  $getDepartmentData[] = $res;
		}
		if($getDepartmentData){
				$response['status'] = "1";
				$response['data'] = $getDepartmentData;
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
		}else{
				$response['status'] = "0";
				$response['data'] = "No records found.";
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
		
	}		
	}	
	public function actionPaidOfferStatus(){
		//$buyDeal = json_decode(file_get_contents('php://input'), TRUE);
		$myObject = json_decode($_POST['data']);
		$buyDeal = $this->objectToArray($myObject);
		$finalResponse = array();	
			if(!isset($buyDeal['user_id']) || $buyDeal['user_id'] ==''){
				$finalResponse['data']['error']='Please pass the user id.';
				$finalResponse['status']='0';
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
				}
			if(!isset($buyDeal['user_type']) || $buyDeal['user_type'] ==''){
				$finalResponse['data']['error']='Please pass the user type.';
				$finalResponse['status']='0';
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($response);
				exit();
				}
			else{
				if($buyDeal['user_type']=='1'){
					
					$response=array();
					$paidOffer = Payment::model()->findAll("user_id='".$buyDeal['user_id']."'");
					if($paidOffer){
						foreach($paidOffer as $offers){
							$offerPrice = Yii::app()->db->createCommand("SELECT offers.*,currency.* FROM `offers` JOIN currency ON offers.currency_id=currency.currency_id WHERE offers.offer_id='".$offers['offer_id']."'");
							$offerDetails = $offerPrice->queryRow();
							//$offerDetails = Offers::model()->find("offer_id='".$offers['offer_id']."'");
							if($offerDetails){
								$offerpayment['offer_name']=$offerDetails['offer_name'];
								$offerpayment['currency']=$offerDetails['currency_name'];
								//$offerpayment['total_qty']=	$offerDetails['no_of_deals'];
							}
							$offerpayment['offer_id']=$offers['offer_id'];
							$offerpayment['payment_date']=$offers['payment_date'];
							$offerpayment['price']=$offers['price'];		
							$response[]=$offerpayment;
						}
						$count = count($response);
						for ($i=0; $i < $count; $i++) { 
						$offerPrice = Yii::app()->db->createCommand("SELECT COUNT( `offer_id` )AS qty FROM `payment` WHERE `offer_id` ='".$response[$i]['offer_id']."' AND user_id='".$buyDeal['user_id']."'");
						$price = $offerPrice->queryRow();
						if($price){
									$response[$i]['purchased_qty'] = $price['qty'];
									
						}	
						}

						if($response){
							$finalResponse['status'] = "1";
							$finalResponse['data'] = $response;
							header('Content-Type: application/json; charset=utf-8');
							echo json_encode($finalResponse);
							exit();
						}
					}else{
							$finalResponse['status'] = "0";
							$finalResponse['data'] = "No Records found";
							header('Content-Type: application/json; charset=utf-8');
							echo json_encode($finalResponse);
							exit();
					}
				}elseif($buyDeal['user_type']=='2'){
						$response=array();
						//$OfferDetails = Offers::model()->findAll("user_id='".$buyDeal['user_id']."'");
						$offers = Yii::app()->db->createCommand("SELECT offers.*,currency.* FROM `offers` JOIN currency ON offers.currency_id=currency.currency_id WHERE offers.user_id='".$buyDeal['user_id']."'");
						$OfferDetails = $offers->queryAll();
						if($OfferDetails){
							
						foreach($OfferDetails as $offers){
							$offerpayment['offer_id']=	$offers['offer_id'];
							$offerpayment['currency']=	$offers['currency_name'];
							$offerpayment['offer_name']=	$offers['offer_name'];
							$offerpayment['total_qty']=	$offers['no_of_deals'];
							$offerpayment['remaining_qty']=	$offers['latest_deal_count'];
							$offerpayment['offer_start_date']=	$offers['offer_start_date'];
							$response[]=$offerpayment;
						}
						
						$count = count($response);
						for ($i=0; $i < $count; $i++) { 
						$offerPrice = Yii::app()->db->createCommand("SELECT  SUM( `price` )AS qty FROM `payment` WHERE `offer_id` ='".$response[$i]['offer_id']."'");
						$price = $offerPrice->queryRow();
						if($price){
									$response[$i]['total_price'] = $price['qty'];		
						}	
					}
						if($response){
							$finalResponse['status'] = "1";
							$finalResponse['data'] = $response;
							header('Content-Type: application/json; charset=utf-8');
							echo json_encode($finalResponse);
							exit();
						}
					}else{
							$finalResponse['status'] = "0";
							$finalResponse['data'] = "No Records found";
							header('Content-Type: application/json; charset=utf-8');
							echo json_encode($finalResponse);
							exit();
					}
				}
			}
	}	
	
}