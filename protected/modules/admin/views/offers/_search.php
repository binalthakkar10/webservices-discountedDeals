<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>
<!--
	<div class="row">
		<?php echo $form->label($model, 'offer_id'); ?>
		<?php echo $form->textField($model, 'offer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'offer_start_date'); ?>
		<?php echo $form->textField($model, 'offer_start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'offer_end_date'); ?>
		<?php echo $form->textField($model, 'offer_end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'offer_text'); ?>
		<?php echo $form->textField($model, 'offer_text', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'offer_link'); ?>
		<?php echo $form->textField($model, 'offer_link', array('maxlength' => 1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'offer_price'); ?>
		<?php echo $form->textField($model, 'offer_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'offer_status'); ?>
		<?php echo $form->dropDownList($model, 'offer_status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'created_date'); ?>
		<?php echo $form->textField($model, 'created_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'updated_date'); ?>
		<?php echo $form->textField($model, 'updated_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'status'); ?>
		<?php echo $form->dropDownList($model, 'status', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>
-->
<?php $this->endWidget(); ?>

</div><!-- search-form -->
