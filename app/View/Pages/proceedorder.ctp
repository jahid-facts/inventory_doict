<div class="full-content-area">

      <div class="container">
              

        <div class="row">
          <div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">
           <div class="content_area">
 <?php echo $this->Form->create('Order',array('name'=>'form2','id'=>'OrderOrdernowForm','url'=>array('controller'=>'orders','action'=>'add'))); ?>
           <div class="shop-single">
             <div class="col-md-12">
                     <table class="table table-hover">
                         <thead>
                              <tr>
                                <th></th>
                                <th></th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                              </tr>
                          </thead>
                          <tbody>
	                         
                      <?php if(!empty($product_datas)){?>
		                  <?php 
			                  $tot_amount=0;
			                  $i=0;
			                  foreach($product_datas as $value){

			                  $i++;
		                  ?>
                              <tr>
                  
	                               <td class="table_content_text"><a href="" title="Remove this item"><i class="fa fa-times" aria-hidden="true" style="color:red;cursor:pointer;" onclick="removeCartItem('<?php echo $value[0]['Product']['id']?>','<?php echo $value[0]['Product']['name']?>');" id="p_amount[<?php echo $value[0]['Product']['id'];?>]"></i></a></td>
	       
	                                <td>
	                                
	                                	<?php echo $this->Form->input("Orderdetail.$i.product_id",array('value'=>$value[0]['Product']['id'],'label'=>false,'type'=>'hidden'));?>
	                                </td>
	                                <td class="table_content_text"><?php echo $value[0]['Product']['name']?></td>
	                                <td class="table_content_text"><?php echo $this->Form->input("Orderdetail.$i.price",array('id'=>'p_price[' . $value[0]['Product']['id'] . ']','value'=>$value[0]['Product']['price'],'label'=>false,'div'=>false,'class'=>'amount amount-new','readonly'=>'readonly','type'=>'text'));?></td>
	                                <td class="table_content_text">
	                                
	                                <?php echo $this->Form->input("Orderdetail.$i.qty",array('onkeyup'=>'calPro(' . $value[0]['Product']['id'] . ',this.value)','id'=>'p_amount[' . $value[0]['Product']['id'] . ']','label'=>false,'class'=>'amount2 amount input-text qty','div'=>false,'value'=>1,'type'=>'text'));?>
	                                
	                                
	                                
	                                </td>
	                                <td class="table_content_text"><?php echo $this->Form->input("Orderdetail.total_pro_price",array('id'=>'total_p_price[' . $value[0]['Product']['id'] . ']','value'=>$value[0]['Product']['price'].'.00','label'=>false,'class'=>'amount paid2 amount-new','div'=>false,'readonly'=>'readonly'));?></td>
                             </tr>
                             <?php 
                  
				                  $tot_amount=$tot_amount+ $value[0]['Product']['price'];
				                  }}
   							 ?>
            
                               
                             </tbody>
                         </table> 

<div class="cart-collaterals">
     <div class="cart_totals ">
    
        <h2 class="bg-danger">Cart Totals</h2>

            <table cellspacing="0" class="table cart">

                  <tbody>
                        <tr class="cart-subtotal">
                             <th>Subtotal</th>
                             <td> : </td>
                             <td><span class="amount"> ৳&nbsp;<?php echo $this->Form->input('Order.subtotal',array('id'=>'gptotal_price','value'=>$tot_amount.'.00','label'=>false,'class'=>'amount amount-new1','div'=>false,'type'=>'text'));?></span></td>
                        </tr>

                        <tr class="cart-subtotal">
                             <th>Shipping</th>
                             <td> : </td>
                             <td> ৳&nbsp;<?php echo $this->Form->input('Order.shipping',array('value'=>'30.00','label'=>false,'class'=>'shippingamount','div'=>false,'type'=>'text'));?></td>
                        </tr>

                       <tr class="order-total">
                              <th>Total</th>
                              <td> : </td>
                              <td>৳&nbsp;<?php

                              $gtotal=$tot_amount+30;
                              
                              echo $this->Form->input('Order.total',array('value'=>$gtotal.'.00','label'=>false,'class'=>'grandtotalamount','div'=>false,'type'=>'text'));?> </td>
                       </tr>
                  </tbody>
             </table>
 
       <div class="box-body">
            <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Name :</label>
                    <div class="col-sm-10">
                    <?php echo $this->Form->input('name',array('class' =>'form-control','label'=>false,'div'=>false,'placeholder'=>'Your Name Here'));?>
                     
                    </div>
            </div>&nbsp;&nbsp;&nbsp;

            <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Email Address :</label>
                    <div class="col-sm-10">          
                      <?php echo $this->Form->input('email',array('class' =>'form-control','label'=>false,'div'=>false,'placeholder'=>'Your email address Here'));?>
                    </div>
            </div>&nbsp;&nbsp;&nbsp;

            <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Phone Number:</label>
                    <div class="col-sm-10">          
                    <?php echo $this->Form->input('mobile',array('class' =>'form-control','label'=>false,'div'=>false,'placeholder'=>'Your Phone number'));?>
                    </div>
           </div>&nbsp;&nbsp;&nbsp;

           <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Address :</label>
                    <div class="col-sm-10">  
                    <?php echo $this->Form->input('address',array('class' =>'form-control','label'=>false,'div'=>false,'placeholder'=>'Your Address'));?>        
                       
                    </div>
           </div>&nbsp;&nbsp;&nbsp;
            
            <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Pay Method :</label>
                    <div class="col-sm-10">          
                     <h5 style="margin:2px;">Cash on Delivery</h5>
                  </div>
            </div>&nbsp;&nbsp;&nbsp;
            

            <div class="">
                  <input class="btn btn-success"  onclick="confirmation();" value="proceed to order" type="button">
             </div>

                              
        </div>
 
      </div>
</div>
<?php echo $this->Form->end(); ?>   
                  
</div>
</div>&nbsp;&nbsp;&nbsp;&nbsp;  
  
           

<script>

function confirmation(){

		 if(document.getElementById('OrderName').value == '')
      	{
      		alert('Please give name');
      		document.getElementById('OrderName').focus();
      	
      	}else if(document.getElementById('OrderEmail').value == '')
      	{
      		alert('Please give email');
      		document.getElementById('OrderEmail').focus();
      	
      	}else if(document.getElementById('OrderMobile').value == '')
      	{
      		alert('Please give mobileno');
      		document.getElementById('OrderMobile').focus();
      	
      	}else if(document.getElementById('OrderAddress').value == '')
      	{
      		alert('Please give address');
      		document.getElementById('OrderAddress').focus();
      	
      	}else{
          	var cond = confirm("Are you sure want to order this items.");
          	if(cond == true){
             // alert(cond);
          		$('#OrderOrdernowForm').submit();
          	     
          	}else{
          	}
	  }
}
</script>

 
         </div>
        </div>
       </div>
     </div>
  </div>
   
  
  