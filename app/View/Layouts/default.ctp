<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Samplemed Blog');
$cakeVersion = __d('cake_dev', 'Cake %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('style.vitor');
		$username = AuthComponent::user('username')?AuthComponent::user('username'):'guest';
		$userid = AuthComponent::user('id');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://www.samplemedblog.com.br'); ?></h1>
			<h2>Underwriting and health intelligence</h2>
			<?php 
			$other =  AuthComponent::user('id')>0?'Regular':'Visitor';
			$role = (AuthComponent::user('role') == 1)? 'Admin' : $other ?>
			<div><?php echo "Welcome ".$username.". You are logged like a ".$role." account.";
			
			if($userid>0){
				echo " Your UserID are: ".$userid ;
			}

			?>
				
			</div>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<p>
				<div class='foot-label'>Samplemed Blog created by Vitor in <?php echo $cakeVersion; ?></div>
			</p>
		</div>
	</div>
</body>
</html>
