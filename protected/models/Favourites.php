<?php

Yii::import('application.models._base.BaseFavourites');

class Favourites extends BaseFavourites
{

	public $business_name;
	public $latitude;
	public $longitude;
	public $type;
	public $place;
	public $coupon_id;
	public $image_url;
	public $business_image_url;
	public $business_phone_number;
	public $the_fine_print;
	public $deal_text;
	public $dealtext;
	public $expiry_date;
	public $city_name;
	public $category_name;
	public $category_id;
	public $user_id;
	public $expirydate;
	public $startdate;
	public $citylatitute;
	public $citylongitute;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function GetFavourites($data){
		if(isset($data['udid']) && !empty($data['udid'])){
			$criteria = new CDbCriteria;
			$criteria->select = 't.is_favourite,tc.expiry_date as expirydate,tc.start_date as startdate,tc.deal_title as dealtext,tf.latitude as citylatitute,tf.longitude as citylongitute,t.udid, tb.*,tc.image_url, tc.expiry_date,tf.city_name,tg.category_name AS category_name, tg.id as category_id';
			$criteria->join = ' LEFT JOIN business as tb on tb.id = t.business_id  LEFT JOIN coupon as tc on tc.id = tb.coupon_id
			LEFT JOIN city as tf on tf.id = tb.city_id  LEFT JOIN categories as tg on tg.id = tb.category_id ';
			$criteria->addCondition("t.udid='".$data['udid']."' AND t.is_favourite=1");
			$resultSet	=	Favourites::model()->findAll($criteria);
			
			$fav_array= array();
			if(isset($resultSet) && !empty($resultSet)){
				$count = 0;
				foreach($resultSet as $data){
					//check retailer subscription
					$current_date = date('Y-m-d H:i:s');
					if((strtotime($data['startdate']) <= strtotime($current_date)) && (strtotime($data['expirydate']) >= strtotime($current_date))){
					$business_id = $data->attributes['id'];
					$business_data = Business::model()->find('id = "'.$business_id.'"');
					$retailer_flag = $this->getretailersubscription($business_data['user_id']);
					if($retailer_flag == 1){
						$fav_array[] = array(
									'City Name'=>$data->city_name,
									'Category id'=>$data->category_id,
									'Category Name'=>$data->category_name,
									'Business ID'=>$data->id,
									'Business Name'=>$data->business_name,	
									'Latitude'=>$resultSet[$count]['citylatitute'],
									'Longitude'=>$resultSet[$count]['citylongitute'],
									'Type'=>$data->type,
									'place'=>$data->place,
									'Coupon ID'=>$data->coupon_id,
									'Coupon Image URL'=>$data['image_url'],
									'Coupon Expiry Date'=>$data['expiry_date'],
									'Business Image URL'=>$data->business_image_url,
									'Business Phone Number'=>$data->business_phone_number,
									'The Fine Print'=>$data->the_fine_print,
									'isFavourite'=>$data['is_favourite'],
									'Deal text'=>$resultSet[$count]['dealtext'],
						);
					}
					}else{
								$flag_date = 1;
					}
					$count++;
				}
				if(count($fav_array) == 0 && $flag_date == 1)
				{
							$response['error']="0";
							$response['data'][]= "Record not found IN DB";
				}else{
							$response['success']="1";
							$response['data']= $fav_array;
				}
			}else{
				$response['error']="0";
				$response['data'][]='udid not found IN DB';
			}
		}else{
			$response['error']="0";
			$response['data'][]='udid can not be blank';

		}

		return $response;

	}
	public function getretailersubscription($ret_id){
				$flag = 0;
				$customer=Users::model()->find('id="'.$ret_id.'"');
				$current_date=date('Y-m-d H:i:s');
				$next_month_date = date("Y-m-d H:i:s", mktime(date('H',strtotime($customer->created_at)), date('i',strtotime($customer->created_at)), date('s',strtotime($customer->created_at)), date('m',strtotime($customer->created_at))+1, date('d',strtotime($customer->created_at)), date('Y',strtotime($customer->created_at))));
				if(strtotime($current_date) < strtotime($next_month_date)){
					$flag = '1';
				}else{
					$credit=Creditcard::model()->find('user_id="'.$customer->id.'"');
					if($credit->allow_deduction == 'Y'){
						$next_month_date = date("Y-m-d H:i:s", mktime(date('H',strtotime($credit->renew_date)), date('i',strtotime($credit->renew_date)), date('s',strtotime($credit->renew_date)), date('m',strtotime($credit->renew_date))+1, date('d',strtotime($credit->renew_date)), date('Y',strtotime($credit->renew_date))));
						if(strtotime($current_date)< strtotime($next_month_date)){
							$flag = '1';
						}else{
							$flag = '0';
						}
	
					}else{
						$flag = '0';
					}
	
			 }
			 return $flag;
		}
	public function AddRemoveFavourite($data){
		if((isset($data['business_id']) && empty($data['business_id'])) || (!isset($data['business_id']))){
			$response['error']="0";
			$response['data'][]='Buiness can not be blank..';
		}else if(empty($data['udid'])){
			$response['error']="0";
			$response['data'][]='udid can not be blank..';
		}else if((isset($data['is_favourite']) && ($data['is_favourite'])=="") || (!isset($data['is_favourite']))){
			$response['error']="0";
			$response['data'][]='is_favourite can not be blank..';
		}else{
			$model1= new Business();
			$business_data = Business::model()->find('id="'.$data['business_id'].'"');
			
			if(isset($business_data) && !empty($business_data))
			{
				$favourite_data = Favourites::model()->find('udid="'.$data['udid'].'" AND business_id = "'.$data['business_id'].'" ');
				if(isset($favourite_data) && !empty($favourite_data))
				{
					//update favourite
					$favourite_data->is_favourite = $data['is_favourite'];
					$favourite_data->save(false);
				}else{
					//insert favourite
					$model= new Favourites();
					$model->udid=$data['udid'];
					$model->business_id=$data['business_id'];
					$model->is_favourite=$data['is_favourite'];
					$model->save(false);
				}
				//Business added favourite successfully.
				if($data['is_favourite']=='0'){
					$response['success']="1";
					$response['data'][]='Favourite Removed successfully';
				}else{
					$response['success']="1";
					$response['data'][]='Favourite added successfully';
				}

			}else{
				$response['error']="0";
				$response['data'][]='Buiness not found in DB';
					
			}
		}

		header('Content-type:application/json');
		echo CJSON::encode($response);
		exit();
	}

}