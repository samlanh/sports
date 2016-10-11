<?php
class Allreport_AccountingController extends Zend_Controller_Action {
	
    public function init()
    {    	
    	header('content-type: text/html; charset=utf8');
	}
	public function indexAction(){
	}
	public function rptAccountRecAction(){
		
	}
	function rptStudentpaymentAction(){
		try{
			if($this->getRequest()->isPost()){
					$_data=$this->getRequest()->getPost();
					$search = array(
							'txtsearch' =>$_data['txtsearch'],
							'start_date'=> $_data['from_date'],
		      				'end_date'=> $_data['to_date']
					);
					
				}
				else{
					$search = array(
							'txtsearch' =>'',
							'start_date'=> date('Y-m-d'),
	                        'end_date'=>date('Y-m-d'),
					);
				}
			$this->view->search = $search;
			$db = new Allreport_Model_DbTable_DbRptPayment();
			$this->view->row = $db->getStudentPayment($search);
			
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
	}
	function  rptPaymentdetailbytypeAction(){
		try{
			if($this->getRequest()->isPost()){
				$_data=$this->getRequest()->getPost();
				//print_r($_data); exit();
				$search = array(
						'txtsearch' =>$_data['txtsearch'],
						'start_date'=> $_data['from_date'],
						'end_date'=> $_data['to_date'],
						'service_type'=>$_data['service']
				);
		
			}
			else{
				$search = array(
						'txtsearch' =>'',
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
						'service_type'=>0
				);
			}
			$db = new Allreport_Model_DbTable_DbRptPayment();
			$this->view->row = $db->getPaymentDetailByType($search);
			$this->view->service = $db->getService();
			$this->view->search = $search;
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
	}
	
	function rptStudentpaymentdetailAction(){
		try{
			if($this->getRequest()->isPost()){
				$_data=$this->getRequest()->getPost();
				$search = array(
						'txtsearch' =>$_data['txtsearch'],
						'start_date'=> $_data['from_date'],
	      				'end_date'=> $_data['to_date']
				);
			}
			else{
				$search = array(
						'txtsearch' =>'',
						'start_date'=> date('Y-m-d'),
                        'end_date'=>date('Y-m-d'),
				);
			}
			$db = new Allreport_Model_DbTable_DbRptPayment();
			$this->view->row = $db->getStudentPaymentDetail($search);
			$this->view->service = $db->getService();
			$this->view->search = $search;
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
		
	}

	function rptPaymentrecieptdetailAction(){
		$id=$this->getRequest()->getParam("id");
		$db = new Allreport_Model_DbTable_DbRptPayment();
		$row = $db->getPaymentReciptDetail($id);
		
		$this->view->row = $row;
		$this->view->rr = $db->getStudentPaymentByid($id);
	
	}
	function  rptSuspendserviceAction(){
		try{
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search=array(
						'txtsearch' => '',
						'start_date'=>date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
						'service'=>'',
						'study_year'=>'',
				);
			}
		$this->view->search = $search;
		$db = new Allreport_Model_DbTable_DbSuspendService();
		$this->view->rs = $db->getStudetnSuspendServiceDetail($search);
		}catch (Exception $e){
			Application_Form_FrmMessage::message("APPLICATION_ERROR");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
		
		$form=new Registrar_Form_FrmSearchInfor();
		$form->FrmSearchRegister();
		Application_Model_Decorator::removeAllDecorator($form);
		$this->view->form_search=$form;
	}
	function rptInvoiceAction(){
	
	}
	function rptStudentListDetailPart1Action(){
	
	}
	function rptStudentListDetailPart2Action(){
	
	}
	function rptStudentListDetailPart3Action(){
	
	}
	public function rptTuitionFeeAction()
	{
	
	}
	function rptGepFeeAction(){
	
	}
	function rptGepListAction(){
	
	}
	function rptListOfItemAction(){
	
	}
	
	
	
	public function rptstudentbalanceAction(){
		try{
			if($this->getRequest()->isPost()){
				$data=$this->getRequest()->getPost();
				$search = array(
						'txtsearch' => $data['txtsearch'],
						'start_date'=> $data['from_date'],
                        'end_date'=>$data['to_date'],
						'service'=>$data['service'],
				);
			}else{
				$search=array(
						'txtsearch' =>'',
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
						'service'=>'',
				);;
			}
			
			$form=new Registrar_Form_FrmSearchInfor();
			$form->FrmSearchRegister();
			Application_Model_Decorator::removeAllDecorator($form);
			$this->view->form_search=$form;
			
			$db = new Allreport_Model_DbTable_DbRptStudentBalance();
			$this->view->rs = $db->getAllStudentBalance($search);
			$this->view->search = $search;
// 			print_r($abc);exit();
		}catch(Exception $e){
			Application_Form_FrmMessage::message("APPLICATION_ERROR");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
	}
	public function rptexpectincomeAction(){
		try{
			if($this->getRequest()->isPost()){
				$data=$this->getRequest()->getPost();
				$search = array(
						'txtsearch' => $data['txtsearch'],
						'start_date'=> $data['from_date'],
						'end_date'=>$data['to_date']
				);
			}else{
				$search=array(
						'txtsearch' =>'',
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
				);;
			}
				
			$db = new Allreport_Model_DbTable_DbRptExpectIncome();
			$this->view->rs = $db->getAllExpectIncome($search);
			$this->view->search = $search;
			// 			print_r($abc);exit();
		}catch(Exception $e){
			Application_Form_FrmMessage::message("APPLICATION_ERROR");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
	}
	
	public function rptstudentnearlyendserviceAction(){
		try{
			if($this->getRequest()->isPost()){
				$data=$this->getRequest()->getPost();
				$search = array(
						'txtsearch' => $data['txtsearch'],
						//'start_date'=> $data['from_date'],
						'end_date'	=>$data['to_date'],
						'service'	=>$data['service']
				);
			}else{
				$search=array(
						'txtsearch' =>'',
						//'start_date'=> date('Y-m-d'),
						'end_date'	=>date('Y-m-d'),
						'service'	=>''
				);;
			}
			$db = new Allreport_Model_DbTable_DbRptStudentNearlyEndService();
			$abc = $this->view->row = $db->getAllStudentNearlyEndService($search);
			
			$form=new Registrar_Form_FrmSearchInfor();
			$form->FrmSearchRegister();
			Application_Model_Decorator::removeAllDecorator($form);
			$this->view->form_search=$form;
			
			$this->view->search = $search;
			
		}catch(Exception $e){
			Application_Form_FrmMessage::message("APPLICATION_ERROR");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
	}
	
	public function rptstudentpaymentlateAction(){
		try{
			if($this->getRequest()->isPost()){
				$data=$this->getRequest()->getPost();
				$search = array(
						'txtsearch' => $data['txtsearch'],
						//'start_date'=> $data['from_date'],
						'end_date'	=>$data['to_date'],
						'service'	=>$data['service'],
				);
			}else{
				$search=array(
						'txtsearch' =>'',
						//'start_date'=> date('Y-m-d'),
						'end_date'	=>date('Y-m-d'),
						'service'	=>'',
				);;
			}
			$db = new Allreport_Model_DbTable_DbRptStudentPaymentLate();
			$abc = $this->view->row = $db->getAllStudentPaymentLate($search);
			
			$form=new Registrar_Form_FrmSearchInfor();
			$form->FrmSearchRegister();
			Application_Model_Decorator::removeAllDecorator($form);
			$this->view->form_search=$form;
			
			$this->view->search = $search;
				
		}catch(Exception $e){
			Application_Form_FrmMessage::message("APPLICATION_ERROR");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
	}
	
	public function rptFeeAction(){
	
		if($this->getRequest()->isPost()){
			$_data=$this->getRequest()->getPost();
			$search = array(
					'txtsearch' => $_data['txtsearch'],
					'year' => $_data['year'],
					//'grade_all' => $_data['grade_all'],
			);
		}
		else{
			$search=array(
					'txtsearch' =>'',
					'year' =>'',
					//'grade_all' =>'',
			);
		}
		
		$form=new Registrar_Form_FrmSearchInfor();
		$form->FrmSearchRegister();
		Application_Model_Decorator::removeAllDecorator($form);
		$this->view->form_search=$form;
		
		$db = new Allreport_Model_DbTable_DbRptFee();
		$group= new Allreport_Model_DbTable_DbRptFee();
		$rs_rows = $group->getAllTuitionFee($search);
	
		$year = $db->getAllYearFee();
		$this->view->row = $year;
		
		$model = new Application_Model_DbTable_DbGlobal();
		$row=0;$indexterm=1;$key=0;
		if(!empty($rs_rows)){
			foreach ($rs_rows as $i => $rs) {
				$rows = $db->getFeebyOther($rs['id']);
				$fee_row=1;
				if(!empty($rows))foreach($rows as $payment_tran){
					if($payment_tran['payment_term']==1){
						$rs_rows[$key]=$this->headAddRecordTuitionFee($rs,$key);
						$term = $model->getAllPaymentTerm($fee_row);
	
						$rs_rows[$key]['status'] = Application_Model_DbTable_DbGlobal::getAllStatus($payment_tran['status']);
						$rs_rows[$key]['class'] = $payment_tran['class'];
						$rs_rows[$key]['session'] = $payment_tran['session'];
						$rs_rows[$key]['remark'] = $payment_tran['remark'];
						$rs_rows[$key]['quarter'] = $payment_tran['tuition_fee'];
						$key_old=$key;
						$key++;
					}elseif($payment_tran['payment_term']==2){
						$term = $model->getAllPaymentTerm($payment_tran['payment_term']);
						$rs_rows[$key_old]['semester'] = $payment_tran['tuition_fee'];
	
					}elseif($payment_tran['payment_term']==3){
						$term = $model->getAllPaymentTerm($payment_tran['payment_term']);
						$rs_rows[$key_old]['year'] = $payment_tran['tuition_fee'];
					}
				}
			}
		}
		else{
			$rs_rows=array();
			$result = Application_Model_DbTable_DbGlobal::getResultWarning();
		}
		$this->view->rs = $rs_rows;
		$this->view->search = $search;
	}
	
	public function headAddRecordTuitionFee($rs,$key){
		$result[$key] = array(
				'id' 	  => $rs['id'],
				'academic'=> $rs['academic'],
				'generation'=> $rs['generation'],
				'class'=>'',
				'session'=>'',
				'quarter'=>'',
				'semester'=>'',
				'year'=>'',
				
				'time'=>$rs['time'],
				'date'=>$rs['create_date'],
				'status'=>''
		);
		return $result[$key];
	}
	public function rptServiceChargeAction(){
	
		if($this->getRequest()->isPost()){
			$_data=$this->getRequest()->getPost();
			$search = array(
					'txtsearch' => $_data['txtsearch'],
					'year' => $_data['year'],
			);
		}
		else{
			$search=array(
					'txtsearch' =>'',
					'year' =>'',
			);
		}
	
		$db = new Allreport_Model_DbTable_DbRptServiceCharge();
		$service= $db->getAllServiceFee($search);
		$year = $db->getAllYearService();
		$this->view->row = $year;
		//print_r($year);exit();
	
		$model = new Application_Model_DbTable_DbGlobal();
		$row=0;$indexterm=1;$key=0;$rs_rows=array();
		if(!empty($service)){
			foreach ($service as $i => $rs) {
				$rows = $db->getServiceFeebyId($rs['id']);
				$fee_row=1;
				if(!empty($rows))foreach($rows as $payment_tran){
					if($payment_tran['payment_term']==1){
						$rs_rows[$key]=$this->headAddRecordServiceFee($rs,$key);
						$term = $model->getAllPaymentTerm($fee_row);
	
	
						$rs_rows[$key]['service_name'] = $payment_tran['service_name'];
						$rs_rows[$key]['remark'] = $payment_tran['remark'];
						$rs_rows[$key]['monthly'] = $payment_tran['price_fee'];
						$key_old=$key;
						$key++;
					}elseif($payment_tran['payment_term']==2){
						$term = $model->getAllPaymentTerm($payment_tran['payment_term']);
						$rs_rows[$key_old]['quarter'] = $payment_tran['price_fee'];
							
					}elseif($payment_tran['payment_term']==3){
						$term = $model->getAllPaymentTerm($payment_tran['payment_term']);
						$rs_rows[$key_old]['semester'] = $payment_tran['price_fee'];
					}
					elseif($payment_tran['payment_term']==4){
						$term = $model->getAllPaymentTerm($payment_tran['payment_term']);
						$rs_rows[$key_old]['year'] = $payment_tran['price_fee'];
					}
				}
			}
		}
		else{
			$rs_rows = array();
			$result = Application_Model_DbTable_DbGlobal::getResultWarning();
		}
	
		$this->view->rs = $rs_rows;
		$this->view->search = $search;
	}
	
	public function headAddRecordServiceFee($rs,$key){
		$result[$key] = array(
				'id' 	  => $rs['id'],
				'academic'=> $rs['academic'],
				'generation'=> $rs['generation'],
				'monthly'=>'',
				'quarter'=>'',
				'semester'=>'',
				'year'=>'',
				'date'=>$rs['create_date'],
				'status'=> Application_Model_DbTable_DbGlobal::getAllStatus($rs['status'])
		);
		return $result[$key];
	}
	
	///report product
	
	public function rptProductLocationAction(){
		try{
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
					
			}
			else{
				$search = array(
						'title' =>'',
						'location' =>'',
						'status_search'=>1,
						'category_id'=>0,
				);
			}
			$db = new Allreport_Model_DbTable_DbProductList();
			$this->view->pro_loc = $db->getProductLocation($search);
	
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
		}
		$form=new Accounting_Form_FrmSearchProduct();
		$form=$form->FrmSearchProduct();
		Application_Model_Decorator::removeAllDecorator($form);
		$this->view->form_search=$form;
	}
	public function rptListProductAction(){
		$id=$this->getRequest()->getParam('id');
		try{
			if($this->getRequest()->isPost()){
				$_data=$this->getRequest()->getPost();
				$search = array(
						'txtsearch' =>$_data['txtsearch'],
						'start_date'=> $_data['from_date'],
						'end_date'=> $_data['to_date']
				);
					
			}
			else{
				$search = array(
						'txtsearch' =>'',
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
				);
			}
			$this->view->search = $search;
			$db = new Allreport_Model_DbTable_DbProductList();
			$this->view->list_pro = $db->getProductsByLocId($id);
			$this->view->branch_name = $db->getLocationNameById($id);
	
		}catch(Exception $e){
			//Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
	
	}
	public function rptPurchaseAction(){
		try{
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'title' =>'',
						'location' =>'',
						'status_search'=>1,
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
				);
			}
			$this->view->search = $search;
			$db = new Allreport_Model_DbTable_DbPurchase();
			$this->view->pur_code = $db->getPurchaseCodeSuplier($search);
	
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
		$form=new Accounting_Form_FrmSearchProduct();
		$form=$form->FrmSearchProduct();
		Application_Model_Decorator::removeAllDecorator($form);
		$this->view->form_search=$form;
	}
	public function rptPurchaseSupplierAction(){
		try{
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = $search = array(
						'title' =>'',
						'location' =>'',
						'status_search'=>1,
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
				);
			}
			$this->view->search = $search;
			$db = new Allreport_Model_DbTable_DbPurchase();
			$id=$this->getRequest()->getParam('id');
			$this->view->pur_detail=$db->getPurchaseProductDetail($id,$search);
	
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
		$form=new Accounting_Form_FrmSearchProduct();
		$form=$form->FrmSearchProduct();
		Application_Model_Decorator::removeAllDecorator($form);
		$this->view->form_search=$form;
	}
	public function rptPurchaseallAction(){
		try{
			if($this->getRequest()->isPost()){
				$search=$this->getRequest()->getPost();
			}
			else{
				$search = array(
						'title' =>'',
						'location' =>'',
						'product' =>'',
						'status_search'=>1,
						'start_date'=> date('Y-m-d'),
						'end_date'=>date('Y-m-d'),
				);
			}
			$this->view->search = $search;
			$db = new Allreport_Model_DbTable_DbPurchase();
			$this->view->pur_all = $db->getAllPurchase($search);
	
		}catch(Exception $e){
			Application_Form_FrmMessage::message("Application Error");
			Application_Model_DbTable_DbUserLog::writeMessageError($e->getMessage());
			echo $e->getMessage();
		}
		$form=new Accounting_Form_FrmSearchProduct();
		$form=$form->FrmSearchProduct();
		Application_Model_Decorator::removeAllDecorator($form);
		$this->view->form_search=$form;
	}
}
