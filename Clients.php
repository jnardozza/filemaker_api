<?php
require_once "FM_Table.php";

class Clients extends FM_Table
{
	private static $table = "CLIENTS";
	private static $layout = "CLIENTS";
	private static $api_find = "api_Clients.Find";
	private static $fields = array(
			"id" => "_kp_ID",
			"active" => "isActive",
			"name" => "Name_Display_calc",
			"nameFirst" => "Name_First",
			"nameLast" => "Name_Last",
			"status" => "Status",
		);

	#====================================================================================================
	#GET AS OBJECT
	#====================================================================================================
	public static function getAsObject($records){
		$result = parent::getAsObject($records, self::$fields);
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
		$result = $this->getAsObject($records);
		return $result;
	}
	#====================================================================================================
	#END FIND EVENTS
	#====================================================================================================
}
?>