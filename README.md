# alidayu
阿里大鱼短信发送接口

只是做了简单的简化 以下是调用demo
<pre>
function sendsms(){
 	$name='注册验证';//短信签名
	$content="{'code':'5555','product':'xrx'}";//短信内容（json格式），根据短信模板来选择
	$phone='';//手机号码
	$code='SMS_4955428';//模板编号
	$appkey ='';//你的App key
	$secret ='';//你的App Secret:
	require('sms.class.php');//根据自己的框架来定位，如thinkphp下用import来引入
	$sms=new Sms($appkey,$secret,$name,$content,$phone,$code);
	$return=$sms->send();
}
</pre>

