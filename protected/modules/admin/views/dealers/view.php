<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->user_id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->user_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'user_id',
'auth_id',
'auth_provider',
'first_name',
'last_name',
'email',
'phone',
'password',
array(
			'name' => 'country0',
			'type' => 'raw',
			'value' => $model->country0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->country0)), array('country/view', 'id' => GxActiveRecord::extractPkValue($model->country0, true))) : null,
			),
'state',
array(
			'name' => 'location0',
			'type' => 'raw',
			'value' => $model->location0 !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->location0)), array('city/view', 'id' => GxActiveRecord::extractPkValue($model->location0, true))) : null,
			),
'latitude',
'longitude',
'image',
'device_type',
'device_token',
'created_date',
'updated_date',
'status:boolean',
'is_active:boolean',
'is_deleted:boolean',
'device_settings:boolean',
'user_type:boolean',
'location_setting',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('offers')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->offers as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('offers/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('payments')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->payments as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('payment/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>