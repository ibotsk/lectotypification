<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP UnitNames
 * @author Matus
 */
class RecordName extends AppModel {
    
    public $actsAs = array('Containable');
    
    public $belongsTo = array(
        'ListOfSpecies' => array(
            'className' => 'ListOfSpecies',
            'foreignKey' => 'new_name_id'
        )
    );
    
    public $hasOne = array(
        'Record' => array(
            'className' => 'Record',
            'foreignKey' => 'taxon_name_id'
        )
    );
    
}
