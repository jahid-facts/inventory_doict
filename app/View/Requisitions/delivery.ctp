
<?php

//$stocks=$this->request->data['Requisitiondetail'];

$data=$this->request->data;

?>
<style>
    .panel-title{
            font-family: inherit;
            font-size: 16px; 
            font-weight: bold;
        }
    .thla th {
        color: #0088cc;
        text-align: center!important;
    }
    .my-padding-0 td {
        text-align: left!important;
    }
</style>
<?php echo $this->Form->create('Delivery',array('class'=>'form-horizontal','url'=>array('controller'=>'deliveries','action'=>'add'))); ?>
 
<div class="payments form">

 <?php echo $this->Form->input('id');?>
     <?php echo $this->Form->input("Delivery.requisition_id",array('type'=>'hidden','value'=>$data['Requisition']['id'])); ?>    
                    
    <div class="panel panel-primary" style="margin-top:20px;">   
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php echo __('Requisition Delivery'); ?>
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-8 col-sm-offset-2">
                <h5 colspan="2" style="text-align: right;"><b><?php echo date("d-m-Y");?></b></h5>
                <table class="table table-bordered my-padding-0">
                    <tr>
                        
                    </tr>
                    <tr>
                        <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner:</td>
                        <td><?php echo $data['User']['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Designation </td>
                        <td><?php echo h($designations[$data['User']['designation_id']]); ?></td>
                    </tr>
                    <tr>
                        <td>Department </td>
                        <td><?php echo h($departments[$data['User']['department_id']]); ?></td>
                    </tr>
                    <tr>
                        <td>Phone </td>
                        <td><?php echo h($data['User']['mobile']); ?></td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td><?php echo h($data['User']['email']); ?></td>
                    </tr>
                    <tr>
                        <td>Delivery location </td>
                        <td><?php echo h($data['Requisition']['location']); ?></td>
                    </tr>
                </table>
            
        
                <table class="table table-striped table-bordered table-hover cntr thla">
                    <thead>
                        <tr>
                            <th colspan="5">Product</th> 
                        </tr>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Purpose</th> 
                        </tr>
                    </thead>                                         
                    <tbody>
                        <?php 

                        $i=0;
                        foreach ($stocks as $stock) {  
                            $description=$stock['SubCategory']['name'].' - '.$products[$stock['Requisitiondetail']['product_id']]; 
                            $pdcodes=$stock['Category']['cCode'].$stock['SubCategory']['sCode'].$stock['Products']['productcode'];
                            
                            if(!empty($stock['Brand']['name'])){
                                $description.=' - '.'<span title="Model" style="cursor:pointer">'.$stock['Brand']['name'].'</span>';
                            }
                            if(!empty($stock['Size']['name'])){
                                $description.=' - '.'<span title="Size" style="cursor:pointer">'.$stock['Size']['name'].'</span>';
                            }
                            if(!empty($stock['Color']['name'])){
                                $description.=' - '.'<span title="Color" style="cursor:pointer">'.$stock['Color']['name'].'</span>';
                            }
                        ?>
                                    
                        <tr>
                            <td><?php echo $stock['Products']['finalcode']?></td>
                            <td>
                                <?php
                                   echo $this->Form->input("Deliverydetail.$i.r_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','default'=>$stock['Requisitiondetail']['id']));

                                 echo $this->Form->input("Deliverydetail.$i.product_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','default'=>$stock['Requisitiondetail']['product_id']));


                                 ?>

                                <?php echo $description;?>
                            </td>
                            <td>
                                <?php echo $this->Form->input("Deliverydetail.$i.quantity",array('class'=>'form-horizontal','label'=>false,'value'=>$stock['Requisitiondetail']['quantity'],'type'=>'hidden')); ?>
                                <?php echo $stock['Requisitiondetail']['quantity'];?>
                            </td>
                            <td>
                                <?php echo $this->Form->input("Deliverydetail.$i.measure_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','value'=>$stock['Requisitiondetail']['measure_id'])); ?>
                                            <?php echo $measures[$stock['Requisitiondetail']['measure_id']];?>
                            </td>
                          
                                 
                          
                            <td>
                                <?php echo $this->Form->input("Deliverydetail.$i.purpose",array('class'=>'form-control','type'=>'hidden','label'=>false));?>
                                           <?php echo $stock['Requisitiondetail']['purpose'];?>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <?php echo $this->Form->input("requisitionId",array('type'=>'hidden','value'=>$stock['Requisitiondetail']['requisition_id']));?>
                           
                <div class="col-sm-12 text-center">  
                    <button type="button" class="btn btn-default" onclick="confirmation()" style="background-color:#428BCA;color:white;">Delivery Now</button>  
                </div>
            </div>
        </div>
    </div> 
</div>
<script>
function confirmation(){
         var name = $.trim($('#log').val());

            // Check if empty of not
            if (name  =='-1') {
                alert('Please Select Head');
                return false;
            }
        
        var cond = confirm("Are you sure that you want to deliver this items");
        if(cond == true){
            $('#DeliveryDeliveryForm').submit();
        }else{
        }
    }
</script>