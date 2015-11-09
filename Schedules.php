<?php
require_once "FM_Table.php";
require_once "Events.php";

class Schedules extends FM_Table
{
	private static $table = "SCHEDULES";
	private static $layout = "API_SCHEDULES";
	private static $api_find = "api_Schedules.Find";
	private static $api_new = "api_Schedules.New";
	private static $fields = array(
			"id" => "_kp_ID",
			"client_id" => "_kf_ClientID",
			"personnel_id" => "_kf_PersonnelID",
			"service_id" => "_kf_ServiceID",
			"dateEnd" => "Date_End",
			"dateStart" => "Date_Start",
			"timeStart" => "Time_Start",
			"timeEnd" => "Time_End",
			"title" => "Title",
			"description" => "Description",
			"repeating" => "isRepeating",
			
			"sunday" => "Repeat_Sundays",
			"sundayTimeStart" => "Time_Start_Sunday",
			"sundayTimeEnd" => "Time_End_Sunday",
			
			"monday" => "Repeat_Mondays",
			"mondayTimeStart" => "Time_Start_Monday",
			"mondayTimeEnd" => "Time_End_Monday",
			
			"tuesday" => "Repeat_Tuesdays",
			"tuesdayTimeStart" => "Time_Start_Tuesday",
			"tuesdayTimeEnd" => "Time_End_Tuesday",
			
			"wednesday" => "Repeat_Wednesdays",
			"wednesdayTimeStart" => "Time_Start_Wednesday",
			"wednesdayTimeEnd" => "Time_End_Wednesday",
			
			"thursday" => "Repeat_Thursdays",
			"thursdayTimeStart" => "Time_Start_Thursday",
			"thursdayTimeEnd" => "Time_End_Thursday",
			
			"friday" => "Repeat_Fridays",
			"fridayTimeStart" => "Time_Start_Friday",
			"fridayTimeEnd" => "Time_End_Friday",
			
			"saturday" => "Repeat_Saturdays",
			"saturdayTimeStart" => "Time_Start_Saturday",
			"saturdayTimeEnd" => "Time_End_Saturday",
			
			"weeks" => "Repeat_Weeks",
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
	#FIND SCHEDULES
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
	#END FIND SCHEDULES
	#====================================================================================================


	#====================================================================================================
	#NEW SCHEDULE
	#====================================================================================================
	public function new($parameter, $connection){
		$new = $connection->newPerformScriptCommand(self::$layout, self::$api_new, $parameter);
		$result = $new->execute();

		if (Filemaker::isError($result)) {
			echo $result->getMessage();
		}

		$records = $result->getRecords();
		$result = Events::getAsObject($records);
		return $result;
	}
	#====================================================================================================
	#END NEW SCHEDULE
	#====================================================================================================

}
?>