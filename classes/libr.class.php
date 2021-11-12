<?php
	class Libr extends DB_conect{
		//метод проверки валидации
			function Sms_validate($sms_name){
				if (!preg_match('/[A-Za-z]/i', $sms_name)){
					$_SESSION['message']= "- Имя должно содержать только латинские символы." ;
				}elseif(preg_match('/[0-9]/', $sms_name)){
					$_SESSION['message']= '- Имя не должно содержать цифры';
				}elseif(strlen($sms_name)<3){
					$_SESSION['message']= '- Имя должно быть некороче 3-х символов';
				}elseif(strlen($sms_name)>11){
					$_SESSION['message']= '- Имя должно быть недлинее 11-ти символов';
				}
				else {
					$_SESSION['message']= '- Запрос отправлен';
					return trim(strip_tags($sms_name));
				}
			}
		//метод записи в БД буфер
			function save_bd_bufer($id_client, $name, $date){
					$db = 'bufer';
					$InsBets=$this->link->prepare("INSERT into $db (id_client, name, date) Values (?, ?, ?)")
																	or die ("извините, таблица БД не найдена");
					$InsBets->bind_param('iss',$id_client, $name, $date);
					$InsBets->execute();
					$InsBets->close();
			}
		//метод выборки данных из БД буфер
			function select_data_bufer(){
					$resBufer=$this->link->prepare("SELECT id, id_client, name, date FROM bufer ORDER BY ID DESC LIMIT 1") 
																				or die ("извините, таблица БД не найдена");
					$resBufer->execute();
					$resBufer->bind_result($id, $id_client, $name, $date);
						while($resBufer->fetch()){
							$mas[]=array('id'=>$id,'id_client'=>$id_client,'name'=>$name,'date'=>$date);
							}
echo <<<HTML
<table>
<caption><h2>Заявка от пользователя на изменение имени</h2></caption>
 <tr>
 <td width='7%'>id</td>
 <td width='7%'>id_client</td>
 <td width='7%'>name</td>
 <td width='7%'>date</td>
 </tr> 
HTML;
			if(is_array($mas)){
				foreach($mas as $value){
					$id = $value['id'];
					$id_client = $value['id_client'];
					$name = $value['name'];
					$date = $value['date'];
echo <<<HTML
 <tr>
 <td width='7%'>{$id}</td>
 <td width='7%'>{$id_client}</td>
 <td width='7%'>{$name}</td>
 <td width='7%'>{$date}</td>
 </tr>

HTML;
				}	
			}
echo"</table>";
return $mas;
	}
		//метод выборки из основной БД name
			function select_data_name($id_client){
					$resBufer=$this->link->prepare("SELECT id, id_client, name, date, status, e_mail FROM name WHERE id_client='$id_client'")
																									or die ("извините, таблица БД не найдена");
					$resBufer->execute();
					$resBufer->bind_result($id, $id_client, $name, $date, $status, $e_mail);
						while($resBufer->fetch()){
							$mas[]=array('id'=>$id,'id_client'=>$id_client,'name'=>$name,'date'=>$date, 'status'=>$status, 'e_mail'=>$e_mail);
							}
echo <<<HTML
<br/>
<table>
<caption><h2>Текущее имя для данного пользователя</h2></caption>
 <tr>
 <td width='7%'>id</td>
 <td width='7%'>id_client</td>
 <td width='7%'>name</td>
 <td width='7%'>date</td>
 <td width='7%'>status</td>
 <td width='7%'>e_mail</td>
 </tr> 
HTML;
				if(is_array($mas)){
					foreach($mas as $value){
						$id = $value['id'];
						$id_client = $value['id_client'];
						$name = $value['name'];
						$date = $value['date'];
						$status = $value['status'];
						$e_mail = $value['e_mail'];
echo <<<HTML
 <tr>
 <td width='7%'>{$id}</td>
 <td width='7%'>{$id_client}</td>
 <td width='7%'>{$name}</td>
 <td width='7%'>{$date}</td>
 <td width='7%'>{$status}</td>
 <td width='7%'>{$e_mail}</td>
 </tr>

HTML;
					}
				}
echo"</table>";
return $mas;
	}
		//метод обнуления старого статуса в основной БД name
			function update_data_name($id_client, $name, $date){
				$db = 'name';
				$status = '0';
				$InsBets=$this->link->prepare("UPDATE $db SET id_client=?, name=?, status=?, date=? WHERE id_client='$id_client' and status='1' ")
																										or die ("извините, таблица БД не найдена");
				$InsBets->bind_param('isis',$id_client, $name, $status, $date);
				$InsBets->execute();
				$InsBets->close();
			}
		//метод записи в БД name
			function save_bd_name($id_client, $name, $status, $date, $e_mail){
					$db = 'name';
					$InsBets=$this->link->prepare("INSERT into $db (id_client, name, status, date, e_mail) Values (?, ?, ?, ?, ?)")
																						 or die ("извините, таблица БД не найдена");
					$InsBets->bind_param('isiss',$id_client, $name, $status, $date, $e_mail);
					$InsBets->execute();
					$InsBets->close();
			}
		//метод удаления записи в БД буфер
			function delete_bd_bufer($id){
					$db = 'bufer';
					$InsBets=$this->link->prepare("DELETE FROM $db WHERE id='$id'")
										 or die ("извините, таблица БД не найдена");
					$InsBets->execute();
					$InsBets->close();
			}
		//метод обнуления POST
			function LocationC(){
				if($_SERVER['REQUEST_METHOD']=='POST'){
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
}
?>