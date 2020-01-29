<h1>Topics</h1>

<?php

if(AuthComponent::user()){
	echo $this->HTML->image('create-topic-icon.png', ['title' => 'Create a new Topic', 'class'=>'icon-png icon-large', 'url' => ['controller' => 'topics', 'action' => 'add']]).
	 "<div class='right'>".
	 $this->HTML->image('profile-icon.png', ['title' => 'Edit Profile', 'class'=>'icon-png icon-large', 'url' => ['controller' => 'users', 'action' => 'edit', AuthComponent::user('id')]]).
	 $this->HTML->image('logout-icon.png', ['title' => 'Logout', 'class'=>'icon-png icon-large', 'url' => ['controller' => 'users', 'action' => 'logout']])
	. "</div>";
}else{
	echo '<br><b>To view all or to create a topic you need to be logged.</b><br>'.
	 $this->HTML->link('Login', array('controller' => 'users', 'action' => 'login'), ['class'=>'btn btn-primary']).' or '. 
	$this->Html->link('Register', array('controller' => 'users', 'action' => 'add'), ['class'=>'btn btn-primary']);
}


?>

<?php 

foreach($topics as $topic) {

		$published = $topic['Topic']['visible'] == 1? 'Published':'Waiting Approve';


		if($topic['Topic']['visible'] == 1 || AuthComponent::user('role') == 1){

		
		echo "<div class='topic'>";

			if(AuthComponent::user()){

				echo "<div class='right'>";

					if(AuthComponent::user('id') == $topic['Topic']['user_id'] || AuthComponent::user('role') == 1){

						echo "<div class='edit'>".

						$this->HTML->image('edit-icon.png', ['title' => 'Edit', 'class'=>'icon-png', 'url' => ['controller' => 'topics', 'action' => 'edit/'.
						$topic['Topic']['id']]]).

						"</div>";
					}

					if(AuthComponent::user('id') == $topic['Topic']['user_id'] || AuthComponent::user('role') == 1){	

						

						echo "<div class='delete'>".


						$this->Form->postLink($this->HTML->image('delete-icon.png', ['title' => 'Delete', 'class'=>'icon-png']), array('controller' => 'Topics', 'action' => 'delete', $topic['Topic']['id']), array('confirm' => 'Are you sure you want to delete this post?', 'escape'=>false)).


						"</div>";


					}

				echo "</div>";
			}

			echo "<div class='username'>".
			$topic['User']['username'].
			"</div>".

			"<div class='title'>".
			$this->HTML->link($topic['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $topic['Topic']['id'])).
			"</div>".

			"<div class='visible'>".
			$published.

			"</div>".

			"<div class='created'>Criado em: ".
			$topic['Topic']['created'].
			"</div>".

			"<div class='modified'>Modificado em: ".
			$topic['Topic']['modified'].
			"</div>".

		

		"</div>";
		}

	}

?>



