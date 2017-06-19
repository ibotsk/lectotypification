<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Publication
 * @author Matus
 */
class Publication extends AppModel {

    public $hasMany = array(
        'TypificationReference' => array(
            'className' => 'TypificationReference',
            'foreignKey' => 'publication_id_new'
        )
    );

}
