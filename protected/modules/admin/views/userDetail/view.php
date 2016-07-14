<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	//array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->user_id)),
	//array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->user_id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>
<?php $width=50; $height=50; ?>
<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
/*'user_id',
'auth_id',
'auth_provider',*/
'first_name',
'last_name',
'email',
'phone',
array(
			'name'=>'image',
			'type' => 'html',
			'value'=>CHtml::image(Yii::app()->baseUrl."/upload/UserImage/".$model->image,'NO Image',array("width"=>$width,"height"=>$height)),
			
		),
//'password',
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
/*'latitude',
'longitude',
'image',*/
array(
					'name' => 'device_type',
					'value' => ($model->device_type ==1) ? Yii::t('app', 'iOS') : Yii::t('app', 'Android'),
					//'filter' => array('1' => Yii::t('app', 'Athlete'), '2' => Yii::t('app', 'Entourage')),
					),
//'device_token',
'created_date',
//'updated_date',
//'status:boolean',
//'is_active:boolean',
//'is_deleted:boolean',
//'device_settings:boolean',
	),
)); ?>

