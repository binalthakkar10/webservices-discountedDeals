<?php

class OffersController extends AdminCoreController {


	public function actionView($id) {
		$this->pageTitle = " View Deal || Yadeal";
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Offers'),
		));
	}

	public function actionCreate() {
		$this->pageTitle = " Create Deal || Yadeal";
		$model = new Offers;


		if (isset($_POST['Offers'])) {
			$model->setAttributes($_POST['Offers']);
			if($model->validate()){
			$model->offer_start_date=date('Y-m-d H:i:s',strtotime($_POST['Offers']['offer_start_date']));
			$model->offer_end_date=date('Y-m-d H:i:s',strtotime($_POST['Offers']['offer_end_date']));
			//$model->user_id=97;
			$model->latest_deal_count=$model->no_of_deals;
			if(($model->offer_start_date) <= ($model->offer_end_date))
			{
					if($_POST['Offers']['image']==''){
					if(($_FILES['Offers']['name']['image']!=''))
					{
							
						$width = "320";
						$height = "436";
						$path	= 	YiiBase::getPathOfAlias('webroot');
						$url ='http://'.$_SERVER['HTTP_HOST']. Yii::app()->baseUrl;
						$model->image=$_FILES['Offers']['name']['image'];
						$model->image = CUploadedFile::getInstance($model, 'image');
						$model->image->saveAs($path.'/upload/OfferImage/'.$model->image);
						$image = Yii::app()->image->load($path.'/upload/OfferImage/'.$model->image);
						$image->resize($width, $height);
						$image->save();
						$image_path=$url.'/upload/OfferImage/'.$model->image;
						$model->image= $model->image;
					}
					
					
			}else{
					$model->image = $_POST['Offers']['image'];

			}
			
							$userData = UserDetail::model()->findAll("user_id NOT IN ('".$model->user_id."') AND device_settings=1");
								 	if($userData){
									$messageImage=$model->offer_text.','.$model->image;
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
				//p($model);
			}else{
				
				Yii::app()->admin->setFlash('error', Yii::t("messages","End date should be greater than start date"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();
					}
			}		
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('admin', 'id' => $model->offer_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$this->pageTitle = " Update Deal || Yadeal";
		$model = $this->loadModel($id, 'Offers');


		if (isset($_POST['Offers'])) {
			$model->setAttributes($_POST['Offers']);
		if($model->validate()){
			$model->offer_start_date=date('Y-m-d H:i:s',strtotime($_POST['Offers']['offer_start_date']));
			$model->offer_end_date=date('Y-m-d H:i:s',strtotime($_POST['Offers']['offer_end_date']));

			if(($model->offer_start_date) <= ($model->offer_end_date))
			{
					if(($_FILES['Offers']['name']['image']!=''))
					{
						$width = "320";
						$height = "436";
						$path	= 	YiiBase::getPathOfAlias('webroot');
						$url ='http://'.$_SERVER['HTTP_HOST']. Yii::app()->baseUrl;
						$model->image=$_FILES['Offers']['name']['image'];
						$model->image = CUploadedFile::getInstance($model, 'image');
						$model->image->saveAs($path.'/upload/OfferImage/'.$model->image);
						$image = Yii::app()->image->load($path.'/upload/OfferImage/'.$model->image);
						$image->resize($width, $height);
						$image->save();
						$image_path=$url.'/upload/OfferImage/'.$model->image;
						$model->image= $model->image;
					}

			else{
					$model->image = $_POST['Offers']['image'];

			}
			}else{
				
				Yii::app()->admin->setFlash('error', Yii::t("messages","End date should be greater than start date"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();
					}
			}
							
			if ($model->save()) {
				$this->redirect(array('admin', 'id' => $model->offer_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Offers')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Offers');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$this->pageTitle = " Manage Deal || Yadeal";
		$model = new Offers('search');
		$model->unsetAttributes();

		if (isset($_GET['Offers']))
			$model->setAttributes($_GET['Offers']);

		$this->render('admin', array(
			'model' => $model,
		));
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
	public function distance($latitude1, $longitude1, $latitude2, $longitude2){
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    return $miles;
	}

}