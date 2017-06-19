<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP ListOfSpeciesAuthors
 * @author Matus
 */
class ListOfSpeciesAuthor extends AppModel {
    
    public $belongsTo = array(
        'ListOfSpecies' => array(
            'className' => 'ListOfSpecies',
            'foreignKey' => 'list_of_species_id'
        ),
        'Authors' => array(
            'className' => 'Author',
            'foreignKey' => 'new_author_id'
        )
    );
    
}
