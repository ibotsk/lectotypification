<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP AuthorsBhlController
 * @author Matus
 */
class AuthorsbhlController extends AppController {

    public $uses = array('AuthorBhl');
    public $components = array('RequestHandler');
    
    public function isAuthorized($user) {
        return true;
    }
    
    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid author'));
        }
        $this->AuthorBhl->unbindModel(array('hasMany' => array('TypifRefAuthors')));
        $author = $this->AuthorBhl->findById($id);
        if (!$author) {
            throw new NotFoundException(__('Invalid author'));
        }
        $this->set(compact('author'));
    }
    
    public function insert() {
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $this->AuthorBhl->save($data);
            $id = $this->AuthorBhl->id;
            $this->set(compact('data', 'id'));
        }
    }

}
