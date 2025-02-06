<?php echo $this->Html->css('print-style3'); ?>
<?php
 $data=$this->request->data;

 $purpose = ClassRegistry::init('Requisitiondetail')->find('list',array('fields'=>array('Requisitiondetail.product_id','Requisitiondetail.purpose'),'conditions'=>array('Requisitiondetail.requisition_id'=>$deliveryviews[0]['Requisition']['id'])));
   
 
?>
<style>
    .f-family1{ line-height: 8px; }
    .f-family2{ line-height: 8px;}
    .f-family3{line-height: 8px; }
	.my-paragraph{
		padding: 0px 15px;
	}
	
	.my-right-align{
		text-align:right;
	}
	
	.my-heading{
		font-size:20px;
		text-align:center;
		font-weight:bold;
	}
	
	.my-space-1{
		height:5px;
	}
	.my-space-2{
		height:10px;
	}
	.my-space-3{
		height:15px;
	}
	.my-space-4{
		height:20px;
	}
	.my-space-5{
		height:40px;
	}
	
	table.borderless td,table.borderless th{
		border: none !important;
		
	}
	
	table.my-padding-0 td,table.borderless th{
		padding: 2px 10px !important;
		
	}
	
	table.my-padding-1 td,table.borderless th{
		padding: 5px 10px !important;
		
	}
	
	.my-flat-input{
		width:100%; height:100%;
		border:none;
	}
        .rf{
            float: right;
        }
        
        .lf{
            float: left;
        }
        .panel-title{
                font-family: inherit;
                font-size: 16px; 
                font-weight: bold;
            }
        .thla th {
            color: #0088cc;
            text-align: center!important;
        }
        .ed{
            margin-top: 5px;
        }
        h4 { color: green; text-align: center;}
        @media print{
            table.borderless td,table.borderless th{
		border: none !important;
		
            }

            table.my-padding-0 td,table.borderless th{
                    padding: 2px 10px !important;

            }

            table.my-padding-1 td,table.borderless th{
                    padding: 5px 10px !important;

            }
            .navbar navbar-inverse navbar-fixed-top {
                display: none;
            }
            #left{
                display: none;
            }
            .btn-info{
                display: none;
            }
            .panel-title{
                font-family: inherit;
                font-size: 16px; 
                font-weight: bold;
            }
            .thla th {
                color: #0088cc;
                text-align: center!important;
            }

	}
</style>

	<br><br>
<div class="col-sm-10 col-sm-offset-1">			
    <div class="row">
        <div class="col-lg-12">
            <h4 class="btn-info"><?php echo $this->Session->flash(); ?></h4>
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
                        <div class="col-sm-2 log-h1">
                            <h2>Delivered</h2>
                        </div> 
                        <div class="col-sm-6 log-h2">
                            <span>
                                <div></div>
                                Requisition No : <b><?php echo $deliveryviews[0]['Requisition']['requisitionno'];?></b>
                            </span><br> 
                            <span>Requisition Date : <b><?php echo date("d-m-Y",strtotime($deliveryviews[0]['Requisition']['created'])); ?></b></span>
                            <span>
                                <div></div>
                                Req. Approval No : <b><?php echo $deliveryviews[0]['Requisition']['requisitionno'];?></b>
                            </span><br> 
                            <span>Delivery Order No : <b><?php echo $deliveryviews[0]['Delivery']['orderid'];?></b></span>
                        </div>             
                        <div style="clear: both;"></div>
                    </div> 

                <div class="panel-body">
                    <!-- My Invoice Start -->
                    <form action="" method="POST">
                        <div class="col-sm-12 my-padding">
                            <div class="col-sm-6 my-left-padding">
                                <table class="table table-bordered tb-ones">
                                    <tr>
                                        <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner </td>
                                        <td><?php echo h($deliveryviews[0]['User']['name']); ?></td> 
                                    </tr>
                                    <tr>
                                        <td>Designation </td>
                                        <td><?php echo h($deliveryviews[0]['Designation']['name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Department </td>
                                        <td><?php echo h($deliveryviews[0]['Department']['name']); ?></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="col-sm-6 my-right-padding">
                                <table class="table table-bordered tb-oness">
                                    <tr>
                                        <td>Phone </td>
                                        <td><?php echo h($deliveryviews[0]['User']['mobile']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email </td>
                                        <td><?php echo h($deliveryviews[0]['User']['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Delivery location </td>
                                        <td><?php echo h($deliveryviews[0]['Requisition']['location']); ?></td>
                                    </tr>
                                </table>
                            </div> 
                        </div> 
                        <div style="clear: both; height: 10px;"> </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover cntr thla ">
                                    <thead>
                                        <tr>
                                            <th colspan="5">Product</th> 
                                        </tr>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Quantity</th> 
                                            <th>Purpose</th> 
                                        </tr> 
                                    </thead>                                         
                                    <tbody>
                                        <?php 

                                            $i=1;

                                            foreach ($deliveryviews as $deliveryview): 

                                            /*p($deliveryview);*/
                                            $description=$deliveryview['SubCategory']['name'].' - '.$products[$deliveryview['Deliverydetail']['product_id']]; 
                                            
                                            if(!empty($deliveryview['Brand']['name'])){
                                                $description.=' - '.'<span title="Model" style="cursor:pointer">'.$deliveryview['Brand']['name'].'</span>';
                                            }

                                            if(!empty($deliveryview['Size']['name'])){
                                                $description.=' - '.'<span title="Size" style="cursor:pointer">'.$deliveryview['Size']['name'].'</span>';
                                            }

                                            if(!empty($deliveryview['Color']['name'])){
                                                $description.=' - '.'<span title="Color" style="cursor:pointer">'.$deliveryview['Color']['name'].'</span>';
                                            }
                                        ?> 

                                        <tr>
                                            <td><?php echo  $i++;?></td>
                                            <td><?php echo $deliveryview['Products']['finalcode']; ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input("Deliverydetail.$i.product_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','default'=>$deliveryview['Deliverydetail']['product_id'])); ?>

                                                 
                                                <?php echo $description;?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input("Deliverydetail.$i.quantity",array('class'=>'form-horizontal','label'=>false,'value'=>$deliveryview['Deliverydetail']['quantity'],'type'=>'hidden')); ?>
                                                <?php echo $deliveryview['Deliverydetail']['quantity'];?>
                                                <?php echo $measures[$deliveryview['Deliverydetail']['measure_id']];?>
                                            </td> 
                                            <td><?php echo $purpose[$deliveryview['Deliverydetail']['product_id']]; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
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
                                        <span class="f-span">Received By</span><br>
                                        <h6 class="f-spans"><?php echo h($deliveryviews[0]['User']['name']); ?></h6>
                                        <span><?php echo date("d-m-Y",strtotime($deliveryviews[0]['Delivery']['created'])); ?></span>
                                    </td>
                                    <td>
                                        <span class="f-span">Approved By</span><br>
                                        <h6 class="f-spans"><?php echo h($users[$deliveryviews[0]['Requisition']['approvedBy']]); ?></h6>
                                        <span><?php echo date("d-m-Y",strtotime($deliveryviews[0]['Requisition']['dateupdate']));?></span>
                                    </td>
                                    <td>
                                        <span class="f-span">Delivered By</span><br>
                                        <h6 class="f-spans"><?php echo h($deliveryviews[0]['Deliveryuser']['name']); ?></h6>
                                        <span><?php echo date("d-m-Y",strtotime($deliveryviews[0]['Delivery']['created'])); ?></span>
                                    </td>
                                </tr>
                                <tr class="ipsita">
                                    <td colspan="1"></td>
                                    <td colspan="2"><small>কারিগরি সহায়তায়ঃ&nbsp;<a href="http://ipsitasoft.com"> ইপসি্‌তা কম্পিউটার্স প্রাঃ লিঃ</a></small></td> 
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>
                        <!-- My Invoice End -->

        </div>
        <div class="col-xs-12" style="text-align: center;">
            <?php 
                if($currentUser['role_id'] ==1 ) {
                    if($this->params['pass'][1]=='views'){
                        echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'deliveries','action' => 'index'),array('class'=>'btn btn-warning','escape' =>false));
                    } 
                }elseif($currentUser['role_id'] ==2 ) {
                    if ($this->params['pass'][1]=='deliver') {
                        echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'requisitions','action' => 'requisitionapprove'),array('class'=>'btn btn-warning','escape' =>false));
                    }elseif($this->params['pass'][1]=='views'){
                        echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'deliveries','action' => 'index'),array('class'=>'btn btn-warning','escape' =>false));
                    }
                }elseif($currentUser['role_id'] ==3 ) {
                    if ($this->params['pass'][1]=='deliviewed') {
                        echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'requisitions','action' => 'requisitiondelivery'),array('class'=>'btn btn-warning','escape' =>false));
                    }
                }elseif($currentUser['role_id'] ==4 ) {
                    if($this->params['pass'][1]=='views'){
                        echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'deliveries','action' => 'index'),array('class'=>'btn btn-warning','escape' =>false));
                    }
                } 
            ?> 

            <?php echo $this->Form->button(('<i class="fa fa-print">  </i> Print'), array('action' => 'index','onclick'=>'PrintDoc()','class'=>'btn btn-info')); ?> 
        </div>
    </div>
</div>


<script type="text/javascript">
    function PrintDoc() {
    
        var toPrint = document.getElementById('SelectorToPrint');
    
        var popupWin = window.open('', '_blank', '');
    
        popupWin.document.open();
    
        popupWin.document.write('<html><title>Delivered<?php echo $deliveryviews[0]['Delivery']['orderid'];?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/print-style3.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">');
    
        popupWin.document.write(toPrint.innerHTML);
    
        popupWin.document.write('</html>');
    
        popupWin.document.close();
    
    }
</script>