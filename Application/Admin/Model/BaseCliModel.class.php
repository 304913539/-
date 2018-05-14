<?php
namespace Admin\Model;
use Think\Model;
class BaseCliModel extends Model {
    protected $tableName = 'member';
    protected $member_obj = ''; //会员表
    protected $insurance_re = '';   //续期保单
    protected $renew = '';      //缴费时间表



    /**
     *  计算标准店旗舰店业务指标
     * @param  [array] $param [机构数组]
     * @return [type]        [description]
     */
    public function business_indicators(&$param)
    {


        if(is_array($param)) {

            $this->_get_cache_shop_assess_standrd();    //将店铺考核标准放进缓存
            $data = array(); //达标的会员
            foreach ($param as &$value) {   //循环设置店铺状态考核标准
                $value['shop_level'] = 1; //标准店筹备期标准
                $value['examine_standard'] = get_address_cate($value['province']);

                $business  = S('result_'.$value['examine_standard'].'_'.$value['shop_level']);
                if($business!=false) {
                   $result_check = $this->_get_shop_business_indicators($value,$business);
                   if($result_check==true){
                        $data[]=$param['m_number'];
                   }
                }

            }
            return $data;
        } else {
            return '参数不正确';
        }
    }

    /**
     * 查询考核店铺标准表 将所有店铺考核标准查询出来放入缓存
     * @author iyting <[<iyting@foxmail.com>]>
     * @return [type] [description]
     */
    protected function _get_cache_shop_assess_standrd()
    {

        $shop_assess_model = M('shop_assess_standard');

        //A类标准
        $result_1_1 = $shop_assess_model
                    ->cache('result_1_1',3600)
                    ->where('shop_level = 1 and area_standard = 1')
                    ->find();   //A类标准 标准店筹备期

        //B类标准

        $result_2_1 = $shop_assess_model
                    ->cache('result_2_1',3600)
                    ->where('shop_level = 2 and area_standard = 1')
                    ->find();   //B类标准 标准店筹备期

         //C类标准

        $result_3_1 = $shop_assess_model
                    ->cache('result_3_1',3600)
                    ->where('shop_level = 2 and area_standard = 1')
                    ->find();   //C类标准 标准店筹备期


    }
    /**
     * 查询各个店铺考核预警数据
     * @author iyting <[<email address>]>
     *
     * @param  [type] $shop_info      [店铺信息]
     * @param  [type] $business     [该店铺考核相应指标]
     * @return [type]                [description]
     */

    protected function _get_shop_business_indicators($shop_info,$business)
    {


        //查询该会员表中是该会员所推荐的用户
        $map['recommend_member_id'] = array('eq',$shop_info['m_number']);
        $map['member_level']        = array('in',array(0,1));
        $map['check_status']        = array('eq',1);

        $member_result              = M('member')->where($map)->getField('m_number',true);

        $member_result_count        = count($member_result);    //所属会员总数
        if($member_result_count){
            array_push($member_result, $shop_info['m_number']); //将会员自己的会员代码加入到所属推荐人数组里面 以便查询保单表
            //查询会员业务指标
        }else{
            $member_result[]['m_number']=$shop_info['m_number'];
            $member_result[]['branch_shop_number']=$shop_info['branch_shop_number'];

        }

        $member_result_str = implode(',', $member_result);
        $condition         = "salesman_number in ({$member_result_str})";
        $beginThismonth    = strtotime(date('Y-m-01')); //筹备期考核起始月份
        $endThismonth      = strtotime('-3 month',$beginThismonth); //筹备期考核结束时间



        //回访成功日期
        $return_visit_date = strtotime('+20 day',$endThismonth);
        //回执日期
        $return_date       = strtotime('+10 day',$endThismonth);
        //查询该店铺当月首期寿险业务指标
        //拼接sql查询语句
        $sql_query=<<<EOF
        SELECT
            SUM(value_premium) AS tp_sum
        FROM
            `insurance`
        WHERE
        $condition
        AND `insurance_type` = 1
        AND `insurance_status` = 1
        AND `surrender_date` =0
        AND `hesitate_date` =0

        AND (
            insured_date >= $beginThismonth
            AND insured_date < $endThismonth
        )
        AND (
            return_visit_date <= $return_visit_date
            AND return_visit_date != 0
            AND return_visit_date IS NOT NULL
        )
        AND (
            return_date <= $return_date
            AND return_visit_date != 0
            AND return_visit_date IS NOT NULL
        )
        LIMIT 1
EOF;

        // 实例化一个model对象 没有对应任何数据表
        $insurance_model   = new \Think\Model();
        //对考核业务指标价值保费进行求和
        $result            = $insurance_model->query($sql_query);
        $result            = current(array_column($result,'tp_sum')); //业务指标
        //继续率
        $continuation_rate = $this->get_prepar_proceed_percent($shop_info,$business['continuation_rate']);
        if(($member_result_count>=$business['first_hand_human']) and ($reslut>=$business['business_ind']) and($continuation_rate==0)){
            return ture;
        }else{
            return false;
        }





    }
    /**查询继续率
     * @author  iyting
     * @param  [array] $org_code       [店铺信息]
     * @param  [float] $bssessment_cri [继续率指标]
     * @return [type]                 [description]
     */
    protected function get_prepar_proceed_percent($shop_info,$bssessment_cri){

        if(func_num_args()==2){

            if (!empty($shop_info['m_number'])) {



                if($shop_info['register_time']){
                    $start_time  = date('Y-n',time());
                    $end_time= date('Y-n',$shop_info['register_time']);


                    $diff_mon         = (getMonthNum($start_time,$end_time,'-'));   //当前月-注册月 得注册到现在的月数

                    if(($diff_mon<24)){ //判断注册日期是否小于24个月
                        return 0;            //不满13个月 继续率按照100%

                    } else { //大于24个月

                        $now_check_re_end_time                          = date('Y-n',strtotime('-15 months ')); //续期考核开始时间
                        $now_check_tr_grace_time                        = date('Y-n-1'); //续期考核结束时间
                        $first_check_start_time                         = date('Y-n',strtotime('-24 months',strtotime($now_check_re_end_time))); //承保开始日期
                        $first_check_end_time                           = date('Y-n',strtotime('-11 months',strtotime($now_check_re_end_time))); //承保结束日期


                        $condition['insurance_re.standard_shop_number'] = array('eq',$shop_info['org_code']); //店铺代码

                            //承保日期
                        $condition['insurance_re.insured_date']         = array('between',array(strtotime($first_check_start_time),
                                                                                                strtotime($first_check_end_time)));
                        $condition['insurance_re.policy_status']        = array('eq',1);
                        $condition['insurance_re.insurance_type']       = array('eq',1);
                        $condition['renew.renew_count']                 = array('eq',2); //缴费次数
                        $condition['renew.two_time']                    = array('between',array(strtotime($now_check_re_end_time),strtotime($now_check_tr_grace_time))); //二次成功日期
                        $condition['renew.two_state']                   = array('eq',1); //二次是否成功

                        $insurance_re_obj  = M('insurance_re'); //实例化续期保单表
                        $resul  = $insurance_re_obj->join('renew ON insurance_re.policy_number = renew.insurance_num ')
                                                   ->where($condition)
                                                   ->field('SUM(insurance_re.insurance_premium) as preminum,SUM(insurance_re.real_insurance_premium) as real_premium')
                                                   ->select();
                        if(is_null($result['real_premium'])){
                            $result['real_premiun'] = 0;
                        }
                        if(is_null($result['premium']) or $result['premium']==0){
                            return false;
                        }
                        $data['bssessment_cri'] = $bssessment_cri; //继续率指标
                        $data['reached']        = $result['real_premium']/$result['preminum']; //为满足13个月按照百分百来算
                        $data['gap']            = ($result['real_premium']/$result['preminum'])-$bssessment_cri; //差距
                        return  $data; #实收/应收=继续率


                    }
                }else{
                    return false;
                }

            } else {
                return false;
            }


        } else {
            return false;
        }


    }
}
