<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/lhSimpleMessage/classes/lhSimpleMessageAttachment.php';
require_once __DIR__ . '/lhSimpleMessage/classes/lhSimpleMessageHint.php';
require_once __DIR__ . '/lhSimpleMessage/classes/lhSimpleMessage.php';

echo "Тестирование lhSimpleMessageAttachment:\n";

try {
    echo "Инициализация объекта...";
    $tmpdata = rand().rand().rand();
    $tmpdata2 = md5($tmpdata);
    $att = new lhSimpleMessageAttachment();
    $att->setName("test/tmp.dat")->setData($tmpdata);
    if ($att->name() != 'test_tmp.dat') throw new Exception ("Не произведена замена символов в имени");
    echo "ok\n";

    $tmpfile = $att->file();

    echo "Установка данных из файла...";
    $att->setFile($tmpfile);
    if ($att->file() != $tmpfile) {
        unlink($tmpfile);
        $tmpfile = $att->file();
        echo "ok\n";
    } else {
        throw new Exception("Имя файла не изменилось");
    }

    echo "Временный файл: $tmpfile\n";
    
    echo 'Тип вложения ...' . $att->type();
    if ($att->type() != 'dat') {
        throw new Exception("Не верно определен тип файла");
    }
    echo " (ok)\n";
    
    echo "Получение данных...";
    if ( (file_get_contents($att->file()) == $tmpdata) && ($att->data() == $tmpdata) ) {
        echo "ok\n";
    } else {
        throw "FAIL - полученные данные не равны переданным\n";
    }

    echo "Удаление объекта";
    $att = NULL;
    sleep(1); echo '.'; sleep(1); echo '.'; sleep(1); echo "."; 

    if (file_exists($tmpfile)) {
        throw "FAIL - файл не удален\n";
    } else {
        echo "ok\n";
    }


    echo "\nТестирование lsSimpleMessage:\n";
    $tmptext = "Это текст для тестирования сообщения";

    echo "Создание объекта";
    $msg = new lhSimpleMessage();
    echo '.';
    $msg->setText($tmptext);
    echo '.';
    $msg->addAttachment((new lhSimpleMessageAttachment())->setName("dynamic1.att")->setData($tmpdata2));
    echo '.';
    $msg->addAttachment((new lhSimpleMessageAttachment())->setName("dynamic2.att")->setFile($msg->attachments()[0]->file()));
    echo "ok\n";

    echo "Проверка вложения";
    if ($msg->attachments()[0]->name() != "dynamic1.att") {
        throw "FAIL - не верное имя вложения";
    } else {
        echo '.';
    } 

    if ($msg->attachments()[1]->name() != "dynamic2.att") {
        throw new Exception("FAIL - не верное имя вложения");
    } else {
        echo '.';
    } 

    if ($msg->attachments()[0]->data().$msg->attachments()[1]->data() == $tmpdata2.$tmpdata2) {
        echo ".";
    } else {
        echo "\n\nAtt0 data: ".$msg->attachments()[0]->data()."\n";
        echo "Att1 data: ".$msg->attachments()[1]->data()."\n";
        throw new Exception("Не верные данные во вложениях");
    }

    $file1 = $msg->attachments()[0]->file();
    $file2 = $msg->attachments()[1]->file();
    
    if ($file1 == $file2) {
        throw new Exception("Имена файлов вложений совпадают");
    }

    if (file_exists($file1) && file_exists($file2)) {
        echo '.';
    } else {
        throw new Exception("FAIL - файлы вложений не существуют");
    }
    echo "ok\n";

    echo "Проверка установки собеседника...";
    $msg->setBuddy(25);
    if (($msg->buddy() == 25) && ($msg->replyto() == 25)) {
        echo "оk\n";
    } else {
        throw new Exception("Установленный собеседник не совпадает с полученным от объекта");
    }
    
    echo "Проверка установки replyto...";
    $msg->setReplyTo(280);
    if (($msg->buddy() == 25) && ($msg->replyto() == 280)) {
        echo "оk\n";
    } else {
        throw new Exception("Установленный replyto не совпадает с полученным от объекта");
    }
    
    echo "\nТестирование подсказок";
    $msg->addHint(new lhSimpleMessageHint("Подсказка 1", 1))->addHint(new lhSimpleMessageHint("Подсказка 2", "https://localhost/"))->addHint(new lhSimpleMessageHint("Подсказка 3"));
    if ($msg->hints()[0]->text() != "Подсказка 1") throw new Exception ("Текст первой подсказки не совпадает");
    echo '.';
    if ($msg->hints()[1]->text() != "Подсказка 2") throw new Exception ("Текст второй подсказки не совпадает");
    echo '.';
    if ($msg->hints()[0]->value() != 1) throw new Exception ("Значение первой подсказки не совпадает");
    echo '.';
    if ($msg->hints()[1]->value() != "https://localhost/") throw new Exception ("Значение второй подсказки не совпадает");
    echo '.';
    if ($msg->hints()[2]->text() != "Подсказка 3") throw new Exception("Текст третьей подсказки не совпадает");
    echo '.';
    if ($msg->hints()[2]->value() != "") throw new Exception("Значение третьей подсказки не совпадает");
    echo ".ok\n";

    echo "\nТестирование сервисных полей";
    $msg->setServiceId("982734");
    if ($msg->serviceId() != "982734") throw new Exception ("serviceId вернул не верное значение");
    echo '.';
    $msg->setServicePointer("9827223434");
    if ($msg->servicePointer() != "9827223434") throw new Exception ("servicePointer вернул не верное значение");
    echo '.';
    $msg->setServiceData("9kllksdfo82734");
    if ($msg->serviceData() != "9kllksdfo82734") throw new Exception ("setServiceData вернул не верное значение");
    echo ".ok\n";




    echo "\nУдаление объекта";
    $msg = NULL;
    sleep(1); echo '.'; sleep(1); echo '.'; sleep(1); echo "."; 

    if (file_exists($file1) || file_exists($file2)) {
        throw new Exception("FAIL - файл не удален");
    } else {
        echo "ok\n";
    }


    echo "\nТестирование успешно завершено";
} catch (Exception $e) {
    echo "\n\nТЕСТИРОВАНИЕ ЗАВЕРШЕНО С ОШИБКОЙ:\n";
    echo $e->getMessage() . "\n";
}