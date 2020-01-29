<?php

class PostsController extends AppController {
	public $components = array('Session','Paginator');

    // add post
	public function add($id = null){
		if($this->request->is('post')){
    		$this->Post->create();
    		$this->request->data['Post']['topic_id'] = $id;
            $this->request->data['Post']['created'] = getdate();
            $this->request->data['Post']['modified'] = getdate();
    		$this->request->data['Post']['user_id'] = AuthComponent::user('id');
    		if($this->Post->save($this->request->data)){
    			$this->Flash->success(__('The post has sucessfully created.'));
    			$this->redirect('/topics/view/'.$id);
    		}
    	}
    	$this->set('topics', $this->Post->Topic->find('list'));
	}

    // view post by id
	public function view($id){
		$data = $this->Post->findById($id);
		$this->set('post', $data);
	}

    // all posts
	public function index(){
		$data = $this->Post->find('all',[ 'order'=>'Topic.id DESC']);
		$this->set('posts', $data);
	}

    // edit posts by id
    public function edit($id) {
    	$data = $this->Post->findById($id);
        $this->request->data['Post']['modified'] = getdate();
    	if($this->request->is(array('post','put'))){
    		$this->Post->id = $id;
    		if($this->Post->save($this->request->data)){
    			$this->request->data['Post']['user_id'] = AuthComponent::user('id');
    			$this->Flash->success(__('The post has sucessfully edited.'));
    			$this->redirect('/topics/view/'.$data['Post']['topic_id']);
    		}
		}	

		$this->request->data = $data;

    }

    // delete a post by id
    public function delete($id){
    	$this->Post->id = $id;
    	$data = $this->Post->findById($id);

    	if($this->request->is(array('post','put'))){
    		if($this->Post->delete()){
    			$this->Flash->success(__('The post has sucessfully deleted.'));
    			$this->redirect('/topics/view/'.$data['Post']['topic_id']);
    		}
		}	
    }

}

?>