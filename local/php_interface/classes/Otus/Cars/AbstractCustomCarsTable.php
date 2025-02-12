<?php

namespace Otus\Cars;

use Bitrix\Main\ORM\Data\DataManager;

class AbstractCustomCarsTable extends DataManager
{
	public const IBLOCK_ID = 0;


	public static function getTableName(): string
	{
		return 'b_iblock_element_prop_s'. static::IBLOCK_ID;
	}

	public static function getTableNameMulti(): string
	{
		return 'b_iblock_element_prop_m'. static::IBLOCK_ID;
	}
}