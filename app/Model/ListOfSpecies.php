<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP ListOfSpecies
 * @author Matus
 */
class ListOfSpecies extends AppModel {
    
    public $useTable = 'list_of_species';
    public $actsAs = array('Containable');
    
    public $hasMany = array(
        'RecordNames' => array(
            'className' => 'RecordName',
            'foreignKey' => 'new_name_id'
        ),
        'LosAuthors' => array(
            'className' => 'ListOfSpeciesAuthor',
            'foreignKey' => 'new_author_id'
        )
    );
    
}
