
<?php App::import('Controller', 'Users'); ?>
<h1 class='post-title'><?php echo $topic['Topic']['title']; ?></h1>


<?php echo $this->HTML->image('create-post-icon.png', ['title' => 'Create a new Post', 'class'=>'icon-png icon-large', 'url' => ['controller' => 'posts', 'action' => 'add', $topic['Topic']['id']]]); ?>


<br>
<table>
<?php 
	foreach($topic['Post'] as $post){
		$userscontroller = new UsersController;
		$uname = $userscontroller->getUserNameById($post['user_id']);



		echo "<div class='post'>".

		"<div class='right'><div class='edit'>".


		$this->HTML->image('edit-icon.png', ['title' => 'Edit', 'class'=>'icon-png', 'url' => ['controller' => 'posts', 'action' => 'edit/'.$post['id']]]).


		"</div>";

		if(AuthComponent::user('id') == $post['user_id'] || AuthComponent::user('role') == 1){

		

		echo "<div class='delete'>".


		$this->Form->postLink($this->HTML->image('delete-icon.png', ['title' => 'Delete', 'class'=>'icon-png']), array('controller' => 'posts', 'action' => 'delete', $post['id']), array('confirm' => 'Are you sure you want to delete this post?', 'escape'=>false)).


		"</div>";


		}
		
		echo "</div><div class='username'>".
		$uname['User']['username'].
		"</div>".

		"<div class='body'>".
		$post['body'].
		"</div>".

		"<div class='created'>Criado em: ".
		$post['created'].
		"</div>".

		"<div class='modified'>Modificado em: ".
		$post['modified'].
		"</div>".

		

		"</div>";

	}

?>
</table>