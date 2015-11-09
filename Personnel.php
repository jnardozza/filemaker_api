<?php

class Personnel
{
	private static $table = "PERSONNEL";
	private static $layout = "API_PERSONNEL";
	private static $api_find = "api_Personnel.Find";

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
		foreach ($records as $personnel) {
			$p = [];
			$p["id"] 			= $personnel->getField("_kp_ID");
			$p["active"] 		= $personnel->getField("isActive");
			$p["age"] 			= $personnel->getField("Age_calc");
			$p["birthday"] 		= $personnel->getField("Birthday");
			$p["dateHired"] 	= $personnel->getField("Date_Hired");
			$p["dateLeft"] 		= $personnel->getField("Date_Left");
			$p["name"] 			= $personnel->getField("Name_Display_calc");
			$p["nameFirst"] 	= $personnel->getField("Name_First");
			$p["nameLast"] 		= $personnel->getField("Name_Last");
			$p["status"] 		= $personnel->getField("Status");
			$p["username"] 		= $personnel->getField("Username_Web");

			$result[] = $p;
		}
		return $result;
	}
	#====================================================================================================
	#END FIND EVENTS
	#====================================================================================================
}
?>