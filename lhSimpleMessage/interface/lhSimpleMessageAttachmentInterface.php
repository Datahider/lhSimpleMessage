<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author user
 */
interface lhSimpleMessageAttachmentInterface {
    // GET
    public function name();
    public function file();
    public function data();
    public function size();
    public function type();


    // SET
    public function setName($param);
    public function setFile($param);
    public function setData($param);
}
