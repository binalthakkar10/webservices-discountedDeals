<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->offer_id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->offer_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()); ?></h1>
<?php $width=100;
		$height=100;?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
	             array(
             'name'=>'User Name', //column header
             'type'=>'html',
             'value'=>UserDetail::getName($model->user_id), //column name, php expression
             ),
//'offer_id',
'offer_name',
'offer_text',
'offer_link',
array(
			'name' => 'cat',
			'type' => 'raw',
			'value' => $model->cat !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->cat)), array('category/view', 'id' => GxActiveRecord::extractPkValue($model->cat, true))) : null,
			),
'offer_price',
array(
			'name' => 'currency',
			'type' => 'raw',
			'value' => $model->currency !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->currency)), array('currency/view', 'id' => GxActiveRecord::extractPkValue($model->currency, true))) : null,
			),
'discount',
'no_of_deals',
array(
			'name'=>'image',
			'type' => 'html',
			'value'=>CHtml::image(Yii::app()->baseUrl."/upload/OfferImage/".$model->image,'NO Image',array("width"=>$width,"height"=>$height)),
			
		),
		 array(
             'label'=>'country', //column header
             'type'=>'html',
             'value'=>UserDetail::getCountryName($model->country), //column name, php expression
             ),
             array(
             'label'=>'location', //column header
             'type'=>'html',
             'value'=>UserDetail::getCityName($model->location), //column name, php expression
             ),
'address1',
'address2',		
'offer_status:boolean',
'offer_start_date',
'offer_end_date',
'created_date',
//'updated_date',
//'status:boolean',
	),
)); ?>
