<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UnitsController
 * @author Matus
 */
class RecordsController extends AppController {

    public $uses = array('Record', 'TypificationReference', 'TypifRefAuthor');
    public $helpers = array('Format', 'Utils');
    public $components = array('Input', 'Paginator', 'Utils');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'view'));
    }

    public function isAuthorized($user) {
        // All registered users can add record
        if ($this->action === 'insert') {
            return true;
        }
        // The owner of a record can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $params = $this->request->params;
            $recId = (int) $params['pass'][0];
            if ($this->Record->isOwnedBy($recId, $user['id']) || $user['permission'] == 2) { //record can be edited by its owner and by moderator
                return true;
            }
        }
        if ($this->action === 'approve' && $user['permission'] == 2) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    public function index($filter = '') {
        $params = $this->request->query;
        $uid = $this->Auth->user('id');
        if (empty($uid)) { //public user
            $conditions['Record.approved'] = true;
            $params['approved'] = true;
        } else { //logged user sees his records as default
            //$conditions['Register.username'] = $this->Auth->user('username');
        }
        $conditions = array();
        if (!empty($filter) && !empty($params)) {
            $this->Input->owner($params['owner'], $conditions);
            $this->Input->approved($params['approved'], $conditions);
            $this->Input->name($params['name'], $conditions);
            $this->Input->status($params['status'], $conditions);
        }
        
        $this->Paginator->settings = array(
            'Record' => array(
                'findType' => 'complete',
                'limit' => 3,
                'conditions' => $conditions,
                'order' => array('RecordName.name_std_form', 'Register.inserted')
            )
        );
        $records = $this->Paginator->paginate('Record');
        //$records = $this->Record->find('complete', array('conditions' => $conditions));
        $this->set(compact('records', 'conditions'));
    }

    public function view($id) {
        $record = $this->Record->findCompleteById($id);
        $this->set(compact('record'));
    }

    public function insert() {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['TypificationReference'] = $this->Utils->fixPublicationFields($data['TypificationReference']);
            $db = $this->Record->getDataSource();
            $db->begin();
            $dr = $this->_ie($data);
            if ($dr['success']) {
                $db->commit();
            } else {
                $db->rollback();
            }
            $this->set('data', $dr['data']);
        }
    }

    public function edit($id) {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['TypificationReference'] = $this->Utils->fixPublicationFields($data['TypificationReference']);
            $db = $this->Record->getDataSource();
            $db->begin();
            $dr = $this->_ie($data);
            if ($dr['success']) {
                $db->commit();
            } else {
                $db->rollback();
            }
        }
        $data = $this->Record->findCompleteById($id);
        $this->set(compact('data'));
    }

    public function approve($id) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $this->Record->setApproved($id, $data['approval'], $this->Auth->user('id'));
            $data = $this->Record->findCompleteById($id);
            $this->set(compact('data'));
            $this->render('edit');
        }
    }

    protected function _ie($data) {
        if (empty($data['Record']['id'])) {
            $data['Register']['inserted'] = date('Y-m-d H:i:s');
        } else {
            $data['Register']['updated'] = date('Y-m-d H:i:s');
        }
        if ($data['RecordName']) {
            if ($data['RecordName']['ipni']) {
                $data['RecordName']['ipni_name_id'] = $data['RecordName']['name_id'];
                $data['RecordName']['new_name_id'] = null;
            } else {
                $data['RecordName']['ipni_name_id'] = null;
                $data['RecordName']['new_name_id'] = $data['RecordName']['name_id'];
            }
        }
        $lat_array = $this->Utils->coord($data['Locality']['latitude']);
        $lon_array = $this->Utils->coord($data['Locality']['longitude'], false);
        $data['Locality'] = Hash::merge($data['Locality'], $lat_array, $lon_array);
        $data['Locality']['latitude'] = $this->Utils->dmsToDec($lat_array['lat_degrees'], $lat_array['lat_minutes'], $lat_array['lat_seconds'], $lat_array['north_or_south']);
        $data['Locality']['longitude'] = $this->Utils->dmsToDec($lat_array['lon_degrees'], $lat_array['lon_minutes'], $lat_array['lon_seconds'], $lat_array['east_or_west']);
        $data['Register']['user_id'] = $this->Auth->user('id');
        $success = $this->Record->saveAll($data);
        $refid = $this->TypificationReference->id;
        //$typifRefAuthors = $data['TypificationReference']['TypifRefAuthor'];
        //$r = Set::insert($typifRefAuthors, '{n}.typif_ref_id', $refid);

        if ($data['TypificationReference']['ipni']) {
            $data['TypificationReference']['publication_id_ipni'] = $data['TypificationReference']['publication_id'];
            $data['TypificationReference']['publication_id_new'] = null;
        } else {
            $data['TypificationReference']['publication_id_ipni'] = null;
            $data['TypificationReference']['publication_id_new'] = $data['TypificationReference']['publication_id'];
        }
        
        if (Hash::check($data, 'TypificationReference.TypifRefAuthor')) {
            //modify lists of updated authors and persisted authors so they can be compared
            $authors = empty($data['TypificationReference']['TypifRefAuthor']) ? array() : $data['TypificationReference']['TypifRefAuthor']; //updated authors
            $this->TypifRefAuthor->unbindModel(array('belongsTo' => array('TypificationReference', 'NewAuthor')));
            $current_authors = Hash::extract($this->TypifRefAuthor->findAllByTypifRefId($refid), '{n}.TypifRefAuthor'); //persisted authors, these two list can differ when updated
            $diff = $this->Utils->diff($current_authors, $authors); //checks for ids already persisted, those will not be updated. If an author is removed and added again, removed record is deleted and new record is inserted
            foreach ($diff as $diff_id) {
                $success = $success && $this->TypifRefAuthor->delete($diff_id); //delete authors associations that are no longer associated with current paper
            }
            //update author order
            for ($i = 0; $i < count($authors); $i++) {
                $a = &$authors[$i];
                if (empty($a['typif_ref_id'])) {
                    $a['typif_ref_id'] = $refid;
                }
                $a['author_order'] = $i + 1;
            }
            $success = $success && $this->TypifRefAuthor->saveMany($authors); //persist
        }
        return array('success' => $success, 'data' => $data);
    }

}
