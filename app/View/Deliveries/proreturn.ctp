
 
<style>
    .thla {
        width: 100%;
    }
    .thla > thead > tr > th { 
        text-align: center!important;
        vertical-align: middle; 
    } 
    .thla > tbody > tr > td:nth-child(1) { 
        text-align: center!important;
        vertical-align: middle; 
        width: 5%;
    }
    .thla > tbody > tr > td:nth-child(2) { 
        text-align: center!important;
        vertical-align: middle; 
        width: 15%;
    }
    .thla > tbody > tr > td:nth-child(3) { 
        text-align: center!important;
        vertical-align: middle;
        width: 35%; 
    }
    .thla > tbody > tr > td:nth-child(4) { 
        text-align: center!important;
        vertical-align: middle; 
        width: 13%;
    }
    .thla > tbody > tr > td:nth-child(5) { 
        text-align: center!important;
        vertical-align: middle; 
        width: 15%;
    }

    .thla > tbody > tr > td:nth-child(5) { 
        text-align: center!important;
        vertical-align: middle; 
        width: 17%;
    }
    .bss {
        width: 60%;
        float: left;
    }
    .bssc {
        width: 40%;
        line-height: 33px;
    }
    .my-padding-0 > tbody > tr > td:nth-child(2) { 
        text-align: left!important;
        vertical-align: middle;  
    }
</style>

<script>
function validValue(id,tval,sval){

    if(sval<tval){

        alert("Please give return quantity within "+ sval);

        $('#etype'+id).val(' ');
    }
}

</script>

    <br><br>
<div class="col-sm-10 col-sm-offset-1">         
    <div class="row">
        <div class="col-lg-12">    
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"> <?php echo __('Product Return'); ?> </h3>
                </div>  
                <div class="panel-body">
                    <!-- My Invoice Start -->
                    <?php echo $this->Form->create('Requisitionreturn',array('type'=>'file','class'=>'form-horizontal')); ?> 
                    <div class="col-xs-8" style="padding-left: 7px;">
                        <table width="100%;" cellpadding="0" cellspacing="0">
                            <td width="30%;">Product Return No.</td>
                            <td width="40%;"><input type="text" name="data[Requisition][dnumber]" value="<?php echo date('Ymdhis');?>" class="form-control m-btm"></td>
                            <td width="30%;"></td>
                        </table> 
                    </div>
                    <div class="col-xs-4 text-right">
                        <b>Date:</b>  <?php echo date("d-m-Y",strtotime($deliveryviews[0]['Delivery']['created'])); ?> 
                    </div>
                    <div style="clear: both; height: 15px;"></div>  
                    <div class="row"> 
                        <div class="col-sm-12">
                            <table class="table table-bordered my-padding-0">
                                <tr>
                                    <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner:</td>
                                    <td><?php echo h($deliveryviews[0]['User']['name']); ?></td>
                                </tr>
                                <tr>
                                    <td>Designation :</td>
                                    <td><?php echo h($deliveryviews[0]['Designation']['name']); ?></td>
                                </tr>
                                <tr>
                                    <td>Department :</td>
                                    <td><?php echo h($deliveryviews[0]['Department']['name']); ?></td>
                                </tr>
                                <tr>
                                    <td>Phone :</td>
                                    <td><?php echo h($deliveryviews[0]['User']['mobile']); ?></td>
                                </tr>
                                <tr>
                                    <td>Email :</td>
                                    <td><?php echo h($deliveryviews[0]['User']['email']); ?></td>
                                </tr>
                                <tr>
                                    <td>Delivery location :</td>
                                    <td><?php echo h($deliveryviews[0]['Requisition']['location']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-12"> 
                            <table class="table table-bordered thla ">
                                <thead>
                                <tr>
                                    <th rowspan="2">S/N</th>
                                    <th colspan="5">Product</th> 
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Returned</th>
                                    <th>Return Now</th>
                                </tr>
                                </thead>                                         
                                <tbody>
                                <?php  
                                    $distid = $currentUser['district_id']; 
                                    $i=1; 
                                    foreach ($deliveryviews as $deliveryview): 
                                    $id=$deliveryview['Deliverydetail']['product_id'];

                                    $did=$deliveryview['Deliverydetail']['id'];

                                    $qss=ClassRegistry::init('Requisitionreturn')->find('first',array('fields'=>array('SUM(quantity) AS quantity'),'recursive'=>-1,'conditions'=>array('Requisitionreturn.did'=>$did,'Requisitionreturn.product_id'=>$id))); 
                                    $qssquantity=0;
                                        if(isset($qss[0]['quantity'])){
                                        $qssquantity=$qss[0]['quantity'];
                                    } 
                                    $sval=$deliveryview['Deliverydetail']['quantity']; 
                                    if($sval>$qssquantity){ 
                                ?>

                                <input name="data[Requisitionreturn][<?php echo $id;?>][product_id]" type="hidden"   value=" <?php echo $id;?>" />
                             
                                <input name="data[Requisitionreturn][<?php echo $id;?>][requisition_id]" type="hidden"   value=" <?php echo $deliveryviews[0]['Requisition']['id'];?>" />

                                <input name="data[Requisitionreturn][<?php echo $id;?>][measure_id]" type="hidden"  id="measure_id0" value=" <?php echo $deliveryview['Deliverydetail']['measure_id'];?>" />

                                <tr>
                                    <td><?php echo  $i++;?></td>
                                    <td><?php echo $deliveryview['Products']['finalcode']; ?>
                                    </td>
                                    <td>
                                        <?php echo $deliveryview['Category']['name'].' - '.$deliveryview['SubCategory']['name'].' - '.$this->Form->input("Deliverydetail.$i.product_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','default'=>$deliveryview['Deliverydetail']['product_id'])); ?> 
                                        <?php echo $products[$deliveryview['Deliverydetail']['product_id']];?>
                                    </td> 
                                    <td>
                                        <?php echo $this->Form->input("Deliverydetail.$i.quantity",array('class'=>'form-horizontal','label'=>false,'value'=>$deliveryview['Deliverydetail']['quantity'],'type'=>'hidden')); ?>
                                        <?php echo $deliveryview['Deliverydetail']['quantity'];?>
                                        <?php echo $measures[$deliveryview['Deliverydetail']['measure_id']];?>
                                    </td>
                                    <td ><?php echo $qssquantity .' '. $measures[$deliveryview['Deliverydetail']['measure_id']];?></td> 
                                    <td> 
                                        <?php 
                                            echo $this->Form->input("Requisitionreturn.$id.did",array('type'=>"hidden",'value'=>$did)); 
                                            echo $this->Form->input("Requisitionreturn.$id.quantity",array('class'=>'form-control bss','label'=>false,'onkeyup'=>"validValue($id,this.value,$sval);",'onclick'=>"validValue($id,this.value,$sval);",'id'=>'etype'.$id)); 
                                            echo $this->Form->input("Requisitionreturn.$id.district_id",array('type'=>"hidden",'value'=>$distid));
                                        ?>
                                        <b class="bssc"><?php echo $measures[$deliveryview['Deliverydetail']['measure_id']];?></b>
                                   </td>
                                </tr>
                            <?php } endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                    </div> 
                    <div style="clear: both;height: 20px;"></div>
                    <div class="col-xs-12 text-center"> 
                        <?php echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'deliveries','action' => 'returnrequisition'),array('class'=>'btn btn-warning','escape' =>false)); ?>
                        <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Submit</button>  </div>
                    </div>   
                  <?php echo $this->Form->end(); ?>
                </div>
            </div> 
        </div> 
    </div> 
</div> 
