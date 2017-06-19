<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP Annotations
 * @author Matus
 */
class AnnotationsController extends AppController {

    public $components = array('AnnoSys', 'RemoteRequest', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('view'));
    }

    public function isAuthorized($user) {
        return true;
    }

    public function view($id) {
        if (!$this->request->is('requested')) {
            throw new MethodNotAllowedException(__("Such use of the method is not allowed"));
        }
        $annotations = $this->RemoteRequest->sendQuery(ANNOSYS_BASE_URL . "/services/records/SAV/Lectotypification/$id/annotations"); //json
        return $annotations;
    }

}
