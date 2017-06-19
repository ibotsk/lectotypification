<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Utils
 * @author Matus
 */
class UtilsHelper extends AppHelper {

    public $helpers = array();

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    public function sempty($value, $field = null) {
        if (empty($value)) {
            return '';
        }
        if (is_array($value)) {
            if (empty($value[$field])) {
                return '';
            }
            return $value[$field];
        }
        return $value;
    }
    
}
