<?php

App::uses('AppModel', 'Model');

class Record extends AppModel {

    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Locality' => array(
            'className' => 'Locality',
            'foreignKey' => 'locality_id'
        ),
        'RecordName' => array(
            'className' => 'RecordNames',
            'foreignKey' => 'taxon_name_id'
        ),
        'TypificationReference' => array(
            'className' => 'TypificationReference',
            'foreignKey' => 'typification_ref_id'
        )
    );
    public $hasOne = array(
        'Register' => array(
            'className' => 'Register',
            'foreignKey' => 'record_id'
        )
    );
    public $findMethods = array('approved' => true, 'complete' => true);

    protected function _findApproved($state, $query, $results = array()) {
        if ($state === 'before') {
            $query['conditions']['Record.approved'] = true;
            return $query;
        }
        return $results;
    }

    protected function _findComplete($state, $query, $results = array()) {
        if ($state === 'before') {
            $query['joins'] = array(
                array(
                    'table' => 'list_of_species',
                    'alias' => 'ListOfSpecies',
                    'type' => 'LEFT',
                    'conditions' => array('RecordName.new_name_id' => 'ListOfSpecies.id')
            ));
            $query['fields'] = array('Record.*', 'TypificationReference.*', 'Locality.*', 'RecordName.*', 'ListOfSpecies.*', 'Register.*');
            $query['contain'] = array(
                'TypificationReference' => array('TypifRefAuthor'),
                'Locality',
                'RecordName',
                'Register'
            );
            return $query;
        }
        return $results;
    }

    public function isOwnedBy($record, $user) {
        return $this->Register->field('id', array('record_id' => $record, 'user_id' => $user)) !== false;
    }
    
    public function setApproved($record, $approved, $approved_by) {
        $this->id = $record;
        $this->saveField('approved', $approved);
        $this->saveField('approved_by', $approved_by);
    }

}
