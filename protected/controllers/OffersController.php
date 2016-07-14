<?php

class OffersController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Offers'),
		));
	}

	public function actionCreate() {
		$model = new Offers;


		if (isset($_POST['Offers'])) {
			$model->setAttributes($_POST['Offers']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->offer_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Offers');


		if (isset($_POST['Offers'])) {
			$model->setAttributes($_POST['Offers']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->offer_id));
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
		$model = new Offers('search');
		$model->unsetAttributes();

		if (isset($_GET['Offers']))
			$model->setAttributes($_GET['Offers']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}