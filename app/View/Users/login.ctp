<div class="login_form">
	<?php echo $this->Form->create('User',array('id'=>'username'));?> 
    <?php echo $this->Session->flash(); ?><br><br>
    <li> 
    	<label class="icon" for="UserUsername"></label>
        <?php
            echo $this->Form->input('username',array('onFocus'=>"if(this.value=='Username')this.value=''", 'placeholder'=>' ব্যবহারকারী নাম ','required'=>'required','div'=>false,'label'=>false,'class'=>'form-control','autocomplete'=>'off'));
		?>
	</li>
	<li>
		<label class="iconn" for="UserPassword"></label> 
		<?php
			echo $this->Form->input('password',array('onFocus'=>"if(this.value=='Password')this.value=''",'required'=>'required','placeholder'=>' পাসওয়ার্ড ','div'=>false,'label'=>false,'class'=>'form-control','autocomplete'=>'off'));
		?>						
	</li>
	<div class="fp">
		<?php echo $this->Html->link(__('পাসওয়ার্ড ভুলে গেছেন ?'), array('controller' => 'users','action' => 'fp'),array('escape'=>false)); ?> 
	</div>
	
	<div class="p-container">
				 
		<input type="submit" onclick="myFunction()" value="প্রবেশ" style="color:#fff; background:#17538e;" >
		<div class="clear"> </div>
	</div> 
</div>
<?php echo $this->Form->end();?>