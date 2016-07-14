<?php

Yii::import('application.models._base.BaseDealers');

class Dealers extends BaseDealers
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
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
		$criteria->compare('country', $this->country);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('location', $this->location);
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
}