

<style>
    .error-message{
        color: #a40303;
        position: absolute;
        top: 260px;
    }

    @media only screen and (min-device-width : 220px) and (max-device-width : 500px) {
        .error-message{
            color: #a40303;
            position: absolute;
            top: 280px!important;
        }
    }

</style>


<div class="login_form">

    <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'activep'), 'name' => 'form')); ?>



    <div style="color: #a40303"><?php echo $this->Session->flash(); ?></div>

    <li> 
        <a class=" iconn"></a>
        <?php
        echo $this->Form->input('password', array('onFocus' => "if(this.value=='Password')this.value=''", 'required' => 'required', 'placeholder' => ' নতুন পাসওয়ার্ড দিন', 'div' => false, 'label' => false));
        ?>
    </li>

    <li> 
        <a class=" iconn"></a>
        <?php
        echo $this->Form->input('cpassword', array('type' => 'password', 'onFocus' => "if(this.value=='Password')this.value=''", 'required' => 'required', 'placeholder' => ' পুনরায় নতুন পাসওয়ার্ড দিন', 'div' => false, 'label' => false));
        ?>


    </li>

    <div class="fp">

        <?php echo $this->Html->link(__('লগিনের জন্য ফিরে আসুন'), array('controller' => 'users', 'action' => 'login'), array('class' => '', 'escape' => false)); ?> 

    </div>

    <?php
    if (!isset($ident)) {
        $ident = '';
    }
    if (!isset($activate)) {
        $activate = '';
    }
    ?>
    <?php echo $this->Form->hidden('ident', array('value' => $ident)) ?>
    <?php echo $this->Form->hidden('activate', array('value' => $activate)) ?>

    <div class="p-container">

        <input type="submit" onclick="myFunction()" value="পরিবর্তন করুন" style="color:#fff; background:#17538e;" >
        <div class="clear"> </div>
    </div> 
</div>
<?php echo $this->Form->end(); ?>














