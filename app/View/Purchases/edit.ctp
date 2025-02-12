


<?php
   $purchasedetails=$this->data['Purchasedetail'];
?>
<?php 
    echo $this->Html->script('jquery-ui');
    echo $this->Html->css('jquery-ui');
    echo $this->Html->css('inventory-style');
?>
<style>
    .col-sm-offset-3 {
        margin-top: 15px;
    }  
    .form-group {
      padding-right: 0px;
    }
    select .spans {
        font-weight: bold;
        color: #5d0c1f!important; 
    }
    .plr-fg {
        padding-left: 15px;
        padding-right: 15px;
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
    
    var i='<?php echo sizeof($purchasedetails);?>';
    function addMulti_file(){
        appPrt = $(".append_attach_file_part").html().replace(/VR/g, i);
        $(".append_attach_file_here").append(appPrt);
        i++;
    }
    function remove_file(id) {
        $('#total' + id).remove();
    }

    function checkpurpose(vl){  
        if(Number(vl)>0 || vl==''){
            
            $("#purpose").hide();
        }else{
            $("#purpose").show();
        }
    }
</script> 
<div class="append_attach_file_part" style="display: none;">
    <div id="totalVR" style="display: block;"> 
        <table class="table table-bordered custable"> 
            <tbody>
                <tr class="th-width">
                    <td> 
                        <select name="data[Purchasedetail][VR][product_id]" class="w-100 form-horizontal" id="PurchasedetailVRProductId" required="required">
                            <option value="">Select</option>
                            
                            <?php foreach ($products as $product){
                                
                            $description=$product['Category']['name'].'<b>-</b>'.$product['SubCategory']['name'].'<b>-</b>'.$product['Product']['name'];
                            if(!empty($product['Brand']['name'])){
                                $description.='<b>-</b>'.$product['Brand']['name'];
                            }
                            if(!empty($product['Color']['name'])){
                                $description.='<b>-</b>'.$product['Color']['name'];
                            }
                            if(!empty($stock['Size']['name'])){
                                $description.='<b>-</b>'.$product['Size']['name'];
                            }
                            
                            ?>
                            <option value="<?php echo $product['Product']['id'];?>"><?php echo $description;?></option>
                            <?php }?> 
                        </select>
                    </td>
                    <!-- <td> </td> -->
                    <td> </td>
                    <td> </td> 
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.price',array('class'=>'w-100 form-horizontal purchasedetailPriceVR','label'=>false,'id'=>'p_priceVR','type'=>'text')); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.quantity',array('onkeyup'=>'calPro(this.value,VR);','class'=>'w-100 form-horizontal amount2','type'=>'number','label'=>false,'id'=>'p_unit0')); ?>
                    </td> 
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.measure_id',array('class'=>'w-100 form-horizontal','label'=>false)); ?>
                    </td>
                    <td id="total_p_priceVR" class="paid2">
                        0
                    </td>
                    <td></td>
                    <td>
                        <div class="pdr15" onclick="remove_file(VR)"><i class="fa fa-minus" style="cursor: pointer; color: red"></i></div>
                    </td>
                </tr>
            </tbody>
        </table>
       
    </div>
</div>
 
<div class="col-sm-12">
<?php echo $this->Form->create('Purchase',array('type'=>'file','class'=>'form-horizontal')); ?>
    <?php echo $this->Form->input('id');?>
        <div class="panel panel-primary" style="margin-top:50px;">  
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Edit Purchase Product'); ?></h3> 
            </div>
            <div class="panel-body">
            
                <div class="col-sm-4">
                    <div class="form-group plr-fg">
                        <label>Purchase Date</label>
                        <?php echo $this->Form->input ('created', array ('type'=>'text','id'=>'datepicker','class'=>'form-input-text form-control','label'=>false) );?> 
                    </div>
                </div>
                <div class="col-sm-4">    
                    <div class="form-group plr-fg"> 
                        <label>Invoice No.</label>  
                        <?php echo $this->Form->input('invoice',array('label'=>false,'div'=>false,'class'=>'form-control'));?> 
                    </div>
                </div>
                <div class="col-sm-4">   
                    <div class="form-group plr-fg"> 
                        <label>Supplier Name</label>  
                        <?php echo $this->Form->input('supplier_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>                         
                    </div>
                </div> 
                <div style="clear: both;">
                    <div class="col-sm-4">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.supplier_other_id",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'purpose','placeholder'=>'Supplier Name'));?> 
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.mobile",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'suppliermobile','placeholder'=>'Supplier Phone'));?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.email",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'supplieremail','placeholder'=>'Supplier E-mail'));?> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.address",array('class'=>'form-control purpose','type'=>'textarea','label'=>false,'id'=>'supplieraddress','placeholder'=>'Supplier Address','rows'=>1));?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                  <!-- add more -->
                    <div class="table-responsive">
                        <table class="table table-bordered custable">
                            <thead>
                                <tr>
                                    <th colspan="3">Product</th>
                                    <th colspan="4">Purchase New Product</th>
                                    <th rowspan="2">Total Product</th>
                                    <th rowspan="2">More</th>
                                </tr>
                                <tr>
                                    <th>Code</th> 
                                    <th>Name</th>
                                    <!-- <th>Barcode</th> -->
                                    <th>Balance</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Total Price</th>    
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $i=0;
                                        $purchasedetails=$this->data['Purchasedetail'];
                                            foreach ($purchasedetails as $purchasedetail) {
                                                $id=$purchasedetail['id'];
                                ?>
                               <?php echo $this->Form->input("Purchasedetail.$i.id",array('value'=>$id)); ?>
                                <tr class="th-width">
                                    <td> 
                                        <select name="data[Purchasedetail][0][product_id]" class="w-100 form-horizontal" id="Purchasedetail0ProductId" required="required">
                                            <option value="">Select</option>
                                            <option href="/inventory/products/addmodal" class="" data-toggle="modal" data-target="#myModal">Add New</option>
                                                                                    
                                            <?php foreach ($products as $product){
                                            
                                                $description=$product['Category']['name'].'->'.$product['SubCategory']['name'].'->'.$product['Product']['name'];
                                                if(!empty($product['Brand']['name'])){
                                                    $description.='->'.$product['Brand']['name'];
                                                }
                                                if(!empty($product['Color']['name'])){
                                                    $description.='->'.$product['Color']['name'];
                                                }
                                                if(!empty($stock['Size']['name'])){
                                                    $description.='->'.$product['Size']['name'];
                                                }
                                                if($product['Product']['id']==$id){?>
                                                    <option value="<?php echo $product['Product']['id'];?>" selected="selected"><?php echo $description;?></option>
                                                <?php }else{?>
                                                        <option value="<?php echo $product['Product']['id'];?>"><?php echo $description;?></option>
                                                <?php } ?> 

                                            <?php }?>
                                        </select>
                                    </td>
                                    <!-- <td> </td> -->
                                    <td> </td>
                                    <td> </td> 
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.price',array('class'=>'w-100 form-horizontal purchasedetailPrice0','label'=>false,'id'=>'p_price0','required'=>false,'type'=>'text')); ?> 
                                    </td>
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.quantity',array('onkeyup'=>'calPro(this.value,0);','class'=>'w-100 form-horizontal amount2','label'=>false,'id'=>'p_unit0')); ?>
                                    </td> 
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.measure_id',array('class'=>'w-100 form-horizontal','label'=>false)); ?> 
                                    </td>
                                    <td id="total_p_price0" class="paid2">
                                        0
                                    </td>
                                    <td></td>
                                    <td>
                                        <div class="pdr15" onclick="addMulti_file()"><i class="fa fa-plus" style="cursor: pointer"></i></div>
                                    </td>
                                </tr>
                                <?php
                                    $i++;
                                    } 
                                ?>
                            </tbody>
                        </table> 
                        <div class="append_attach_file_here"></div>
                        <table class="table table-bordered custable">
                            <tbody>
                                <tr>
                                 
                                    <td colspan="6" width="71.2%">Grand Total Price</td>

                                    <td id="gptotal_price" colspan="3" style="text-align: left!important;">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                         
                </div>  
                <div style="clear: both; height: 15px;"></div>
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
                </div> 
            
        </div> 
        <?php echo $this->Form->end(); ?>
</div>
 



<script type="text/javascript">
    $(document).ready( function($){
        $(".purpose").hide();
    });
    function checkpurpose(vl){  
        if(Number(vl)>0 || vl==''){
            
            $(".purpose").hide();
        }else{
            $(".purpose").show();
        }
    }

    function calPro(bb,b){

        
        var p_price = parseFloat(document.getElementById('p_price'+b).value);
        var p_unit = parseFloat(bb);

        document.getElementById('total_p_price'+b).innerHTML = (p_price * p_unit).toFixed(2);

        gtotal_price2=0.0;
        $(".paid2").each ( function() {

            gtotal_price2 += parseFloat ( $(this).html().replace(/\s/g,'').replace(',','.'));
        });
        $("#gptotal_price").html(gtotal_price2.toFixed(2));
        //document.getElementById('gptotal_price').value = parseFloat(document.getElementById('gptotal_price').value)+(p_price * p_unit);

    }


    $(document).ready ( function () {
            $(".amount2").keyup(function(event) {
                gtotal_price2=0.0;
                $(".paid2").each ( function() {

                    gtotal_price2 += parseFloat ( $(this).html().replace(/\s/g,'').replace(',','.'));
                });
                $("#gptotal_price").html(gtotal_price2.toFixed(2));
            });


    });


    var path='<?php echo $this->webroot;?>';
    function getSubcategory(id,did){
    
        $.ajax({
            type: 'POST',
            url: path +'products/getprice',
            data: {id:id},
            success: function(data){

                $('.purchasedetailPrice' + did).val(data);
                        
            }
        });
    
     }
 </script> 