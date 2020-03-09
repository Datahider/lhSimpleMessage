<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/lhSimpleMessage/classes/lhSimpleMessageAttachment.php';
require_once __DIR__ . '/lhSimpleMessage/classes/lhSimpleMessage.php';

echo "Тестирование lhSimpleMessageAttachment:\n";

try {
    echo "Инициализация объекта...";
    $tmpdata = rand().rand().rand();
    $tmpdata2 = md5($tmpdata);
    $att = new lhSimpleMessageAttachment();
    $att->setName("test.tmp")->setData($tmpdata);
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


    echo "Тестирование lsSimpleMessage:\n";
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


    echo "Удаление объекта";
    $msg = NULL;
    sleep(1); echo '.'; sleep(1); echo '.'; sleep(1); echo "."; 

    if (file_exists($file1) || file_exists($file2)) {
        throw new Exception("FAIL - файл не удален");
    } else {
        echo "ok\n";
    }


    echo "Тестирование успешно завершено";
} catch (Exception $e) {
    echo "\n\nТЕСТИРОВАНИЕ ЗАВЕРШЕНО С ОШИБКОЙ:\n";
    echo $e->getMessage() . "\n";
}