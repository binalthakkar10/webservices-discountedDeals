<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'currency-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'currency_name'); ?>
		<?php echo $form->textField($model, 'currency_name', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'currency_name'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('offers')); ?></label>
		<?php echo $form->checkBoxList($model, 'offers', GxHtml::encodeEx(GxHtml::listDataEx(Offers::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->