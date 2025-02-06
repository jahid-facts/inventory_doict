<div style="width: 800px; margin: 5px auto; border: 2px solid #D9F7C9; overflow-x: auto;">
    <table width="100%;" border="0" cellpadding="0" cellspacing="0">
        <thead style="background-color: #D9F7C9;">
            <tr>
                <th style="width: 35%;border:0px!important; ">
                    <img src="http://www.digitalprogressbd.com/inventory/img/DoIctByICPL.png" width="85%"/>
                </th>
                <th style="border:0px!important; width: 30%; font-size: 16px; font-weight: bold;">Requisition Status</th>
                <th style="border:0px!important; width: 35%; text-align: right; padding-right: 10px;"> 
                    Req. Approval No : <b> <?php echo $requisition[0]['Requisition']['requisitionno'];?></b> <br>
                    Approval Date : <b> <?php echo $requisition[0]['Requisition']['dateupdate'];?></b>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">
                    <table style="width:90%; margin: 35px auto 0px;">
                        <tr>
                            <td style="width: 4%; text-align: left;">To</td>
                            <td style="width: 96%; text-align: left; padding-left: 5px;"> 
                                <b>: <?php echo $requisition[0]['User']['name'];?></b>
                            </td>
                        </tr>
                    </table>
                </td> 

            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:90%; margin: 5px auto 0px;">
                        <tr>
                            <td style="width: 4%; text-align: left;">Sub </td>
                            <td style="width: 96%; text-align: left; padding-left: 5px;"> 
                                <b>: Your Requisition Status.</b>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:90%; margin: 25px auto 0px;">
                        <tr>
                            <td style="text-align: left;">Dear Sir,</td> 
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 10px 0px;">
                                <p style="text-align: justify;">This is for your kind information that against your Requisition No: <?php echo $requisition[0]['Requisition']['requisitionno'];?> Requisition Date.<?php echo $requisition[0]['Requisition']['created'];?> following products was approved / disapproved for delivery.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:90%; margin-top: 25px; margin: 0 auto;" border="1" cellspacing="0" cellpadding="0">
                        <tr>
                            <th colspan="5" align="center" style="background-color: #CCC; color: #000">Product</th>
                        </tr>
                        <tr>
                            <th align="center">SL.</th>
                            <th align="center">Code</th>
                            <th align="center">Name</th>
                            <th align="center">Quantity</th>
                            <th align="center">Status</th>
                        </tr>

                        <?php 

                        $i=0;
                        foreach($requisition as $deliveryview){
                            $i++;


                                            $description=$deliveryview['Product']['name']; 
                                            
                                            if(!empty($deliveryview['Brand']['name'])){
                                                $description.=' - '.'<span title="Model" style="cursor:pointer">'.$deliveryview['Brand']['name'].'</span>';
                                            }

                                            if(!empty($deliveryview['Size']['name'])){
                                                $description.=' - '.'<span title="Size" style="cursor:pointer">'.$deliveryview['Size']['name'].'</span>';
                                            }

                                            if(!empty($deliveryview['Color']['name'])){
                                                $description.=' - '.'<span title="Color" style="cursor:pointer">'.$deliveryview['Color']['name'].'</span>';
                                            }

                                            $title=null;
                                            if($deliveryview['Requisitiondetail']['status']==2){
                                                $title=' <b>Approved</b>';
                                            }else{
                                                $pother=$deliveryview['Requisitiondetail']['purposeothers'];
                                                $title="<b style='color: red;''>Not Approved</b><br>
                                                <b>Reason :</b> $pother";
                                            }
                            ?>
                        <tr>
                            <td align="center"><?php echo $i;?></td>
                            <td align="center"><?php echo $deliveryview['Product']['finalcode'];?></td>
                            <td align="center"><?php echo $description;?></td>
                            <td align="center"><?php echo $deliveryview['Requisitiondetail']['rquantity'];?></td>
                            <td align="center">
                               <?php echo $title;?>
                            </td>
                        </tr>
                        <?php }?>

                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:90%; margin: 0 auto;">
                        <tr>
                            <td style="text-align: left; padding-top: 20px;">
                                We hope that you will receive the products soon.
                            </td> 
                        </tr>
                        <tr>
                            <td style="text-align: left; padding-top: 10px;">
                                Thank you.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table style="width:90%; margin: 25px auto;">
                        <tr> 
                            <td style="width: 20%; text-align: left;">
                                <b> <?php echo $requisition[0]['Requisition']['name'];?> </b><br>
                                   <?php echo $requisition[0]['Requisition']['dateupdate'];?>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>