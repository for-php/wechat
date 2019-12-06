<?php


namespace wechat\lib;

use wechat\lib\Config;
use wechat\lib\core\Auth;
use wechat\lib\core\IAuth;
use wechat\lib\core\IMenu;
use wechat\lib\core\IRequestMsg;
use wechat\lib\core\IResponseCode;
use wechat\lib\core\IResponseMsg;
use wechat\lib\core\Menu;
use wechat\lib\core\RequestMsg;
use wechat\lib\core\ResponseMsg;

/**
 * Class Wechat
 * @package wechat\lib
 * @auth: Taurus12C
 * @email: 1402410174@qq.com
 * @date: 2019-12-04 10:27:35
 */
class Wechat implements IAuth,IResponseCode,IMenu,IRequestMsg,IResponseMsg
{
    use Auth,Menu,RequestMsg,ResponseMsg;

    /**
     * @desc 微信 服务号|订阅号 appid
     * @var bool|string
     */
    protected $appid = '';

    /**
     * @desc 微信 服务号|订阅号 appsecret
     * @var bool|string
     */
    protected $appsecret = '';

    /**
     * @desc 微信 服务号|订阅号 token
     * @var bool|string
     */
    protected $token = '';

    /**
     * Wechat constructor.
     * @param bool $appid
     * @param bool $appsecret
     * @param bool $token
     */
    public function __construct($appid=false, $appsecret=false, $token=false)
    {
        $this->appid = $appid?$appid:Config::wechat('appid');
        $this->appsecret = $appsecret?$appsecret:Config::wechat('appsecret');
        $this->token = $token?$token:Config::wechat('token');
    }

    /**
     * @desc 获取全局access_token
     * @return string
     */
    public function getGlobalAccessToken():string
    {
        $arr = json_decode(Cache::cache('globalaccesstoken'),true);
        $str = Cache::cache('globalaccesstoken');

        if ($arr['timeout']&&$arr['timeout']<time()){
            $str = $this->globalAccessToken($this->appid,$this->appsecret);
        }

        if(!$arr||!array_key_exists('access_token',$arr)){
            $str = $this->globalAccessToken($this->appid,$this->appsecret);
        }

        $res = $this->checkError($str);
        if ($res){
            return json_decode($str,true)['access_token'];
        }
        return false;

    }

    /**
     * @desc 引导用户前往微信授权页面
     * @param $redirect_uri 授权后重定向地址
     * @param $scope 应用授权作用域
     * @param string $state 授权回调参数
     */
    public function webAuth(string $redirect_uri, string $scope, string $state='state'):void
    {
        $this->getCode($this->appid,$redirect_uri,$scope,$state);
    }

    /**
     * @desc 获取用户基本信息
     * @return string|mixed
     */
    public function getUserInfo()
    {

        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $str = $this->userInfo($this->appid,$this->appsecret,$code);
            $res = $this->checkError($str);
            if ($res){
                return $str;
            }
            return false;
        }

        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $this->webAuth($redirect_url,'snsapi_userinfo');

    }

    /**
     * @desc 获取用户openid
     * @return mixed
     */
    public function getOpenId()
    {

        if (isset($_GET['code'])){
            $code = $_GET['code'];
            $str = $this->openId($this->appid,$this->appsecret,$code);
            $res = $this->checkError($str);
            if ($res){
                return $str;
            }
            return false;
        }

        $redirect_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $this->webAuth($redirect_url,'snsapi_base');
    }

    /**
     * @desc 设置自定义菜单
     * @param array $data
     * @return bool
     */
    public function setMenu(array $data): bool
    {
        $str = $this->menu($this->getGlobalAccessToken(), $data);
        return $this->checkError($str);
    }

    /**
     * @desc 获取自定义菜单
     * @return string
     */
    public function getMenuInfo(): string
    {
        $str = $this->menuInfo($this->getGlobalAccessToken());
        if ($this->checkError($str)){
            return $str;
        }
        return false;
    }

    /**
     * @desc 删除自定义菜单
     * @return bool
     */
    public function delMenu(): bool
    {
        $str = $this->menuDel($this->getGlobalAccessToken());
        return $this->checkError($str);
    }

    /**
     * @desc 设置个性化菜单
     * @param array $data
     * @param array $matchrule
     * @return bool
     */
    public function setMenuConditional(array $data, array $matchrule): bool
    {
        $str = $this->menuConditional($this->getGlobalAccessToken(),$data,$matchrule);
        return $this->checkError($str);
    }

    /**
     * @desc 获取个性化菜单
     * @return string
     */
    public function getMenuConditionalInfo(): string
    {
        $str = $this->menuConditionalInfo($this->getGlobalAccessToken());
        return $this->checkError($str);
    }

    public function getMsg(): array
    {
        return $this->Msg();
    }

    public function sendText(string $toUserName,string $fromUserName,string $content): void
    {
        $this->text($toUserName,$fromUserName,$content);
    }

    public function sendImg(string $toUserName, string $fromUserName, string $mediaId): void
    {
        $this->img($toUserName,$fromUserName,$mediaId);
    }

    public function sendVoice(string $toUserName, string $fromUserName, string $mediaId): void
    {
        $this->voice($toUserName,$fromUserName,$mediaId);
    }

    public function sendMusic(string $toUserName, string $fromUserName, array $content): void
    {
        $this->music($toUserName,$fromUserName,$content);
    }

    public function sendVideo(string $toUserName, string $fromUserName, array $content): void
    {
        $this->video($toUserName,$fromUserName,$content);
    }

    public function sendNews(string $toUserName, string $fromUserName, array $articles): void
    {
        $this->news($toUserName,$fromUserName,$articles);
    }

    /**
     * @desc 捕获微信错误码
     * @param string $response
     * @return bool
     */
    public function checkError(string $response)
    {
        $arr = json_decode($response,true);
        try{
            if(array_key_exists('errcode',$arr)&&$arr['errcode']!=0){
                $msg = IResponseCode::RESPONSE_CODE[$arr['errcode']];
                throw new \Exception($msg,$arr['errcode']);
            }
        }catch (\Exception $e){
            $err_arr = array_reverse(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))[0];
            echo '错误原因: "'.$e->getMessage().'" 微信错误码: ('.$e->getCode().')</br>';
            echo $err_arr['file'].'::'.$err_arr['line'];
            die();
        }

        return true;
    }

}