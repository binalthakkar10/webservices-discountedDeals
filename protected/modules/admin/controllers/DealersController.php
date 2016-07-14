<?php

class DealersController extends AdminCoreController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Dealers'),
		));
	}

	public function actionCreate() {
		$model = new Dealers;


		if (isset($_POST['Dealers'])) {
			$model->setAttributes($_POST['Dealers']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->user_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Dealers');


		if (isset($_POST['Dealers'])) {
			$model->setAttributes($_POST['Dealers']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->user_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Dealers')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Dealers');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Dealers('search');
		$model->unsetAttributes();

		if (isset($_GET['Dealers']))
			$model->setAttributes($_GET['Dealers']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}