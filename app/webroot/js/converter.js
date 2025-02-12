/*
Usage
=====
	call Convert.ConvertToText(<your_number>);
	
This function returns textual representation of your_number;
*/

var Convert = new function() {
	this.in_word = [];
	this.in_word[0] = "Zero";
	this.in_word[1] = "One";
	this.in_word[2] = "Two";
	this.in_word[3] = "Three";
	this.in_word[4] = "Four";
	this.in_word[5] = "Five";
	this.in_word[6] = "Six";
	this.in_word[7] = "Seven";
	this.in_word[8] = "Eight";
	this.in_word[9] = "Nine";
	this.in_word[10] = "Ten";
	this.in_word[11] = "Eleven";
	this.in_word[12] = "Twelve";
	this.in_word[13] = "Thirteen";
	this.in_word[14] = "Fourteen";
	this.in_word[15] = "Fifteen";
	this.in_word[16] = "Sixteen";
	this.in_word[17] = "Seventeen";
	this.in_word[18] = "Eighteen";
	this.in_word[19] = "Nineteen";
	this.in_word[20] = "Twenty";
	this.in_word[30] = "Thirty";
	this.in_word[40] = "Fourty";
	this.in_word[50] = "Fifty";
	this.in_word[60] = "Sixty";
	this.in_word[70] = "Seventy";
	this.in_word[80] = "Eighty";
	this.in_word[90] = "Ninety";
	
	this.number = 0;
	this.textual = "";
	this.dos_temp = 0;
	this.temp = 0;
	this.ekok = 0;
	this.doshok = 0;
	this.shotok = 0;
	this.hazar = 0;
	this.lac = 0;
	this.crore = 0;

	this.ConvertToText = function (thisValue) {
		this.textual = "";
		this.dos_temp = 0;
		this.temp = 0;
		this.ekok = 0;
		this.doshok = 0;
		this.shotok = 0;
		this.hazar = 0;
		this.lac = 0;
		this.crore = 0;
		this.number = thisValue;
		this.crore = Math.floor(this.number / 10000000);
		this.number -= (this.crore * 10000000);
		this.lac = Math.floor(this.number / 100000);
		this.number -= (this.lac * 100000);
		this.hazar = Math.floor(this.number / 1000);
		this.number -= (this.hazar * 1000);
		this.shotok = Math.floor(this.number / 100);
		this.number -= (this.shotok * 100);
		this.dos_temp = this.number;
		this.doshok = Math.floor(this.number / 10);
		this.ekok = this.number - (this.doshok * 10);

		if(this.crore > 0 && this.crore <= 19)
		{
		    this.textual += this.in_word[this.crore] + " Crore ";
		}
		else if(this.crore != 0)
		{
		    this.temp = this.crore / 10;
	    	this.crore -= (this.temp * 10);
		    if(this.crore != 0)
			{
       			this.textual += this.in_word[this.temp * 10] + " " + this.in_word[this.crore] + " Crore ";
			}
			else
			{
	       		this.textual += this.in_word[this.temp * 10] + " Crore ";
		    }
		}

		if(this.lac > 0 && this.lac <= 19)
		{
		    this.textual += this.in_word[this.lac] + " Lac ";
		}
		else if(this.lac != 0)
		{
		    this.temp = this.lac / 10;
	    	this.lac -= (this.temp * 10);
		    if(this.lac != 0)
			{
       			this.textual += this.in_word[this.temp * 10] + " " + this.in_word[this.lac] + " Lac ";
		    }
			else
			{
	       		this.textual += this.in_word[this.temp * 10] + " Lac ";
			}
		}

		if(this.hazar > 0 && this.hazar <= 19)
		{
		    this.textual += this.in_word[this.hazar] + " Thousand ";
		}
		else if(this.hazar != 0)
		{
		    this.temp = this.hazar / 10;
	    	this.hazar -= (this.temp * 10);
		    if(this.hazar != 0)
			{
	    	    this.textual += this.in_word[this.temp * 10] + " " + this.in_word[this.hazar] + " Thousand ";
			}
			else
			{
		       	this.textual += this.in_word[this.temp * 10] + " Thousand ";
			}
		}

		if(this.shotok != 0)
		{
		    this.textual += this.in_word[this.shotok] + " Hundred ";
		}
	
		if(this.doshok == 1)
		{
		    this.textual += this.in_word[this.dos_temp];
	    	this.ekok = 0;
		}
		else if(this.doshok != 0)
		{
		    this.textual += this.in_word[this.doshok * 10] + " ";
		}
	
		if(this.ekok != 0)
		{
		    this.textual += this.in_word[this.ekok];
		}	
		else if(thisValue == 0)
		{
		    this.textual += this.in_word[this.ekok];
		}
		
		return 'Taka ' + this.textual + ' Only';
	};
}