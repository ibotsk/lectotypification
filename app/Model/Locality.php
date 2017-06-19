<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Locality
 * @author Matus
 */
class Locality extends AppModel {
    
    public $hasOne = array(
        'Record' => array(
            'className' => 'Record',
            'foreignKey' => 'locality_id'
        )
    );
    
}
