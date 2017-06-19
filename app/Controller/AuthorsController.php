<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP AuthorsController
 * @author Matus
 */
class AuthorsController extends AppController {

    public $uses = array('Author');
    public $components = array('RequestHandler');
    
    public function isAuthorized($user) {
        return true;
    }
    
    
    public function insert() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $this->Author->save($data);
            $id = $this->Author->id;
            $this->set(compact('data', 'id'));
            echo json_encode(array('id' => $id /*$this->Author->id*/, 'std_name' => $data['Author']['standard_form'])); //$data['Author']['standard_form']
        }
    }

}
