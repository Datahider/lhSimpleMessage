<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once __DIR__ . '/../interface/lhSimpleMessageInterface.php';
/**
 * Description of lhSimpleMessage
 *
 * @author user
 */
class lhSimpleMessage implements lhSimpleMessageInterface {
    private $text;
    private $attachments;
    
    public function text() {
        return $this->text;
    }
    
    public function attachments() {
        return $this->attachments;
    }
    
    public function setText($param) {
        $this->text = $param;
        return $this;
    }
    
    public function addAttachment(lhSimpleMessageAttachment $param) {
        $this->attachments[] = $param;
    }
}
