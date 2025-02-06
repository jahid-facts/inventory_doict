<style>
    .col-sm-offset-3 {
        margin-top: 15px;
    }
    .panel-heading {
        background: #337AB7!important;
        border-color: #337AB7!important;
    }
    .panel-heading h3 {
        margin: 2px auto;
        text-align: center;
        color: #FFF;
    }
    .form-group {
      padding-right: 0px;
    }
    .form-control-feedback {
        margin-top: 25px;
        width: auto;
    }
    .glyphicon-ok {
        color: #3C763D;
        padding-right: 10px;
    }
    .glyphicon-remove {
        color: #A94442;
        padding-right: 10px;
    }
    .message {
        margin: 1px 0px 5px;
        background: #f2f3f7;
        padding: 4px;
        color: #A94442;
        text-align: center;
        font-size: 16px;
    }
</style> 

<script type="text/javascript">
    var path='<?php echo $this->webroot;?>';

   $(document).ready(function(){
    $(".subcategory_option").html("<option value='0'>Select Subcategory</option>"); 
    
  });
  function getSubcategory(category_id){

    $.ajax({
       type: 'POST',
       dataType: 'json',
       url: path+'categories/getsubcategory',
       data: {category_id:category_id}, 
       success: function(data) {

         $(".subcategory_option").empty();

         $.each(data, function(index, value) {
           
             $(".subcategory_option").append("<option value='"+index+"'>"+value+"</option>"); 
            }); 
         }       
    }); 
  }
function getSize(){
	var id = document.getElementById('size').value;
	$.ajax({	
		type: 'POST',
		url: path +'sizes/getsize',
		data: {id:id},
		success: function(data){
			
			 var defaultSelected = true;
             var nowSelected = true;
             $('.size').append(new Option(id, data, defaultSelected, nowSelected));
		}
	});
}
function getColor(){
	var id = document.getElementById('color').value;
    alert(id);
        die();
	$.ajax({	
		type: 'POST',
		url: path +'colors/getcolor',
		data: {id:id},
		success: function(data){
			
			 var defaultSelected = true;
             var nowSelected = true;
             $('.color').append(new Option(id, data, defaultSelected, nowSelected));
		}
	});
}

function getBrand(){
	var id = document.getElementById('brand').value;
	$.ajax({	
		type: 'POST',
		url: path +'brands/getbrand',
		data: {id:id},
		success: function(data){
			
			 var defaultSelected = true;
             var nowSelected = true;
             $('.brand').append(new Option(id, data, defaultSelected, nowSelected));
		}
	});
}

function codeVerify(value){
    var cat_id=$('#ProductCategoryId').val();
    var subcat_id=$('#ProductSubcategoryid').val();
    $.ajax({
        type: 'POST',
        url: path +'products/code',
        data: {id:value,cat_id:cat_id,subcat_id:subcat_id},
        success: function(data){  
            if(data==1){
                $('#message').html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }else{
                $('#message').html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }                
        }
    });
}



</script> 

<div class="col-sm-10 col-sm-offset-1">
    <div style="height: 20px"></div>
    <div class="panel panel-default" style="margin-bottom: 75px; clear: both;">
        <div class="panel-heading">
            <h3><?php echo __('Add Product Detail'); ?></h3> 
        </div>
        <div class="panel-body">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Form->create('Product',array('type'=>'file','class'=>'form-horizontal')); ?>
            <?php echo $this->Form->input('price',array('type'=>'hidden','class'=>'form-control','label'=>false,'value'=>1));?>
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Category Name</label> 
                    <?php echo $this->Form->input('category_id',array('onChange'=>'getSubcategory(this.value);','label'=>false,'div'=>false,'type'=>'select','class'=>'form-control','empty'=>array('-1'=>'-- Select Category --')));?> 
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Sub-category Name</label> 
                    <?php echo $this->Form->input('subcategoryid',array('type'=>'select','class'=>'form-control subcategory_option','label'=>false,'empty'=>'Select'));?> 
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Product Code</label> 
                    <?php echo $this->Form->input('productcode',array('class'=>'form-control','label'=>false,'onkeyup'=>'codeVerify(this.value);'));?> 
                      <span id="message"></span>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Product Name</label> 
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?>

                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Measure</label>  
                    <?php echo $this->Form->input('measure_id',array('type'=>'select','class'=>'form-control','label'=>false));?>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Model</label>  
                    <select name='data[Product][brand_id]' id="modalBrand" class="form-control brand">
                        <option value="">Select</option>
                        <option value="addbrand">Add New Model</option>                   
                        <?php foreach ($brands as $key=>$brand){?>
                        <option value="<?php echo $key;?>"><?php echo $brand;?></option>
                        <?php }?> 
                    </select>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Size</label> 
                    <select name="data[Product][size_id]" id="modalPrimary" class="form-control size">
                        <option value="">Select</option>
                        <option value="addsize">Add New Size</option>                   
                        <?php foreach ($sizes as $key=>$size){?>
                        <option value="<?php echo $key;?>"><?php echo $size;?></option>
                        <?php }?>    
                    </select> 
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Color</label> 
                    <select name="data[Product][color_id]" id="modalColor" class="form-control color">
                        <option value="">Select</option>
                        <option value="addcolor">Add New Color</option>                   
                        <?php foreach ($colors as $key=>$color){?>
                        <option value="<?php echo $key;?>"><?php echo $color;?></option>
                        <?php }?> 
                    </select>
                </div>
            </div> 
            <div class="col-sm-4">
                <div class="col-sm-12 form-group" > 
                    <label>Re-order Warning</label> 
                    <?php echo $this->Form->input('limitation',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>

            <div class="col-sm-12" style="padding-right: 45px!important; padding-left: 30px;">
                <div class="form-group"> 
                    <label>Description</label> 
                    <?php echo $this->Form->input('description',array('type' =>'textarea','rows' =>3,'class' =>'form-control','label'=>false,'div'=>false));?>
                </div>
            </div>
            <?php echo $this->Form->input('status',array('type'=>'hidden','value'=>1,'label'=>false,'div'=>false,'class'=>'form-control','required'=>true));
                        ?>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div> 

<!-- Modal Size -->
<div class="modal fade modal-primary" id="modalPrimarys" tabindex="-1" role_id="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Size</h4>
			</div>
			<div class="modal-body">
				 <?php echo $this->Form->input('size',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control'));
						?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="getSize()" data-dismiss="modal">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Color -->
<div class="modal fade modal-primary" id="modalColors" tabindex="-1" role_id="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Color</h4>
			</div>
			<div class="modal-body">
				 <?php echo $this->Form->input('color',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control'));
						?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="getColor()" data-dismiss="modal">Save</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Brand -->
<div class="modal fade modal-primary" id="modalBrands" tabindex="-1" role_id="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Model</h4>
			</div>
			<div class="modal-body">
				 <?php echo $this->Form->input('brand',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control'));
						?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="getBrand()" data-dismiss="modal">Save</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
  $("#modalBrand").on("change", function () {        
      $modal = $('#modalBrands');
      if($(this).val() === 'addbrand'){
        $modal.modal('show');
    }
 });
  $("#modalColor").on("change", function () {        
      $modal = $('#modalColors');
      if($(this).val() === 'addcolor'){
        $modal.modal('show');
    }
 });
  $("#modalPrimary").on("change", function () {        
      $modal = $('#modalPrimarys');
      if($(this).val() === 'addsize'){
        $modal.modal('show');
    }
 });
</script>