<?php
require 'app/base/init.php';
$core->load_module(array('base'=>array('user','dept')));
$act=trim($act);

switch ($act){
	case 'login':
		$username = trim($usr);
		$password = trim($pwd);
		$code = strtolower(trim($code));

		if($code != strtolower($_SESSION['code'])){_go(array('msg'=>'登录失败！','time'=>3,'type'=>'error','url'=>$_conf['host'].'/login.php'));}
		
		if(User::login($username,$password)){
			unset($_SESSION['code']);
			_go(array('msg'=>'登录成功！','time'=>1,'url'=>$_conf['host'].'/index.php'));
		}else{
			_go(array('msg'=>'登录失败！','time'=>3,'type'=>'error','url'=>$_conf['host'].'/login.php'));
		}
		break;
	case 'logout':
		User::logout();
	    _go('login.php');
		break;
	default:
		if(User::checkLogin()) {_go($_conf['host'].'/index.php');}
		include template('login');
}

?>