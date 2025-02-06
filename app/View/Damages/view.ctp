<?php   
    echo $this->Html->css('print-style1');                                       
?> 
<style>
    .mystyle {
        width: 100%;
        padding: 25px;
        background-color: coral;
        color: white;
        font-size: 25px;
        box-sizing: border-box;
    }
</style>	
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
                        <div class="col-sm-2 log-h1">
                            <h2>Product Adjustment</h2>
                        </div> 
                        <div class="col-sm-6 log-h2">
                            <span>
                                <div></div>
                                Adjustment No: <b><?php echo h($damagedetails[0]['Damage']['dnumber']); ?></b>
                            </span><br>
                            <span>
                                <div></div>
                                Reference No: <b><?php echo h($damagedetails[0]['Damage']['rnumber']); ?></b>
                            </span><br>
                            <span>Date: <b><?php echo  date("d-m-Y",strtotime($damagedetails[0]['Damage']['ddate'])); ?></b></span>
                        </div>             
                    	<div style="clear: both;"></div>
                    </div> 
                    <div class="panel-body">
                        <!-- My Invoice Start -->
                        <form action="" method="POST"> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered custable"> 
                                        <thead>
                                            <tr>
                                                <th rowspan="2">SL.</th>
                                                <th colspan="6">Product</th>
                                            
                                               
                                            </tr>
                                            <tr>

                                                <th>Code</th> 
                                                <th>Name</th>
                                               
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Adjustment type</th>    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $i=1;
                                               
                                                foreach ($damagedetails as $damagedetail):

                                            ?>
                                            <tr class="th-width">
                                                <td><?php echo   $i++;?></td>
                                                <td><?php echo $damagedetail['Product']['finalcode']; ?></td>
                                                <td><?php echo $damagedetail['Product']['name']; ?></td>
                                              
                                                <td><?php echo $damagedetail['Damage']['quantity']; ?></td>
                                                
                                                <td><?php echo $damagedetail['Measure']['name']; ?></td>
                                                 <td><?php echo $padjtype[$damagedetail['Damage']['type']]; ?></td>
                                               
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
                                            <span class="f-span">Approved By</span><br>
                                            <h6 class="f-spans"><?php echo $damagedetails[0]['Damage']['appBye'];?></h6>
                                            <span><?php echo date("d-m-Y"); ?></span>
                                        </td>
                                        <td></td>
                                        <td>
                                            <span class="f-span">Adjustment By</span><br>
                                            <h6 class="f-spans"><?php echo $damagedetails[0]['Damage']['adjBye'];?></h6>
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
            <div style="clear: both;"></div> 
            <div class="col-sm-6"> 
            
                <?php    
                    $file =WWW_ROOT . "img/upload/damage/".$damagedetails[0]['Damage']['dnumber'].'.'.$damagedetails[0]['Damage']['ext'];
                ?>
                <?php    if(is_file($file)){?> 
                <a class="img img-responsive btn btn-warning" target="_blank" href="<?php echo $this->webroot ?>/img/upload/damage/<?php echo $damagedetails[0]['Damage']['dnumber'].'.'.$damagedetails[0]['Damage']['ext'];?>">Open Attached Approval Letter</a>
               <?php }?>       
           
            </div>
            <div class="col-sm-6">
                <?php echo $this -> Html -> link('&nbsp;&nbsp;Back&nbsp;&nbsp;', array('controller' => 'damages', 'action' => 'index'),array('class'=>'btn btn-warning','escape'=>false));?>
                <button href="#" class="btn btn-info" onclick="PrintDoc()"><span class="fa fa-print"></span>&nbsp;Print&nbsp;</button> 
            </div> 
        </div>
        <div style="clear: both; height: 10px;"></div> 
    </div>
</div>

<script type="text/javascript">
	function PrintDoc() {
	
	    var toPrint = document.getElementById('SelectorToPrint');
	
	    var popupWin = window.open('', '_blank', '');
	
	    popupWin.document.open();
	
	    popupWin.document.write('<html><title>Adjustment<?php echo date("YmdHis"); ?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/print-style1.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">');
	
	    popupWin.document.write(toPrint.innerHTML);
	
	    popupWin.document.write('</html>');
	
	    popupWin.document.close();
	
	}
</script>
