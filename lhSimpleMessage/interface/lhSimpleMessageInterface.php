<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../classes/lhSimpleMessageAttachment.php';
/**
 *
 * @author user
 */
interface lhSimpleMessageInterface {
    // GET
    public function text();
    public function buddy();
    public function replyto();

    public function attachments();
    public function hints();


    // SET
    public function setText($param);
    public function setBuddy($param);
    public function setReplyTo($param);
    
    // ADD
    public function addAttachment(lhSimpleMessageAttachment $param);
    public function addHint(lhSimpleMessageHint $param);
    
}
