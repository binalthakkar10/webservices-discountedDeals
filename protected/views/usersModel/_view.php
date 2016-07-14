<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('u_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->u_id), array('view', 'id' => $data->u_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('username')); ?>:
	<?php echo GxHtml::encode($data->username); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('password')); ?>:
	<?php echo GxHtml::encode($data->password); ?>
	<br />

</div>