<?php
require_once "FM_Table.php";
include_once "Personnel.php";
include_once "Clients.php";

class Events extends FM_Table
{
	private static $table = "EVENTS";
	private static $layout = "API_EVENTS";
	private static $api_find = "api_Events.Find";
	private static $fields = array(
			"id" => "_kp_ID",
			"active" => "isActive",
			"client_id" => "_kf_ClientID",
			"clientName" => "Client_Display_calc",
			"service_id" => "_kf_ServiceID",
			"serviceName" => "Service_Display_calc",
			"personnel_id" => "_kf_PersonnelID",
			"personnelName" => "Personnel_Display_calc",
			"start_unix" => "Start_unix",
			"end_unix" => "End_unix",
			"time_start" => "Time_Start",
			"time_end" => "Time_End",
			"date" => "Date",
			"title" => "Title",
			"description" => "Description",
			"comments" => "Comnents",
			"allDay" => "isAllDay",
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


	#====================================================================================================
	#FIND CALENDAR RESOURCES
	#====================================================================================================
	public function getCalendarResources($connection, $group){
		$personnel = new Personnel;
		$clients = new Clients;

		$personnel_list = $personnel->find(null, $connection);
		$client_list = $clients->find(null, $connection);

		$resources = [];

		switch ($group) {		
			case 'Client':
				foreach ($client_list as $clientRecord) {
				
					foreach ($personnel_list as $personnelRecord) {
						$r = [];

						$r["id"] = $personnelRecord["id"];
						$r["clientName"] = $clientRecord["name"];
						$r["title"] = $personnelRecord["name"];

						$resources[] = $r;
					}

				};
				break;

			default:
				foreach ($personnel_list as $personnelRecord) {
						
					foreach ($client_list as $clientRecord) {
						$r = [];

						$r["id"] = $clientRecord["id"];
						$r["personnelName"] = $personnelRecord["name"];
						$r["title"] = $clientRecord["name"];

						$resources[] = $r;
					}

				};
				break;
		}
		$resources = json_encode($resources);
		return $resources;
	}

	#====================================================================================================
	#END FIND RESOURCES
	#====================================================================================================


	#====================================================================================================
	#GET CALENDAR EVENTS
	#====================================================================================================
	public function getCalendarEvents($findObject, $connection, $resource){

		$eventSearchResult = $this->find($findObject, $connection);
		
		$events = [];
		foreach ($eventSearchResult as $event) {
			$e = [];

			$e["id"] 			= $event["id"];
			$e["start"] 		= gmdate('Y-m-d\TH:i:s\Z', $event["start_unix"]);
			$e["end"] 			= gmdate('Y-m-d\TH:i:s\Z', $event["end_unix"]);
			$e["startTime"] 	= gmdate('H:i:s', $event["start_unix"]);
			$e["endTime"] 		= gmdate('H:i:s', $event["end_unix"]);
			$e["date"] 			= gmdate('Y-m-d', $event["start_unix"]);

			switch ($resource) {
				case 'Client':
					$e["resourceId"] = $event["personnel_id"];
					break;

				default:
					$e["resourceId"] = $event["client_id"];
					break;
			}

			$e["title"] 		= $event["title"];
			$e["description"] 	= $event["description"];
			$e["service_id"] 	= $event["service_id"];
			$e["serviceName"] 	= $event["serviceName"];
			$e["client_id"] 	= $event["client_id"];
			$e["clientName"] 	= $event["clientName"];
			$e["personnel_id"] 	= $event["personnel_id"];
			$e["personnelName"] = $event["personnelName"];

			if ($event["allDay"] == "1") {
				$e["allDay"] 	= true;
			}

			$events[] = $e;
		}

		$events = json_encode($events);
		return $events;
	}
	#====================================================================================================
	#END GET CALENDAR OBJECTS
	#====================================================================================================
}
?>