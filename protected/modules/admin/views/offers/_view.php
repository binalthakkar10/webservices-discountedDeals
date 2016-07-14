<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('offer_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->offer_id), array('view', 'id' => $data->offer_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('offer_start_date')); ?>:
	<?php echo GxHtml::encode($data->offer_start_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('offer_end_date')); ?>:
	<?php echo GxHtml::encode($data->offer_end_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('offer_text')); ?>:
	<?php echo GxHtml::encode($data->offer_text); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('offer_link')); ?>:
	<?php echo GxHtml::encode($data->offer_link); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('offer_price')); ?>:
	<?php echo GxHtml::encode($data->offer_price); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('image')); ?>:
	<?php echo GxHtml::encode($data->image); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('offer_status')); ?>:
	<?php echo GxHtml::encode($data->offer_status); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('created_date')); ?>:
	<?php echo GxHtml::encode($data->created_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('updated_date')); ?>:
	<?php echo GxHtml::encode($data->updated_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />
	*/ ?>

</div>