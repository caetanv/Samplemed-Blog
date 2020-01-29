<h1> Edit the Topic </h1>

<?php
	echo $this->Form->create('Topic');
	echo $this->Form->input('title');
	if(AuthComponent::user('role') == 1){
		echo $this->Form->input('visible');
	}
	echo $this->Form->end('Edit');
?>