<?php

namespace Otus\Doctors;

use Otus\AbstractIblockPropertyValuesTable;
use Bitrix\Main\Entity\ReferenceField;

class DoctorsPropertyValuesTable extends AbstractIblockPropertyValuesTable
{
	public const IBLOCK_ID = 22;

	public static function getMap(): array
	{
		$map = [
			'PROC' => new ReferenceField(
				'PROC',
				\Bitrix\Iblock\Elements\ElementProceduresTable::class,
				['=this.PROCEDURES' => 'ref.ID']
			)
		];

		return parent::getMap() + $map;

	}

}