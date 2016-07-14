<?php

$this->breadcrumbs = array(
	$model->label(2) => array('admin'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' .'Dealers', 'url'=>array('createDealer')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-detail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . 'Dealers'; ?></h1>

<!--<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>--->

<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'user-detail-grid',
	'dataProvider' => $model->dealerssearch(),
	'filter' => $model,
	'columns' => array(
		//'user_id',
		//'auth_id',
		//'auth_provider',

		array(
		'name'=>'first_name',
		'value'=>'($data->first_name=="")?("N/A"):$data->first_name' ,
		),
		array(
		'name'=>'last_name',
		'value'=>'($data->last_name=="")?("N/A"):$data->last_name' ,
		),
		'email',
		
		'phone',
		//'user_type',
		//'password',
		//'country',
		//'state',
		//'latitude',
		//'longitude',
		//'image',
		//'device_type',
		//'device_token',
		/*'created_date',
		'updated_date',
		array(
					'name' => 'status',
					'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'is_active',
					'value' => '($data->is_active === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'is_deleted',
					'value' => '($data->is_deleted === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'device_settings',
					'value' => '($data->device_settings === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),*/
	
		 array('class'=>'CButtonColumn',
    'template'=>'{update} {view} {delete}&nbsp;{offers}',
    'buttons'=>array (
        'update'=> array(
            'label'=>'',
            'imageUrl'=>'',
            'url'=>'Yii::app()->createUrl(\'admin/UserDetail/UpdateDealer\', array(\'id\'=>$data->user_id))',
            'options'=>array( 'class'=>'icon-edit','title'=>'edit' ),
        ),
        'view'=>array(
            'label'=>'',
            'imageUrl'=>'',
            'options'=>array( 'class'=>'icon-search','title'=>'view' ),
        ),
                'delete'=>array(
            'label'=>'',
            'imageUrl'=>'',
            'options'=>array( 'class'=>'icon-trash','title'=>'delete' ),
        ),
        		 'offers' => array
		        (   
		        	'imageUrl'=>Yii::app()->baseUrl.'/images/submember.png',    
		         	'url'=>'Yii::app()->createUrl(\'admin/UserDetail/getoffers\', array(\'id\'=>$data->user_id))',
		        ),  
    ),
),
	),
)); ?>