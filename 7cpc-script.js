function updateRowColor() 
{
	var cells = document.getElementById("myTable").getElementsByTagName("td");

	for (var i = 0; i < 12; i++) 
		{    
                cells[i].style.backgroundColor = "#618685";
		cells[i].style.color = "#FFFFFF";
		}
		for (var i = 12; i < 24; i++) 
		{    
		cells[i].style.backgroundColor = "#F0FFF0";
		}
}

window.onload=function()
{
	updateRowColor();
}
//////////////////////////////////////////////////////////////////////////////////

function myFunction() 
{
	var bp = document.getElementById("bp").value;
	var gp = document.getElementById("gp").value;
  	var msp = document.getElementById("msp").value;
  	var oldpay = +bp + +gp + +msp ;
  	var da = (oldpay*2.36).toFixed(2);
  	var oldpaycal = +bp + +gp ;
  	var newmsp = 15500;

        if (gp < 5400)
  	{
  		alert("Entered Grade Pay Falls under PBOR Bracket. Redirecting to Jawan Window. Press OK");
  		window.location.href = "https://navyxp.com/7-cpc/jawans/";
  	}
    
  	if (gp < 8000)
  		{var inc = 2.57;}  
  	else
  		{inc = 2.57;}
  
  	var newpay = (oldpaycal*inc).toFixed(2);

// FOR GRADE PAY  
  
	var input = document.getElementById("gp");
	var filter = input.value.toUpperCase();

	var cells = document.getElementById("myTable").getElementsByTagName("td");

	for (var i = 0; i < cells.length; i++) 
	{
		if (cells[i].innerHTML == filter) 
		{
			var data=i;
		    cells[i].style.backgroundColor = "green";
		    cells[i].style.color = "white";
		    cells[i].style.fontSize = "xx-large";
		    break;
		}
	}

	if (+newpay <= cells[data+24].innerHTML)	
	
	{
	cells[data+24].style.backgroundColor = "red";
	//console.log(cells[i+12].innerHTML);
	cells[data+24].style.color = "white";
	cells[data+24].style.fontSize = "xx-large";
	var sal = cells[data+24].innerText;	 
	}

	else 
	{		
		for (var i = data+12; i < cells.length-12; i=i+12) 
	
		{
	
			if (cells[i].innerHTML <= +newpay && cells[i+12].innerHTML >= +newpay) 
			{
				//console.log(cells[i].innerHTML);
				cells[i+12].style.backgroundColor = "red";
				console.log(cells[i+12].innerHTML);
				cells[i+12].style.color = "white";
				cells[i+12].style.fontSize = "xx-large";
				var sal = cells[i+12].innerText;
				break;
			}
		}
	
	}
   
	document.getElementById("demo1").innerHTML = "Sum of Basic Pay + Grade Pay + MSP :: Rs  " + oldpay;
	document.getElementById("demo2").innerHTML = "Total Pay Including Present DA (136%) :: Rs " + da;
	document.getElementById("demo3").innerHTML = "Pay multiplied by " + inc + " :: Rs  " + newpay;
	   
	document.getElementById("demo4").innerHTML = "Approximated to nearest Pay in Pay Matrix :: Rs " + sal; 
		      var totalpay = (+sal + +newmsp).toFixed(2);

	document.getElementById("demo5").innerHTML = "Total Pay including new MSP :: Rs " + totalpay;
		      var newda = (totalpay*1.04).toFixed(2);

	document.getElementById("demo6").innerHTML = "Total Pay including MSP & DA(4%) :: Rs " + newda;
		      var diff = (newda - da).toFixed(2);
	document.getElementById("demo7").innerHTML = "Total Increase in Pay :: Rs " + diff;      
          
}
///////////////////////////////////////////////////////////////////////

function reset() 
{
	window.location.reload();
	window.location.href = window.location.href;
}
