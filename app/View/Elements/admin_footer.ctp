<style>
	.my_footer{
		background:#683091;
		width:100%;
		position: fixed;
		bottom: 0px;
		border-top: 2px solid #CCCCCC;
	} 
	.my_foot_content{
		margin-top: 1px;
		padding: 12px 5px;
		color: #FFF!important;
	}
	.text-center a {
		color: #FFF!important;
		text-decoration: none;
	}
	.text-center a:hover {
		color: #31B0D5!important;
		text-decoration: none;
	}
        
</style>
<?php
	function getBanglaDate($date){
	 $engArray = array(
	 1,2,3,4,5,6,7,8,9,0,
	 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',
	 'am', 'pm'
	 );
	 $bangArray = array(
	 '১','২','৩','৪','৫','৬','৭','৮','৯','০',
	 'জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর',
	 'সকাল', 'দুপুর'
	 );
	 
	 $converted = str_replace($engArray, $bangArray, $date);
	 return $converted;
	}
 
?>
 <div class="my_footer">
	<div class="container my_foot_content">
		<div class="col-sm-12">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-11 text-center">
				কপিরাইট &copy; <?php echo getBanglaDate(date("Y")); ?>, তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর ,  
				কারিগরি সহায়তায়ঃ&nbsp;<a href="http://ipsitasoft.com"> ইপসি্‌তা কম্পিউটার্স প্রাঃ লিঃ</a> 
			</div>
		</div>  
	</div>
</div>  