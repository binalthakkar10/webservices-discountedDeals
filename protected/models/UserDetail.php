<?php

Yii::import('application.models._base.BaseUserDetail');

class UserDetail extends BaseUserDetail
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	public function beforeSave() {
    	if ($this->isNewRecord)
        	$this->created_date = new CDbExpression('NOW()');
    	else
        	$this->updated_date = new CDbExpression('NOW()');
 
    	return parent::beforeSave();
	}
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('auth_id', $this->auth_id, true);
		$criteria->compare('auth_provider', $this->auth_provider, true);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('location', $this->location, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('device_type', $this->device_type);
		$criteria->compare('device_token', $this->device_token, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('is_active', $this->is_active);
		$criteria->compare('is_deleted', $this->is_deleted);
		$criteria->compare('device_settings', $this->device_settings);
		$criteria->compare('user_type', $this->user_type);
		$criteria->compare('location_setting', $this->location_setting, true);
		$criteria->addCondition('user_type="1"');

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
	public function dealerssearch() {
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('auth_id', $this->auth_id, true);
		$criteria->compare('auth_provider', $this->auth_provider, true);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('location', $this->location, true);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('device_type', $this->device_type);
		$criteria->compare('device_token', $this->device_token, true);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('is_active', $this->is_active);
		$criteria->compare('is_deleted', $this->is_deleted);
		$criteria->compare('device_settings', $this->device_settings);
		$criteria->compare('user_type', $this->user_type);
		$criteria->compare('location_setting', $this->location_setting, true);
		$criteria->addCondition('user_type="2"');

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
		public function rules() {
		return array(
			array('email, phone, password, location,device_type', 'required'),
			array('device_type, status, is_active, is_deleted, device_settings, user_type', 'numerical', 'integerOnly'=>true),
			array('auth_id, password', 'length', 'max'=>250),
			array('auth_provider', 'length', 'max'=>8),
			array('first_name, last_name, email, phone, country, state, location, latitude, longitude', 'length', 'max'=>100),
			array('image', 'length', 'max'=>255),
			array('device_token', 'length', 'max'=>500),
			array('location_setting', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			array('auth_provider, updated_date, status, is_active, is_deleted, device_settings, location_setting', 'default', 'setOnEmpty' => true, 'value' => null),
			array('user_id, auth_id, auth_provider, first_name, last_name, email, phone, password, country, state, location, latitude, longitude, image, device_type, device_token, created_date, updated_date, status, is_active, is_deleted, device_settings, user_type, location_setting', 'safe', 'on'=>'search'),
		);
	}
	public function attributeLabels() {
		return array(
			'user_id' => Yii::t('app', 'User'),
			'auth_id' => Yii::t('app', 'Auth'),
			'auth_provider' => Yii::t('app', 'Auth Provider'),
			'first_name' => Yii::t('app', 'First Name'),
			'last_name' => Yii::t('app', 'Last Name'),
			'email' => Yii::t('app', 'Email'),
			'phone' => Yii::t('app', 'Phone'),
			'password' => Yii::t('app', 'Password'),
			'country' => Yii::t('app', 'Country'),
			'state' => Yii::t('app', 'State'),
			'location' => Yii::t('app', 'City'),
			'latitude' => Yii::t('app', 'Latitude'),
			'longitude' => Yii::t('app', 'Longitude'),
			'image' => Yii::t('app', 'Image'),
			'device_type' => Yii::t('app', 'Device Type'),
			'device_token' => Yii::t('app', 'Device Token'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
			'is_active' => Yii::t('app', 'Is Active'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'device_settings' => Yii::t('app', 'Device Settings'),
			'user_type' => Yii::t('app', 'User Type'),
			'location_setting' => Yii::t('app', 'Location Setting'),
			'dealUsers' => null,
			'notifications' => null,
			'offers' => null,
			'payments' => null,
		);
	}
	public function getUserName($user_id)
	{
		$modelData = UserDetail::model()->find('user_id = "'.$user_id.'"');
		
		return $modelData->email;
	}
	public function getCountryName($country){
		$coutryName=Country::model()->find("country_id = '".$country."'");
		return $coutryName['country_name'];
	}
	public function getCityName($city){
		$cityName=City::model()->find("city_id = '".$city."'");
		return $cityName['city_name'];
	}
		public function getUserFirstName(){
			
			$sql = (Yii::app()->db->createCommand("SELECT first_name,user_id FROM user_detail where user_type='2' GROUP BY `first_name`"));
			
			$userName = $sql->queryAll();
			
		//$userName=UserDetail::model()->findAll("user_type='2'",array('select'=>'first_name', 'distinct'=>true));
		if($userName){
						$response=array();
						foreach ($userName as $userData){
						$response[$userData['user_id']]=$userData['first_name'];
						
						}
						if($response){
							return $response;
						}else{
							return false;	
						}			
		}

	}
		public function getName($user_id){
		$userName=UserDetail::model()->find("user_id = '".$user_id."'");
		if($userName['first_name'])
		return $userName['first_name'];
		else 
		return false;
	}	
}