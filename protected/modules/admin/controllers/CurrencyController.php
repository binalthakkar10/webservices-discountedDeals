<?php

class CurrencyController extends AdminCoreController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Currency'),
		));
	}

	public function actionCreate() {
		$model = new Currency;


		if (isset($_POST['Currency'])) {
			$model->setAttributes($_POST['Currency']);
				$curData = Currency::model()->findAll("currency_name='".$_POST['Currency']['currency_name']."'");
				if(!empty($curData)){
				
				Yii::app()->admin->setFlash('error', Yii::t("messages","Currency Code Already Exist..!!"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();	
		}else{
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('admin', 'id' => $model->currency_id));
			}
				}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Currency');


		if (isset($_POST['Currency'])) {
			$model->setAttributes($_POST['Currency']);
			$curData = Currency::model()->findAll("currency_name='".$_POST['Currency']['currency_name']."'");
				if(!empty($curData)){
				
				Yii::app()->admin->setFlash('error', Yii::t("messages","Currency Code Already Exist..!!"));
							$this->render('create', array( 'model' => $model));
							Yii::app()->end();	
		}else{
			if ($model->save()) {
				$this->redirect(array('admin', 'id' => $model->currency_id));
			}
		}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Currency')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Currency');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Currency('search');
		$model->unsetAttributes();

		if (isset($_GET['Currency']))
			$model->setAttributes($_GET['Currency']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}