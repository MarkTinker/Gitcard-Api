<html>
<head>
	<title>Retail Test Sample</title>
</head>
<body>

	<h1>Valutec Integration Samples (PHP SCRIPT)</h1>
	<h2>(G01) - GIFT Retail Sale</h2>
	<hr size=1/>
	
	<!-- BEGIN SAMPLE -->
	
	<form name="frmSample" method="POST" action="giftcardapi.php">
	<table>
	<tr>
		<td>Client Key: </td>
		<td>
			<input id="txtClientKey" type="text" name="txtClientKey" size="30" maxLength="40" Value=""/>
		</td>
	</tr>
	<tr>
		<td>Terminal ID: </td>
		<td>
			<input id="txtTID" type="text" name="txtTID" size="30" maxLength="40" Value=""/>
		</td>
	</tr>
	<tr>
		<td>Card Number: </td>
		<td>
			<input id="txtCardNumber" type="text" name="txtCardNumber" size="30" maxLength="20" Value=""/>
		</td>
	</tr>
	<tr>
		<td>Amount: $ </td>
		<td><input id="txtAmount" type="text" name="txtAmount" size="10" maxLength="10" Value=""/></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<br/>
			<input type="submit" value="Process Sale"/>	
		</td>
	</tr>
	</table>
	
	</form>
	<a onclick="giftAjaxTest();">GiftCard ajax test</a>
	
	<!-- END SAMPLE -->	

</body>

<script src="http://www.google.com/jsapi" type="text/javascript"></script> 
<script type="text/javascript">google.load("jquery", "1.3.2");</script>
<script src="giftsample.js"></script>
</html>
