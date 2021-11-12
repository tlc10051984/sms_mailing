<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		header("refresh: 5 " . $_SERVER['REQUEST_URI']);
	}
	require_once "session.inc.php";
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" href="css/style.css"/>
		<script src="js/login.js"></script>
		<script src="js/jquery.js" type="text/javascript"></script>
	</head>
	<body>
	<script type="text/javascript" src="js/procrutka.js"></script>
<div id="glbox">
	<header>
		<div id="logotype">                    
			<a href='index.support.php' title='SMS'>
				<img src="/image/sms_rassylka_1.png" alt="Центр СМС рассылки"/>
				<h3><span>Страница для техподдержки <?php echo $_SESSION['message']; $_SESSION = array();?></span></h3>
			</a>
		</div>
	</header>
<!--вывод основного контента на странице-->
	<div id="content">
		<?php include "processor.php";?><br/>
		<?php include "form_support.php";?>
	</div><br/>
	

<!-- форма для авторизации-->

</div>
	<footer>	
		<hr/>	
		<span class="copirate">
			<a href=''>SMS</a> &copy; 2014 - <?php echo date('Y');?>
		</span>
	</footer>	

	</body>
</html>