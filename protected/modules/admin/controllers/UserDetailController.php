<?php

class UserDetailController extends AdminCoreController {


	public function actionView($id) {
		$this->pageTitle = " View users || Yadeal";
		$this->render('view', array(
			'model' => $this->loadModel($id, 'UserDetail'),
		));
	}

	public function actionCreate() {
		$this->pageTitle = " Create users || Yadeal";
		$model = new UserDetail;


		if (isset($_POST['UserDetail'])) {
				$userData = UserDetail::model()->find("email = '".strtolower($_POST['UserDetail']['email'])."'  AND  status = 1");
				if(empty($userData)){
				$model->setAttributes($_POST['UserDetail']);
			$model->user_type='1';	
			$model->password=md5($_POST['UserDetail']['password']);
				if(($_FILES['UserDetail']['name']['image']!=''))
						{
							$width = "320";
							$height = "436";
							$path	= 	YiiBase::getPathOfAlias('webroot');
							$url ='http://'.$_SERVER['HTTP_HOST']. Yii::app()->baseUrl;
							$model->image=$_FILES['UserDetail']['name']['image'];
							$model->image = CUploadedFile::getInstance($model, 'image');
							$model->image->saveAs($path.'/upload/UserImage/'.$model->image);
							$image = Yii::app()->image->load($path.'/upload/UserImage/'.$model->image);
							$image->resize($width, $height);
							$image->save();
							$image_path=$url.'/upload/UserImage/'.$model->image;
							$model->image= $model->image;
						}
	
				else{
						$model->image = $_POST['UserDetail']['image'];
	
				}
				if ($model->save()) {
					if (Yii::app()->getRequest()->getIsAjaxRequest())
						Yii::app()->end();
					else
						$this->redirect(array('admin', 'id' => $model->user_id));
				}
			}else{
				Yii::app()->admin->setFlash('error', Yii::t("messages","Email Id already exist..!!"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actioncreateDealer() {
		$this->pageTitle = " Create Dealer || Yadeal";
		$model = new UserDetail;


		if (isset($_POST['UserDetail'])) {
				$userData = UserDetail::model()->find("email = '".strtolower($_POST['UserDetail']['email'])."'  AND  status = 1");
				if(empty($userData)){
				$model->setAttributes($_POST['UserDetail']);
				
			$model->password=md5($_POST['UserDetail']['password']);
			$model->user_type='2';
				if(($_FILES['UserDetail']['name']['image']!=''))
						{
							$width = "320";
							$height = "436";
							$path	= 	YiiBase::getPathOfAlias('webroot');
							$url ='http://'.$_SERVER['HTTP_HOST']. Yii::app()->baseUrl;
							$model->image=$_FILES['UserDetail']['name']['image'];
							$model->image = CUploadedFile::getInstance($model, 'image');
							$model->image->saveAs($path.'/upload/UserImage/'.$model->image);
							$image = Yii::app()->image->load($path.'/upload/UserImage/'.$model->image);
							$image->resize($width, $height);
							$image->save();
							$image_path=$url.'/upload/UserImage/'.$model->image;
							$model->image= $model->image;
						}
	
				else{
						$model->image = $_POST['UserDetail']['image'];
	
				}
				if ($model->save()) {
					if (Yii::app()->getRequest()->getIsAjaxRequest())
						Yii::app()->end();
					else
						$this->redirect(array('dealersadmin', 'id' => $model->user_id));
				}
			}else{
				Yii::app()->admin->setFlash('error', Yii::t("messages","Email Id already exist..!!"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();
			}
		}

		$this->render('create', array( 'model' => $model));
	}
	public function actionUpdate($id) {
		$this->pageTitle = " Update users || Yadeal";
		$model = $this->loadModel($id, 'UserDetail');


		if (isset($_POST['UserDetail'])) {
			$emailVerify = UserDetail::model()->find("email='".$_POST['UserDetail']['email']."' AND user_id NOT IN ('".$id."')");
			if(empty($emailVerify)){
			$model->setAttributes($_POST['UserDetail']);
			$model->password=md5($_POST['UserDetail']['password']);
				if(($_FILES['UserDetail']['name']['image']!=''))
					{
						$width = "320";
						$height = "436";
						$path	= 	YiiBase::getPathOfAlias('webroot');
						$url ='http://'.$_SERVER['HTTP_HOST']. Yii::app()->baseUrl;
						$model->image=$_FILES['UserDetail']['name']['image'];
						$model->image = CUploadedFile::getInstance($model, 'image');
						$model->image->saveAs($path.'/upload/UserImage/'.$model->image);
						$image = Yii::app()->image->load($path.'/upload/UserImage/'.$model->image);
						$image->resize($width, $height);
						$image->save();
						$image_path=$url.'/upload/UserImage/'.$model->image;
						$model->image= $model->image;
					}

			else{
					$model->image = $_POST['UserDetail']['image'];

			}
			if($model->user_type=='1'){
								if ($model->save()) {
				$this->redirect(array('admin', 'id' => $model->user_id));
			}
			}elseif($model->user_type=='2'){
			if ($model->save()) {
				$this->redirect(array('dealersadmin', 'id' => $model->user_id));
			}
			}

		}else{
				Yii::app()->admin->setFlash('error', Yii::t("messages","Email Id already exist..!!"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();
		}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}
	public function actionUpdateDealer($id) {
		$this->pageTitle = " Update dealer || Yadeal";
		$model = $this->loadModel($id, 'UserDetail');


		if (isset($_POST['UserDetail'])) {
			$emailVerify = UserDetail::model()->find("email='".$_POST['UserDetail']['email']."' AND user_id NOT IN ('".$id."')");
			if(empty($emailVerify)){
			$model->setAttributes($_POST['UserDetail']);
			$model->password=md5($_POST['UserDetail']['password']);
				if(($_FILES['UserDetail']['name']['image']!=''))
					{
						$width = "320";
						$height = "436";
						$path	= 	YiiBase::getPathOfAlias('webroot');
						$url ='http://'.$_SERVER['HTTP_HOST']. Yii::app()->baseUrl;
						$model->image=$_FILES['UserDetail']['name']['image'];
						$model->image = CUploadedFile::getInstance($model, 'image');
						$model->image->saveAs($path.'/upload/UserImage/'.$model->image);
						$image = Yii::app()->image->load($path.'/upload/UserImage/'.$model->image);
						$image->resize($width, $height);
						$image->save();
						$image_path=$url.'/upload/UserImage/'.$model->image;
						$model->image= $model->image;
					}

			else{
					$model->image = $_POST['UserDetail']['image'];

			}
			if($model->user_type=='1'){
								if ($model->save()) {
				$this->redirect(array('admin', 'id' => $model->user_id));
			}
			}elseif($model->user_type=='2'){
			if ($model->save()) {
				$this->redirect(array('dealersadmin', 'id' => $model->user_id));
			}
			}

		}else{
				Yii::app()->admin->setFlash('error', Yii::t("messages","Email Id already exist..!!"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();
		}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'UserDetail')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('UserDetail');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$this->pageTitle = "Users || Yadeal";
		$model = new UserDetail('search');
		$model->unsetAttributes();

		if (isset($_GET['UserDetail']))
			$model->setAttributes($_GET['UserDetail']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
	public function actionDealersAdmin() {
		$this->pageTitle = "Dealer || Yadeal";
		$model = new UserDetail('dealerssearch');
		$model->unsetAttributes();

		if (isset($_GET['UserDetail']))
			$model->setAttributes($_GET['UserDetail']);

		$this->render('dealersadmin', array(
			'model' => $model,
		));
	}	

	public function actionGetoffers(){
		$this->pageTitle = "Offers || Yadeal";
		$model = new Offers('offersearch');
		$model->unsetAttributes();

		if (isset($_GET['Offers']))
			$model->setAttributes($_GET['Offers']);
		$this->render('offersadmin', array(
			'model' => $model,
		));
	}
	public function actionGetCity()
	{
		
		if(isset($_POST['country_name']) && !empty($_POST['country_name']))
		{
			
			$state = $_POST['country_name'];
			
			$cityData= City::model()->findAll("country_id=$state");

			if(count($cityData)>0)
						{?>
							
							<option value=""> Select City</option>	
							<?php foreach($cityData as $city)
							{
								if(!empty($city['city_name']))
								{
									
								?>
								
								<option value="<?php  echo $city['city_id'];?>"><?php echo $city['city_name']; ?></option>
								
							<?php }
							} 
						}
				 }
	}

}