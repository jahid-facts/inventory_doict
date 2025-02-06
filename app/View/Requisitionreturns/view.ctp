<?php echo $this->Html->css('print-style2'); ?>  
<div style="clear: both; height: 20px;"></div>
<div class="col-sm-10 col-sm-offset-1 col-lg-10 col-lg-offset-1">  
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
                        <h2>Product Return</h2>
                    </div> 
                    <div class="col-sm-6 log-h2">
                        <span>
                            <div></div>
                            Pro. Return No: <b><?php echo $returnviews[0]['Requisitionreturn']['rrnumber'];?></b>
                        </span><br> 
                        <span>Date: <b><?php echo date("d-m-Y",strtotime($returnviews[0]['Requisitionreturn']['ddate']));?></b></span>
                    </div>             
                    <div style="clear: both;"></div>
                </div> 

                <div class="panel-body">  
                    <div style="clear: both; height: 10px;"></div>
                    <div class="col-sm-12 my-padding">
                        <div class="col-sm-6 my-left-padding">
                            <table class="table table-bordered tb-ones">
                                <tr>
                                    <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner </td>
                                    <td><?php echo h($returnviews[0]['User']['name']); ?></td>
                                </tr>
                                <tr>
                                    <td>Designation </td>
                                    <td><?php echo h($returnviews[0]['Designation']['name']); ?></td>
                                </tr>
                                <tr>
                                    <td>Department </td>
                                    <td><?php echo h($returnviews[0]['Department']['name']); ?></td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-sm-6 my-right-padding">
                            <table class="table table-bordered tb-oness">
                                <tr>
                                    <td>Phone </td>
                                    <td><?php echo h($returnviews[0]['User']['mobile']); ?></td>
                                </tr>
                                <tr>
                                    <td>Email </td>
                                    <td><?php echo h($returnviews[0]['User']['email']); ?></td>
                                </tr>
                                <tr>
                                    <td>Delivery location </td>
                                    <td><?php echo h($returnviews[0]['Requisition']['location']); ?></td>
                                </tr>
                            </table>
                        </div> 
                    </div> 
                    <div style="clear: both; height: 10px;"> </div>  

                    <div class="row">
                        <div class="col-sm-12"> 
                            <table class="table table-striped table-bordered table-hover cntr thla retun">
                                <thead>
                                    <tr>
                                        <th rowspan="2">SL</th>
                                        <th colspan="3">Product</th>
                                    </tr>
                                    <tr> 
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Return Quantity</th>
                                    </tr>
                                </thead>                                         
                                <tbody>
                                    <?php  
                                        $i=1;  
                                        foreach ($returnviews as $deliveryview): 
                                    ?> 
                                    <tr>
                                        <td><?php echo  $i++;?></td>
                                        <td><?php echo $deliveryview['Products']['finalcode']; ?>
                                        </td>
                                        <td>
                                           <?php echo $deliveryview['Products']['name']; ?>
                                        </td>
                                        <td>
                                           <?php echo $deliveryview['Requisitionreturn']['quantity']; ?>  
                                        </td>

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="col-sm-12">
                        <table class="foot-table" cellspacing="0" cellpadding="0">
                            <tfoot>
                                <tr>
                                    <td>
                                        <span class="f-span">Return By</span><br>
                                        <h6 class="f-spans"><?php echo h($returnviews[0]['User']['name']); ?></h6>
                                        <span><?php echo date("d-m-Y",strtotime($deliveryview['Requisitionreturn']['ddate'])); ?></span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span class="f-span">Return To</span><br>
                                        <h6 class="f-spans"><?php echo $storekeeperuserindexs[$returnviews[0]['Requisitionreturn']['user_id']];?></h6>
                                        <span><?php echo date("d-m-Y",strtotime($deliveryview['Requisitionreturn']['ddate'])); ?></span>
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
            <?php if ($this->params['pass'][1]=='success') {
                    echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'deliveries','action' => 'returnrequisition'),array('class'=>'btn btn-warning','escape' =>false));
                }elseif ($this->params['pass'][1]=='reviews'){ 
                    echo $this->Html->link(__('&nbsp;Back&nbsp;'), array('controller' => 'requisitionreturns','action' => 'index'),array('class'=>'btn btn-warning','escape' =>false));
                }
            ?>
            <button href="#" class="btn btn-info" onclick="PrintDoc()"><span class="fa fa-print"></span> Print</button> 
        </div> 
    </div>
</div>

<script type="text/javascript">
    function PrintDoc() {
    
        var toPrint = document.getElementById('SelectorToPrint');
    
        var popupWin = window.open('', '_blank', '');
    
        popupWin.document.open();
    
        popupWin.document.write('<html><title>Return<?php echo date("YmdHis"); ?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/print-style2.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">');
    
        popupWin.document.write(toPrint.innerHTML);
    
        popupWin.document.write('</html>');
    
        popupWin.document.close();
    
    }
</script>