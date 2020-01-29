<h1> Create a new Topic </h1>

<?php
	echo $this->Form->create('Topic');
	echo $this->Form->input('title');
	echo $this->Form->input('visible');
	echo $this->Form->end('Save');
?>