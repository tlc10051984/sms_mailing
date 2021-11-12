<?php
	include "classes/DB.class.php";
	include "classes/libr.class.php";
	// Подключаем библиотеку PHPMailer
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;
		require 'PHPMailer/PHPMailer.php';
		require 'PHPMailer/SMTP.php';
		require 'PHPMailer/Exception.php';

	if(isset($_POST['sms_name']) and isset($_POST['order'])){
		//подключаем класс библиотеку
			$libr = new Libr;
		//запускаем проверку на допустимые символы
			$libr_validate = $libr->Sms_validate($_POST['sms_name']);
		//если все ок то записываем данные в БД буфер
			$id_client = '001';
			$name = $libr_validate;
			$date = date("d.m.Y");
			if($name){
				$libr->save_bd_bufer($id_client, $name, $date);
			}
	}
		//выводим данные по клиенту из буфера из основной БД
	if($_SERVER['REQUEST_URI'] == '/index.support.php'){
		$libr = new Libr;
		$mas_bufer = $libr->select_data_bufer();
			if(is_array($mas_bufer)){
				foreach($mas_bufer as $value){
					$id_b = $value['id'];
					$id_client_b = $value['id_client'];
					$name_b = $value['name'];
					$date_b = $value['date'];
				}
			}
		$mas_name = $libr->select_data_name($id_client_b);
		//если оператор техподдержки решает подтвердить изменения
		//обновление в БД name меняется статус на 0, соханяются данные из буфера в базу name, данные которые сохранены удаляются из буфера
		if(isset($_POST['yes']) and is_array($mas_name)){
			foreach($mas_name as $value_1){
				if($value_1['status'] != '1'){
					continue;
				}else{
					$id = $value_1['id'];
					$id_client = $value_1['id_client'];
					$name = $value_1['name'];
					$date = $value_1['date'];
					$status = $value_1['status'];
					$e_mail = $value_1['e_mail'];
				}
			}
			$comment = $_POST['comment'];
			$libr->update_data_name($id_client, $name, $date);
			$libr->save_bd_name($id_client_b, $name_b, 1, $date_b, $e_mail);
			$libr->delete_bd_bufer($id_b);
			// Создаем письмо, 
				$mail = new PHPMailer();
				$mail->CharSet = 'UTF-8';
				$mail->isSMTP();
				$mail->Host   = 'ssl://smtp.yandex.ru';
				$mail->SMTPAuth   = true;
				$mail->Username   = '****************@yandex.ru';
				$mail->Password   = '*********';
				$mail->SMTPSecure = 'ssl';
				$mail->Port   = 465;
				 
				$mail->setFrom('vitaliy.mordarew@yandex.ru', 'СМС сервис');    // от кого
				$mail->addAddress($e_mail, 'Вася Петров'); // кому
				 
				$mail->Subject = 'Изменения имени одобрены';
				$mail->msgHTML("<html><body>
								<h1>Здравствуйте!</h1>
								<p>Ваше имя отправителя было изменено на $name_b</p>
								<p>$comment</p>
								</html></body>");
			// Отправляем
				if ($mail->send()) {
				  echo 'Письмо отправлено!';
				} else {
				  echo 'Ошибка: ' . $mail->ErrorInfo;
				}
		}
		//если оператор техподдержки решает не изменять имя то данные в бд буфер удаляются
		if(isset($_POST['no']) and is_array($mas_name)){
			$libr->delete_bd_bufer($id_b);
			foreach($mas_name as $value_1){
				if($value_1['status'] != '1'){
					continue;
				}else{
					$e_mail = $value_1['e_mail'];
				}
			}
			$comment = $_POST['comment'];
			// Создаем письмо, 
				$mail = new PHPMailer();
				$mail->CharSet = 'UTF-8';
				$mail->isSMTP();
				$mail->Host   = 'ssl://smtp.yandex.ru';
				$mail->SMTPAuth   = true;
				$mail->Username   = '****************@yandex.ru';
				$mail->Password   = '***********';
				$mail->SMTPSecure = 'ssl';
				$mail->Port   = 465;
				 
				$mail->setFrom('vitaliy.mordarew@yandex.ru', 'СМС сервис');    // от кого
				$mail->addAddress($e_mail, 'Вася Петров'); // кому
				 
				$mail->Subject = 'Изменения имени отклонено';
				$mail->msgHTML("<html><body>
								<h1>Здравствуйте!</h1>
								<p>Ваше имя отправителя не было изменено b</p>
								<p>$comment</p>
								</html></body>");
			// Отправляем
				if ($mail->send()) {
				  echo 'Письмо отправлено!';
				} else {
				  echo 'Ошибка: ' . $mail->ErrorInfo;
				}
		}
	}
	
?>