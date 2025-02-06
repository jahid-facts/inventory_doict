<style type="text/css">
	.ad-span a{
        border: 1px solid;
        margin-top: -5px;
        float: right;
        color: #FFF!important;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > td {
    	text-align: center;
        vertical-align: middle;
    }
    .tbl-td > tbody > tr > td {
        font-weight: bold;
        font-size: 15px;
    }
    .h-date {
        text-align: right;
        width: 100%;
    }
    .m-btm {
        margin-bottom: 10px;
    }
    .p-lft {
        padding-left: 0px!important;
    }
    .p-rgt {
        padding-right: 0px!important;
    }
    .body-tbl {
        width: 100%;
        margin-bottom: 0px;
    }
    
    .body-tbl > tbody > tr > td:nth-child(1), .body-tbl > tbody > tr > td:nth-child(2) {
        width: 26%;
    }
    .body-tbl > tbody > tr > td:nth-child(3), .body-tbl > tbody > tr > td:nth-child(4) {
        width: 12%;
    }
    .body-tbl > tbody > tr > th:nth-child(5) {
        width: 16%;
    }

     .body-tbl > tbody > tr > td:nth-child(6) {
        width: 8%;
    }
    .tcenter {
        text-align: center!important;
    }
</style>
<style type="text/css">
    .web{
        font-family:tahoma;
        size:12px;
        top:10%;
        border:1px solid #CDCDCD;
        border-radius:10px;
        padding:10px;
        width:38%;
        margin:auto;
    } 
    #search_keyword_id
    {
        width:300px;
        border:solid 1px #CDCDCD;
        padding:10px;
        font-size:14px;
    }
    #result
    {
        position:absolute; 
        width:320px;
        display:none;
        margin-top:-1px;
        border-top:0px;
        overflow:hidden;
        border:1px #CDCDCD solid;
        background-color: white;
        z-index:999;
    }
    .show
    {
        font-family:tahoma;
        padding:10px; 
        border-bottom:1px #CDCDCD dashed;
        font-size:15px; 
    }
    .show:hover
    {
        background:#364956;
        color:#FFF;
        cursor:pointer;
    }
    #result1
    {
        position:absolute; 
        width:320px;
        display:none;
        margin-top:-1px;
        border-top:0px;
        overflow:hidden;
        border:1px #CDCDCD solid;
        background-color: white;
        z-index:999;
    }
     
     
</style>

<script>

var path='<?php echo $this->webroot;?>';
    /* add multiple attach file  */
    var i=1;
    function addMulti_file(){
        appPrt = $(".append_attach_file_part").html().replace(/VR/g, i);
        $(".append_attach_file_here").append(appPrt);
        i++;
    }
    
    function remove_file(id) {
        $('#total' + id).remove();

        gtotal_price2=0.0;
        $(".paid2").each ( function() {

            gtotal_price2 += parseFloat ( $(this).html().replace(/\s/g,'').replace(',','.'));
        });
        $("#gptotal_price").html(gtotal_price2.toFixed(2));
    }

 

function getTaxpayerId(id,nid){
  $.ajax({
    type: 'POST',
    url: path +'products/dropdown',
    data: {t_id:id,nid:nid},
    success: function(data){
       $("#result"+nid).html(data).show();
            
    }
  });
}
    function showTaxpayer(v,nid,code){


          var $name = $('.work_smart'+nid).html(); 
          var decoded = $("<div/>").html($name).text();
          $('#TaxpayerHoldingNo'+nid).val(decoded);
          $("#result"+nid).fadeOut();

        showTaxpayerout(v,nid,code);


    }

    function showTaxpayerout(v,id,code){
     
         $.ajax({
            type: 'POST',
            url: path +'products/pascode',
            data: {code:code},
            success: function(data){
                var res = data.split("/");
                 $('#pedi'+id).val(res[0]);
                 $('.product_name'+id).val(res[1]);
                  $('#measure_id'+id).val(res[2]);
                   $('#measure_name'+id).val(res[3]);
                   $('#product_code'+id).val(code);
                            
            }
        });

         
          $("#result"+nid).fadeOut();

    }
</script>


<script>
    function codeVerify(code,id){
       
        $.ajax({
            type: 'POST',
            url: path +'products/pascode',
            data: {code:code},
            success: function(data){
                var res = data.split("/");
                 $('#pedi'+id).val(res[0]);
                 $('.product_name'+id).val(res[1]);
                  $('#measure_id'+id).val(res[2]);
                   $('#measure_name'+id).val(res[3]);

                            
            }
        });
    }
</script>
<div class="append_attach_file_part" style="display: none;">
    <div id="totalVR" style="display: block;">
        <table class="table table-bordered body-tbl"> 
            <tbody> 
                <tr>
                    <td>
                    <input name="data[Damage][VR][product_id]" type="hidden"  id="pediVR" />


                    <input name="data[Damage][VR][measure_id]" type="hidden"  id="measure_idVR" />

                     <input name="data[Damage][VR][product_code]" class="form-control tcenter" type="text" onkeyup="codeVerify(this.value,VR);" id="product_codeVR" required="required"/>


                     </td>
                    <td> 
                        <input name="data[Damage][VR][product_name]" class="search_keyword  form-control tcenter product_nameVR" type="text" onkeyup="getTaxpayerId(this.value,VR);" placeholder="Product name" id="TaxpayerHoldingNoVR" autocomplete = "off" required="required" />
                                <div id="resultVR"></div>


                    </td>
                    <td><input type="text" name="data[Damage][VR][quantity]" id="quantityVR" class="form-control tcenter" required="required"></td>
                    <td><input type="text" name="data[Damage][VR][measure_name]" id="measure_nameVR"  class="form-control tcenter"></td>
                    <td>
                        <?php 
                            echo $this->Form->input('Damage.VR.type',array('class'=>'form-control','label'=>false,'options'=>$padjtype));
                            echo $this->Form->input('Damage.VR.district_id',array('type'=>'hidden','value'=>$currentUser['district_id']));
                        ?>
                    </td>
                    <td>
                  
                        <div class="pdr15" onclick="remove_file(VR)"><i class="fa fa-minus" style="cursor: pointer; color: red"></i></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="user index">
    <div style="height:20px;"></div> 
    <?php echo $this->Form->create('Damage',array('type'=>'file','class'=>'form-horizontal')); ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Product Adjustment'); ?> 
                <span class="ad-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-mail-reply"></span> Back'), array('controller' => 'damages','action' => 'index'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?> 
                </span>
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-10 col-sm-offset-1">
                <div class="col-sm-6 p-lft">
                    <table class="tbl-td">
                        <tr>
                            <td>Adjustment No. </td>
                            <td>&nbsp; : &nbsp;</td>
                            <td><input type="text" name="data[Damages][dnumber]" value="<?php echo date('Ymdhis');?>" class="form-control m-btm" placeholder="Auto"></td>
                        </tr>

                        <tr>
                            <td>Reference No. </td>
                            <td>&nbsp; : &nbsp;</td>
                            <td><input type="text" name="data[Damages][rnumber]" class="form-control"  ></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6 p-rgt">
                    <h5 class="h-date">Date : <b><?php echo date("d-m-Y");?></b></h5>
                </div>
                <div style="clear: both; height: 20px;"></div>

            	<table class="table table-bordered body-tbl">
                    <thead>
                        <tr>
                            <th colspan="5">Product</th>
                            <th rowspan="2">More</th> 
                        </tr>
                        <tr> 
                            <th>Code</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Adjustment Type</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                     
                            <td>
                            <input name="data[Damage][0][product_id]" type="hidden"  id="pedi0" />
                            <input name="data[Damage][0][measure_id]" type="hidden"  id="measure_id0" />


                             <input name="data[Damage][0][product_code]" class="form-control tcenter" type="text" onkeyup="codeVerify(this.value,0);" id="product_code0" required="required" />


                             </td>
                            <td> 

                                <input name="data[Damage][0][product_name]" class="search_keyword  form-control tcenter product_name0" type="text" onkeyup="getTaxpayerId(this.value,0);"  autocomplete = "off" placeholder="Product name" id="TaxpayerHoldingNo0"  required="required" />
                                <div id="result0"></div>

                            </td>
                            <td><input type="text" name="data[Damage][0][quantity]" id="quantity0" class="form-control tcenter" required="required"></td>
                            <td><input type="text" name="data[Damage][0][measure_name]" id="measure_name0"  class="form-control tcenter"></td>
                            <td>
                                <?php 
                                    echo $this->Form->input('Damage.0.type',array('class'=>'form-control tcenter','label'=>false,'options'=>$padjtype));
                                    echo $this->Form->input('Damage.0.district_id',array('type'=>'hidden','value'=>$currentUser['district_id']));
                                ?>
                            </td>
                            <td>
                                <div class="pdr15" onclick="addMulti_file()"><i class="fa fa-plus" style="cursor: pointer"></i></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="append_attach_file_here"></div>
                <div style="clear: both; height: 10px;"></div>
                
                <div class="col-sm-4 p-lft"> 
                    <label>Attached Approval Letter</label> 
                    <?php echo $this->Form->input('Damages.attach',array('type'=>'file','class'=>'form-control','label'=>false));?>
                </div>
                <div class="col-sm-4 p-rgt text-center"> 
                    <label>&nbsp;</label><br> 
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Submit</button>
                </div>
                <div style="clear: both; height: 3px;"></div>
               
            </div>
        </div>
    </div>
     <?php echo $this->Form->end(); ?>
</div>