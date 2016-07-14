<?php

Yii::import('application.models._base.BaseContactus');

class Contactus extends BaseContactus
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function rules() {
		return array(
			array('name, email, message,', 'required'),
			array('email','email'),
			array('name, email, message', 'length', 'max'=>255),
			array('staus', 'length', 'max'=>1),
			array('id, name, email, message, send_date, staus', 'safe', 'on'=>'search'),
		);
	}
	
}