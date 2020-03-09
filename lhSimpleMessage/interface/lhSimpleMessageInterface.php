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
    public function attachments();
    
    // SET
    public function setText($param);
    public function addAttachment(lhSimpleMessageAttachment $param);
}
