

<?php include("valutec.php");?>
<?php

	/**
		* This function send info to valuetech and return response.
		*
		* @access 	public
		* @param 	string 		$txtTID 				TERMINAL ID 
		* @param 	string 		$txtClientKey 			Client Key 
		* @param    string     	$txtCardNumber  		Card Number
		* @param    string     	$txtAmount  			Amount $
		* @return 	string 		$echomsg 			response data of request
	*/

	//check if cardnumber, amount are setted.	
	if(isset($_POST['txtTID']) && isset($_POST['txtClientKey']) && isset($_POST['txtCardNumber']) && isset($_POST['txtAmount']))
	{
		$InputTID = $_REQUEST['txtTID'];
		$InputClientKey = $_REQUEST['txtClientKey'];
		$InputCardNumber = $_REQUEST['txtCardNumber'];
		$InputAmount = $_REQUEST['txtAmount'];
		$ResultData = Sale($InputTID, $InputClientKey, $InputCardNumber, $InputAmount, "Gift");
		//
		//Assign some of the data in the array to local variables for easier use.
		//
		$Authorized			= $ResultData->Authorized;
		$Balance			= $ResultData->Balance;
		$CardAmountUsed		= $ResultData->CardAmountUsed;

		$echomsg = ""; // Output result;
		if($Authorized == 1)
		{
			//
			// Since we're in this code block, the transaction HAS been approved.
			//
			$echomsg = 'Your transaction was approved.<br/>';
			$echomsg .= 'Your Approval Code is ' . $ResultData->AuthorizationCode . '.<br/>';
			
			//
			//This demonstrates the "Split-Pay" functionality.
			//
			//If the amount redeemed is more than what is available on the card and you have requested that Valutec
			//has enabled SplitPay on your account, then you will ALWAYS get an Approved Response.
			//
			//The $CardAmountUsed variable will contain the actual amount redeemed ONLY IF the amount requested is
			//more than what is available.  Otherwise the variable will be empty.
			//
			//
			if($CardAmountUsed != '')
			{
				$echomsg .= 'The amount of ' . $InputAmount . ' is more than what is available on the card.<br/>';
                $echomsg .= 'Only ' . $CardAmountUsed . ' was redeemed, and the card has been depleted.<br/>';
                $echomsg .= 'You must still collect ' . ($InputAmount - $CardAmountUsed) . ' by other means to cover the full amount of this transaction.<br/>';
        
			}
			
		    //
		    // Show the balance remaining on the card.
		    //
		    $echomsg .='The balance remaining on the card is : ' . $Balance;
			
	    }else{
	
		    //
		    // Since we're in this code block, the transaction has been denied. Show the Error.
		    // This will probably not be something you'll want to show to your clients.
		    // If Split-Pay is not enabled on your Valutec account, the main thing to look for
		    // here is an NSF (Non-Sufficient Funds) message.
		    //
		    $echomsg .= 'Your transaction was DENIED.<br/>';
		    $echomsg .= 'reason : ' . $ErrorMsg;
			
		}

		$RawOutput			= $ResultData->RawOutput;
        $TerminalID			= $ResultData->TerminalID;
        $IPaddress			= $ResultData->IPaddress;
        $AuthorizationCode	= $ResultData->AuthorizationCode;
        $TransactionType	= $ResultData->TransactionType;
        $PointBalance		= $ResultData->PointBalance;
        $RewardLevel		= $ResultData->RewardLevel;
        $Refund				= $ResultData->Refund;
        $AmountDue			= $ResultData->AmountDue;	
        $Identifier			= $ResultData->Identifier;
        $ErrorMsg			= $ResultData->ErrorMsg;

        $echomsg .= '<hr size=1 color=maroon/>';
        $echomsg .= '<font size=2 color=maroon face=couriernew>';
        $echomsg .=  'RawOutput = ' . $RawOutput . '<br/>';
        $echomsg .=  'TerminalID = ' . $TerminalID . '<br/>';
        $echomsg .=  'IPaddress = ' . $IPaddress . '<br/>';
        $echomsg .=  'Authorized = ' . $Authorized . '<br/>';
        $echomsg .=  'AuthorizationCode = ' . $AuthorizationCode . '<br/>';
        $echomsg .=  'TransactionType = ' . $TransactionType . '<br/>';
        $echomsg .=  'Balance = ' . $Balance . '<br/>';
        $echomsg .=  'PointBalance = ' . $PointBalance . '<br/>';
        $echomsg .=  'RewardLevel = ' . $RewardLevel . '<br/>';
        $echomsg .=  'Refund = ' . $Refund . '<br/>';
        $echomsg .=  'CardAmountUsed = ' . $CardAmountUsed . '<br/>';
        $echomsg .=  'AmountDue = ' . $AmountDue . '<br/>';
        $echomsg .=  'Identifier = ' . $Identifier . '<br/>';
        $echomsg .=  'ErrorMsg = ' . $ErrorMsg . '<br/>';
        $echomsg .=  '</font><hr size=1 color=maroon/>';
		
		echo $echomsg;
	}
?>