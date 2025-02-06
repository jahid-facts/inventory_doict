<?php echo $this->Html->css('print-style4'); ?>   
<style>
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
	table.my-padding-1 {
        width: 100%;
        margin-bottom: 1px!important;
    }
	table.my-padding-1 td,table.borderless th{
		padding: 5px 0px !important;
        text-align: left!important;
		
	}
    table.my-padding-1 td:nth-child(1){
        width: 9%;
        
    }
	
	.my-flat-input{
		width:100%; height:100%;
		border:none;
	}
    .rf{
        float: right;
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
	@media print{
            table.borderless td,table.borderless th{
		border: none !important;
		
            }

            table.my-padding-0 td,table.borderless th{
                    padding: 2px 10px !important;

            }

            table.my-padding-1 td,table.borderless th{
                    padding: 5px 0px !important;

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
	}
        
        .ed{
            margin: 0 2% 0 -12%;
        }
        
        .ap{
           margin: 0 13%;
        }
        .apa {
            
            color: #fff;
            font-size: 13px;
            font-weight: bold;
            margin: 0 716px -40px -168px;
            padding: 10px 20px 1px;
          }
          h5{ text-align: center; }
</style>

<style>
    #pop{
        width:100%; height:100%;
        background-color: rgba(0, 0, 0, 0.8);
        position:fixed;
        top:0px; left:0px;
        display:none;
          
    }
    #pop-in{
        width:80%; height:70%;
        overflow: auto;
        background:#FFF; font-family:Arial; 
        position:relative; font-size:11px; 
        z-index: 1; border: 1px solid #333;
        margin:100px auto;
        box-shadow:0px 0px 10px black;
    }
    #pop-in h1{
    position:fixed; width:80%; margin:0px; background:#8dc641; color:#FFF;
    font-size:16px; font-weight:bold; padding:10px;
    z-index:999;
    }
    #pop-in .mssg{
    margin:50px 10px; background:#F5F6CE; color:#222; border: 1px solid #F7BE81;
    font-size:12px; padding:10px;
    }
    #pop-in .btn{
    background:#084B8A; color:#FFF;
    padding:1px 8px; border: 0px;
    margin:10px 0px;
    }
    #pop-in .input{
    padding:1px 8px; border:1px solid #BBB;
    margin:1px;
    }


</style>
 
 
<div style="height: 30px"></div>			
<div class="col-sm-12" style="overflow-x: auto;"> 
    <h4 class="btn-info"><?php echo $this->Session->flash(); ?></h4>
    <div style="clear: both;"></div>
    <div class="col-sm-1">
        <?php 
            if($currentUser['role_id'] ==1){
                if($this->params->pass[1]=='rsubmit'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'index'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[2]=='received'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceived'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[1]=='pending'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionpending'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[2]=='receivedd'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceivedd'), array('class'=>'btn btn-success','escape'=>false));
                }
            }elseif($currentUser['role_id'] ==2){
                if($this->params->pass[1]==1 ){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceived'), array('class'=>'btn btn-success','escape'=>false));
                }
            }elseif($currentUser['role_id'] ==3){
                if($this->params->pass[1]=='rsubmit'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'index'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[2]=='received'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceived'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[1]=='pending'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionpending'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[2]=='receivedd'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceivedd'), array('class'=>'btn btn-success','escape'=>false));
                }
            }elseif($currentUser['role_id'] ==4){
                if($this->params->pass[1]=='rsubmit'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'index'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[2]=='received'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceived'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[1]=='pending'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionpending'), array('class'=>'btn btn-success','escape'=>false));
                }elseif($this->params->pass[2]=='receivedd'){
                    echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-mail-reply-all')).' Back', array('controller' => 'requisitions', 'action' => 'requisitionreceivedd'), array('class'=>'btn btn-success','escape'=>false));
                }
            }  
        ?>  
    </div> 
    <div id="SelectorToPrint" class="form printform col-sm-11"> 
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
                    <h2>REQUISITION</h2>
                </div> 
                <div class="col-sm-6 log-h2">
                    <span>
                        <div class="c-height"></div>
                        Requisition No : <b><?php echo $requisition['Requisition']['requisitionno'];?></b>
                    </span><br> 
                    <span>Date : <b><?php echo $requisition['Requisition']['created'];?></b></span>
                </div>             
                <div style="clear: both;"></div>
            </div> 
            <div class="panel-body">
                        <!-- My Invoice Start -->
               <form action="" method="POST">  
                    <div class="col-sm-12"> 
                        <table class="table borderless my-padding-1">
                            <tr>
                                <td><b>To </b></td>
                                <td><b>: </b> ADMIN</td>
                            </tr>       
                            <tr>
                                <td><b>Address </b></td> 
                                <td><b>: </b>
                                    <?php foreach ($users as $user) {?> 
                                        <?php echo h($user['Department']['name']); ?>, 
                                    <?php   }?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"> 
                                    Dear Sir, <br>
                                    We need the following items for the purpose indicated below. 
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                        </table> 
                    </div>  

                    <div class="row">
                        <div style="clear: both; height: 10px;"></div>
                        <div class="col-sm-12">
                            <div class="col-sm-6 my-left-padding">
                                <table class="table table-bordered tb-ones">
                                    <tr>
                                        <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner:</td>
                                        <td>
                                           
                                            <?php echo $requisition['User']['name']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Designation :</td>
                                        <td>
                                            
                                                <?php echo h($designations[$requisition['User']['designation_id']]); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Department :</td>
                                        <td>
                                            
                                                <?php echo h($departments[$requisition['User']['department_id']]); ?>
                                         </td>
                                    </tr>
                                </table>

                            </div>
                            <div class="col-sm-6 my-right-padding">
                                <table class="table table-bordered tb-oness">
                                    <tr>
                                        <td>Phone :</td>
                                        <td>
                                           
                                                <?php echo h($requisition['User']['mobile']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td>
                                            
                                                <?php echo h($requisition['User']['email']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Delivery location :</td>
                                        <td>
                                            
                                                <?php echo h($requisition['Requisition']['location']); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div> 
                        </div> 
                        <div style="clear: both; height: 10px;"> </div> 
                    </div>

                    <div class="row">
                        <div class="col-sm-12 ovrfl">
                            <table class="table table-bordered txtcen">
                                <thead>
                                    <tr>
                                        <th colspan="5">Product</th> 
                                    </tr>
                                    <tr>
                                        <th class="col-xs-1">SL.</th>
                                        <th class="col-xs-2">Code</th>
                                        <th class="col-xs-5">Name</th>
                                        <th class="col-xs-2">Quantity</th>
                                        <th class="col-xs-2">Purpose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=1;
                                        foreach ($requisitiondetails as $requisitiondetail): 
                                        //p($requisitiondetail['Requisitiondetail']['status']); 
                                        $description=$requisitiondetail['SubCategory']['name'].' - '.$requisitiondetail['Products']['name']; 
                                    
                                        if(!empty($requisitiondetail['Brand']['name'])){
                                            $description.=' - '.'<span title="Model" style="cursor:pointer">'.$requisitiondetail['Brand']['name'].'</span>';
                                        }
                                        if(!empty($requisitiondetail['Size']['name'])){
                                            $description.=' - '.'<span title="Size" style="cursor:pointer">'.$requisitiondetail['Size']['name'].'</span>';
                                        }
                                        if(!empty($requisitiondetail['Color']['name'])){
                                            $description.=' - '.'<span title="Color" style="cursor:pointer">'.$requisitiondetail['Color']['name'].'</span>';
                                        }

                                    ?>

                                    <tr>
                                        <td>
                                        
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                           
                                            <?php echo $requisitiondetail['Products']['finalcode']; ?>
                                        </td>
                                        <td>
                                            
                                            <?php echo $description; ?>
                                        </td>
                                        <td>
                                            
                                            <?php echo $requisitiondetail['Requisitiondetail']['quantity'].'  '.$requisitiondetail['Measures']['name']; ?>
                                        </td>
                                        <td>
                                           
                                            <?php echo $requisitiondetail['Requisitiondetail']['purpose']; ?>
                                        </td>
                                    </tr>

                                 <?php $i++;  endforeach ;?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="my-space-3"></div>

                    <div class="row">
                        <div class="col-sm-12">
                            <p  class="my-paragraph">We need your kind approval in it with instruction to store for necessary
                            delivery arrangement </p>
                            <p  class="my-paragraph">Thank you.</p>
                            <table class="foot-tables" cellspacing="0" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td>
                                            
                                        </td>
                                        <td></td>
                                        <td>
                                            <span class="f-span"><?php echo $requisition['User']['name']; ?></span><br> 
                                            <span><?php echo $requisition['Requisition']['created']; ?></span>
                                        </td>
                                    </tr>
                                    <tr class="ipsita">
                                        
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div> 
                </form>
                    <!-- My Invoice End -->
            </div>
            <div class="panel-footer">
                <div class="col-sm-12">
                    <table class="foot-table" cellspacing="0" cellpadding="0">
                        <tfoot>
                            <tr class="vhide">
                                <td>
                                    
                                </td>
                                <td></td>
                                <td>
                                    <span class="f-span"><?php echo $requisition['User']['name']; ?></span><br> 
                                    <span><?php echo $requisition['Requisition']['created']; ?></span>
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
    <?php if($currentUser['role_id'] ==3){?>
        <div class="col-xs-1 text-center">
        </div>
        <div class="col-xs-11 text-center clspt">
            <button href="#" class="btn btn-info" onclick="PrintDoc()"><span class="fa fa-print"></span> Print</button> 
        </div>    
    <?php }?>
    <div style="clear: both; height: 20px;"></div> 
</div>



<div id="pop">
    <div id="pop-in">
        <h1>ষ্টোর ব্যবস্থাপনা এবং ই- রিকুজিশন
        <a style="padding:10px; text-decoration:none; right:0px; top:0px; position:absolute; color:#084B8A;" href="javascript:void(0)" onclick="document.getElementById('pop').style.display='none';document.getElementById('pop').style.transition='.5 all'">Cancel</a>
        </h1>
        <p class="mssg"> Details information of Last Product Deliveries.</p>
        
        <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th> S/N </th>
                                                <th> ITEM CODE </th>
                                                <th> DESCRIPTION </th>
                                                <th> Quantity </th>
                                                <th> PURPOSE </th>
                                                <th style="background: #8dc641; font-weight:bold;"> Last Delivery Date </th>
                                                <th style="background: #8dc641; font-weight:bold;"> Last Delivery Quantity </th>
                                            </tr>
                                             <?php 
                                              $i=1;
                                             foreach ($requisitiondetails as $requisitiondetail):

                                                  
                                                $product_last_delivery_id=$requisitiondetail['Products']['id'];
                                                
                                                $product_last_delivery_qnty = ClassRegistry:: init('Deliverydetail')->find('first',array('fields'=>array('id','quantity','ddate'),'conditions'=>array('Deliverydetail.product_id'=>$product_last_delivery_id)));

                

                                            ?>

                                            <tr>
                                                <td>
                                                
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                   
                                                    <?php echo $requisitiondetail['Products']['productcode']; ?>
                                                </td>
                                                <td>
                                                    
                                                    <?php echo $requisitiondetail['Category']['name'].'->'.$requisitiondetail['SubCategory']['name'].'->'.$requisitiondetail['Products']['name']; ?>
                                                </td>
                                                <td>
                                                    
                                                    <?php echo $requisitiondetail['Requisitiondetail']['quantity']; ?>
                                                </td>
                                                <td>
                                                   
                                                    <?php echo $requisitiondetail['Requisitiondetail']['purpose']; ?>
                                                </td>

                                                <td style="background: #bde488;">
                                                   <b> 
                                                   <?php 

                                                        if(empty($product_last_delivery_qnty)){
                                                            echo "<span style='color:red;'> Not yet delivered </span>";
                                                        }else{
                                                             echo $product_last_delivery_qnty['Deliverydetail']['ddate'] ;
                                                        }
                                                   ?>
                                                    </b>
                                                   
                                                </td>
                                                <td style="background: #bde488;">
                                                   <b> 
                                                   <?php 

                                                        if(empty($product_last_delivery_qnty)){
                                                            echo "<span style='color:red;'> -- </span>";
                                                        }else{
                                                             echo $product_last_delivery_qnty['Deliverydetail']['quantity'] ;
                                                        }
                                                   ?>
                                                    </b>
                                                </td>
                                            </tr>

                                             <?php $i++; endforeach ;?>
                                        </table>
                                    </div>

        <hr>
        
    </div>
</div>


<script type="text/javascript">
    var path='<?php echo $this->webroot;?>'; 

    function getStatusReject(id){

        if (confirm("Are you sure want to reject ??") == true) {

            $.ajax({    
                type: 'POST',
                url: path +'requisitions/getreject',
                data: {id:id},
                success: function(data){
                    location.href=path+"requisitions/index";
                }
            });
            
        }
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

<script type="text/javascript">
    function PrintDoc() {
    
        var toPrint = document.getElementById('SelectorToPrint');
    
        var popupWin = window.open('', '_blank', '');
    
        popupWin.document.open();
    
        popupWin.document.write('<html><title>Requisition<?php echo $requisition['Requisition']['requisitionno'];?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/print-style4.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">');
    
        popupWin.document.write(toPrint.innerHTML);
    
        popupWin.document.write('</html>');
    
        popupWin.document.close();
    
    }
</script>