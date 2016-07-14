<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		//array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('offers-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php $height=50;
		$width=50;
?>
<?php //echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'offers-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'offer_id',
				array(
                'header'=>'User Name', //column header
                'type'=>'html',
               'value'=>'UserDetail::getName($data->user_id)', //column name, php expression
            ),
		array(
		 'name'=>'offer_text',
		 'value'=>'substr($data->offer_text,0,50)',
		 'headerHtmlOptions' => array('width'=>'40'),
		 'htmlOptions'=>array('width'=>'40'),
		),
		
	//	'offer_link',
		'offer_price',
		'no_of_deals',
		'offer_start_date',
		'offer_end_date',
						array(
			'name'=>'image',
			'filter'=>'',
			'type' => 'html',
			'value'=> 'CHtml::tag("div",  array("style"=>"text-align: center" ) , CHtml::tag("img", array("height"=>\''.$height.'\',\'width\'=>\''.$width.'\',"src" => UtilityHtml::getOfferImage(GxHtml::valueEx($data,\'image\')))))',
		),
		/*array(
					'name' => 'offer_status',
					'value' => '($data->offer_status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'created_date',
		'updated_date',
		array(
					'name' => 'status',
					'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		*/
			 array('class'=>'CButtonColumn',
    'template'=>'{update} {view} {delete}',
    'buttons'=>array (
        'update'=> array(
            'label'=>'',
            'imageUrl'=>'',
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
    ),
),
	),
)); ?>