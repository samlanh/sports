<?php

class Application_Model_DbTable_DbGlobal extends Zend_Db_Table_Abstract
{
    // set name value
	public function setName($name){
		$this->_name=$name;
	}
	public function init()
	{
		$this->tr = Application_Form_FrmLanguages::getCurrentlanguage();
	}
	public function getGlobalDb($sql)
  	{
  		$db=$this->getAdapter();
  		$row=$db->fetchAll($sql);  		
  		if(!$row) return NULL;
  		return $row;
  	}
  	public function getGlobalDbRow($sql)
  	{
  		$db=$this->getAdapter();  		
  		$row=$db->fetchRow($sql);
  		if(!$row) return NULL;
  		return $row;
  	}
  	public static function getActionAccess($action)
    {
    	$arr=explode('-', $action);
    	return $arr[0];    	
    }     
    public function isRecordExist($conditions,$tbl_name){
		$db=$this->getAdapter();		
		$sql="SELECT * FROM ".$tbl_name." WHERE ".$conditions." LIMIT 1"; 
		$row= count($db->fetchRow($sql));
		if(!$row) return NULL;
		return $row;	
    }
    /*for select 1 record by id of earch table by using params*/
    public function GetRecordByID($conditions,$tbl_name){
    	$db=$this->getAdapter();
    	$sql="SELECT * FROM ".$tbl_name." WHERE ".$conditions." LIMIT 1";
    	$row = $this->fetchRow($sql);
    	return $row;
    	$row= $db->fetchRow($sql);
    	return $row;
    }
    public function addRecord($data,$tbl_name){
    	//print_r($data);exit;    	
    	$this->setName($tbl_name);
    	return $this->insert($data);
    }
    public function updateRecord($data,$id,$tbl_name){
    	$this->setName($tbl_name);
    	$where=$this->getAdapter()->quoteInto('id=?',$id);
    	$this->update($data,$where);    	
    }
    public function DeleteRecord($tbl_name,$id){
    	$db = $this->getAdapter();
		$sql = "UPDATE ".$tbl_name." SET status=0 WHERE id=".$id;
		return $db->query($sql);
    } 
     public function DeleteData($tbl_name,$where){
    	$db = $this->getAdapter();
		$sql = "DELETE FROM ".$tbl_name.$where;
		return $db->query($sql);
    } 
    public function convertStringToDate($date, $format = "Y-m-d H:i:s")
    {
    	if(empty($date)) return NULL;
    	$time = strtotime($date);
    	return date($format, $time);
    }
    public function getMarjorById($major_id){
    	$db = $this->getAdapter();
    	$sql=" SELECT major_id AS id,major_enname AS name FROM `rms_major`
    	WHERE `dept_id` = $major_id ";
    	$db->fetchAll($sql);
    	return $db->fetchAll($sql);
    }   
    public static function getResultWarning(){
          return array('err'=>1,'msg'=>'មិន​ទាន់​មាន​ទន្និន័យ​នូវ​ឡើយ​ទេ!');	
   }
   public function getDeptById($dept_id){
   		$db = $this->getAdapter();
   		$sql=" SELECT * FROM `rms_dept`
   		WHERE `dept_id` = ".$db->quote($dept_id);
   		return $db->fetchRow($sql);
   }
   public function getProvince(){
   	$db = $this->getAdapter();
   	$sql ="SELECT province_en_name,province_id FROM rms_province WHERE is_active=1 AND province_en_name!='' ";
   	return $db->fetchAll($sql);
   }
   public static  function getAllStatus($id=null){
   	$tr = Application_Form_FrmLanguages::getCurrentlanguage();
   	$rs = array(
   			1=>$tr->translate("ACTIVE"),
   			0=>$tr->translate("DEACTIVE"));
   	if($id==null)return $rs;
   	return $rs[$id];
   }
   public function AllStatus($id=null){
   	$tr = Application_Form_FrmLanguages::getCurrentlanguage();
   	$rs = array(
   			1=>$tr->translate("ACTIVE"),
   			0=>$tr->translate("DEACTIVE"));
   	if($id==null)return $rs;
   	return $rs[$id];
   }
   function getAllProvince($opt=null,$option=null){
   	$db= $this->getAdapter();
   	$sql="SELECT province_id AS id,province_en_name AS province_name FROM rms_province WHERE is_active=1 AND province_en_name!=''";
   	$rows =  $db->fetchAll($sql);
   	if($opt==null){
   		return $rows;
   	}else{
   		if($option!=null){
   			$opt_province = array(-1=>"Please Select Location");
   		}else{$opt_province=array();
   		}
   		if(!empty($rows))foreach($rows AS $row) $opt_province[$row['id']]=$row['province_name'];
   		return $opt_province;
   	}
   }
}
?>