<div class="dropdown dropdown-cart">
	<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
		<div class="items-cart-inner">
			<?php 
                $tot_amount=0;
                foreach ($product_datas as $Child){?>
				<?php
			 		$tot_amount=$tot_amount+ $Child[0]['Product']['price']; 	
			 	}?>
						
				<?php 	
                   
				if(!empty($product_datas)){
					$item=sizeof($product_datas);
				}else{
					$item=0;
				}
							
				?>
				<img src="<?php echo $this->Html->webroot;?>img/logo/cartd.png" class="img-circle img-span"><div class="basket-item-count">
				    <span class="count" id="icount"><?php echo $item;?></span>
			    </div>
						 
					
	    </div>
	</a>
	<ul class="dropdown-menu">
	 <?php 
                   $i=1;
                   $tot_amount=0;
                   foreach ($product_datas as $Child){
                 
			     ?>
		<li>
			<div class="cart-item product-summary">
				<div class="row">
					<table class="tabletable">
							<tr id="rmid<?php echo $Child[0]['Product']['id'];?>">
							<td><?php echo $i;?>. </td>
							  <td><?php echo $Child[0]['Product']['name']?></td> 
							  <td id="tdp<?php echo $Child[0]['Product']['id'];?>"><?php echo $Child[0]['Product']['price']?></td>  
							  <td> <span class="remove" data-djax-exclude="true" title="Remove this item"><i class="fa fa-trash" aria-hidden="true" style="color:red;cursor:pointer;" onclick="removeCartItem('<?php echo $Child[0]['Product']['id']?>');"></i></span></td> 
							</tr>
					</table>
					 
					
					 
				</div>
			</div><!-- /.cart-item -->
			<?php
		        $i++;
	 		    $tot_amount=$tot_amount+ $Child[0]['Product']['price']; 	
	 		}
	 		
	 		?>
			<div class="clearfix"></div>
			<hr>
			 
			<li class="summation">
				<div class="summation-subtotal">
					<span><span id="icount-new" style="margin-left: 15px;"><?php echo $item;?></span>&nbsp;items </span>
					 <span id="cart" style="display: none;"><?php echo $i;?></span><span style="float:right; padding-right:36px;" class="amount" id="tdtp" ><?php echo $tot_amount;?></span> 
					 
				</div>
				
				<div class="btn-cart">
				 	<button class="btn btn-dark" onclick="goOrder();">Checkout</button>
				</div>
			</li>					
		<span id="total" style="display: none;" value="<?php echo $tot_amount;?>"> <?php echo $tot_amount;?></span>
		
		 
	</ul><!-- /.dropdown-menu-->
</div><!-- /.dropdown-cart -->
<script type="text/javascript">
			function goOrder() {
                 
            location.href = '<?php echo $this->webroot ?>pages/proceedorder';
            }
</script>
      

        