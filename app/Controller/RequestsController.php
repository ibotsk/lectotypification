<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP RequestsController
 * @author Matus
 */
class RequestsController extends AppController {

    public $uses = array('Author', 'AuthorBhl', 'ListOfSpecies', 'Publication');
    public $components = array('IpniDelimited', 'RemoteRequest', 'RequestHandler');
    public $helpers = array('Format');

    public function isAuthorized($user) {
        return true;
    }

    /**
     * Requests IPNI url for full title of publication
     */
    public function publication() {
        if ($this->request->is('ajax')) {
            $data = $this->request->query;
            $term = $data['term'];
            
            $this->Publication->unbindModel(array('hasMany' => 'TypificationReference'));
            $local = $this->Publication->find('all', array(
                'fields' => array('id as value', 'title as label', 'abbreviation as desc'),
                'conditions' => array('OR' => array('title LIKE' => '%' . $term . '%', 'abbreviation LIKE' => '%' . $term . '%'))
            ));
            
            $response = $this->RemoteRequest->sendQuery('http://www.ipni.org/ipni/advPublicationSearch.do', array('find_title' => $term, 'output_format' => 'delimited'));
//            $params = array('find_title' => $term, 'output_format' => 'delimited');
//            $query = http_build_query($params);
//            $curl = curl_init('http://www.ipni.org/ipni/advPublicationSearch.do?' . $query);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            $response = curl_exec($curl);

            $remote = array();
            if ($response !== false) {
                $remote = $this->IpniDelimited->resultsToArray($response);
            }
            $this->set(compact('local', 'remote'));
        }
    }

    /**
     * Taxon authors from IPNI
     */
    public function authors() {
        if ($this->request->is('ajax')) {
            $data = $this->request->query;
            $term = $data['term'];

            //search in local database first (takes shorter time)
            $this->Author->unbindModel(array('hasMany' => array('TypifRefAuthors', 'LosAuthors')));
            $local = $this->Author->find('all', array(
                'fields' => array('id as value', 'standard_form as label', 'dates as desc'),
                'conditions' => array('standard_form LIKE' => '%' . $term . '%')
            ));

            //search in ipni
            $response = $this->RemoteRequest->sendQuery('http://www.ipni.org/ipni/advAuthorSearch.do', array('find_surname' => $term . '*', 'output_format' => 'delimited-classic'));
//            $params = array('find_surname' => $term . '*', 'output_format' => 'delimited-classic');
//            $query = http_build_query($params);
//            $curl = curl_init('http://www.ipni.org/ipni/advAuthorSearch.do?' . $query);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            $response = curl_exec($curl);

            $remote = array();
            if ($response !== false) {
                $remote = $this->IpniDelimited->resultsToArray($response);;
            }
            $this->set(compact('local', 'remote'));
        }
    }

    /**
     * Publication authors from BHL
     */
    public function authorsbhl() {
        if ($this->request->is('ajax')) {
            //$this->autoRender = false;
            $data = $this->request->query;
            $term = $data['term'];

            //search in local database first (takes shorter time)
            $this->AuthorBhl->unbindModel(array('hasMany' => array('TypifRefAuthors')));
            $local = $this->AuthorBhl->find('all', array(
                'fields' => array('id as value', 'name as label', 'dates as desc'),
                'conditions' => array('name LIKE' => '%' . $term . '%')
            ));
            
            //search in BHL
            $response = $this->RemoteRequest->sendQuery('http://www.biodiversitylibrary.org/api2/httpquery.ashx', array('op' => 'AuthorSearch', 'name' => $term, 'apikey' => '62aa1760-9065-42e1-9382-70e136027989', 'format' => 'json'));
//            $params = array('op' => 'AuthorSearch', 'name' => $term, 'apikey' => '62aa1760-9065-42e1-9382-70e136027989', 'format' => 'json');
//            $query = http_build_query($params);
//            $curl = curl_init('http://www.biodiversitylibrary.org/api2/httpquery.ashx?' . $query);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            $response = curl_exec($curl);

            $remote = array();
            if ($response !== false) {
                $remote = $response;
            }
            
            $this->set(compact('local', 'remote'));
        }
    }

    public function taxons() {
        if ($this->request->is('ajax')) {
            //$this->autoRender = false;
            $data = $this->request->query;
            $term = $data['term'];
            
            $this->ListOfSpecies->unbindModel(array('hasMany' => array('RecordNames', 'LosAuthors')));
            $st = '%' . strtolower($term) . '%'; //search term
            $local = $this->ListOfSpecies->find('all', array(
                'conditions' => array('OR' => array('genus LIKE' => $st, 'species LIKE' => $st, 'infra_species LIKE' => $st))
            ));
            
            $response = $this->RemoteRequest->sendQuery('http://www.ipni.org/ipni/simplePlantNameSearch.do', array('find_wholeName' => $term . '*', 'output_format' => 'delimited-short'));
//            $params = array('find_wholeName' => $term . '*', 'output_format' => 'delimited-short');
//            $query = http_build_query($params);
//            $curl = curl_init('http://www.ipni.org/ipni/simplePlantNameSearch.do?' . $query);
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//            $response = curl_exec($curl);

            $remote = array();
            if ($response !== false) {
                $remote = $this->IpniDelimited->resultsToArray($response);
            }
            $this->set(compact('local', 'remote'));
        }
    }

}
