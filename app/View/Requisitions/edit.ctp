<?php echo $this->Html->css('print-style5');echo $this->Html->css('newdis'); ?>

<script>
  
    function remove_file(id) {
        $('#total' + id).remove();
    }
 	function getStatusApprove(id){
      
        if (confirm("Are you sure want to approve ??") == true) {

            $.ajax({    
                type: 'POST',
                url: path +'requisitions/getapprove',
                data: {id:id},
                success: function(data){
                    location.href=path+"requisitions/dashboard";
                }
            });
            
        }
    }
</script>
 <style type="text/css">
 	.tb-oness > tbody > tr > td:nth-child(1) {
	    width: 38.2%!important;
	    text-align: right!important;
	}
 	.aprv-tbl {
 		width: 100%!important;
 	}
 	.aprv-tbl th {
 		vertical-align: middle!important;
 		text-align: center;
 	}
 	.qunt {
 		width: 60%;
 		margin: 0 auto; 
 		text-align: center!important;
 	}
 </style>
<?php

$stocks=$this->request->data['Requisitiondetail'];

$data=$this->request->data;


?>

<script>
function validValues(tval,sval,id){ 
    if(sval<tval){
        alert("Please give requisitions quantity less than or equal to "+ sval + ".");
        $('#Requisitiondetail'+id+'Quantity').val(sval);
    }
}

</script>
<?php 

	$products=array();
	foreach ($product as $productsss){
		$products[$productsss['Product']['id']]=$productsss['SubCategory']['name'].' - '.$productsss['Product']['name'];

		if(!empty($productsss['Brand']['name'])){
	    	$products[$productsss['Product']['id']].=' - '.'<span title="Model" style="cursor:pointer">'.$productsss['Brand']['name'].'</span>';
	    }
        if(!empty($productsss['Size']['name'])){
            $products[$productsss['Product']['id']].=' - '.'<span title="Size" style="cursor:pointer">'.$productsss['Size']['name'].'</span>';
        }
		if(!empty($productsss['Color']['name'])){
	    	$products[$productsss['Product']['id']].=' - '.'<span title="Color" style="cursor:pointer">'.$productsss['Color']['name'].'</span>';
	    } 
	}
		

?>


 
<?php echo $this->Form->create('Requisition',array('class'=>'form-horizontal')); ?>
 
<div class="payments form" style="margin-top: 30px;"> 
 	<?php echo $this->Form->input('id');?>
	<div class="panel panel-primary">
        <div class="panel-heading">
         	<h3 class="panel-title"> 
          		<?php echo __('Requisition Approve'); ?> 
          		<span class="ad-span"> <?php echo $this->Html->link(__('<span class="fa fa-reply"></span> Back'), array('controller'=>'requisitions','action' => 'requisitionreceived'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?></span>
          	</h3>
        </div> 
        <div class="panel-body">
        	<div class="col-sm-12">
                <table class="table table-bordered my-padding-0">
                    <tr>
                        <td style="width: 20%; text-align: right;">Requisition Approval No. </td>
                        <td style="width: 30%; text-align: left;"> <?php echo date('Ymdhis');?></td>
                        <td style="width: 20%; text-align: right;">Approval Date </td>
                        <td style="width: 30%; text-align: left;"><?php echo date("d-m-Y");?></td>
                    </tr>
                    <tr>
                        <td style="width: 20%; text-align: right;">Requisition No </td>
                        <td style="width: 30%; text-align: left;"><?php echo $data['Requisition']['requisitionno'];?></td>
                        <td style="width: 20%; text-align: right;">Requisition Date </td>
                        <td style="width: 30%; text-align: left;"><?php echo date("d-m-Y",strtotime($data['Requisition']['created']));?>
 
                        </td>
                    </tr> 
                </table>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-6 my-left-padding">
                    <table class="table table-bordered tb-ones">
                        <tr>
	                        <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner</td>
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
                    </table>

                </div>
                <div class="col-sm-6 my-right-padding">
                    <table class="table table-bordered tb-oness">
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
                </div> 
            </div> 
            <div style="clear: both; height: 10px;"> </div> 

        	<div class="col-sm-12 table-responsive">
        		<table class="table table-bordered aprv-tbl">
					<thead>
						<tr>
							<th colspan="4">Product</th>
							<th rowspan="2">Requisition Purpose</th>
							<th colspan="3">Last Issue</th>
							<th colspan="2">Product</th>
							<th rowspan="2">Approve/Reject</th>
						</tr>
						<tr>
							<th>Code</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Stock</th>
							<th>Quantity</th>
							<th>Date</th>
							<th>Purpose</th>
							<th >Total Issue</th>
							<th >Approve Quantity</th>
						</tr>
					</thead>
					<?php 


					echo $this->Form->input("Email.email",array('class'=>'form-horizontal','label'=>false,'id'=>'Requisitiondetaiddfl','type'=>'hidden','default'=>$data['User']['email'])); 

						$i=0;
						foreach ($stocks as $stock) {

						
						$pid=$stock['product_id'];

						$r_id=$this->params['pass']['0'];

						$currUser=$this->params['pass']['1'];
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
                                    AS dm ON pt.id = dm.product_id WHERE pt.id='".$pid."' GROUP BY pt.id ";
                					
                					$data = getQueryData($sql);
                					$stockIn=($data['squantity']+$data['pquantity']+$data['rrquantity']);


                                   
                					$stockOut=($data['dquantity']+$data['dmquantity']+$data['dsquantity']);
                					$balance=$stockIn-$stockOut; 

			 				$stockdetails=classRegistry::init('Requisitiondetail')->find(
							'first',
								array(
									'fields'=>array(
						 				'Requisitiondetail.quantity',
						 				'Requisitiondetail.purpose',
						 				'Requisition.dateupdate',
						 				"(SELECT SUM(r.quantity) FROM requisitiondetails AS r LEFT JOIN requisitions AS rs ON rs.id=r.requisition_id WHERE rs.user_id=$currUser AND  r.product_id=$pid AND r.product_id<$r_id AND r.status=4) AS quantity"
						 				 
										) ,
									'joins'=>array(
										array(
										   'table'=>'requisitions',
										   'alias'=>'Requisition',
										   'type'=>'LEFT',
										   'conditions'=>'Requisition.id=Requisitiondetail.requisition_id'
										 ),
										  
									),
							'conditions'=>array(
								'Requisition.user_id'=>$currUser,
								'Requisitiondetail.product_id'=>$pid,
								"Requisitiondetail.product_id<$r_id",
								"Requisitiondetail.status=4",
							),
							'recursive'=>-1,
							'order'=>'Requisitiondetail.id DESC',
							'limit'=>'1',

					
								)
							);

							//p($stockdetails);

							$lqty=$tqty=0;
							$lpur=null;
							$ldate=null;
							$count=count($stockdetails);

							if($count>0){
								$lqty=$stockdetails['Requisitiondetail']['quantity'];
								$lpur=$stockdetails['Requisitiondetail']['purpose'];
								$ldate=$stockdetails['Requisition']['dateupdate'];
								$tqty=$stockdetails['0']['quantity'];
							}
							
 
							/*p($stockdetails);
							die();*/
						?>
						<?php echo $this->Form->input("Requisitiondetail.$i.id");?>										 
					<tbody>
						<td><?php echo $data['finalcode'];?></td>
						<td>
							<?php echo $this->Form->input("Requisitiondetail.$i.product_id",array('class'=>'form-horizontal','label'=>false,'id'=>'Requisitiondetail','type'=>'hidden','default'=>$products[$stock['product_id']])); ?>


							<?php echo $this->Form->input("Requisitiondetail.$i.finalcode",array('class'=>'form-horizontal','label'=>false,'id'=>'Requisitiondetail','type'=>'hidden','default'=>$data['finalcode'])); ?>

								<?php echo $products[$stock['product_id']];?>
						</td>
						<td>
							<?php echo $stock['quantity'];?>
							 
						</td>
						<td><?php echo $balance;?></td>
						<td>
							
							<?php echo $this->Form->input("Requisitiondetail.$i.purpose",array('class'=>'form-control','type'=>'hidden','label'=>false));?>
				            <?php echo $stock['purpose'];?>
				        </td>
						<td><?php echo $lqty;?></td>
						<td><?php echo $ldate;?></td>
						<td><?php echo $lpur;?></td>
						<td><?php echo $tqty;?></td>
						<td><?php


						$sval=$stock['quantity'];

						 echo $this->Form->input("Requisitiondetail.$i.quantity",array('class'=>'form-horizontal qunt','label'=>false,'value'=>$stock['quantity'],'onkeyup'=>"validValues(this.value,$sval,$i)",'onclick'=>"validValues(this.value,$sval,$i)")); ?>

							<?php echo $this->Form->input("Requisitiondetail.$i.rquantity",array('type'=>'hidden','value'=>$stock['quantity'])); ?>
						</td>
						<td> 
							<?php echo $this->Form->input("Requisitiondetail.$i.status",array('onchange' => "checkpurposes(this.value,$i);",'class'=>'form-horizontal','label'=>false,'options'=>$approvestatus));?>


							 <?php echo $this->Form->input("Requisitiondetail.$i.purposeothers",array('class'=>'form-horizontal purpose','type'=>'text','rows'=>'1','label'=>false,'id'=>'purpose'.$i,'style'=>'display:none'));?> 
						</td>
					</tbody>
					<?php $i++; } ?>
				</table>


				<div style="clear: both;height: 10px;"></div>
				<!-- <table class="table table-bordered">
					<thead>
						<tr>
							<th>Product name</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Purpose</th> 
						</tr>
					</thead>										 
					<tbody>
						<?php 

						$i=0;
						foreach ($stocks as $stock) { 
						?>
						<?php echo $this->Form->input("Requisitiondetail.$i.id");?>
			                    
						<tr>
							<td>
								<?php echo $this->Form->input("Requisitiondetail.$i.product_id",array('class'=>'form-horizontal','label'=>false,'id'=>'Requisitiondetail','type'=>'hidden','default'=>$products[$stock['product_id']])); ?>

								<?php echo $products[$stock['product_id']];?>
							</td>
							<td>
								<?php echo $this->Form->input("Requisitiondetail.$i.quantity",array('class'=>'form-horizontal','label'=>false,'value'=>$stock['quantity'])); ?>
								
							<td>
								<?php echo $this->Form->input("Requisitiondetail.$i.measure_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','value'=>$stock['measure_id'])); ?>
				                            <?php echo $measures[$stock['measure_id']];?>
							</td>
							<td>
								<?php echo $this->Form->input("Requisitiondetail.$i.purpose",array('class'=>'form-control','type'=>'hidden','label'=>false));?>
				                           <?php echo $stock['purpose'];?>
							</td>
					    </tr>
						<?php $i++; } ?>
			    	</tbody>
				</table> 
               onClick="getStatusApprove($rejectid);" 'javascript:void(0)'

			-->
			</div>  
			<div style="clear: both; height: 5px;"></div>
			<div class="col-sm-12" style="text-align: center;">  
				<button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;" >Submit</button> 
			</div> 
		</div>
	</div>
</div>
<script>
 function checkpurposes(vl,i){  

 	
            if(vl==3){

                $("#purpose"+i).show();
            }else{
                $("#purpose"+i).hide();
            }
        }

</script>