<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP TypifRefAuthors
 * @author Matus
 */
class TypifRefAuthor extends AppModel {
    
    public $belongsTo = array(
        'TypificationReference' => array(
            'className' => 'TypificationReference',
            'foreignKey' => 'typif_ref_id'
        ),
        'NewAuthor' => array(
            'className' => 'AuthorBhl',
            'foreignKey' => 'local_author_id'
        )
    );
    
}
