<?php

Yii::import('application.models._base.BaseOffers');

class Offers extends BaseOffers
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
		public function rules() {
		return array(
			array('offer_start_date, offer_end_date, offer_text, offer_link, offer_price,location, no_of_deals, address1, country', 'required'),
			array('user_id, cat_id, currency_id, location, latest_deal_count, no_of_deals, offer_status, status, country', 'numerical', 'integerOnly'=>true),
			array('offer_price', 'numerical'),
			array('offer_name, address1, address2', 'length', 'max'=>255),
			array('offer_text', 'length', 'max'=>250),
			array('offer_link', 'length', 'max'=>1000),
			array('phone, state', 'length', 'max'=>50),
			array('image, latitude, longitude', 'length', 'max'=>100),
			array('discount', 'length', 'max'=>20),
			array('updated_date', 'safe'),
			array('offer_status, updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('offer_id, user_id, cat_id, offer_start_date, offer_end_date, offer_name, offer_text, offer_link, offer_price, currency_id, phone, image, location, latitude, longitude, latest_deal_count, no_of_deals, discount, offer_status, created_date, updated_date, status, address1, address2, country, state', 'safe', 'on'=>'search'),
		);
	}

	public function offersearch(){
		$criteria = new CDbCriteria;
		$parentId = $_REQUEST['id'];
			$criteria->compare('offer_id', $this->offer_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('cat_id', $this->cat_id);
		$criteria->compare('offer_start_date', $this->offer_start_date, true);
		$criteria->compare('offer_end_date', $this->offer_end_date, true);
		$criteria->compare('offer_name', $this->offer_name, true);
		$criteria->compare('offer_text', $this->offer_text, true);
		$criteria->compare('offer_link', $this->offer_link, true);
		$criteria->compare('offer_price', $this->offer_price);
		$criteria->compare('currency_id', $this->currency_id);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('location', $this->location);
		$criteria->compare('latitude', $this->latitude, true);
		$criteria->compare('longitude', $this->longitude, true);
		$criteria->compare('latest_deal_count', $this->latest_deal_count);
		$criteria->compare('no_of_deals', $this->no_of_deals);
		$criteria->compare('discount', $this->discount, true);
		$criteria->compare('offer_status', $this->offer_status);
		$criteria->compare('created_date', $this->created_date, true);
		$criteria->compare('updated_date', $this->updated_date, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('address1', $this->address1, true);
		$criteria->compare('address2', $this->address2, true);
		$criteria->compare('country', $this->country);
		$criteria->compare('state', $this->state, true);
		$criteria->addCondition("user_id = '".$parentId."'");
		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/*public function rules() {
		return array(
			array('offer_start_date, offer_end_date, offer_text, offer_price, location,no_of_deals,discount,latitude, longitude', 'required'),
			array('offer_status, status', 'numerical', 'integerOnly'=>true),
			array('offer_price', 'numerical'),
			array('offer_text', 'length', 'max'=>250),
			array('offer_link', 'length', 'max'=>1000),
			array('image, location', 'length', 'max'=>100),
			array('updated_date', 'safe'),
			array('offer_status, updated_date, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('offer_id, offer_start_date, offer_end_date, offer_text, offer_link, offer_price, image, location, offer_status, created_date, updated_date, status', 'safe', 'on'=>'search'),
			// array('offer_end_date', 'compare', 'compareAttribute'=>'offer_start_date', 'operator'=>'>=','allowEmpty'=>true,'message'=>'End date must be greater than start date.')		
		);
	}*/
		public static function label($n = 1) {
		return Yii::t('app', 'Deals|Deals', $n);
	}
	public function attributeLabels() {
		return array(
			'offer_id' => Yii::t('app', 'Offer'),
			'user_id' => null,
			'offer_start_date' => Yii::t('app', 'Offer Start Date'),
			'offer_end_date' => Yii::t('app', 'Offer End Date'),
			'offer_text' => Yii::t('app', 'Offer Text'),
			'offer_link' => Yii::t('app', 'Offer Link'),
			'offer_price' => Yii::t('app', 'Offer Price'),
			'image' => Yii::t('app', 'Image'),
			'location' => Yii::t('app', 'City'),
			'latitude' => Yii::t('app', 'Latitude'),
			'longitude' => Yii::t('app', 'Longitude'),
			'no_of_deals' => Yii::t('app', 'No Of Deals'),
			'discount' => Yii::t('app', 'Discount'),
			'offer_status' => Yii::t('app', 'Offer Status'),
			'created_date' => Yii::t('app', 'Created Date'),
			'updated_date' => Yii::t('app', 'Updated Date'),
			'status' => Yii::t('app', 'Status'),
			'address1' => Yii::t('app', 'Address1'),
			'address2' => Yii::t('app', 'Address2'),
			'country' => Yii::t('app', 'Country'),
			'state' => Yii::t('app', 'State'),
			'user' => null,
			'payments' => null,
		);
	}
	public function getOfferName($offer_id)
	{
		$modelData = Offers::model()->find('offer_id = "'.$offer_id.'"');
		
		return $modelData->offer_name;
		
	}

}