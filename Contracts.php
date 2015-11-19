<?php
require_once "FM_Table.php";

class Contracts extends FM_Table
{
	private static $table = "CONTRACTS";
	private static $layout = "CONTRACTS";
	private static $api_find = "api_Contracts.Find";
	private static $fields = array(
			"id" => "_kp_ID",
			"client_id" => "_kf_ClientID",
			"client_display" => "Client_Display_calc",
			"service_id" => "_kf_ServiceID",
			"service_display" => "Service_Display_calc",
			"account_id" => "_kf_AccountID",
			"account_display" => "Account_Display_calc",
			"dateStart" => "Date_Start",
			"dateEnd" => "Date_End",
			"description" => "Description",
			"display" => "Display_calc",
			"hoursContract" => "Hours_Contract_number",
			"hoursMonthly" => "Hours_Monthly_Budget_number",
			"hoursDaily" => "Hours_Daily_Max",
			"hoursScheduled" => "Hours_Scheduled_calc",
			"active" => "isActive",
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
	#GET FIELDS
	#====================================================================================================
	public static function getFields(){
		return self::$fields;
	}
	#====================================================================================================
	#END GET FIELDS
	#====================================================================================================


	#====================================================================================================
	#FIND CONTRACTS
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
	#END FIND CONTRACTS
	#====================================================================================================
}
?>