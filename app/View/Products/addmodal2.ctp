<style>
    .lgd {
        background-color: #0088cc;
        color: #fff;
        font-family: inherit;
        font-weight: bold;
        margin-left: -15px;
        padding: 10px;
        text-align: center;
        width: 1044px;
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
</script>
<div class="products form">
    
<?php echo $this->Form->create('Product',array('type'=>'file','class'=>'form-horizontal')); ?>
   			
        <div class="container">
            
            <legend class="lgd"><?php echo __('Add Product Category'); ?></legend>            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Category</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('category_id',array('onChange'=>'getSubcategory(this.value);','label'=>false,'div'=>false,'type'=>'select','class'=>'form-control','empty'=>array('-1'=>'-- Select Category --')));?>
                </div>
            </div>
            <div class="form-group" >
                <div class="col-md-2">
                    <label>Subcategory</label>
                </div>  
                <div class="col-md-4">
                    <?php echo $this->Form->input('subcategory',array('type'=>'select','class'=>'form-control subcategory_option','label'=>false,'empty'=>'Select'));?>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-2">
                    <label>Product Name</label>
                </div>  
                <div class="col-md-4">
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?>
                </div>
            </div>
             
            <div class="form-group">
                <div class="col-md-2">
                    <label>Product Code</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('productcode',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>
            
            
         
                    <?php echo $this->Form->input('price',array('type'=>'hidden','class'=>'form-control','label'=>false,'value'=>1));?>
              
            <div class="form-group" >
                <div class="col-md-2">
                    <label>Measure</label>
                </div>  
                <div class="col-md-4">
                    <?php echo $this->Form->input('measure_id',array('type'=>'select','class'=>'form-control','label'=>false,'options'=>$measure));?>
                </div>
            </div>
            <div class="form-group" >
                <div class="col-md-2">
                    <label>Model</label>
                </div>  
                <div class="col-md-4">
                    <?php echo $this->Form->input('brand_id',array('type'=>'select','class'=>'form-control','label'=>false,'empty'=>'Select'));?>
                </div>
            </div>
            <div class="form-group" >
                <div class="col-md-2">
                    <label>Size</label>
                </div>  
                <div class="col-md-4">
                    <?php echo $this->Form->input('size_id',array('type'=>'select','class'=>'form-control','label'=>false,'empty'=>'Select'));?>
                </div>
            </div>
             <div class="form-group" >
                <div class="col-md-2">
                    <label>Color</label>
                </div>  
                <div class="col-md-4">
                    <?php echo $this->Form->input('color_id',array('type'=>'select','class'=>'form-control','label'=>false,'empty'=>'Select'));?>
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-md-2">
                    <label>Re-order Qty.</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('limitation',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2">
                    <label>Description</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('description',array('type' =>'textarea','class' =>'form-control','label'=>false,'div'=>false));?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2">
                    
                </div>	
                <div class="col-md-4">
                   <?php echo $this->Form->input('status',array('type'=>'hidden','value'=>1,'label'=>false,'div'=>false,'class'=>'form-control','required'=>true));
						?>
                </div>
            </div>

            <div class="box-footer">
                <?php echo $this->Html->link(__('Close'),array('controller'=>'purchases','action' => 'add'), array('class'=>'btn btn-info pull-left')); ?>
                <button type="submit" class="btn btn-success pull-right">Save</button>
             </div>
            
            <br><br><br>
        </div>       
<?php echo $this->Form->end(); ?>
</div>

