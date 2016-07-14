<?php
$cntrlerName=Yii::app()->controller->id;
$cntrlerActionName=Yii::app()->controller->action->id;

if($cntrlerActionName=='UpdateDealer'){
$this->breadcrumbs = array(
	$model->label(2) => array('DealersAdmin'),
	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(
	array('label' => Yii::t('app', 'Manage') . ' ' . 'Dealers', 'url'=>array('DealersAdmin')),
);
?>

<h1><?php echo Yii::t('app', 'Update') . ' ' . 'Dealer'; ?></h1>
<?php 
$this->renderPartial('_form', array(
		'model' => $model));
		
}else{ 
$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);

$this->menu = array(
	array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()); ?></h1>
<?php 
$this->renderPartial('_form', array(
		'model' => $model));	
 } ?>