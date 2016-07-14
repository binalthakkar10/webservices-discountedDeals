<?php

class UsersModelController extends AdminCoreController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'UsersModel'),
		));
	}

	public function actionCreate() {
		$model = new UsersModel;


		if (isset($_POST['UsersModel'])) {
			$model->setAttributes($_POST['UsersModel']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->u_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'UsersModel');


		if (isset($_POST['UsersModel'])) {
			$model->setAttributes($_POST['UsersModel']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->u_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'UsersModel')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('UsersModel');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new UsersModel('search');
		$model->unsetAttributes();

		if (isset($_GET['UsersModel']))
			$model->setAttributes($_GET['UsersModel']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}