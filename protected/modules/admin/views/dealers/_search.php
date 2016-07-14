<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'user_id'); ?>
		<?php echo $form->textField($model, 'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'auth_id'); ?>
		<?php echo $form->textField($model, 'auth_id', array('maxlength' => 250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'auth_provider'); ?>
		<?php echo $form->textField($model, 'auth_provider', array('maxlength' => 8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'phone'); ?>
		<?php echo $form->textField($model, 'phone', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'country'); ?>
		<?php echo $form->dropDownList($model, 'country', GxHtml::listDataEx(Country::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'state'); ?>
		<?php echo $form->textField($model, 'state', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'location'); ?>
		<?php echo $form->dropDownList($model, 'location', GxHtml::listDataEx(City::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'latitude'); ?>
		<?php echo $form->textField($model, 'latitude', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'longitude'); ?>
		<?php echo $form->textField($model, 'longitude', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'device_type'); ?>
		<?php echo $form->textField($model, 'device_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'device_token'); ?>
		<?php echo $form->textField($model, 'device_token', array('maxlength' => 500)); ?>
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

	<div class="row">
		<?php echo $form->label($model, 'is_active'); ?>
		<?php echo $form->dropDownList($model, 'is_active', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'is_deleted'); ?>
		<?php echo $form->dropDownList($model, 'is_deleted', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'device_settings'); ?>
		<?php echo $form->dropDownList($model, 'device_settings', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'user_type'); ?>
		<?php echo $form->dropDownList($model, 'user_type', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'location_setting'); ?>
		<?php echo $form->textField($model, 'location_setting', array('maxlength' => 1)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
