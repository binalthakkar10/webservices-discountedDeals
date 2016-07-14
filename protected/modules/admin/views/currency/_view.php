<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('currency_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->currency_id), array('view', 'id' => $data->currency_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('currency_name')); ?>:
	<?php echo GxHtml::encode($data->currency_name); ?>
	<br />

</div>