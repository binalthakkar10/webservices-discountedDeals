<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="letsgoout">
	<meta name="author" content="letsgoout">
	<meta name="keyword" content="letsgoout">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link href=<?php echo Yii::app()->baseUrl."/css_new/bootstrap.min.css" ?> rel="stylesheet">
	<link href=<?php echo Yii::app()->baseUrl."/css_new/bootstrap-responsive.min.css"?> rel="stylesheet">
	<link href=<?php echo Yii::app()->baseUrl."/css_new/style.min.css" ?> rel="stylesheet">
	<link href=<?php echo Yii::app()->baseUrl."/css_new/style-responsive.min.css" ?> rel="stylesheet">
	<link href=<?php echo Yii::app()->baseUrl."/css_new/retina.css" ?> rel="stylesheet">
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
	
	<!-- start: Favicon and Touch Icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href=<?php echo Yii::app()->baseUrl."/ico/apple-touch-icon-144-precomposed.png" ?> >
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href=<?php echo Yii::app()->baseUrl."/ico/apple-touch-icon-114-precomposed.png" ?> >
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href=<?php echo Yii::app()->baseUrl."/ico/apple-touch-icon-72-precomposed.png" ?> >
	<link rel="apple-touch-icon-precomposed" href=<?php echo Yii::app()->baseUrl."/ico/apple-touch-icon-57-precomposed.png" ?> >
	<!--<link rel="shortcut icon" href=<?php echo Yii::app()->baseUrl."/ico/abc.png" ?>>-->
	<!-- end: Favicon and Touch Icons -->	
		
</head>

<body>
<!-- start: Header -->
<?php require_once('header.php')?>
<!-- End: Header -->
	<div class="maincont"> 
		
		<div id="sidebar-left" class="span2" style="margin-left:0px !important; width:177px !important; height:591px !important;">
		 <?php $loginId = Yii::app()->admin->id; ?>
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="<?php echo Yii::app()->baseUrl.'/admin/index';?>"><i class="icon-bar-chart"></i><span class="hidden-tablet">Dashboard</span></a></li>
						<li class='campaign'><a href="<?php echo Yii::app()->baseUrl.'/admin/UserDetail/admin';?>"><i class="icon-user"></i><span class="hidden-tablet" id="campaign">Users</span></a></li>
						<li class='campaign'><a href="<?php echo Yii::app()->baseUrl.'/admin/UserDetail/DealersAdmin';?>"><i class="icon-user"></i><span class="hidden-tablet" id="campaign">Dealers</span></a></li>
						<li class='qr_code'><a href="<?php echo Yii::app()->baseUrl.'/admin/Offers/admin';?>"><i class="icon-tasks"></i><span class="hidden-tablet" id="qr_code">Deals</span></a></li>
						<li class='users'><a href="<?php echo Yii::app()->baseUrl.'/admin/Payment/admin';?>"><i class=" icon-credit-card"></i><span class="hidden-tablet" id="users">Payment</span></a></li>
						<li class='users'><a href="<?php echo Yii::app()->baseUrl.'/admin/Currency/admin';?>"><i class="icon-money"></i><span class="hidden-tablet" id="users">Currency</span></a></li>
						<li class='system_config'><a href="<?php echo Yii::app()->baseUrl.'/admin/AdminUser/change?id='.$loginId;?>"><i class="icon-circle"></i><span class="hidden-tablet" id="system_config">Change Password</span></a></li>
						
						<!--<li class='qr_code'><a href="<?php echo Yii::app()->baseUrl.'/admin/UserSettings/admin';?>"><i class="icon-user"></i><span class="hidden-tablet" id="qr_code">User Settings</span></a></li>-->
						
						<!--<li class='qr_code'><a href="<?php echo Yii::app()->baseUrl.'/admin/TrainingZone/admin';?>"><i class="icon-user"></i><span class="hidden-tablet" id="qr_code">Training Zones</span></a></li>
					-->	<li><a href="<?php echo Yii::app()->baseUrl.'/admin/index/logout';?>"><i class="icon-off"></i><span class="hidden-tablet">Logout</span></a></li>
					</ul>
				</div>
			</div>
		
			<div id="content" class="span10" style="width:1000px !important;">
			<?php $controller = Yii::app()->controller->id;
				  $action = Yii::app()->controller->action->id;
				  if($controller != 'index' && $action != 'index'){ ?>
			<div class="breadcrumb" style="width:300px;">
				<?php  $this->widget('application.extensions.inx.AdminBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				
				));
					//m($this); //->breadcrumbs->homeLink = 'admin';
				?>
			 </div>
		 
		
			 <div class="content_left">
				 <div id="sidebar">
			        <?php
						$this->beginWidget('zii.widgets.CPortlet', array(
						));
						$this->widget('zii.widgets.CMenu', array(
							'items'=>$this->menu,
							'htmlOptions'=>array('class'=>'operations'),
						));
						$this->endWidget();
					?>
			      </div>
		      </div>
	      	<?php } ?>
	     
		 <?php echo $content; ?>
		</div>
			<!--/.fluid-container-->
			<!-- Require the footer -->
			<?php require_once('footer.php')?>
	</div>
		
	

		    
</body>
</html>