<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->payment_id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->payment_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
//'payment_id',
	array(
                'name'=>'Deal Name', //column header
                'type'=>'html',
               'value'=>Offers::getOfferName($model->offer_id), 
                
            ),
			array(
                'name'=>'User Name', //column header
                'type'=>'html',
               'value'=>UserDetail::getUserName($model->user_id), 
                
            ),

'payment_date',
'price',
'created_date',
'payment_status',
            array(
					'name' => 'payment_status',
					'value' => ($model->payment_status ==1) ? Yii::t('app', 'Done') : Yii::t('app', 'Not done'),
					//'filter' => array('1' => Yii::t('app', 'Athlete'), '2' => Yii::t('app', 'Entourage')),
					),
//'status:boolean',
	),
)); ?>

