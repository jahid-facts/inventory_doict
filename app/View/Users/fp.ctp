<div class="login_form">

    <?php echo $this->Form->create('User', array('id' => 'username')); ?>


    <div style="color: #a40303"><?php echo $this->Session->flash(); ?></div>

    <br><br>
    <li> 
        <a class=" icon"></a>
        <?php
        echo $this->Form->input('email', array('onFocus' => "if(this.value=='Email')this.value=''", 'placeholder' => ' ই-মেইল', 'required' => 'required', 'div' => false,'class'=>'form-control','label' => false));
        ?>
    </li>

    <div class="fp">
        <?php echo $this->Html->link(__('লগিনের জন্য ফিরে আসুন'), array('controller' => 'users', 'action' => 'login'), array('class' => '', 'escape' => false)); ?> 

    </div>

    <div class="p-container">

        <input type="submit" onclick="myFunction()" value="পাঠান" style="color:#fff; background:#17538e;" >
        <div class="clear"> </div>
    </div> 
</div>
<?php echo $this->Form->end(); ?>