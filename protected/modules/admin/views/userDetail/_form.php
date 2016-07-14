<script>
$(document).ready(function(){
	setTimeout(function(){ $(".flash-error").hide(); },3000);
	setTimeout(function(){ $(".flash-success").hide(); },3000);
});
</script>
<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'user-detail-form',
	'enableAjaxValidation' => false,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>true,
    ),
      'htmlOptions'=>array('enctype'=>'multipart/form-data'),
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

	<!--	<div class="row">
		<?php echo $form->labelEx($model,'auth_id'); ?>
		<?php echo $form->textField($model, 'auth_id', array('maxlength' => 250)); ?>
		<?php echo $form->error($model,'auth_id'); ?>
		</div><!-- row -->
	<!--	<div class="row">
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
		<!---- Country -->
		<?php if($model->isNewRecord=='1'){ ?>
		<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
       		<?php $countryData= Country::model()->findAll();?>	
		<select id="cmdCountryId" name="UserDetail[country]">
			<option value=""> Select Country</option>	
			<?php if($countryData){
			foreach($countryData as $country){ ?>
			<option value="<?php echo $country['country_id']; ?>"><?php  echo $country['country_name']; ?></option>	
			<?php }} ?>
		</select>	
		<?php echo $form->error($model,'country'); ?>
		</div><!-- row -->
		<?php }else{?>
		<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
       		<?php $countryData= Country::model()->findAll();?>	
		<select id="cmdCountryId" name="UserDetail[country]">
			<option value=""> Select Country</option>	
			<?php if($countryData){
			foreach($countryData as $country){ ?>
			<option value="<?php echo $country['country_id']; ?>"<?php if($country['country_id']==$model->country){ echo "selected=selected" ;} ?>><?php  echo $country['country_name']; ?></option>	
			<?php }} ?>
		</select>	
		<?php echo $form->error($model,'country'); ?>
		</div><!-- row -->	
		<?php } ?>
		
	<!-- Country --->	

<!--- City -->
<?php if($model->isNewRecord=='1'){ ?>
		<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>	
		<select id="cmdCityId" name="UserDetail[location]">
			<option value=""> Select City</option>	
		</select>	
		<?php echo $form->error($model,'location'); ?>
		</div><!-- row -->
		<?php }else{ ?>
			<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
       		<?php $cityData= City::model()->findAll();?>	
		<select id="cmdCityId" name="UserDetail[location]">
			<option value=""> Select City</option>	
	<?php
			if($cityData){
			foreach($cityData as $city){ ?>
			<option value="<?php echo $city['city_id']; ?>" <?php if($city['city_id']==$model->location){ echo "selected=selected" ;} ?>><?php  echo $city['city_name']; ?></option>	
			<?php }} ?> 
		</select>	
		<?php echo $form->error($model,'location'); ?>
		</div><!-- row -->
		<?php } ?>
	<!-- City -->	

		<?php if($model->isNewRecord!='1'){ ?>
		<div class="row">	      	
		<?php echo $form->labelEx($model,'image',array('required' => true));?>
		<?php echo $form->fileField($model, 'image', array('maxlength' => 100)); 
		$path =  YiiBase::getPathOfAlias('webroot');
		if($model->image!='' && file_exists($path."/upload/UserImage/$model->image"))
		{
			 echo CHtml::image(Yii::app()->request->baseUrl.'/upload/UserImage/'.$model->image,"image",array("width"=>80)); 
		}else{
			echo CHtml::image(Yii::app()->request->baseUrl.'/upload/UserImage/images.jpg',"image",array("width"=>80)); 
		}?>
		<input type="hidden" name='UserDetail[image]' id='Music_file1' value='<?php echo $model->image;?>' /> 
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<?php }else{ ?>
		<div class="row">
		<?php echo $form->labelEx($model,'image',array('required' => true));?>
		<?php echo $form->fileField($model, 'image', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'image'); ?>	
		</div><!-- row -->
		<?php }?>
		<!--<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model, 'latitude', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'latitude'); ?>
		</div><!-- row -->
		<!--<div class="row">
		<?php echo $form->labelEx($model,'user_type'); ?>
		<?php echo $form->dropdownList($model, 'user_type', array(1=>'user',2=>'admin')); ?>
		<?php echo $form->error($model,'user_type'); ?>
		</div><!-- row -->
		<!--<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->textField($model, 'image', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'image'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'device_type'); ?>
			<?php echo $form->dropdownList($model, 'device_type',array(1=>'iOS',2=>'Android')); ?>
		<?php echo $form->error($model,'device_type'); ?>
		</div><!-- row -->
	<!--	<div class="row">
		<?php echo $form->labelEx($model,'device_token'); ?>
		<?php echo $form->textField($model, 'device_token', array('maxlength' => 500)); ?>
		<?php echo $form->error($model,'device_token'); ?>
		</div><!-- row -->
	<!--	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model, 'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
		</div><!-- row -->
		<!--<div class="row">
		<?php echo $form->labelEx($model,'updated_date'); ?>
		<?php echo $form->textField($model, 'updated_date'); ?>
		<?php echo $form->error($model,'updated_date'); ?>
		</div><!-- row -->
	<!--	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->checkBox($model, 'status'); ?>
		<?php echo $form->error($model,'status'); ?>
		</div><!-- row -->
		<!--<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->checkBox($model, 'is_active'); ?>
		<?php echo $form->error($model,'is_active'); ?>
		</div><!-- row -->
		<!--<div class="row">
		<?php echo $form->labelEx($model,'is_deleted'); ?>
		<?php echo $form->checkBox($model, 'is_deleted'); ?>
		<?php echo $form->error($model,'is_deleted'); ?>
		</div><!-- row -->
		<!--<div class="row">
		<?php echo $form->labelEx($model,'device_settings'); ?>
		<?php echo $form->checkBox($model, 'device_settings'); ?>
		<?php echo $form->error($model,'device_settings'); ?>
		</div><!-- row -->

		
<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->
<script>
$(document).ready(function(){
$("#cmdCountryId").on("change",function(event){
	event.preventDefault();
	 var country_name = $('#cmdCountryId').val();
	 $.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->getBaseUrl(true);?>/admin/UserDetail/GetCity',
			data: "country_name="+country_name,
			cache:false,
			async:true,
			beforeSend: function(data){
				},
			success: function(data)
                        {
                        		$("#cmdCityId").html(data);
						}
			});			
});	
});	
	</script>