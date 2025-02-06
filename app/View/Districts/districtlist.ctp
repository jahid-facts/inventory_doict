<style type="text/css">
	option:disabled{ 
	    display: none!important;
	}
</style>
<?php
	if (!empty($superDistrict)) {
		echo $this->Form->input("$modelname.district_id",array('onChange'=>'getSubvName(this.value);','type'=>'select','options'=>$districts,'class'=>'form-control district_option','label'=>false,'empty'=>'Select District','required'=>true,'disabled'=>$superDistrict));
	}else{
   		echo $this->Form->input("$modelname.district_id",array('onChange'=>'getSubvName(this.value);','type'=>'select','options'=>$districts,'class'=>'form-control district_option','label'=>false,'empty'=>'Select District','required'=>true));	
   	}
?>
