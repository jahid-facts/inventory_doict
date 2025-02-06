<div style="background: #e5e5e5;padding: 20px; text-align: center;font-family: Lucida Sans Unicode">

	<p style="text-align: left;font-weight: bold;"><?php echo date('d M, Y');?></p>
	<p style="text-align: left;font-weight: bold;color: green;padding-top: 5px;">Subject: Requistion No.<?php echo h($requisition['Requisition']['requisitionno']); ?> at <?php echo substr($requisition['Requisition']['created'],0,10);?> has been submitted.</p>
	
	<p style="text-align: left;"> Dear Mr/Mrs. <?php echo h($requisition['User']['name']); ?> ,</p>
	
	<p style="text-align: left;">
		This is for your kind information that a requisition has been submitted as indicated in the subject.
	</p>
	
	<p style="text-align: left;">Thank you.</p>
	
	<table style="width: 100%">
		<tr>
			<td align="right" colspan="2"><b>ADMIN AREA</b></td>
		</tr>
	</table>
	
	<table style="width: 100%">
		<tr>
			<td align="right">
				<!--<img src="http://ipsitasoft.com/americanclubs/img/logo-admin-sm.png" width="40" alt="ONLINE TENNIS AND SQUASH BOOKING SYSTEM" >
				-->
				<span style="position: relative;bottom: 15px;">Inventory Management System</span>
			</td>
		</tr>
	</table>
	<p style="text-align: left;">
		Auto generated message from 
		<span style="font-weight: bold; font-style: italic;">
			Inventory Management System
		</span>.
	</p>
</div>
