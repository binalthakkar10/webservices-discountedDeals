<?php

Yii::import('application.models._base.BaseDealUser');

class DealUser extends BaseDealUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}