<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP TypificationReference
 * @author Matus
 */
class TypificationReference extends AppModel {

    public $actsAs = array('Containable');
    public $hasOne = array(
        'Record' => array(
            'className' => 'Record',
            'foreignKey' => 'typification_ref_id'
        )
    );
    public $hasMany = array(
        'TypifRefAuthor' => array(
            'className' => 'TypifRefAuthor',
            'foreignKey' => 'typif_ref_id',
            'order' => 'TypifRefAuthor.author_order'
        )
    );
    public $belongsTo = array(
        'Publication' => array(
            'className' => 'Publication',
            'foreignKey' => 'publication_id_new'
        )
    );

}
