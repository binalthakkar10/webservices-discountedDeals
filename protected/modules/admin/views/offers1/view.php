<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->offer_id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->offer_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'offer_id',
array(
			'name' => 'user',
			'type' => 'raw',
			'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('userDetail/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
			),
array(
			'name' => 'cat',
			'type' => 'raw',
			'value' => $model->cat !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->cat)), array('category/view', 'id' => GxActiveRecord::extractPkValue($model->cat, true))) : null,
			),
'offer_start_date',
'offer_end_date',
'offer_name',
'offer_text',
'offer_link',
'offer_price',
'phone',
'image',
'location',
'latitude',
'longitude',
'latest_deal_count',
'no_of_deals',
'discount',
'offer_status:boolean',
'created_date',
'updated_date',
'status:boolean',
'address1',
'address2',
'country',
'state',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('dealUsers')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->dealUsers as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('dealUser/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
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