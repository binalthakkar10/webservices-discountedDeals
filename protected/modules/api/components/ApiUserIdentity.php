<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ApiUserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIV=4;
	const ERROR_STATUS_BAN=5;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if (strpos($this->username,"@")) {
			//$user=User::model()->findByAttributes(array('email'=>$this->username));
		} else {
			$user=User::model()->find('activated=1 AND username="'.$this->username.'"'); //array('username'=>$this->username));
		}


		if($user===null)
		if (strpos($this->username,"@")) {
			$this->errorCode=self::ERROR_EMAIL_INVALID;
		} else {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if(Yii::app()->getModule('api')->encrypting($this->password)!==$user->password) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}else {
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
				
			Yii::app()->user->setId($this->_id);
			Yii::app()->user->guestName = $user->username;
			$userData = $user->attributes;
			Yii::app()->user->setState('apiUser',$userData);
		}
		return !$this->errorCode;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		
		return $this->_id;
	}
}