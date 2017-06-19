<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP ServicesController
 * @author Matus
 */
class ServicesController extends AppController {

    public $components = array('Biocase', 'RemoteRequest');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('record'));
    }
    
    public function isAuthorized($user) {
        return true; //public services
    }
    
    public function record($id, $schema) {
        if (!$id) {
            throw new InvalidArgumentException(__("Ivalid argument id"));
        }
        if (!$schema) {
            throw new InvalidArgumentException(__("Ivalid argument schema"));
        }
        switch ($schema){
            case 'abcd2.06':
                $this->response->type('xml');
                $req_string = $this->Biocase->buildAbcd206Query($id);
                $params = array('dsa' => 'lectotypification', 'query' => $req_string);
                $url = 'http://dataflos.sav.sk:8080/biocase/pywrapper.cgi';
                break;
            default:
                break;
        }
        $result = $this->RemoteRequest->sendQuery($url, $params);
        $this->set(compact('result'));
        $this->layout = 'xml/default';
    }

}
