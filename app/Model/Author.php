<?php

App::uses('AppModel', 'Model');

class Author extends AppModel {

    public $hasMany = array(
        /*'TypifRefAuthors' => [
            'className' => 'TypifRefAuthor',
            'foreignKey' => 'new_author_id'
        ],*/
        'LosAuthors' => array(
            'className' => 'ListOfSpeciesAuthor',
            'foreignKey' => 'local_author_id'
        )
    );
    
}
