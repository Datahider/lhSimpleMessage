<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/../interface/lhSimpleMessageHintInterface.php';
/**
 * Description of lhSimpleMessageHint
 *
 * @author user
 */
class lhSimpleMessageHint implements lhSimpleMessageHintInterface {
    private $text;
    private $value;
    
    // Конструктор
    public function __construct($text, $value='#') {
        $this->text = $text;
        $this->value = $value;
    }
    
    // GET
    public function text() {
        return $this->text;
    }
    
    public function value() {
        return $this->value;
    }
}
