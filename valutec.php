<?php
/*******************************************************************************************
 GLOBAL VARIABLES
 -------------------------------
 Modify these variables to match your settings as supplied by Valutec to you.  This will allow
 all these sample pages to work with your cards & data.  This is something you MUST do if you
 plan to simply copy this page to use within your own website for your customers.
********************************************************************************************/

	//CLIENT KEY
	//--------------------------------------
	//define('ClientKey', '45C4DDCC-FEB1-4CB1-99F0-1BA71D6D8F69');
	define('ClientKey', '45C4DDCC-FEB1-4CB1-99F0-1BA71D6D8F69');	
	
	//TERMINAL ID
	//--------------------------------------
	//define('TID', 333333);
	define('TID', 881556);
	
	//SERVER ID
	//--------------------------------------
	define('ServerId', 1);
	
	



	
/*******************************************************************************************

DO NOT MODIFY BELOW THIS LINE			DO NOT MODIFY BELOW THIS LINE

********************************************************************************************/
	define('ProgramType','Gift');
	define('Identifier',substr(sha1(time()),0,10));
	define('CLIENT','https://ws.valutec.net/Valutec.asmx?WSDL');
	
	function GiftBalance($CardNumber)
	{
		return CardBalance($CardNumber, 'Gift');
	}
	function LoyaltyBalance($CardNumber)
	{
		return CardBalance($CardNumber, 'Loyalty');
	}
    function CardBalance($CardNumber, $ProgramType)
   	{
		$input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => $ProgramType,
			'CardNumber' => $CardNumber,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$trans = $client->Transaction_CardBalance($input);
		$data = $trans->Transaction_CardBalanceResult; 
		
		if(Identifier == $data->Identifier)
		{
			$response = (!empty($data->Balance) && is_numeric($data->Balance) ? $data->Balance : $data->ErrorMsg);
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		}
		
		return $response;
	}

    function Sale($TID, $ClientKey, $CardNumber, $Amount, $CardType)
  	{
        $input = array
		(
			'ClientKey' => $ClientKey,
			'TerminalID' => $TID,
			'ProgramType' => $CardType,
			'CardNumber' => $CardNumber,
			'Amount' => $Amount,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$bal = $client->Transaction_Sale($input);
		$data = $bal->Transaction_SaleResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
			//$response = (!empty($data->Balance) && is_numeric($data->Balance) ? $data->Balance : $data->ErrorMsg);
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		} 
		return $response; 
	}

    function RestaurantSale($CardNumber, $Amount, $TipAmount)
   	{
       $input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType,
			'CardNumber' => $CardNumber,
			'Amount' => $Amount,
			'TipAmount' => $TipAmount,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$bal = $client->Transaction_RestaurantSale($input);
		$data = $bal->Transaction_RestaurantSaleResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		}
		
        return $response; 
	}
		
	function AddValue($CardNumber, $Amount, $CardType)
   	{
      	$input = array
		(	
			'ClientKey' => ClientKey,	
			'TerminalID' => TID,
			'ProgramType' => $CardType,
			'CardNumber' => $CardNumber,
			'Amount' => $Amount,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1)); 
		$trans = $client->Transaction_AddValue($input);
		$data = $trans->Transaction_AddValueResult; 
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		} 
		
		return $response;
	} 
		
   	function ActivateCard($CardNumber, $Amount, $CardType)
  	{
    	$input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => $CardType,
			'CardNumber' => $CardNumber,
			'Amount' => $Amount,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1)); 
		$trans = $client->Transaction_ActivateCard($input);
		$data = $trans->Transaction_ActivateCardResult; 
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		} 
		
		return $response;
	}
       
    function DeactivateCard($CardNumber)
   	{
		$input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType,
			'CardNumber' => $CardNumber,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$trans = $client->Transaction_DeactivateCard($input);
		$data = $trans->Transaction_DeactivateCardResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		}
		
		return $response;
	}
		
   	function HostTotals($TotalType)
  	{
    	$input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType,
			'TotalType' => $TotalType,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$bal = $client->Transaction_HostTotals($input);
		$data = $bal->Transaction_HostTotalsResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		} 
		
		return $response; 
	}
          
    function ReplaceCard($NewCardNumber, $OldCardNumber)
   	{
        $input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType,
			'OldCard' => $OldCardNumber,
			'CardNumber' => $NewCardNumber,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$bal = $client->Transaction_ReplaceCard($input);
		$data = $bal->Transaction_ReplaceCardResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		}
		
        return $response; 
	}
          
    function Void($CardNumber, $AuthCode)
   	{
        $input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType,
			'CardNumber' => $CardNumber,
			'RequestAuthCode' => $AuthCode,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$bal = $client->Transaction_Void($input);
		$data = $bal->Transaction_VoidResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		}
		
        return $response; 
	}

    function CreateECommerceCard($CardProgram, $Amount)
   	{
      	$input = array
		(		
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType,
			'CardProgram' => $CardProgram,
			'Amount' => $Amount,
			'ServerID' => ServerId,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1)); 
		$trans = $client->Transaction_CreateCard($input);
		$data = $trans->Transaction_CreateCardResult; 
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		} 
		
		return $response;
	}

    function TransactionRequest($TransactionType, $CardNumber = '', $Amount = '', $TipAmount = '', $AuthCode = '', $OldCardNumber = '')
   	{ 
        $input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'ProgramType' => ProgramType, 
			'TransactionType' => $TransactionType, 
			'CardNumber' => $CardNumber,
			'Amount' => $Amount,
			'ServerID' => ServerId,
			'TipAmount' => $TipAmount,
			'RequestAuthCode' => $AuthCode,
			'OldCard' => $OldCardNumber,
			'Identifier' => Identifier
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$bal = $client->Transaction_Generic($input);
		$data = $bal->Transaction_GenericResult;
		
		if(Identifier == $data->Identifier)
		{
			$response = $data;
		}
		else
		{
			//Set a response error, codes did not match
			$response = 'Security error, transaction has been terminated';
		}
		
        return $response; 
	}
	
	
	
    function GetRegistration($CardNumber)
   	{
		$input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'CardNumber' => $CardNumber
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$trans = $client->Registration_Get($input);
		$data = $trans->Registration_GetResult; 
		
		return $data;
	}

    function SetRegistration($CardNumber, $Name='', $Address1='', $Address2='', $City='', $State='', $Zip='', $Telephone='', $Email='', $DOB='', $M1='', $M2='', $M3='', $M4='', $M5='')
   	{
		$input = array
		(
			'ClientKey' => ClientKey,
			'TerminalID' => TID,
			'CardNumber' => $CardNumber,
			'Name' => $Name,
			'Address1' => $Address1,
			'Address2' => $Address2,
			'City' => $City,
			'State' => $State,
			'Zip' => $Zip,
			'Telephone' => $Telephone,
			'EmailAddress' => $Email,
			'DateOfBirth' => $DOB,
			'Misc1' => $M1,
			'Misc2' => $M2,
			'Misc3' => $M3,
			'Misc4' => $M4,
			'Misc5' => $M5
		);
		$client = new SoapClient(CLIENT, array('trace' => 1));
		$trans = $client->Registration_Set($input);
		$data = $trans->Registration_SetResult; 
		
		return $data;
	}	
?>