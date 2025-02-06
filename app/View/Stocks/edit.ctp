<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
?>
<style type="text/css">
  .pr {
    padding-right: 30px;
  }
  .pl {
    padding-left: 30px;
  }
  .form-control-feedback {
      margin-top: 26px;
      right: 5px;
      width: auto;
      height: 30px;
      background-color: #FFF;
  }
  .glyphicon-ok {
      color: #3C763D;
  }
  .glyphicon-remove {
      color: #A94442;
  }
  option:disabled{ 
    display: none!important;
  }
</style> 
<script> 
  $(function() { 
    $("#datepicker").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
          changeYear: true,
          yearRange:"-100:+50"
    }); 
  });  
</script> 

<?php
$products=array();
foreach ($prod as $product){
                            
            $description=$product['SubCategory']['name'];
                            
            $description.=' - '.$product['Product']['name'];

            
            if(!empty($product['Brand']['name'])){
                $description.=' - '.$product['Brand']['name'];
            }
            if(!empty($product['Color']['name'])){
                $description.=' - '.$product['Color']['name'];
            }
            if(!empty($stock['Size']['name'])){
                $description.=' - '.$product['Size']['name'];
            }

            $products[$product['Product']['id']]=$description;
      }

?>

<div style="height: 25px;"></div>
<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <b><?php echo __('Add Opening Stock'); ?></b> </h3>
        </div>
        <div class="panel-body">
          <?php 
            echo $this->Form->create('Stock',array('class'=>'form-horizontal'));
            echo $this->Form->input('id');
            echo $this->Form->input('district_id',array('type'=>'hidden','class'=>'form-control','label'=>false, 'value'=>$currentUser['district_id']));  
          ?> 
          <script>
            function codeVerify(value){
              var path='<?php echo $this->webroot;?>';
              var userDid = '<?php echo $currentUser['district_id']; ?>';
              var exitid = '<?php echo $this->request->data['Stock']['product_id']; ?>';
              $.ajax({
                  type: 'POST',
                  url: path +'stocks/stockpcheck',
                  data: {id:value,disid:userDid},
                  success: function(data){
                    $("#message").html(data); 
                    if(data=="<span class='glyphicon glyphicon-remove form-control-feedback'></span>"){ 
                      if(exitid==value){
                        document.getElementById("myBtn").disabled = false;
                        $("#message").hide();
                      }else{
                        document.getElementById("myBtn").disabled = true;
                        $("#message").show();
                      } 
                    }else{
                      document.getElementById("myBtn").disabled = false;
                      $("#message").show();
                    }       
                  }
              });
            } 
          </script>
          <div class="col-sm-6">
            <div class="form-group pr" > 
                <label>Stock Date</label> 
                <?php echo $this->Form->input ('ddate', array ('type'=>'text','id'=>'datepicker','class'=>'form-input-text form-control','label'=>false) );?> 
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group pl" > 
                <label>Product Name</label> 
              <?php echo $this->Form->input('product_id',array('class'=>'form-control','empty'=>'Select','label'=>false,'options'=>$products,'onchange'=>'codeVerify(this.value);','disabled' =>$stocks));?> 
                <span id="message"></span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group pr" > 
                <label>Quantity</label> 
                <?php echo $this->Form->input('quantity',array('class'=>'form-control','label'=>false));?> 
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group pl" > 
                <label>Price</label>   
                <?php echo $this->Form->input('price',array('class'=>'form-control','label'=>false));?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group pr" > 
                <label>Measure</label>   
                <?php echo $this->Form->input('measure_id',array('class'=>'form-control','label'=>false));?>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group pl" > 
                <label>Status</label> 
                <div id="volunter"></div>
                <?php echo $this->Form->input('status',array('class'=>'form-control','label'=>false,'options'=>array('1'=>'Active','2'=>'Inactive'),'type'=>'select'));?> 
            </div>
          </div>
          <div class="col-sm-12 text-center">
            <button id="myBtn" type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>