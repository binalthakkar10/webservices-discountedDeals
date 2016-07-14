<?php
$cntrlerName=Yii::app()->controller->id;
$cntrlerActionName=Yii::app()->controller->action->id;

if($cntrlerActionName=='createDealer'){
	$this->breadcrumbs = array(
	'Dealers' => array('DealersAdmin'),
	Yii::t('app', 'Create'),
);

	$this->menu = array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . 'Dealers', 'url' => array('createDealer')),
);
?>

<h1><?php echo Yii::t('app', 'Create') . ' ' . 'Dealers'; ?></h1>
<?php
	
}else{
	$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Create'),
);

	$this->menu = array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url' => array('index')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label()); ?></h1>
<?php
}


?>
<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>