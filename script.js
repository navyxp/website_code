
function header_color() 
{
	var j;
	var t = document.getElementById('myTable');	
	for (var i = 0; i < t.rows.length; i = i+1)
	{		
		if 
		(t.rows[i].cells[0].innerHTML ===  "JAN-CREDIT"
			|| t.rows[i].cells[0].innerHTML === "FEB-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "MAR-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "APR-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "MAY-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "JUN-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "JUL-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "AUG-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "SEP-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "OCT-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "NOV-CREDIT" 
			|| t.rows[i].cells[0].innerHTML === "DEC-CREDIT")
		
		{
			for (j=0; j<4; j=j+1)
			{
				t.rows[i].cells[j].style.backgroundColor = "#618685";
				t.rows[i].cells[j].style.color = "#ffffff";
				//t.rows[i].cells[j].style.fontSize = "24px";
				t.rows[i].cells[j].style.paddingRight = "0px";
				t.rows[i].cells[j].style.textAlign = "center";
			}

		}
	}	
	for (var i = 0; i < t.rows.length; i = i+1)	
	{
		if (t.rows[i].cells[0].innerHTML ===  "TOTAL")
		{
			for (j=0; j<4; j=j+1)
			{
				t.rows[i].cells[j].style.backgroundColor = "#F0FFF0";
			}
		}
	
	}	
	var t1 = document.getElementById('mTable');
	
	for (var i = 0; i < 4; i = i+1)
	{
		t1.rows[0].cells[i].style.backgroundColor = "#618685";
		t1.rows[0].cells[i].style.color = "#ffffff";
		t1.rows[0].cells[i].style.paddingRight = "0px";
		t1.rows[0].cells[i].style.textAlign = "center";
	}
}
function credit()
{	
	var obj;
	var t = document.getElementById('myTable');
	var num_of_rows = t.rows.length;
	var num_of_cols = t.rows[0].cells.length;

	var val = [];
	
	for (var i = 0; i < t.rows.length; i = i+1)
	{
		val[i] = t.rows[i].cells[0].innerHTML;
		var unique = [...new Set(val)];
	} 
	
	var obj = unique.indexOf("JAN-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}	
	var obj = unique.indexOf("FEB-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("MAR-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("APR-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("MAY-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("JUN-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("JUL-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("AUG-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("SEP-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("OCT-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("NOV-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("DEC-CREDIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("TOTAL");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}	
	var j;
	var sal = [];
	for (var j = 0; j < unique.length; j = j+1)
	{ 
		filter = unique[j];
		var sum =0;
		for (var i = 1; i < t.rows.length; i = i+1) 
		{		    
			if (t.rows[i].cells[0].innerHTML ===  filter)
			{
				var amt = t.rows[i].cells[1].innerHTML;
				amt = amt.replace(/,/g, "");
				parseInt(amt, 10);
				sum = +sum + +amt;
			}		
		}
		sal[j]=sum;
	}
	for (var i = 0; i < unique.length; i = i+1)
	{
		var ts=document.getElementById("mTable");
		var row=ts.insertRow(ts.rows.length);
            
		var cell1=row.insertCell(0);
		var t1=document.createElement("text");
		cell1.appendChild(t1);
		cell1.innerHTML = 10;
                
		var cell2=row.insertCell(1);
		var t2=document.createElement("text");
		cell2.appendChild(t2);
                
		var cell3=row.insertCell(2);
		var t3=document.createElement("text");
		cell3.appendChild(t3);
                
		var cell4=row.insertCell(3);
		var t4=document.createElement("text");
		cell4.appendChild(t4);                
	}	
	for (var i = 0; i < unique.length; i = i+1)
	{
		ts.rows[i+1].cells[0].innerHTML=unique[i];
	} 

	for (var i = 0; i < unique.length; i = i+1)
	{
		ts.rows[i+1].cells[1].innerHTML=sal[i];
	} 
	var row=ts.insertRow(ts.rows.length);            
	var cell1=row.insertCell(0);
	var t1=document.createElement("text");
	cell1.appendChild(t1);
	cell1.innerHTML = "TOTAL CREDITS";
                
	var cell2=row.insertCell(1);
	var t2=document.createElement("text");
	cell2.appendChild(t2);
	cell2.innerHTML = "AMOUNT";
                
	var cell3=row.insertCell(2);
	var t3=document.createElement("text");
	cell3.appendChild(t3);
	cell3.innerHTML = "TOTAL DEBITS";
                
	var cell4=row.insertCell(3);
	var t4=document.createElement("text");
	cell4.appendChild(t4);
	cell4.innerHTML = "AMOUNT";
	var row=ts.insertRow(ts.rows.length);
	var cell1=row.insertCell(0);
	var t1=document.createElement("text");
	cell1.appendChild(t1);
	cell1.innerHTML = "SALARY TO BANK";
                
	var cell2=row.insertCell(1);
	var t2=document.createElement("text");
	cell2.appendChild(t2);
	cell2.innerHTML = "AMOUNT";
	for (var i = 0; i < ts.rows.length; i = i+1)	
	{
		if (ts.rows[i].cells[0].innerHTML ===  "TOTAL CREDITS")
		{
			for (j=0; j<4; j=j+1)
			{
				ts.rows[i].cells[j].style.backgroundColor = "#F0FFF0";
			}
			break;
		}	
	}	
}
function debit()
{	
	var obj;
	var t = document.getElementById('myTable');
	var num_of_rows = t.rows.length;
	var num_of_cols = t.rows[0].cells.length;
	var val = [];

	for (var i = 0; i < t.rows.length; i = i+1)
	{
		if (t.rows[i].cells.length > 2)
		{
		val[i] = t.rows[i].cells[2].innerHTML;
		var unique = [...new Set(val)];		
		}
	} 
	var obj = unique.indexOf("JAN-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}	
	var obj = unique.indexOf("FEB-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("MAR-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("APR-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("MAY-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("JUN-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("JUL-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("AUG-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("SEP-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("OCT-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("NOV-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var obj = unique.indexOf("DEC-DEBIT");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	
	var obj = unique.indexOf("TOTAL");	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	
	var obj = unique.indexOf(undefined);	
	if(obj != -1) 
	{
		unique.splice(obj, 1);
	}
	var j;
	var sal = [];
	for (var j = 0; j < unique.length; j = j+1)
	{ 
		filter = unique[j];
		var sum =0;			
		for (var i = 1; i < t.rows.length; i = i+1) 
		{		    
			if (t.rows[i].cells.length > 2)
			{
				if (t.rows[i].cells[2].innerHTML ===  filter)
				{
					var amt = t.rows[i].cells[3].innerHTML;
					amt = amt.replace(/,/g, "");
					parseInt(amt, 10);
					sum = +sum + +amt;
				}		
			}
		}
		sal[j]=sum;
	}
	var ts = document.getElementById('mTable');

	for (var i = 0; i < unique.length; i = i+1)
	{
		ts.rows[i+1].cells[2].innerHTML=unique[i];
	} 

	for (var i = 0; i < unique.length; i = i+1)
	{
		ts.rows[i+1].cells[3].innerHTML=sal[i];
	}	
	
}

var months= ["JAN-CREDIT", "FEB-CREDIT", "MAR-CREDIT", "APR-CREDIT", "MAY-CREDIT", "JUN-CREDIT", "JUL-CREDIT", 
			 "AUG-CREDIT", "SEP-CREDIT", "OCT-CREDIT", "NOV-CREDIT", "DEC-CREDIT",];
function salary_sum()
{
	var start, end, cre, deb;
	var t = document.getElementById('myTable');
	
	for (var j=0; j < months.length; j=j+1)
	{
		var sumc=0, sumd=0;
		var month = months[j];
		for (var i = 0; i < t.rows.length; i = i+1)	
		{
			if (t.rows[i].cells[0].innerHTML ===  month)
			{
				start =i;
				break;
			}
		}
		for (var i = start; i < t.rows.length; i = i+1)	
		{	
			if (t.rows[i].cells[0].innerHTML ===  "TOTAL")
			{
				end = i;
				break;
			}			
		}	
		for (var k = start+1; k < end; k = k+1)	
		{
			cre = t.rows[k].cells[1].innerHTML;			
			cre = cre.replace(/,/g, "");
			parseInt(cre, 10);
			sumc = +sumc + +cre;		
			if (t.rows[k].cells.length > 2)
			{
				deb = t.rows[k].cells[3].innerHTML;			
				deb = deb.replace(/,/g, "");
				parseInt(deb, 10);
				sumd = +sumd + +deb;
			}		
		}
		t.rows[end].cells[1].innerHTML = sumc;	
		t.rows[end].cells[3].innerHTML = sumd;
	}	
	var t = document.getElementById('mTable');
	
	var sumc=0, sumd=0;	
	var len=t.rows.length-1;
	for (var k = 1; k < len-1; k = k+1)	
	{
		cre = t.rows[k].cells[1].innerHTML;			
		cre = cre.replace(/,/g, "");
		parseInt(cre, 10);
		sumc = +sumc + +cre;
		if (t.rows[k].cells[3].innerHTML.length != "13")
		{
			deb = t.rows[k].cells[3].innerHTML;			
			deb = deb.replace(/,/g, "");
			parseInt(deb, 10);
			sumd = +sumd + +deb;
			}		
		}
		t.rows[len-1].cells[1].innerHTML = sumc;	
		t.rows[len-1].cells[3].innerHTML = sumd;	

	var salary = +sumc - +sumd;
	t.rows[len].cells[1].innerHTML = salary;
	t.rows[len].cells[0].style.backgroundColor = "#F0FFF0";
	t.rows[len].cells[1].style.backgroundColor = "#F0FFF0";
}
var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
        base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        }, format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
    return function (table, filename) {
        if (!table.nodeType) table = document.getElementById(mTable)
        var ctx = {
            worksheet: name || 'Worksheet',
            table: mTable.innerHTML
        }
   document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
    }
})()
function reset() 
{
	window.location.reload();
	window.location.href = window.location.href;
}
window.onload=function()
{
	header_color();
	credit();
	debit();
	salary_sum();
}
