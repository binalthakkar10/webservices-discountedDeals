<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'offers-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model, 'user_id', GxHtml::listDataEx(UserDetail::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cat_id'); ?>
		<?php echo $form->dropDownList($model, 'cat_id', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'cat_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_start_date'); ?>
		<?php echo $form->textField($model, 'offer_start_date'); ?>
		<?php echo $form->error($model,'offer_start_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_end_date'); ?>
		<?php echo $form->textField($model, 'offer_end_date'); ?>
		<?php echo $form->error($model,'offer_end_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_name'); ?>
		<?php echo $form->textField($model, 'offer_name', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'offer_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_text'); ?>
		<?php echo $form->textField($model, 'offer_text', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'offer_text'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_link'); ?>
		<?php echo $form->textField($model, 'offer_link', array('maxlength' => 1000)); ?>
		<?php echo $form->error($model,'offer_link'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_price'); ?>
		<?php echo $form->textField($model, 'offer_price'); ?>
		<?php echo $form->error($model,'offer_price'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model, 'location', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'location'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model, 'latitude', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'latitude'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model, 'longitude', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'longitude'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'latest_deal_count'); ?>
		<?php echo $form->textField($model, 'latest_deal_count'); ?>
		<?php echo $form->error($model,'latest_deal_count'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'no_of_deals'); ?>
		<?php echo $form->textField($model, 'no_of_deals'); ?>
		<?php echo $form->error($model,'no_of_deals'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'discount'); ?>
		<?php echo $form->textField($model, 'discount', array('maxlength' => 20)); ?>
		<?php echo $form->error($model,'discount'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'offer_status'); ?>
		<?php echo $form->checkBox($model, 'offer_status'); ?>
		<?php echo $form->error($model,'offer_status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model, 'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'updated_date'); ?>
		<?php echo $form->textField($model, 'updated_date'); ?>
		<?php echo $form->error($model,'updated_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'address1'); ?>
		<?php echo $form->textField($model, 'address1', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'address1'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'address2'); ?>
		<?php echo $form->textField($model, 'address2', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'address2'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model, 'country', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'country'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model, 'state', array('maxlength' => 50)); ?>
		<?php echo $form->error($model,'state'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('dealUsers')); ?></label>
		<?php echo $form->checkBoxList($model, 'dealUsers', GxHtml::encodeEx(GxHtml::listDataEx(DealUser::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('payments')); ?></label>
		<?php echo $form->checkBoxList($model, 'payments', GxHtml::encodeEx(GxHtml::listDataEx(Payment::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->