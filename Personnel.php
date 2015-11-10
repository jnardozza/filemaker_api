<?php
require_once "FM_Table.php";

class Personnel extends FM_Table
{
	private static $table = "PERSONNEL";
	private static $layout = "API_PERSONNEL";
	private static $api_find = "api_Personnel.Find";
	private static $fields = array(
			"id" => "_kp_ID",
			"active" => "isActive",
			"age" => "Age_calc",
			"birthday" => "Birthday",
			"dateHired" => "Date_Hired",
			"dateLeft" => "Date_Left",
			"name" => "Name_Display_calc",
			"nameFirst" => "Name_First",
			"nameLast" => "Name_Last",
			"status" => "Status",
			"username" => "Username_Web",
		);

	#====================================================================================================
	#GET AS OBJECT
	#====================================================================================================
	public static function getAsObject($records, $fields){
		$result = parent::getAsObject($records, $fields);
		return $result;
	}
	#====================================================================================================
	#END GET AS OBJECT
	#====================================================================================================

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
		$result = $this->getAsObject($records, self::$fields);
		return $result;
	}
	#====================================================================================================
	#END FIND EVENTS
	#====================================================================================================
}
?>