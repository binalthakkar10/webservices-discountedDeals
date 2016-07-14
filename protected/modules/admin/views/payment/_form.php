<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'payment-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'offer_id'); ?>
		<?php echo $form->dropDownList($model, 'offer_id', GxHtml::listDataEx(Offers::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'offer_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(UserDetail::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'payment_date'); ?>
		<?php echo $form->textField($model, 'payment_date'); ?>
		<?php echo $form->error($model,'payment_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model, 'price'); ?>
		<?php echo $form->error($model,'price'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model, 'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'payment_status'); ?>
		<?php echo $form->textField($model, 'payment_status', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'payment_status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->