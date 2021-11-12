Задание реализованно следующим образом

Две формы
- Первая форма для клиента (index.php)
- Вторая форма для оператора техподдержки (index.support.php)

Запрос отправляемый клиентом обрабатывается обработчиком (processor.php). Из обработчика данные попадают 
в специально созданную БД (bd_sms) в таблицу (bufer) именно в эту таблицу стекаются все завки на изменение имени.

В форме оператора выводится последняя запись из буфера и по id клиента выводятся все имена, когда либо присвоенные этому клиенту 
и статус из основной таблицы (name).
Если статус равен 1 то значит текущее имя для клиента активно на данный момент.

Оператор принимает решение изменять данные или нет
Если Да то 
- в таблицу name добавляеся новая запись и меняется статус на 0.
- в таблице буфер данная строка удаляется (заявка считается обработанной)
- клиенту отправляется письмо с подтверждением
Если Нет то
- в таблице буфер данная строка удаляется (заявка считается обработанной)
- клиенту отправляется письмо с отказом

В папке classes расположен весь функционал
Отправка почты реализована через PHPMailer (SMTP yandex для того чтобы работал на отправку надо в настройках ящика от яндекса дать разрешение
на использование стороних программ).
Дамп базы в файле bd_sms.sql