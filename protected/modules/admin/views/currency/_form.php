<script>
$(document).ready(function(){
	setTimeout(function(){ $(".flash-error").hide(); },3000);
	setTimeout(function(){ $(".flash-success").hide(); },3000);
});
</script>
<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'currency-form',
	'enableAjaxValidation' => false,
));
?>
<?php
	    foreach(Yii::app()->admin->getFlashes() as $key => $message) {
	        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
	    }
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
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->