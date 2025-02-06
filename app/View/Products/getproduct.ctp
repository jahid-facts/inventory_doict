

<?php
	echo $this->Form->input('Report.id',array('class'=>'form-control',
	'type'=>'select','options'=>$products,'empty' => array('-1'=> '--Product--'),'label'=>false,'id'=>'products')); 
?>
