<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;


class InsuranceRateReReportController extends AdminbaseController{
	
	public function __construct() {
		parent::__construct();
		$this->insurance=M('insurance_re');

	}
	//保单首页展示
	public function index(){
		if(IS_POST){
			$post=I('post.time_purview');
			$thisyear=substr($post, 0,4);
			$thismonth=substr($post,-2);
			S('thismonth',$thismonth);
			S('thisyear',$thisyear);
        $arr=$this->getContinuation($thismonth,$thisyear,salesman_number);
        $this -> assign('insurance',$arr);
       }

        $this -> display();
        }

	
     //续期保单导出
 public function export(){
		header("Content-Typ:text/html;charset=utf-8");
		vendor('Excel.PHPExcel');
		vendor('Excel.PHPExcel.IOFactory');
		Vendor('PHPExcel.PHPExcel.Reader.Excel2007');
		$objPHPExcel = new \PHPExcel();
        $objPHPExcel ->setActiveSheetIndex(0)
       				 ->setCellValue('A1', "分公司")//设置列的值
                     ->setCellValue('B1', "旗舰店")//设置列的值
                     ->setCellValue('C1', "标准店")//设置列的值
                     ->setCellValue('D1', "业务员代码")//设置列的值
                     ->setCellValue('E1', "业务员姓名")//设置列的值
                     ->setCellValue('F1', "13个月单月继续率")//设置列的值
                     ->setCellValue('G1', "13个月累计继续率")//设置列的值
                     ->setCellValue('H1', "25个月单月继续率")//设置列的值
                     ->setCellValue('I1', "25个月累计继续率")//设置列的值*/
                     ->setCellValue('J1', "37个月单月继续率")//设置列的值*/
                     ->setCellValue('K1', "37个月累计继续率")//设置列的值*/
                     ->setCellValue('L1', "49个月单月继续率")//设置列的值*/
                     ->setCellValue('M1', "49个月累计继续率");//设置列的值*/
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setWidth(18);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setWidth(18);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setWidth(18);
		$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setWidth(18);
//		个人
		$thismonth=S('thismonth');
		$thisyear=S('thisyear');
		$arr=$this->getContinuation($thismonth,$thisyear,'salesman_number');
		$a=2;
                foreach ($arr as $key => $value) {
           				 $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$a, $value['branch_shop_number'])
                        ->setCellValue('B'.$a, $value['flag_shop_number'])
                        ->setCellValue('C'.$a, $value['standard_shop_number'])
                        ->setCellValue('D'.$a, $value['salesman_number'])
                        ->setCellValue('E'.$a, $value['salesman_name'])
                        ->setCellValue('F'.$a, $value['13'])
                        ->setCellValue('G'.$a, $value['13s'])
                        ->setCellValue('H'.$a, $value['25'])
                        ->setCellValue('I'.$a, $value['25s'])
                        ->setCellValue('J'.$a, $value['37'])
                        ->setCellValue('K'.$a, $value['37s'])
                        ->setCellValue('L'.$a, $value['49'])
                        ->setCellValue('M'.$a, $value['49s']);
                        
            $a++;
        }
        $objPHPExcel->getActiveSheet(0)->setTitle('个人');
////		------------------------------------标准店
	    $objPHPExcel ->createSheet(1);
        $objPHPExcel->setActiveSheetIndex(1);
   	$objPHPExcel ->setActiveSheetIndex(1)
       				 ->setCellValue('A1', "分公司")//设置列的值
                     ->setCellValue('B1', "旗舰店")//设置列的值
                     ->setCellValue('C1', "标准店")//设置列的值
                     ->setCellValue('D1', "业务员代码")//设置列的值
                     ->setCellValue('E1', "业务员姓名")//设置列的值
                     ->setCellValue('F1', "13个月单月继续率")//设置列的值
                     ->setCellValue('G1', "13个月累计继续率")//设置列的值
                     ->setCellValue('H1', "25个月单月继续率")//设置列的值
                     ->setCellValue('I1', "25个月累计继续率")//设置列的值*/
                     ->setCellValue('J1', "37个月单月继续率")//设置列的值*/
                     ->setCellValue('K1', "37个月累计继续率")//设置列的值*/
                     ->setCellValue('L1', "49个月单月继续率")//设置列的值*/
                     ->setCellValue('M1', "49个月累计继续率");//设置列的值*/
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(18);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(18);
		$objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(18);
		$objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(18);
		$arr=$this->getContinuation($thismonth,$thisyear,'standard_shop_number');
		$a=2;
                foreach ($arr as $key => $value) {
           				 $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A'.$a, $value['branch_shop_number'])
                        ->setCellValue('B'.$a, $value['flag_shop_number'])
                        ->setCellValue('C'.$a, $value['standard_shop_number'])
                        ->setCellValue('D'.$a, $value['salesman_number'])
                        ->setCellValue('E'.$a, $value['salesman_name'])
                        ->setCellValue('F'.$a, $value['13'])
                        ->setCellValue('G'.$a, $value['13s'])
                        ->setCellValue('H'.$a, $value['25'])
                        ->setCellValue('I'.$a, $value['25s'])
                        ->setCellValue('J'.$a, $value['37'])
                        ->setCellValue('K'.$a, $value['37s'])
                        ->setCellValue('L'.$a, $value['49'])
                        ->setCellValue('M'.$a, $value['49s']);
                        
            $a++;
        }
		$objPHPExcel->getActiveSheet(1)->setTitle('部门');
////		-------------------------------------旗舰店
		$objPHPExcel ->createSheet(2);
        $objPHPExcel->setActiveSheetIndex(2);
   		$objPHPExcel ->setActiveSheetIndex(2)
       				 ->setCellValue('A1', "分公司")//设置列的值
                     ->setCellValue('B1', "旗舰店")//设置列的值
                     ->setCellValue('C1', "标准店")//设置列的值
                     ->setCellValue('D1', "业务员代码")//设置列的值
                     ->setCellValue('E1', "业务员姓名")//设置列的值
                     ->setCellValue('F1', "13个月单月继续率")//设置列的值
                     ->setCellValue('G1', "13个月累计继续率")//设置列的值
                     ->setCellValue('H1', "25个月单月继续率")//设置列的值
                     ->setCellValue('I1', "25个月累计继续率")//设置列的值*/
                     ->setCellValue('J1', "37个月单月继续率")//设置列的值*/
                     ->setCellValue('K1', "37个月累计继续率")//设置列的值*/
                     ->setCellValue('L1', "49个月单月继续率")//设置列的值*/
                     ->setCellValue('M1', "49个月累计继续率");//设置列的值*/
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('D')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('E')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('F')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('G')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('J')->setWidth(18);
        $objPHPExcel->getActiveSheet(2)->getColumnDimension('K')->setWidth(18);
		$objPHPExcel->getActiveSheet(2)->getColumnDimension('L')->setWidth(18);
		$objPHPExcel->getActiveSheet(2)->getColumnDimension('M')->setWidth(18);
		$arr=$this->getContinuation($thismonth,$thisyear,'flag_shop_number');
		$a=2;
                foreach ($arr as $key => $value) {
           				 $objPHPExcel->setActiveSheetIndex(2)
                        ->setCellValue('A'.$a, $value['branch_shop_number'])
                        ->setCellValue('B'.$a, $value['flag_shop_number'])
                        ->setCellValue('C'.$a, $value['standard_shop_number'])
                        ->setCellValue('D'.$a, $value['salesman_number'])
                        ->setCellValue('E'.$a, $value['salesman_name'])
                        ->setCellValue('F'.$a, $value['13'])
                        ->setCellValue('G'.$a, $value['13s'])
                        ->setCellValue('H'.$a, $value['25'])
                        ->setCellValue('I'.$a, $value['25s'])
                        ->setCellValue('J'.$a, $value['37'])
                        ->setCellValue('K'.$a, $value['37s'])
                        ->setCellValue('L'.$a, $value['49'])
                        ->setCellValue('M'.$a, $value['49s']);
                        
            $a++;
        }
        $objPHPExcel->getActiveSheet(2)->setTitle('分区');
////		-----------------------------------分公司
		$objPHPExcel ->createSheet(3);
        $objPHPExcel->setActiveSheetIndex(3);
		$objPHPExcel ->setActiveSheetIndex(3)
       				 ->setCellValue('A1', "分公司")//设置列的值
                     ->setCellValue('B1', "旗舰店")//设置列的值
                     ->setCellValue('C1', "标准店")//设置列的值
                     ->setCellValue('D1', "业务员代码")//设置列的值
                     ->setCellValue('E1', "业务员姓名")//设置列的值
                     ->setCellValue('F1', "13个月单月继续率")//设置列的值
                     ->setCellValue('G1', "13个月累计继续率")//设置列的值
                     ->setCellValue('H1', "25个月单月继续率")//设置列的值
                     ->setCellValue('I1', "25个月累计继续率")//设置列的值*/
                     ->setCellValue('J1', "37个月单月继续率")//设置列的值*/
                     ->setCellValue('K1', "37个月累计继续率")//设置列的值*/
                     ->setCellValue('L1', "49个月单月继续率")//设置列的值*/
                     ->setCellValue('M1', "49个月累计继续率");//设置列的值*/
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('A')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('B')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('C')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('D')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('E')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('F')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('G')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('H')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('I')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('J')->setWidth(18);
        $objPHPExcel->getActiveSheet(3)->getColumnDimension('K')->setWidth(18);
		$objPHPExcel->getActiveSheet(3)->getColumnDimension('L')->setWidth(18);
		$objPHPExcel->getActiveSheet(3)->getColumnDimension('M')->setWidth(18);
		$arr=$this->getContinuation($thismonth,$thisyear,'branch_shop_number');
		$a=2;
                foreach ($arr as $key => $value) {
           				 $objPHPExcel->setActiveSheetIndex(3)
                        ->setCellValue('A'.$a, $value['branch_shop_number'])
                        ->setCellValue('B'.$a, $value['flag_shop_number'])
                        ->setCellValue('C'.$a, $value['standard_shop_number'])
                        ->setCellValue('D'.$a, $value['salesman_number'])
                        ->setCellValue('E'.$a, $value['salesman_name'])
                        ->setCellValue('F'.$a, $value['13'])
                        ->setCellValue('G'.$a, $value['13s'])
                        ->setCellValue('H'.$a, $value['25'])
                        ->setCellValue('I'.$a, $value['25s'])
                        ->setCellValue('J'.$a, $value['37'])
                        ->setCellValue('K'.$a, $value['37s'])
                        ->setCellValue('L'.$a, $value['49'])
                        ->setCellValue('M'.$a, $value['49s']);
                        
            $a++;
        }
        $objPHPExcel->getActiveSheet(3)->setTitle('分公司');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
        header("Content-Disposition:attachment;filename=".$thisyear.'-'.$thismonth."月继续率.xlsx");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); 
		S('thismonth',null);
		S('thisyear',null);
    }

   public static function array_group_by($arr, $key)
    {
        $grouped = [];
        foreach ($arr as $value) {
            $grouped[$value[$key]][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value){
                $parms = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $parms);
            }
        }
        return $grouped;
    }
	/*
	 * $type 机构
	 * return array 
	 * 获得个人标准店旗舰店分公司继续率
	 * */
	public function getContinuation($thismonth,$thisyear,$type) {
		$where = "";
        if ($thismonth == 1) {
             $starmonth = 10;
             $staryear = $thisyear - 2;
        }else if($thismonth == 2){
             $starmonth = 11;
             $staryear = $thisyear - 2;
        }else if($thismonth == 3){
             $starmonth = 12;
             $staryear = $thisyear - 2;
        }else{
             $starmonth = $thismonth - 3;
             $staryear = $thisyear - 1;
        }
        $startime= mktime(0, 0, 0, $starmonth, 1, $staryear);

        $endThisMonth = mktime(0, 0, 0, $starmonth + 1, 1, $staryear);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+1);
        $endtime = mktime(0, 0, 0, $starmonth + 3, 1, $staryear+1);    
        //查询判断
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['two_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['two_state']=array('eq',1);
        $result13 = $this->insurance
        				  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
         				  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should13,sum(real_insurance_premium) as fact13')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();
		if ($thismonth == 1) {
             $starmonth = 11;
             $staryear = $thisyear - 3;
        }else if($thismonth == 2){
             $starmonth = 12;
             $staryear = $thisyear - 3;
        }else{
             $starmonth = $thismonth - 2;
             $staryear = $thisyear - 2;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth, 1, $staryear+1);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+1);
        $endtime = mktime(0, 0, 0, $starmonth+2, 1, $staryear+2);    
        //查询判断
		
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['two_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['two_state']=array('eq',1);
		$result13s = $this->insurance
						  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should13s,sum(real_insurance_premium) as fact13s')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();
		if ($thismonth == 1) {
             $starmonth = 10;
             $staryear = $thisyear - 3;
        }else if($thismonth == 2){
             $starmonth = 11;
             $staryear = $thisyear - 3;
        }else if($thismonth == 3){
             $starmonth = 12;
             $staryear = $thisyear - 3;
        }else{
             $starmonth = $thismonth - 3;
             $staryear = $thisyear - 2;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth+1, 1, $staryear);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+2);
        $endtime = mktime(0, 0, 0, $starmonth+3, 1, $staryear+2);    
        //查询判断
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['three_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['three_state']=array('eq',1);
		$result25 = $this->insurance
						  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should25,sum(real_insurance_premium) as fact25') 
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select(); 					  
		if ($thismonth == 1) {
             $starmonth = 11;
             $staryear = $thisyear - 4;
        }else if($thismonth == 2){
             $starmonth = 12;
             $staryear = $thisyear - 4;
        }else{
             $starmonth = $thismonth - 2;
             $staryear = $thisyear - 3;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth, 1, $staryear+2);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+1);
        $endtime = mktime(0, 0, 0, $starmonth+2, 1, $staryear+3);    
        //查询判断
        
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['three_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['three_state']=array('eq',1);
		$result25s = $this->insurance
						  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should25s,sum(real_insurance_premium) as fact25s')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();					  
		if ($thismonth == 1) {
             $starmonth = 10;
             $staryear = $thisyear - 4;
        }else if($thismonth == 2){
             $starmonth = 11;
             $staryear = $thisyear - 4;
        }else if($thismonth == 3){
             $starmonth = 12;
             $staryear = $thisyear - 4;
        }else{
             $starmonth = $thismonth - 3;
             $staryear = $thisyear - 3;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth+1, 1, $staryear);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+3);
        $endtime = mktime(0, 0, 0, $starmonth+3, 1, $staryear+3);   
        //查询判断
        
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['four_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['four_state']=array('eq',1);
		$result37 = $this->insurance
						  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should37,sum(real_insurance_premium) as fact37')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();					  
		if ($thismonth == 1) {
             $starmonth = 11;
             $staryear = $thisyear - 5;
        }else if($thismonth == 2){
             $starmonth = 12;
             $staryear = $thisyear - 5;
        }else{
             $starmonth = $thismonth - 2;
             $staryear = $thisyear - 4;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth, 1, $staryear+3);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+1);
        $endtime = mktime(0, 0, 0, $starmonth+2, 1, $staryear+4);    
        //查询判断
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['four_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['four_state']=array('eq',1);
		$result37s = $this->insurance
						  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should37s,sum(real_insurance_premium) as fact37s')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();					  
		if ($thismonth == 1) {
             $starmonth = 10;
             $staryear = $thisyear - 5;
        }else if($thismonth == 2){
             $starmonth = 11;
             $staryear = $thisyear - 5;
        }else if($thismonth == 3){
             $starmonth = 12;
             $staryear = $thisyear - 5;
        }else{
             $starmonth = $thismonth - 3;
             $staryear = $thisyear - 4;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth+1, 1, $staryear);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+4);
        $endtime = mktime(0, 0, 0, $starmonth+3, 1, $staryear+4);   
        //查询判断
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['five_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['five_state']=array('eq',1);
		$result49 = $this->insurance
				  		  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should49,sum(real_insurance_premium) as fact49')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();					  
		if ($thismonth == 1) {
             $starmonth = 11;
             $staryear = $thisyear - 6;
        }else if($thismonth == 2){
             $starmonth = 12;
             $staryear = $thisyear - 6;
        }else{
             $starmonth = $thismonth - 2;
             $staryear = $thisyear - 5;
        }
		$startime= mktime(0, 0, 0, $starmonth, 1, $staryear);
		$endThisMonth = mktime(0, 0, 0, $starmonth, 1, $staryear+4);
//		缴费日期
		$startimes= mktime(0, 0, 0, $starmonth, 1, $staryear+1);
        $endtime = mktime(0, 0, 0, $starmonth+2, 1, $staryear+5);    
        //查询判断
        $where['insured_date']=array(array('gt',$startime),array('lt',$endThisMonth));
        $where['five_time']=array(array('gt',$startimes),array('lt',$endtime));
		$where['five_state']=array('eq',1);
		$result49s = $this->insurance
						  ->join('renew  on insurance_re.policy_number = renew.insurance_num')
						  ->field('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name,sum(insurance_premium) as should49s,sum(real_insurance_premium) as fact49s')
						  -> group('branch_shop_number,standard_shop_number,flag_shop_number,salesman_number,salesman_name') 
						  -> where($where) 
						  -> select();					  
		$a = array_merge($result13, $result13s, $result25, $result25s,$result37,$result37s, $result49, $result49s);
		$b = self::array_group_by($a, $type);	
		$array = array('should13', 'fact13', 'should13s', 'fact13s', 'should25', 'fact25', 'should25s', 'fact25s', 'shoulds37', 'facts37', 'shoulds37s', 'facts37s', 'shoulds49', 'facts49', 'shoulds49s', 'facts49s');		
				foreach ($b as $k => $v) {																																																			
					foreach ($v as $kk => $vv) {	
						foreach ($vv as $kkk => $vvv) {
							if (in_array($kkk, $array)) {
								$arr[$k][$kkk] += $vvv;
							} else {

								$arr[$k][$kkk] = $vvv;
							}
						}
					}
				}
		foreach($arr as $k => $v){
			foreach($v as $kk => $vv){
				$arr[$k]["13"] = $v["fact13"]/$v["should13"]*100 .'%';
				$arr[$k]["13s"] = $v["fact13s"]/$v["should13s"]*100 .'%';
				$arr[$k]["25"] = $v["fact25"]/$v["should25"]*100 .'%';
				$arr[$k]["25s"] = $v["fact25s"]/$v["should25s"]*100 .'%';
				$arr[$k]["37"] = $v["fact37"]/$v["should37"]*100 .'%';
				$arr[$k]["37s"] = $v["fact37s"]/$v["should37s"]*100 .'%';
				$arr[$k]["49"] = $v["fact49"]/$v["should49"]*100 .'%';
				$arr[$k]["49s"] = $v["fact49s"]/$v["should49s"]*100 .'%';
			}
		}
		return $arr;
		
	}

}


?>