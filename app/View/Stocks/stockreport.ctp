<?php echo $this->Html->css('stockstyle');?> 

<style> 
    .panel-heading {
    	padding-bottom: 0px!important;
    	border-bottom: 0px!important;
    }
    .panel-title{
            font-family: inherit;
            font-size: 16px; 
            font-weight: bold;
        }
    .thla th {
        color: #0088cc;
        text-align: left;
    }
    .st-table {
    	width: 100%;
    }
    .st-table > thead > tr > th:nth-child(1), .st-table > thead > tr > th:nth-child(2) {
    	width: 15%;
    	vertical-align: middle;
    }
    .st-table > thead > tr > th:nth-child(3) {
    	width: 34%;
    	vertical-align: middle;
    }
    .st-table > thead > tr > th:nth-child(4), .st-table > thead > tr > th:nth-child(5), .st-table > thead > tr > th:nth-child(6) {
    	width: 12%;
    	vertical-align: middle;
    }
    .st-date {
    	text-align: center;
    	font-weight: bold;
    	vertical-align: middle!important;
    }
    .hd-spn {
    	border-bottom: 1px solid #FFF;
    } 
    .btn-default {
    	margin-top: 10px;
    	border-bottom: 0px;
    	border-bottom-left-radius: 0px;
    	border-bottom-right-radius: 0px;
    }
    .b0 {
    	color: #000000!important; 
    	margin: 0px!important;
    	border: 1px solid #ccc;
	    border-radius: 4px;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
	    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
	    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
	    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s; 
    }
    .btn-class a.b1 {
    	color: #00A651!important;
    	font-size: 16px;
    }
    .btn-class a.b2 {
    	color: #000000!important;
    	font-size: 16px;
    }
</style>
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>

<script type="text/javascript">
  	$(function() {

	    $( "#datepicker").datepicker(
	      {
	          dateFormat:'yy-mm-dd',
	          changeMonth:true,
	          changeYear:true,
	          yearRange:"-10:+5",

	      }
	    );
  	}); 
 
  	$(function() {

	    $( "#datepicker1").datepicker(
	      {
	          dateFormat:'yy-mm-dd',
	          changeMonth:true,
	          changeYear:true,
	          yearRange:"-10:+5",

	      }
	    );
  	});


	var path='<?php echo $this->webroot;?>';
    function codeVerify(code){
       
        $.ajax({
            type: 'POST',
            url: path +'products/pascode',
            data: {code:code},
            success: function(data){
                var res = data.split("/");
                 $('#PurchasedetailProductId').val(res[0]);
                
                            
            }
        });
    }
    function getDistrictId(id){   
        var href = id; 
        if (href) window.open(href,"_self");
    }
</script>

<?php 
	if ($currentUser['role_id']==5) {
        $distid= $this->params['pass'][0];
        $distids= $this->params['pass'][0];
    }else{
        $distid = $currentUser['district_id'];
        $distids='';
    }
?>


<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
          	<h3 class="panel-title"> <span class="hd-spn"><?php echo __('তারিখ অনুসারে পণ্যদ্রব্যের স্টক'); ?> </span></h3>
          	<div class="col-sm-12 btn-class">
          		<?php  
          			echo $this->Html->link(__('স্টক ইন/আউট রিপোর্ট'), array('action' => 'stockreport',$distids),array('class'=>'btn btn-default b1','escape'=>false)); 
          			echo $this->Html->link(__('পণ্যদ্রব্যের রিপোর্ট'), array('action' => 'datewisestock',$distids),array('class'=>'btn btn-default b2','escape'=>false)); 
          		?> 
          	</div>
          	<div style="clear: both;"></div>
        </div>
        <div class="panel-body">
        	<div class="col-sm-10 col-sm-offset-1"> 

    			<?php echo $this->Form->create ('Report', array ('name' => 'form') ); ?>
            	<table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                	<tr>  
					<?php
						$pcode=null;
						if(!empty($this->request->data['Report']['code'])){
							$pcode= $this->request->data['Report']['code'];
						}

						if (!empty($distids)) {
          					echo "<td>".$this->Form->input('district_id',array('type'=>'select','options'=>$districtList,'empty'=>'Select','label'=>false,'div'=>false,'selected'=>$distid,'onChange'=>'getDistrictId(this.value);','class'=>'btn btn-default b0'))."</td>";
          				}
					?> 
                    <td> 
						<input type="text" name="data[Report][code]" class="form-control" value="<?php echo $pcode?>" placeholder="Product Code" autocomplete="off" >

                    </td>
                    <td>
                        <?php echo $this->Form->input ('frommonth', array ('class' => 'form-control','id'=>'datepicker', 'label' => false,'required'=>false,'placeholder'=>'From','autocomplete'=>'off') );?> 
                    </td>
                    <td>
                        <?php echo $this->Form->input ('tomonth', array ('class' => 'form-control','id'=>'datepicker1', 'label' => false,'required'=>false,'placeholder'=>'To','autocomplete'=>'off') );?> 
                    </td>
                    <td>
                         <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') ); ?>
                    </td>
                    <td>
                    	<?php echo $this->Html->link(__('Refresh'), array('action' => 'stockreport',$distids),array('class'=>'btn btn-warning','escape'=>false)); ?>  
                    </td>
                </tr>
            </table>
            <?php echo $this->Form->end (); ?>
            <div id="SelectorToPrint">
	            <table class="table table-bordered st-table" id="dataTables-example">
			 		<thead>
			 			<tr>
			 				<th colspan="6" style="padding: 0px!important;">
			 					<div class="my-heading">
			                        <div class="col-sm-4 log-h">
			                            <img src="<?php echo $this->webroot;?>img/logo/doict_logo.png">
			                            <span class="one">
			                                <div class="c-height"></div>
			                                তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর
			                            </span>
			                            <br>
			                            <span class="two">Department OF ICT</span>
			                        </div> 
			                        <div class="col-sm-4 log-h1">
			                            <h2>স্টক ইন/আউট রিপোর্ট</h2>
			                            <?php if (!empty($distids)) {
			                            	echo "<label>".$districtList[$distids]."</label>";
			                            }?> 
			                        </div> 
			                        <div class="col-sm-4 log-h2">
			                            <span>
			                                <div class="c-height"></div>
			                                
			                            </span><br>
			                            <span></span>
			                        </div>             
			                    	<div style="clear: both;"></div>
			                    </div>
			 				</th>
			 			</tr>
		                <tr>
		                	<th>Stock Date</th>
		                	<th>Product Code</th>
		                    <th>Product Name</th>
		                    <th>Stock In</th>
		                    <th>Stock Out</th>
		                     <th>Balance</th>
		                </tr> 
		            </thead>
		        <?php  
		        	$productlist=array();

		        	$pcode=array();
			        foreach ($stockprodcucts as $stock){ 
						$pid=$stock['Product']['id'];
						$description=$stock['Product']['name'];
						
					    if(!empty($stock['Brand']['name'])){
					    	$description.=' - '.$stock['Brand']['name'];
					    }
						if(!empty($stock['Color']['name'])){
					    	$description.=' - '.$stock['Color']['name'];
					    }
					    if(!empty($stock['Size']['name'])){
					    	$description.=' - '.$stock['Size']['name'];
					    }
					    $productlist[$pid]=$description;

					    $pcode[$pid]=$stock['Product']['finalcode'];
				    } 
			    ?>         
	              
	            <?php

	             	$ext="1=1";
	             	$ext1="1=1";
	              	$ext2="1=1";
	              	$ext3="1=1";
	              	$ext4="1=1";
	              	$cadte=date('Y-m-d');
				
					if(!empty($this->request->data['Report']['frommonth']) || !empty($this->request->data['Report']['tomonth'])){
						$sadte=$this->request->data['Report']['frommonth'];
						$eadte=$this->request->data['Report']['tomonth'];

						$ext.=" AND stocks.ddate BETWEEN '".$sadte."' AND '".$eadte."'";
						$ext1.=" AND purchasedetails.ddate BETWEEN '".$sadte."' AND '".$eadte."'";
						$ext2.=" AND deliverydetails.ddate BETWEEN '".$sadte."' AND '".$eadte."'";
						$ext3.=" AND damages.ddate BETWEEN '".$sadte."' AND '".$eadte."'";
						$ext4.=" AND requisitionreturns.ddate BETWEEN '".$sadte."' AND '".$eadte."'";
					}else{
						$ext.=" AND stocks.ddate BETWEEN '".$cadte."' AND '".$cadte."'";
						$ext1.=" AND purchasedetails.ddate BETWEEN '".$cadte."' AND '".$cadte."'";
						$ext2.=" AND deliverydetails.ddate BETWEEN '".$cadte."' AND '".$cadte."'";
						$ext3.=" AND damages.ddate BETWEEN '".$cadte."' AND '".$cadte."'";
						$ext4.=" AND requisitionreturns.ddate BETWEEN '".$cadte."' AND '".$cadte."'";
					}

					
					if(!empty($this->request->data['Report']['code'])){

						$code=$this->request->data['Report']['code'];

						$p_data=classRegistry::init('Product')->find('first',array('conditions'=>array('Product.finalcode'=>$code)));

						$pid=$p_data['Product']['id'];
						$ext.=" AND stocks.product_id=".$pid."";
						$ext1.=" AND purchasedetails.product_id=".$pid."";
						$ext2.=" AND deliverydetails.product_id=".$pid."";
						$ext3.=" AND damages.product_id=".$pid."";
						$ext4.=" AND requisitionreturns.product_id=".$pid."";
					}

					$ext.=" AND stocks.district_id=".$distid."";
					$ext1.=" AND purchasedetails.district_id=".$distid."";
					$ext2.=" AND deliverydetails.district_id=".$distid."";
					$ext3.=" AND damages.district_id=".$distid."";
					$ext4.=" AND requisitionreturns.district_id=".$distid."";


					  $sql  = "SELECT stocks.product_id,stocks.ddate AS dt,SUM(stocks.quantity) AS quantity,0 AS outQty FROM stocks WHERE $ext GROUP BY stocks.product_id
				         UNION
						SELECT purchasedetails.product_id,purchasedetails.ddate AS dt,SUM(purchasedetails.quantity) AS quantity,0 AS outQty FROM purchasedetails WHERE $ext1 GROUP BY purchasedetails.ddate,purchasedetails.product_id 
						UNION
						SELECT deliverydetails.product_id,deliverydetails.ddate AS dt,0 AS quantity,SUM(deliverydetails.quantity) AS outQty FROM deliverydetails WHERE $ext2 GROUP BY deliverydetails.ddate,deliverydetails.product_id
						UNION
						SELECT damages.product_id,damages.ddate AS dt,0 AS quantity,SUM(damages.quantity) AS outQty FROM damages WHERE $ext3 GROUP BY damages.ddate,damages.product_id
						UNION
						SELECT requisitionreturns.product_id,requisitionreturns.ddate AS dt,SUM(requisitionreturns.quantity) AS quantity,0 AS outQty FROM requisitionreturns WHERE $ext4 GROUP BY requisitionreturns.ddate,requisitionreturns.product_id ORDER BY dt
						";

					$result = connect($sql);
					$datas=array();
					while($data = mysql_fetch_array($result)){
						$datas[]=$data;
					} 

					$result = array();
					
					//rsort($datas);
					foreach ($datas as $data1) {
					  $id = $data1['dt'];
					  if (isset($result[$id])) {
					     $result[$id][$data1['product_id']][] = $data1;
					  } else {
					     $result[$id][$data1['product_id']] = array($data1);
					  }
					} 
		
					$resultarray=array();
					$m=0;
					foreach($result as $key=>$results){
						$trow = count($results); 
						
				?> 
			 	
		            <tbody>
		                <tr>
		                	<td rowspan="<?php echo $trow; ?>" class="st-date"><?php echo $key;?></td>
							<?php  
								foreach($results as $keys=>$results2){
								$tinqty=$toqty=0;
								$i=1;
								$count=count($results2);
								
								foreach($results2 as $results3){
									
								$pid=$results3['product_id'];
							
								if($pid==$keys){
									$tinqty=$tinqty+$results3['quantity'];
									$toqty=$toqty+$results3['outQty'];
								}
								
								if($count==$i){ 

								$p_date=date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $key) ) ));
								
								$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity, dm.dmquantity, rr.rrquantity FROM products 
									AS pt LEFT JOIN
									( 
										SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
										FROM stocks WHERE stocks.ddate<='".$p_date."' AND stocks.district_id='".$distid."' GROUP BY stocks.product_id 
									) 
									AS s ON pt.id = s.product_id LEFT JOIN 
									( 
										SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
										FROM purchasedetails WHERE purchasedetails.ddate<='".$p_date."' AND purchasedetails.district_id='".$distid."' GROUP BY purchasedetails.product_id 
									)
									 AS p ON pt.id = p.product_id LEFT JOIN 
									( 
										SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
										FROM deliverydetails WHERE deliverydetails.ddate<='".$p_date."' AND deliverydetails.district_id='".$distid."' GROUP BY deliverydetails.product_id 
									)
									AS d ON pt.id = d.product_id LEFT JOIN
	                                ( 
	                                    SELECT requisitionreturns.product_id,SUM(requisitionreturns.quantity) AS rrquantity 
	                                    FROM requisitionreturns WHERE requisitionreturns.ddate<='".$p_date."' AND requisitionreturns.district_id='".$distid."' GROUP BY requisitionreturns.product_id 
	                                )
	                                AS rr ON pt.id = rr.product_id LEFT JOIN
	                                ( 
	                                    SELECT damages.product_id,SUM(damages.quantity) AS dmquantity 
	                                    FROM damages WHERE damages.ddate<='".$p_date."' AND damages.district_id='".$distid."' GROUP BY damages.product_id 
	                                )
	                                AS dm ON pt.id = dm.product_id 
									WHERE pt.id='".$pid."'
									GROUP BY pt.id 
									";
									
									$stockdata = getQueryData($sql);
									
									$stockIn=$stockdata['pquantity']+$stockdata['squantity']+$data['rrquantity'];
									$stockOut=$stockdata['dquantity']+$data['dmquantity'];
									$closingbalance=$stockIn-$stockOut;
									
							?>
							<td>
		                      <?php 
		                            echo $pcode[$pid];
		                          ?>
		                    </td>
		                    <td>
		                      <?php 
		                            echo $productlist[$pid];
		                          ?>
		                    </td>
		                    <td >
		                        <?php 
		                        	echo $finalIn=$closingbalance+$tinqty;
		                        ?>
		                    </td>
		                    <td ><?php echo $toqty; ?></td>
		                     <td ><?php echo $finalIn-$toqty; ?></td>
		                </tr>
						<?php  }
					
							$i++;
						} 


					}
					
					?>
					</tbody>																			
			
				<?php  } ?> 
					</table>
				</div>
				<div class="col-xs-12 text-center">
	                <button href="#" class="btn btn-info" onclick="PrintDoc()"><span class="fa fa-print"></span> Print</button> 
	            </div>
			</div>
    	</div>
	</div>
</div>


<script type="text/javascript">
	function PrintDoc() {
	
	    var toPrint = document.getElementById('SelectorToPrint');
	
	    var popupWin = window.open('', '_blank', '');
	
	    popupWin.document.open();
	
	    popupWin.document.write('<html><title>StockIn/Out<?php echo date("Ymdhis");?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/stockstyle.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">');
	
	    popupWin.document.write(toPrint.innerHTML);
	
	    popupWin.document.write('</html>');
	
	    popupWin.document.close();
	
	}
</script>