<?php
class IndexController extends AdminCoreController
{
	public $defaultAction = 'index';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function defaultAccessRules()
	{
		//$rules = parent::accessRules();
	 
		$rules = array(
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','logout','forgot'),
				'users'=>array('*'),
				'desc'=>'Login and Logout',
		),
		
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('admin'),
				'desc'=>'Dashboard',
		),
		array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('superadmin'),
				'desc'=>'Dashboard',
		),
		);
		return $rules;
	}

	public function actionIndex()
	{
		//$this->actionLogin();
		$this->pageTitle = "Dashboard || Yadeal";
		$this->render('index');
		//$this->forward('adminUser/admin');
		 
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->pageTitle = "Login || Yadeal";
		$this->layout = 'admin_login';
		$model=new AdminLoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['AdminLoginForm']))
		{
			$model->attributes=$_POST['AdminLoginForm'];
			// validate user input and redirect to the previous page if valid

			if($model->login())
			$this->redirect("index");
		}


		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->admin->logout(false);
		$this->redirect(AdminModule::getUrl('home'));
	}
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
			echo $error['message'];
			else
			$this->render('error', $error);
		}
	}
	public function actionCreatepdf(){
 		yii::import('ext.tcpdf.MYPDF');
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        spl_autoload_register(array('YiiBase','autoload'));
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Lets Go Out');
		$pdf->SetSubject('Lets Go Out');
		$pdf->SetKeywords('Lets Go Out TCPDF, PDF');

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);
		
		// remove default footer
		$pdf->setPrintFooter(false);
		
		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		// set font
		$pdf->SetFont('times', '', 48);

		// add a page
		$pdf->AddPage();
		// --- example with background set on page ---
		
		// remove default header
		$pdf->setPrintHeader(false);

		// get the current page break margin
		$bMargin = $pdf->getBreakMargin();
		// get current auto-page-break mode
		$auto_page_break = $pdf->getAutoPageBreak();
		// disable auto-page-break
		//$pdf->SetAutoPageBreak(false, 0);
		//$pdf->setJPEGQuality(200);
		//$pdf->setImageScale(1);
		// set bacground image);
		$img_file = yii::app()->baseUrl.'/images/business_card.jpg';
		$pdf->Image($img_file, 35, 25, 145, 73, '', '', '', false, 300, '', false, false, 0);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// restore auto-page-break status
		$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
		// set the starting point for the page content
		$pdf->setPageMark();
		
		// Print a text
		$pdf->SetY(70);
		$pdf->SetX(36);
		$html = '<span style="color:blue; text-align:left;">Ankit Sompura&nbsp;</span>
		<span stroke="0.1" fill="false" strokecolor="blue" color="blue" style="font-family:helvetica;font-weight:bold;font-size:15pt;text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ankit.sompura@letsnurture.com</span>';
		$pdf->writeHTML($html, true, false, true, false, '');

		//Close and output PDF document
		$pdf->Output('example_demo.pdf', 'I'); //D means open and save pdf file.
		Yii::app()->end();
		 
	}
}