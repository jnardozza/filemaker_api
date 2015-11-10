<?php

class FM_Table
{
	#====================================================================================================
	#GET AS OBJECT
	#====================================================================================================
	public static function getAsObject($records, $fields){
		$result = [];
		foreach ($records as $record) {
			$r = [];
			foreach ($fields as $attribute => $field) {
				$r[$attribute] = $record->getField($field);
			}
			$result[] = $r;
		}
		return $result;
	}
	#====================================================================================================
	#END GET AS OBJECT
	#====================================================================================================


	#====================================================================================================
	#GET AS PARAMETER - accepts a dictionary of $attribute => $value and converts to $field => $value
	#====================================================================================================
	public static function getAsParameter($request, $fields){
		$result = [];
		foreach ($request as $attribute => $value) {
			$field = $fields[$attribute];
			$result[$field] = $value;
		}
		return $result;
	}
	#====================================================================================================
	#END GET AS PARAMETER
	#====================================================================================================
}
?>