<?php

class Clients
{
	private static $table = "CLIENTS";
	private static $layout = "CLIENTS";
	private static $api_find = "api_Clients.Find";

	#====================================================================================================
	#FIND EVENTS
	#====================================================================================================
	public function find($parameter, $connection){
		$find = $connection->newPerformScriptCommand(self::$layout, self::$api_find, $parameter);
		$result = $find->execute();

		if (Filemaker::isError($result)) {
			echo $result->getMessage();
		}

		$records = $result->getRecords();

		$result = [];
		foreach ($records as $client) {
			$c = [];
			$c["id"] 			= $client->getField("_kp_ID");
			$c["active"] 		= $client->getField("isActive");
			$c["name"] 			= $client->getField("Name_Display_calc");
			$c["nameFirst"] 	= $client->getField("Name_First");
			$c["nameLast"] 		= $client->getField("Name_Last");
			$c["status"] 		= $client->getField("Status");

			$result[] = $c;
		}
		return $result;
	}
	#====================================================================================================
	#END FIND EVENTS
	#====================================================================================================
}
?>