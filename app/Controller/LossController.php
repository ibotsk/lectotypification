<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP LossController
 * @author Matus
 */
class LossController extends AppController {

    public $uses = array('ListOfSpecies');
    public $helpers = array('Format');
    public $components = array('RequestHandler');
    
    public function isAuthorized($user) {
        return true;
    }
    
    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid taxon name'));
        }
        $this->ListOfSpecies->unbindModel(array('hasMany' => array('RecordNames', 'LosAuthors')));
        $los = $this->ListOfSpecies->findById($id);
        if (!$los) {
            throw new NotFoundException(__('Invalid taxon name'));
        }
        $this->set(compact('los'));
    }

    public function insert() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $this->ListOfSpecies->save($data);
            $id = $this->ListOfSpecies->id;
            $this->set(compact('data', 'id'));
        }
    }

}
