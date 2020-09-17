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
    private $hints;
    private $buddy;
    private $replyto;
    private $type;

    public function __construct() {
        $this->attachments = [];
        $this->hints = [];
    }
        
    public function text() {
        return $this->text;
    }
    
    public function attachments() {
        return $this->attachments;
    }
    
    public function hints() {
        return $this->hints;
    }
    
    public function buddy() {
        return $this->buddy;
    }
    
    public function replyto() {
        if ($this->replyto) {
            return $this->replyto;
        } else {
            return $this->buddy;
        }
    }
    
    public function type() {
        return $this->type;
    }


    public function setText($param) {
        $this->text = $param;
        return $this;
    }
    
    public function addAttachment(lhSimpleMessageAttachment $param) {
        $this->attachments[] = $param;
        return $this;
    }
    
    public function addHint(lhSimpleMessageHint $param) {
        $this->hints[] = $param;
        return $this;
    }

    public function setBuddy($param) {
        $this->buddy = $param;
        return $this;
    }
    
    public function setReplyTo($param) {
        $this->replyto = $param;
        return $this;
    }
    
    public function setType($param) {
        $this->type = $param;
        return $this;
    }
}
