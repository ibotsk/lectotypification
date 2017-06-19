<?php

App::uses('AppController', 'Controller');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login');
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('login', 'logout'))) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function add() {
        $h = new BlowfishPasswordHasher();
        $user['User'] = array(
            'username' => 'kmarhold',
            'password' => $h->hash('marhold:37_K'),
            'permission' => 3,
            'name' => 'Karol Marhold',
            'email' => 'karol.marhold@savba.sk');
        $this->User->save($user);
    }

}
