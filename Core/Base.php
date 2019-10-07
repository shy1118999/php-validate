<?php
/**
 * Created by PhpStorm.
 * User: 少航
 * Date: 2019/4/12
 * Time: 21:50
 */

namespace App\Validate\Core;
use EasySwoole\Http\Request;
use App\Exception\ParameterException;

class Base extends Validate{
    public function gocheck(Request $request){

        $param = $request->getRequestParam();
        $res = $this->batch()->check($param);

        if(!$res){
            $error = $this->error;
            $e = new ParameterException([
                'msg'=>"参数错误：".(implode('，',$error)),
            ]);
            throw $e;
        }else{
            return true;
        }
    }
    protected function isPositiveInt($value,$rule='',$date='',$field=''){
        if(is_numeric($value) && is_int($value + 0) && ($value + 0)>0){
            return true;
        }else{
            return false;
        }
    }
    protected function isNotEmpty($value,$rule='',$date='',$field=''){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }
    protected function isMobile($value,$rule='',$date='',$field=''){
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    // 获取数据通过验证器验证的数据
    public function getDataByRule($arrays){
        if(array_key_exists("user_id",$arrays) || array_key_exists("uid",$arrays)){
            throw new ParameterException([
                "msg"=>"参数中包含非法的参数名user_id或者uid"
            ]);
        }
        $newArray = [];
        foreach($this->rule as $key=>$value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
    // 不做验证
    public function noCheck($value,$rule='',$date='',$field=''){
        return true;
    }
}