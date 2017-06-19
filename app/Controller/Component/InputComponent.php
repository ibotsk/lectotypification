<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP InputComponent
 * @author Matus
 */
class InputComponent extends Component {

    public $components = array('Auth');

    public function owner($inputValue, &$conditions) {
        if ($inputValue === 'mine') {
            $conditions['Register.username'] = $this->Auth->user('username');
        } else if ($inputValue === 'notmine') {
            $conditions['Register.username !='] = $this->Auth->user('username');
        }
        //return $conditions;
    }

    public function approved($inputValue, &$conditions) {
        if ($inputValue === 'yes') {
            $conditions['Record.approved'] = true;
        } else if ($inputValue === 'no') {
            $conditions['Record.approved'] = false;
        }
        //return $conditions;
    }

    public function name($inputValue, &$conditions) {
        $conditions['RecordName.name_std_form LIKE'] = "%$inputValue%";
    }

    public function status($inputValue, &$conditions) {
        if ($inputValue != 'A') {
            $conditions['Record.type'] = $inputValue;
        } else {
            $conditions['Record.type LIKE'] = "_";
        }
    }

}
