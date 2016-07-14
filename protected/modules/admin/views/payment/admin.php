<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
	//	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		//array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('payment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>



<?php// echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'payment-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'payment_id',

				
					array(
                'header'=>'Deal Name', //column header
                'type'=>'html',
               'value'=>'Offers::getOfferName($data->offer_id)', 
                
            ),
			array(
                'header'=>'User Name', //column header
                'type'=>'html',
               'value'=>'UserDetail::getUserName($data->user_id)', 
                
            ),
		'payment_date',
		'price',
		'created_date',
		/*
		'payment_status',
		array(
					'name' => 'status',
					'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
				 array('class'=>'CButtonColumn',
    'template'=>'{view}',
    'buttons'=>array (
        'view'=>array(
            'label'=>'',
            'imageUrl'=>'',
            'options'=>array( 'class'=>'icon-search','title'=>'view' ),
        ),
            
    ),
),
	),
)); ?>