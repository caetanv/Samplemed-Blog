<?php
class TopicsController extends AppController {

	public $components = array('Session','Paginator');

	//Principal views
	public function index(){
		$data = $this->Topic->find('all',[ 'order'=>'Topic.id DESC']);
		$this->set('topics', $data);
	}

	//Allow View index
	public function beforeFilter(){
		$this->Auth->allow('index');
	}

	// Add Topic
    public function add() {
    	if($this->request->is('post')){
    		$this->Topic->create();

    		$this->request->data['Topic']['user_id'] = AuthComponent::user('id');
    		$this->request->data['Topic']['created'] = getdate();
    		$this->request->data['Topic']['modified'] = getdate();
    		if(AuthComponent::user('role')!=1){
    			$this->request->data['Topic']['visible'] = 0;
    			$this->Flash->error(__('Your topic need to be aproved by admin to publish.'));
    		}

    		if($this->Topic->save($this->request->data)){
    			$this->Flash->success(__('The topic has sucessfully created.'));
    			$this->redirect('index');
    		}
    	}
    }

    // View Topic
    public function view($id){
    	$data = $this->Topic->findById($id);
    	$this->set('topic',$data);
    }
    
    //Edit Topic
    public function edit($id) {
    	$data = $this->Topic->findById($id);
		$this->request->data['Topic']['modified'] = getdate();
    	if($this->request->is(array('post','put'))){
    		$this->Topic->id = $id;
    		if($this->Topic->save($this->request->data)){
    			$this->request->data['Topic']['user_id'] = AuthComponent::user('id');
    			$this->Flash->success(__('The topic has sucessfully edited.'));
    			$this->redirect('index');
    		}
		}	

		$this->request->data = $data;

    }

    //Delete topic
    public function delete($id){
    	$this->Topic->id = $id;

    	if($this->request->is(array('post','put'))){
    		if($this->Topic->delete()){
    			$this->Flash->success(__('The topic has sucessfully deleted.'));
    			$this->redirect('index');
    		}
		}	
    }
}
?>