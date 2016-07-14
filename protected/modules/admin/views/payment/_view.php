<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('payment_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->payment_id), array('view', 'id' => $data->payment_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('offer_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->offer)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('user_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->user)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('payment_date')); ?>:
	<?php echo GxHtml::encode($data->payment_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('price')); ?>:
	<?php echo GxHtml::encode($data->price); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_date')); ?>:
	<?php echo GxHtml::encode($data->created_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('payment_status')); ?>:
	<?php echo GxHtml::encode($data->payment_status); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>