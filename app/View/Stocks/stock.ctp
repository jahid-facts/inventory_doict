<style>
    .btn.btn-rounded {
        background: #0a99d4 none repeat scroll 0 0;
        border-radius: 12px;
        border-width: 2px;
        color: #fff;
        font-weight: 600;
        padding: 2px 10px;
        float: right;
        margin-top: -5px;
    }
    .btn.btn-rnd {
        background: #0a99d4 none repeat scroll 0 0;
        color: #fff;
        font-weight: 600;
    }
    .btn.btn-rnd:hover,.btn.btn-rnd:focus{
        color: #0a99d4;
    }
    .panel-title{
        font-family: inherit;
        font-size: 16px; 
        font-weight: bold;
    } 
   .add-span a {
        float: right;
    }
    .thla th {
        color: #173a18;
        text-align: left;
    }
    input[type="search"] {
        border:1px solid #8dc641;
    }
    
    .thla th:nth-child(1), .thla th:nth-child(2), .thla th:nth-child(3), .thla th:nth-child(4), .thla th:nth-child(5), .thla th:nth-child(6){
        border-right: 1px solid #a0a0a0;
        text-align: center;
    }
    .thla td:nth-child(1), .thla td:nth-child(2), .thla td:nth-child(3), .thla td:nth-child(4), .thla td:nth-child(5), .thla td:nth-child(6){
        border-right: 1px solid #a0a0a0;
    }
    table.dataTable thead th {
        border-bottom: 1px solid #a0a0a0!important;
    }
    #example {
        border: 1px solid #a0a0a0;
    }
    
    ul.tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #DFF0D8;
    }

    /* Float the list items side by side */
    ul.tab li {float: left;}

    /* Style the links inside the list items */
    ul.tab li a {
        display: inline-block;
        color: #173a18;
        text-align: center;
        padding: 5px 10px;
        text-decoration: none;
        transition: 0.3s;
        font-size: 14px;
        font-weight: bold;
    }

    /* Change background color of links on hover */
    ul.tab li a:hover {
        background-color: #8dc641;
        color: #fff;
    }

    /* Create an active/current tablink class */
    ul.tab li a:focus, .active {
        background-color: #8dc641;
        color:#fff;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #8dc641; 
    }
    .pr {
        padding-right: 0px;
      }
    .pl {
        padding-left: 0px;
    }
    .br-rdr {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .br-btn {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        border: 1px solid #ccc;
        line-height: 20px;
    }
    #district_id {
        color: #000;
        font-size: 14px;
    }
</style>
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/jquery.dataTables.min.css"> 

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
</script>
<script type="text/javascript">
	var path='<?php echo $this->webroot;?>';
	function getCategory(id){ 
        var disId= "<?php echo $this->params['pass'][0]?>"; 
		$.ajax({	
			type: 'POST',
			url: path +'stocks/getcategory',
			data: {id:id,disId:disId},
			success: function(data){
				$('.thla').remove();
				$('.othetcat').html(data);
			}
		});
	}
    function getDistrictId(id){   
        var href = id; 
        if (href) window.open(href,"_self");
    }
</script>


<div class="user index">
    <div style="height:20px;"></div>

    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> 
            <?php 
                if ($currentUser['role_id']==5) {
                    $distid= $this->params['pass'][0];
                    if ($distid==100) {
                        echo "<a href='".$this->webroot."users/individual/district/".$distid."'>ICT Division (Central)</a>  / পণ্যদ্রব্যের স্টক";
                    }else{
                        echo $this->Form->input('district_id',array('type'=>'select','options'=>$districtList,'empty'=>'Select','label'=>false,'div'=>false,'selected'=>$distid,'onChange'=>'getDistrictId(this.value);')); 
                        echo "<i class='fa fa-caret-right'></i> পণ্যদ্রব্যের স্টক";  
                    }?> 
                    <span class="add-span">
                        <?php echo $this->Html->link(__('<span class="fa fa-reply"></span> Back'), array('controller'=>'users','action' => 'individual','district',$distid),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                    </span>
            <?php }else{
                    echo __('পণ্যদ্রব্যের স্টক');
                }   
            ?> 
        </h3>
        </div>
        <div class="panel-body">   
            <div style="clear: both; height: 1px;"></div>  
            <ul class="tab">
           		 <li class="active"><a href="javascript:void(0)" onclick="getCategory(0);"  class="tablinks" >All Products</a></li>
                <li ><a href="javascript:void(0)" style="display: none;"  class="tablinks"   onclick="openCity(event, 'AllProducts')" id="defaultOpen">All Products</a></li> 
                <?php
                    foreach ($categories as $category): 
                    $imgId=$category['Category']['id'];
                ?> 
                    <li><a href="javascript:void(0)" class="tablinks" onclick="getCategory(<?php echo $imgId;?>)" ><?php echo $category['Category']['name'];?></a></li> 
                <?php endforeach; ?> 
            </ul>
            <div style="clear: both; height: 1px;"></div>
            <div id="AllProducts" class="tabcontent">    
                <div class="table-responsive">
                    <div class="thla"> 
                        <script src="<?php echo $this->webroot;?>js/jquery.dataTables.min.js"></script> 
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#example').DataTable( {
                                    "pagingType": "full_numbers"
                                } );
                            } );
                        </script> 
            		
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th colspan="4">Product</th>
                                    <th colspan="2">Product Adjustment Quantity</th> 
                                    <?php if($currentUser['role_id'] !=3) {?>
                                    <th rowspan="2">Balance</th>
                                    <?php }else{?>
                                    <th rowspan="2">Stock</th>
                                    <?php }?>
                                </tr>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th> 
                                    <th>Stock In</th>
                                    <th>Stock Out</th>
                                    <th>Missing</th>
                                    <th>Damage</th>                        
                                </tr>
                            </thead>

                			<tbody>

                    			<?php

                        			$i=0;

                        			foreach ($stockprodcucts as $stock): 
                        			$i++;
                        			//echo p($stock);
                        			$pid=$stock['Product']['id'];
                        			$description=/*$stock['Category']['name'].'->'.*/$stock['SubCategory']['name'].' - '.$stock['Product']['name'];
                                    $pdcodes=$stock['Category']['cCode'].$stock['SubCategory']['sCode'].$stock['Product']['productcode'];
                        			
                        		    if(!empty($stock['Brand']['name'])){
                        		    	$description.=' - '.'<span title="Model" style="cursor:pointer">'.$stock['Brand']['name'].'</span>';
                        		    }
                                    if(!empty($stock['Size']['name'])){
                                        $description.=' - '.'<span title="Size" style="cursor:pointer">'.$stock['Size']['name'].'</span>';
                                    }
                        			if(!empty($stock['Color']['name'])){
                        		    	$description.=' - '.'<span title="Color" style="cursor:pointer">'.$stock['Color']['name'].'</span>';
                        		    }

                        			$cdate=date('Y-m-d');
                        			
                        			$pdate=date('Y-m-d', strtotime('-1 days'));

                                    if ($currentUser['role_id']==5) {
                                        $distid= $this->params['pass'][0];
                                    }else{
                                        $distid = $currentUser['district_id'];
                                    } 
                        			
                					$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity,rr.rrquantity,ds.dsquantity,dm.dmquantity FROM products 
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
                                        FROM damages WHERE damages.type=1 AND damages.district_id=$distid  GROUP BY damages.product_id 
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
                                     
                    			
                    			?>
            			
            			
            					
                                <tr>
                                    <td><?php echo $pdcodes; ?>&nbsp;</td>
                                    <td>
                                        <?php  echo $description; ?>
                                    </td> 
                                    <?php if($currentUser['role_id'] !=3) {?>
                                    <td><?php echo $stockIn; ?>&nbsp;</td>
                                    <td><?php echo $stockOut; ?>&nbsp;</td>
                                    <?php }?>
                                    <td><?php echo $data['dmquantity'];?></td>
                                    <td><?php echo $data['dsquantity'];?></td>
                                    <td><?php echo $balance.' '.$stock['Measure']['name']; ?>&nbsp;</td>
                                </tr>

                            <?php endforeach; ?>          
                            <tbody>
            		    </table>
            		</div>
            		<div class="othetcat"></div>
                </div>
            </div>
            <?php foreach ($categories as $category):  $imgId=$category['Category']['id']; ?>

                <div id=$imgId class="tabcontent">
                    <h3>Stationary</h3>
                    <p>Paris is the capital of France.</p>
                </div>
                              
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!--Tab Link Start-->
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();
</script>
<!--Tab Link End-->