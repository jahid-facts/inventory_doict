<style type="text/css">
    #cd-cart { 
      border: 1px solid #000!important;
    }
    th{
        text-align: center;
    }
    td{
        text-align: center;
        vertical-align: middle;
    }
    .fa-trash {
        color: #ef4b4b;
        font-size: 20px;
    }
    .f-con-tb {
        width: 100%;
    }
    .f-con-tb .form-control {
        height: 24px!important;
        padding: 2px 5px!important;
        text-align: center!important;
    }
    .f-con-tb > thead > tr > th {
        vertical-align: middle!important;
        padding: 5px!important;
        color: #66929e!important;
        text-align: center!important;
    }
    .f-con-tb > tbody > tr > td {
        vertical-align: middle!important;
        padding: 3px 5px!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(1) {
        width: 14%!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(2) {
        width: 10%!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(3) {
        width: 27%!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(4) {
        width: 12%!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(5) {
        width: 14%!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(6) {
        width: 15%!important;
    }
    .f-con-tb > tbody > tr > td:nth-child(7) {
        width: 8%!important;
    }
</style>
<div id="cd-cart" class="show-cart">
    <h2>New Requisition</h2>
    <div class="col-sm-12 table-responsive">  
        <?php echo $this->Form->create('Requisition',array('class'=>'form-horizontal','url' => array('controller'=>'requisitions','action'=>'add'))); ?> 
        <table class="table table-bordered more-tbl f-con-tb">
            <thead>
                <tr> 
                    <th colspan="6">Product</th> 
                    <th rowspan="2">Action</th>
                </tr>
                <tr> 
                 
                    <th>Code</th>
                    <th>Stock</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th> 
                    <th>Purpose</th> 
                </tr>
            </thead>
            <tbody> 
                <span id="totalcount" style="display:none"><?php echo count($product_datas);?></span> 
                <?php  
                    $i=0;

                    foreach($product_datas as $product_datas) {
                    ++$i;

                    $class=$product_datas['Product']['id'];
                    $distid = $currentUser['district_id'];

                    $sql  = "SELECT pt.id, pt.finalcode,s.squantity, d.dquantity, p.pquantity,rr.rrquantity,ds.dsquantity,dm.dmquantity FROM products 
                    AS pt LEFT JOIN
                    ( 
                        SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
                        FROM stocks WHERE district_id=$distid GROUP BY stocks.product_id 
                    ) 
                    AS s ON pt.id = s.product_id LEFT JOIN 
                    ( 
                        SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
                        FROM purchasedetails WHERE district_id=$distid GROUP BY purchasedetails.product_id 
                    )
                     AS p ON pt.id = p.product_id LEFT JOIN 
                    ( 
                        SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
                        FROM deliverydetails WHERE district_id=$distid GROUP BY deliverydetails.product_id 
                    )
                    AS d ON pt.id = d.product_id LEFT JOIN
                    ( 
                        SELECT requisitionreturns.product_id,SUM(requisitionreturns.quantity) AS rrquantity 
                        FROM requisitionreturns WHERE district_id=$distid GROUP BY requisitionreturns.product_id 
                    )
                    AS rr ON pt.id = rr.product_id LEFT JOIN
                    ( 
                        SELECT damages.product_id,SUM(damages.quantity) AS dsquantity 
                        FROM damages WHERE damages.type=1 AND damages.district_id=$distid GROUP BY damages.product_id 
                    )
                    AS ds ON pt.id = ds.product_id LEFT JOIN
                    ( 
                        SELECT damages.product_id,SUM(damages.quantity) AS dmquantity 
                        FROM damages WHERE damages.type=2 AND damages.district_id=$distid GROUP BY damages.product_id 
                    )
                    AS dm ON pt.id = dm.product_id WHERE pt.id='".$class."' GROUP BY pt.id ";
                    
                    $data = getQueryData($sql);
                    $stockIn=($data['squantity']+$data['pquantity']+$data['rrquantity']);

                    $stockOut=($data['dquantity']+$data['dmquantity']+$data['dsquantity']);
                    $balance=$stockIn-$stockOut; 

                    $sval=$balance;
                ?>
                <tr id="rmid<?php echo $class;?>"> 
                    <td>
                    <input name="data[Requisitiondetail][<?php echo $i;?>][product_id]" type="hidden" value="<?php echo $product_datas['Product']['id'];?>"  id="pedi<?php echo $class;?>" />

                    <input name="data[Requisitiondetail][<?php echo $i;?>][measure_id]" type="hidden" value="<?php echo $product_datas['Measure']['id'];?>"  id="measure_id<?php echo $class;?>" />


                   <?php echo $product_datas['Product']['finalcode'];?>


                     </td>

                   <td id="pid<?php echo $class;?>"><?php echo $balance;?></td>
                  
                   <td id="product_name<?php echo $class;?>"><?php echo $product_datas['Product']['name'];?></td>

                    <td>

                       <input type="number" name="data[Requisitiondetail][<?php echo $i;?>][quantity]" id="quantity<?php echo $class;?>" onkeyup="validValue(<?php echo $class;?>,this.value,<?php echo $sval;?>);" onclick="validValue(<?php echo $class;?>,this.value,<?php echo $sval;?>);" class="form-control qnt"  required="required" value="1" >

                    </td>

                    <td>
                        <input type="text" name="data[Requisitiondetail][<?php echo $i;?>][measure_name]" id="measure_name<?php echo $class;?>"  class="form-control" value="<?php echo $product_datas['Measure']['name'];?>"> 
                    </td>

                    <td><?php echo $this->Form->input("Requisitiondetail.$i.purpose",array('onchange' => "checkpurpose(this.value,$class);",'class'=>'form-horizontal','type'=>'select','options'=>$purpose,'label'=>false,'required'));?>
                            <?php echo $this->Form->input("Requisitiondetail.$i.purposeothers",array('class'=>'form-horizontal purpose','type'=>'text','rows'=>'1','label'=>false,'id'=>'purpose'.$class,'style'=>'display:none','cols'=>'16'));?> 
                    </td>
                    
                    <td> 
                        <i class="fa fa-trash" title="Remove To Cart" onclick="removeCartItem('<?php echo $product_datas['Product']['id'] ?>', '<?php echo $product_datas['Cart']['user_id'] ?>');" style="cursor: pointer"></i>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="append_attach_file_here"></div>
        <div style="clear: both; height: 1px;"></div> 
        <div class="col-sm-12 p-rgt p-lft text-center"> 
            <?php if (!empty($product_datas['Product']['finalcode'])) {?>
                <button type="submit" class="btn btn-default  hdb" style="background-color:#428BCA;color:white;">Submit <i class="fa fa-send-o"></i></button>
            <?php }else{?> 
                <h3 style="margin: 0; text-align: center; font-size: 16px; font-weight: 600; color: #d28585;">No requisition added.</h3>
            <?php }?>
        </div>
        <div style="clear: both; height: 3px;"></div>
          <?php echo $this->Form->end(); ?>

    </div>
</div> 


