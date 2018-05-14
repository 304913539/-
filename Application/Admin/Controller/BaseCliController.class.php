<?php
namespace Admin\Controller;
use Think\Controller;

class BaseCliController extends Controller {

    /**
     * cli模式查询店铺是否达到申请店铺的条件
     * @return [type] [description]
     */
    public function get_shop_qual(){

                $condition['m.member_level'] = array('eq','1') ; //会员等级自身业务会员
                $condition['m.check_status'] = array('eq','1') ; //审核通过

                $result = M('member') ->table('member as m')
                                      ->join('member_profile as mp on m.m_number = mp.m_number')
                                      ->where($condition)
                                      ->field('m.m_number, m.my_shop_number, m.shop_number,mp.province,m.register_time,m.branch_shop_number')
                                      ->select();

                $base_cli_model = D('BaseCli');

                //计算各个店铺不同状态（筹备期 经营期）的业务指标
                $result = $base_cli_model->business_indicators($result);
                $now_mon = strtotime(date('Y-n',time()));
                if($result){
                    foreach ($result as  $value) {
                        $data[] = array('m_number'=>$value['m_number'],'branch_shop_number'=>$value['branch_shop_number'],'standard'=>$now_mon);
                    }
                    $add_result = M('member_standard')->addAll($dataList);

                }



    }



}
