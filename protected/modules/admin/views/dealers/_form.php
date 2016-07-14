<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'dealers-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'auth_id'); ?>
		<?php echo $form->textField($model, 'auth_id', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'auth_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'auth_provider'); ?>
		<?php echo $form->textField($model, 'auth_provider', array('maxlength' => 8)); ?>
		<?php echo $form->error($model,'auth_provider'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'first_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'last_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model, 'password', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'password'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->dropDownList($model, 'country', GxHtml::listDataEx(Country::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'country'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model, 'state', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'state'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->dropDownList($model, 'location', GxHtml::listDataEx(City::model()->findAllAttributes(null, true))); ?>
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
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'device_type'); ?>
		<?php echo $form->textField($model, 'device_type'); ?>
		<?php echo $form->error($model,'device_type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'device_token'); ?>
		<?php echo $form->textField($model, 'device_token', array('maxlength' => 500)); ?>
		<?php echo $form->error($model,'device_token'); ?>
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
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->checkBox($model, 'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->checkBox($model, 'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'device_settings'); ?>
		<?php echo $form->checkBox($model, 'device_settings'); ?>
		<?php echo $form->error($model,'device_settings'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'user_type'); ?>
		<?php echo $form->checkBox($model, 'user_type'); ?>
		<?php echo $form->error($model,'user_type'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'location_setting'); ?>
		<?php echo $form->textField($model, 'location_setting', array('maxlength' => 1)); ?>
		<?php echo $form->error($model,'location_setting'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('offers')); ?></label>
		<?php echo $form->checkBoxList($model, 'offers', GxHtml::encodeEx(GxHtml::listDataEx(Offers::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('payments')); ?></label>
		<?php echo $form->checkBoxList($model, 'payments', GxHtml::encodeEx(GxHtml::listDataEx(Payment::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->