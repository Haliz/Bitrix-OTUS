<?php

require_once('crest.php');
//		require_once (__DIR__.'/crest.php');

//$eventBind = CRest::call(
//	'event.bind',
//	[
//		'event' => 'ONCRMACTIVITYADD',
//		'handler' => 'https://cy28799.tw1.ru/marketplace/otus/index.php'
//	]
//);
//if($eventBind['result'])
//{
//	echo 'event bind successful';
//}

//echo '<PRE>';
//print_r($result);
//echo '</PRE>';
//file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log_rest.log', var_export($result, true)); // ,FILE_APPEND
//file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log_rest.log', var_export($_REQUEST, true));
//
//echo '<PRE>';
//file_put_contents($_SERVER['DOCUMENT_ROOT'].'/log_rest.log', var_export($_REQUEST['data']['FIELDS']['ID'], true),FILE_APPEND);
//
//echo '</PRE>';


function dealDefining($activityId)
{
	$result = CRest::call(
		'crm.activity.binding.list',
		[
			'activityId' => $activityId // ID дела
		]
	);

	//	echo '<PRE>';
	//	print_r($result);
	//	echo '</PRE>';
	//	print("Hfcgtxfnfr <br />");
	foreach ($result['result'] as $item)
	{
		//		print_r($item); //"Item = $item";
		if ($item['entityTypeId'] == 2)
		{
			return $dealID = $item['entityId'];
		}
	}
}

function contactDefining($dealID)
{
	$result = CRest::call(
		'crm.deal.get',
		[
			'ID' => $dealID
		]
	);

	return $result['result']['CONTACT_ID'];
}

function updateContact($contactID)
{
	$result = CRest::call(
		'crm.contact.update',
		[
			'ID' => $contactID,
			'FIELDS' => [
				'UF_CRM_1741724740059' => date("Y-m-d H:i:s")
			]
		]
	);
}

$activityId = $_REQUEST['data']['FIELDS']['ID'];
$dealID = dealDefining($activityId);
$contactID = contactDefining($dealID);
updateContact($contactID);


