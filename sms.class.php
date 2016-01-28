<?php
/** 
* 阿里大鱼短信接口
* @author xrx
* @project sms.api.cli.im
* @author xrx 2015 0127
* @email sixersun@gmail.com
*/
require('TopClient.class.php');
require('ResultSet.class.php');
require('RequestCheckUtil.class.php');
require('TopLogger.class.php');
require('request/AlibabaAliqinFcSmsNumSendRequest.class.php');
Class sms{

	private $appkey; //你的App key

	private $secret; //你的App Secret

	private $name;  //进入阿里大鱼的管理中心找到短信签名管理，输入已存在签名的名称，这里是身份验证。

	private $content;//内容 json格式 exp："{'code':'1234','product':'alidayu'}"

	private $phone;//目标号码

	private $code;//短信模板编号 exp:SMS_4955428 在阿里大鱼里找

	public function __construct($appkey,$secret,$name,$content,$phone,$code){
		$this->TopClient = new TopClient();
		$this->TopClient->appkey=$appkey;
		$this->TopClient->secretKey=$secret;
		$this->TopClient->format="json";
		$this->TopClient->simplify=true;
		$this->name=$name;
		$this->content=$content;
		$this->phone=$phone;
		$this->code=$code;
	}
	public function send(){
		$req = new AlibabaAliqinFcSmsNumSendRequest();
		$req->setExtend("123456");//确定发给的是哪个用户，参数为用户id
		$req->setSmsType("normal");
		$req->setSmsFreeSignName($this->name);
		$req->setSmsParam($this->content); 
		//这里设定的是发送的短信内容：验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”
		$req->setRecNum($this->phone);//参数为用户的手机号码
		$req->setSmsTemplateCode($this->code);
		$resp = $this->TopClient->execute($req);
		return $resp;
	}
}