<?php
class RetailerController extends AdminCoreController
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);

	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function defaultAccessRules()
	{
		return array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin','update'),
				'users'=>array('admin'),
		),
		);
	}

	public function actionAdmin()
	{
		
	}
	public function actionUpdate($id)
	{
		
	}


}