<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP AuthorBhl
 * @author Matus
 */
class AuthorBhl extends AppModel {

    public $useTable = 'author_bhl';
    
    public $hasMany = array(
        'TypifRefAuthors' => array(
            'className' => 'TypifRefAuthor',
            'foreignKey' => 'local_author_id'
        )
    );

}
