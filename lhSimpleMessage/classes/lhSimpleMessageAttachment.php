<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/../interface/lhSimpleMessageAttachmentInterface.php';
/**
 * Description of lhSimpleMessageAttachment
 *
 * @author user
 */
class lhSimpleMessageAttachment implements lhSimpleMessageAttachmentInterface {
    private $name;
    private $file_name;
    
    // GET
    public function name() {
        return $this->name;
    }
    
    public function file() {
        return $this->file_name;
    }
    
    public function data() {
        return file_get_contents($this->file_name);
    }
    
    public function size() {
        return filesize($this->file());
    }
    
    // SET
    public function setName($param) {
        $this->name = $param;
        return $this;
    }
    
    public function setFile($param) {
        $file_name = sys_get_temp_dir() . '/' . uniqid() . '.' . $this->name();
        copy($param, $file_name);
        $this->file_name = $file_name;
        return $this;
    }
    
    public function setData($param) {
        $file_name = sys_get_temp_dir() . '/' . uniqid() . '.' . $this->name();
        file_put_contents($file_name, $param);
        $this->file_name = $file_name;
        return $this;
    }
    
    // Destructor
    public function __destruct() {
        if (file_exists($this->file())) {
            unlink($this->file());
        }
    }
}
