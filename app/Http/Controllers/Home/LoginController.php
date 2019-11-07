<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Api\SmsController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
	//验证登录
    public function login(Request $request){
    $params = $request->all();
    $userName = $params['user_name'];
    $password = $params['password'];

    if(empty($userName)){
        return $this->sendError('缺少参数userName');
    }
    if(empty($password)){
        return $this->sendError('缺少参数password');
    }
    //连接成美优选
    $mysql2 = Db::connection('mysql2')
                ->table('yaogou_merchant')
                ->where([
                    ['store_name',$userName],
                    ['status',1]
                ])
                ->first();
        
     if (empty($mysql2)) {
        //连接虚拟充值
        $mysql  = Db::connection('mysql')
                ->table('user')
                ->where([
                    ['user_name',$userName],
                    ['password',$password]
                ])
                ->first();
        if (empty($mysql)) {
            $return = [
                'code' => 4001,
                'msg' => '账户或密码不正确'
            ];
            return json_encode($return);
        }else{
            $return = [
                'code'=>200,
                'msg'=>'登录成功？'
            ];
            return json_encode($return);
        }

    }


    $res = json_decode(json_encode($mysql2), true);
    
    $dbPassword = $res['password'];//数据表中的密码
    
    $result = password_verify($password,$dbPassword);//自己填的密码和数据表密码对比，返回true，填写正确；返回false，

    if($result){
        return $this->sendResponse($result,'登录成功');
    }else{
        return $this->sendError('用户名密码错误');
    }
}
    //用户注册
    public function regisert(Request $request){

        
    }
}
