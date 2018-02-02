#!/bin/bash

export path=$1
cd $path

files=final.txt
if [ -f "$files" ] 
then
	rm $files
fi

function asf
{
pdftotext $pdf $txt
sed -n '/DEBITS/,/TOTAL CREDIT:/{//!p}' $txt > tmp.txt
grep -E "^[^1,2,3,4,5,6,7,8,9,0]" tmp.txt > credit_header.txt
sed -n '/DEBITS/,/TOTAL CREDIT:/{//!p}' $txt > tmp.txt
grep -E "^[^Q,W,E,R,T,Y,U,I,O,P,A,S,D,F,G,H,J,K,L,Z,X,C,V,B,N,M]" tmp.txt > credit_value.txt
sed -n '/TOTAL CREDIT:/,/TOTAL DEBIT:/{//!p}' $txt > tmp.txt
grep -E "^[^1,2,3,4,5,6,7,8,9,0]" tmp.txt > debit_header.txt
rm tmp.txt
echo  "breakpoint"
sed -n '/TOTAL CREDIT:/,/TOTAL DEBIT:/{//!p}' $txt > tmp.txt
grep -E "^[^Q,W,E,R,T,Y,U,I,O,P,A,S,D,F,G,H,J,K,L,Z,X,C,V,B,N,M]" tmp.txt > tmp1.txt
echo "bp2"
echo "$(tail -n +2 tmp1.txt)" > debit_value.txt
rm tmp.txt
rm tmp1.txt
rm $pdf
echo "end"
paste credit_header.txt credit_value.txt | sed 's/\t/\0\t/g' | column -s $'\t' -t > credit.txt
paste debit_header.txt debit_value.txt | sed 's/\t/\0\t/g' | column -s $'\t' -t > debit.txt
echo "$header-CREDIT	$header-AMOUNT	$header-DEBIT	$header-AMOUNT" >> final.txt
paste credit.txt debit.txt | sed 's/\t/\0\t/g' | column -s $'\t' -t >> final.txt
echo "TOTAL AMOUNT TOTAL AMOUNT" >> final.txt
rm debit_header.txt 
rm debit_value.txt
rm debit.txt

rm credit_header.txt 
rm credit_value.txt 
rm credit.txt
rm $txt
}

pdf=mar.pdf
txt=mar.txt
header=MAR
asf
pdf=apr.pdf
txt=apr.txt
header=APR
asf
pdf=may.pdf
txt=may.txt
header=MAY
asf
pdf=jun.pdf
txt=jun.txt
header=JUN
asf
pdf=jul.pdf
txt=jul.txt
header=JUL
asf
pdf=aug.pdf
txt=aug.txt
header=AUG
asf
pdf=sep.pdf
txt=sep.txt
header=SEP
asf
pdf=oct.pdf
txt=oct.txt
header=OCT
asf
pdf=nov.pdf
txt=nov.txt
header=NOV
asf
pdf=dec.pdf
txt=dec.txt
header=DEC
asf
pdf=jan.pdf
header=JAN
txt=jan.txt
asf
pdf=feb.pdf
txt=feb.txt
header=FEB
asf
echo " 
<?php
session_start();
\$sessData = !empty(\$_SESSION['sessData'])?\$_SESSION['sessData']:'';
if(!empty(\$sessData['status']['msg'])){
    \$statusMsg = \$sessData['status']['msg'];
    \$statusMsgType = \$sessData['status']['type'];
    unset(\$_SESSION['sessData']['status']);
}
?>       	
        <?php
			if(!empty(\$sessData['userLoggedIn']) && !empty(\$sessData['userID']))
			{
				include '../user.php';
				\$user = new User();
				\$conditions['where'] = array(
					'id' => \$sessData['userID'],
				);
				\$conditions['return_type'] = 'single';
				\$userData = \$user->getRows(\$conditions);


			\$dir=\$userData['first_name'];
			\$test1 = getcwd();
			\$test= basename(\"\$test1\").PHP_EOL;
			\$test=trim(\$test);	

		

			if(\$test === \$dir)
			{				
		?> 
<!DOCTYPE html>
<html>
	<head>
		<title>SE Summary</title>
		<link rel=\"icon\" type=\"image/png\" href=\"/wp-content/uploads/2016/12/favicon-16x16-1.png\">
		<link rel=\"stylesheet\" type=\"text/css\" href=\"../email.css\">
		<script type=\"text/javascript\" src=\"../script.js\"></script>
                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
	</head>
	
<body>
	<div align = \"center\">
		<button onclick=window.open('https://navyxp.com','_blank');>HOME</button>
		<button onclick=window.open('https://navyxp.com/7-cpc/officers','_blank');>7 CPC</button>
		<button onclick=\"window.location.href='/navpay/'\">BACK</button>
		<button onclick=\"window.location.href='../userAccount.php?logoutSubmit=1'\">LOGOUT</button>
	</div>

<h1 align=\"center\">SUMMARY OF STATEMENT OF ENTITLEMENT</h1>

<div id=\"div1\">
<table id=\"mTable\">
<br>
<br>
<tr>
	<td>TOTAL CREDIT</td>
	<td>TOTAL AMOUNT</td>
	<td>TOTAL DEBIT</td>
	<td>TOTAL AMOUNT</td>
</tr>
</table>
</div>
<button onclick=\"tabletopdf()\">PDF</button>
<a id=\"dlink\" style=\"display:none;\"></a>
<button onclick=\"tableToExcel('mTable', 'summary.xls')\">EXCEL</button>
</div>

<div id=\"div2\">
<table id=\"myTable\">
  <br> <br> <br>
  <h2 align=\"center\">COMPLETE STATEMENT OF ENTITLEMENT</h2>
  <br>" > index.php
IFS=\n  
awk '
BEGIN{
    print ""
    } 
    {print "<tr>"
    for(i=1;i<=NF;i++)
        print "<td>" $i"</td>"
    print "</tr>"
    }
END{
	print "\n</div>\n</table>"
    }' final.txt >> index.php

echo "
<?php }}

        else{?>        
        	<?php         
        	header(\"Location:https://navyxp.com/navpay/\");
        	} ?>        
        
	</div>
<br />
<div align = \"center\">
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- RXP-AUTO -->
<ins class=\"adsbygoogle\"
     style=\"display:block\"
     data-ad-client=\"ca-pub-6460140889486984\"
     data-ad-slot=\"7420663759\"
     data-ad-format=\"auto\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<br />
<div align = \"center\">
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<!-- RXP-AUTO -->
<ins class=\"adsbygoogle\"
     style=\"display:block\"
     data-ad-client=\"ca-pub-6460140889486984\"
     data-ad-slot=\"7420663759\"
     data-ad-format=\"auto\"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>


</Body>
</html>" >> index.php
exit
