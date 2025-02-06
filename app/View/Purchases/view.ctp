<?php   
    echo $this->Html->css('print-style');                                       
?> 
	
<div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-1">			
    <br>
    	<?php echo $this->Session->flash(); ?>
    <br>	
    <div class="row">
        <div class="col-sm-12">
            <div id="SelectorToPrint" class="form printform">
                <div class="panel panel-default">
                    <div class="panel-heading my-heading">
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
                            <h2>Purchase Invoice</h2>
                        </div> 
                        <div class="col-sm-4 log-h2">
                            <span>
                                <div class="c-height"></div>
                                Invoice No: <b><?php echo h($purchase['Purchase']['invoice']); ?></b>
                            </span><br> 
                            <span>Date: <b><?php echo  date("d-m-Y",strtotime($purchase['Purchase']['created'])); ?></b></span>
                        </div>             
                    	<div style="clear: both;"></div>
                    </div> 
                    <div class="panel-body">
                        <!-- My Invoice Start -->
                        <form action="" method="POST">  
                            <?php if (!empty($purchase['Purchase']['supplier_id'])) {?>
                                <div class="my-space-3"></div>
                                <div class="col-sm-12 my-padding">
                                    <div class="col-sm-6 my-left-padding">
                                        <table class="table table-bordered tb-ones">
                                            <tr>
                                                <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Supplier</td>
                                                <td>
                                                    <?php echo $purchase['Supplier']['name']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email </td>
                                                <td>
                                                    <?php echo h($purchase['Supplier']['email']); ?>
                                                </td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-sm-6 my-right-padding">
                                        <table class="table table-bordered tb-oness">
                                            <tr>
                                                <td>Contact Person </td>
                                                <td>
                                                    <?php echo h($purchase['Supplier']['contactperson']); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tel./Mobile No. </td>
                                                <td>
                                                        <?php echo h($purchase['Supplier']['mobile']); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table class="table table-bordered tb-twos">    
                                        <tr>
                                            <td>Address </td>
                                            <td>
                                                <?php echo h($purchase['Supplier']['address']); ?>
                                            </td>
                                        </tr>                                          
                                    </table>
                                </div>
                            <?php }?> 
                            <div style="clear: both; height: 10px;"> </div> 

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered custable"> 
                                        <thead>
                                            <tr>
                                                <th rowspan="2">SL.</th>
                                                <th colspan="3">Product</th>
                                                <th colspan="4">Purchase New Product</th>
                                                <th rowspan="2">Total Product</th> 
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
                                                $i=1;
                                                $total_price=0;
                                                foreach ($purchasedetails as $purchasedetail):
                                                    $description=$purchasedetail['Product']['name']; 
                                    
                                                    if(!empty($purchasedetail['Brand']['name'])){
                                                        $description.=' - '.'<span title="Model" style="cursor:pointer">'.$purchasedetail['Brand']['name'].'</span>';
                                                    }
                                                    if(!empty($purchasedetail['Size']['name'])){
                                                        $description.=' - '.'<span title="Size" style="cursor:pointer">'.$purchasedetail['Size']['name'].'</span>';
                                                    }
                                                    if(!empty($purchasedetail['Color']['name'])){
                                                        $description.=' - '.'<span title="Color" style="cursor:pointer">'.$purchasedetail['Color']['name'].'</span>';
                                                    }
                                                $total_price_qty=$purchasedetail['Purchasedetail']['price']*$purchasedetail['Purchasedetail']['quantity'];

                                                $total_price=$total_price+$total_price_qty;
                                                $pid=$purchasedetail['Purchasedetail']['product_id'];
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
                                                
                                            ?>
                                            <tr class="th-width">
                                                <td><?php echo   $i++;?></td>
                                                <td><?php echo $purchasedetail['Product']['finalcode']; ?></td>
                                                <td><?php echo $description; ?></td>
                                                <td><?php echo $balance-$purchasedetail['Purchasedetail']['quantity'];?></td>
                                                <td><?php echo $purchasedetail['Purchasedetail']['price']; ?></td>
                                                <td><?php echo $purchasedetail['Purchasedetail']['quantity']; ?></td>
                                                <td><?php echo $purchasedetail['Measure']['name']; ?></td>
                                                <td><?php echo $total_price_qty;?></td>
                                                <td><?php echo $balance;?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr> 
                                                <td colspan="7">Grand Total Price</td>
                                                <td colspan="2"><?php echo $total_price;?> <b>Tk.</b></td>
                                            </tr>
                                        </tbody> 
                                    </table> 
                                </div>
                            </div>  
                        </form>
                    </div>
                    <div class="panel-footer">
                        <div class="col-sm-12">
                            <table class="foot-table" cellspacing="0" cellpadding="0">
                                <tfoot>
                                    <tr>
                                        <td>
                                            <span class="f-span">Approved By</span><br>
                                            <h6 class="f-spans"><?php echo $purchase['Purchase']['approBy'];?></h6>
                                            <span><?php echo date("d-m-Y"); ?></span>
                                        </td>
                                        <td></td>
                                        <td>
                                            <span class="f-span">Purchase By</span><br>
                                            <h6 class="f-spans"><?php echo $purchase['Purchase']['purchBy'];?></h6>
                                            <span><?php echo date("d-m-Y"); ?></span>
                                        </td>
                                    </tr>
                                    <tr class="ipsita">
                                        <td colspan="3"><small>কারিগরি সহায়তায়ঃ&nbsp;<a href="http://ipsitasoft.com"> ইপসি্‌তা কম্পিউটার্স প্রাঃ লিঃ</a></small></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div style="clear: both;"></div>
                    </div> 
                </div>  
            </div>
            <div class="col-xs-12 text-center">
                <?php if ($this->params['pass']='v1') {
                    echo $this -> Html -> link('&nbsp;&nbsp;Back&nbsp;&nbsp;', array('controller' => 'purchases', 'action' => 'purchasereport'),array('class'=>'btn btn-warning','escape'=>false));
                }else{
                    echo $this -> Html -> link('&nbsp;&nbsp;Back&nbsp;&nbsp;', array('controller' => 'purchases', 'action' => 'add'),array('class'=>'btn btn-warning','escape'=>false));
                }?> 
                <button href="#" class="btn btn-info" onclick="PrintDoc()"><span class="fa fa-print"></span>&nbsp;Print&nbsp;</button> 
            </div>
            <div style="clear: both; height: 20px;"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function PrintDoc() { 
	    var toPrint = document.getElementById('SelectorToPrint'); 
	    var popupWin = window.open('', '_blank', ''); 
	    popupWin.document.open(); 
	    popupWin.document.write('<html><title>Purchase<?php echo date("YmdHis"); ?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/print-style.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">'); 
	    popupWin.document.write(toPrint.innerHTML); 
	    popupWin.document.write('</html>'); 
	    popupWin.document.close(); 
	}
</script>