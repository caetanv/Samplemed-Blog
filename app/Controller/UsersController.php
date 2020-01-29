<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	// view all users
	public function index() {

		if(AuthComponent::user('role') != 1){
			$this->redirect(array('controller' => 'topics' , 'action' => 'index'));
		}

		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

	//get username 
	public function getUserNameById($id){
		$data = $this->User->findById($id);
		return $data;
	}

	//login function
	public function login(){
		if($this->request->is('post'))
		{
			if($this->Auth->login()){
				return $this->redirect($this->Auth->redirectUrl());
			} else{
				$this->Session->setFlash('Invalid username or password.');
			}
		}
	}

	//logout function
	public function logout(){
		$this->Auth->logout();
		$this->redirect('/topics/index');
	}

	//allow add view
	public function beforeFilter(){
		$this->Auth->allow('add');
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function view($id = null) {

		if(AuthComponent::user('role') != 1){
			$this->redirect(array('controller' => 'topics' , 'action' => 'index'));
		}

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if(AuthComponent::user('role') != 1 && AuthComponent::user('id') != $id){
			$this->redirect(array('controller' => 'topics' , 'action' => 'index'));
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {

		if(AuthComponent::user('role') == 1){
			$this->redirect(array('controller' => 'topics' , 'action' => 'index'));
		}

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
