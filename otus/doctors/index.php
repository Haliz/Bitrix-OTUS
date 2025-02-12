<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Врачи');

use Bitrix\Main\Loader;

Loader::includeModule('iblock');

function getDoctors($id = NULL) : array
{
	$res = [];
	$query = \Otus\Doctors\DoctorsPropertyValuesTable::query()
		->setSelect(['ID'=>'IBLOCK_ELEMENT_ID' ,'LAST_NAME', 'DOCNAME', 'SECOND_NAME', 'PROCEDURES']);
	if($id != null) {
		$query = $query ->setFilter(array('=ID' => $id));
	}
	$elements = $query->fetchAll();
	foreach ($elements as $element)
	{
		$res[$element['ID']] = $element;
//
	}
	return $res;
}
//pr(getDoctors(53));

function getDoctorProcedures($id)
{
$doctor = getDoctors($id);
$proceduresID = $doctor [$id]['PROCEDURES'];
$procName =[];
foreach ($proceduresID as $proc) {
	$procName[] = \Bitrix\Iblock\Elements\ElementProceduresTable::getByPrimary(
		$proc, ['select' => ['NAME']])
		->fetch()['NAME'];
}
$res = $doctor [$id];
$res ['PROC_NAME'] = $procName;
return $res;
}
//pr(getDoctorProcedures(53));
//die;
$proc = isset($_GET['proc']) ? $_GET['proc'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Если есть параметры, отображаем процедуры врача
if ($proc && $id) {
	$doctor = getDoctorProcedures($id);
	?>
	<!DOCTYPE html>
	<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--		<title>--><?php //echo $doctor['LAST_NAME'] . ' ' . $doctor['DOCNAME'] . ' ' . $doctor['SECOND_NAME']; ?><!--</title>-->
		<style>
			body {
				font-family: Arial, sans-serif;
				background-color: #f8f8f8;
				margin: 0;
				padding: 20px;
			}
			h2 {
				color: #6a5acd; /* Сиреневый цвет */
			}
			h3 {
				color: #333;
			}
			.procedure-list {
				list-style-type: none;
				padding: 0;
			}
			.procedure-list li {
				background-color: #fff;
				padding: 10px;
				margin: 5px 0;
				box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
				border-radius: 5px;
			}
		</style>
	</head>
	<body>
	<h2><?php echo $doctor['LAST_NAME'] . ' ' . $doctor['DOCNAME'] . ' ' . $doctor['SECOND_NAME']; ?></h2>
	<h3>Процедуры</h3>
	<ul class="procedure-list">
		<?php foreach ($doctor['PROC_NAME'] as $procedure): ?>
			<li><?php echo $procedure; ?></li>
		<?php endforeach; ?>
	</ul>
	<div class="button-container">
		<a class="back-button" href="index.php">Назад</a>
	</div>
	</body>
	</html>
	<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
	exit; // Завершаем выполнение скрипта после отображения процедур
}

// Если параметров нет, отображаем список врачей
$doctors = getDoctors();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--	<title>Врачи</title>-->
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f8f8f8;
			margin: 0;
			padding: 20px;
		}
		h1 {
			text-align: center;
			color: #6a5acd; /* Сиреневый цвет */
		}
		.doctor-button {
			display: inline-block;
			background-color: #e0d7f1; /* Бело-сиреневый цвет */
			color: #333;
			padding: 15px 30px;
			margin: 10px;
			text-align: center;
			text-decoration: none;
			border-radius: 5px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			transition: background-color 0.3s, transform 0.3s;
		}
		.doctor-button:hover {
			background-color: #d1c8e3; /* Более темный сиреневый цвет при наведении */
			transform: translateY(-2px);
		}
		.button-container {
			text-align: center;
			margin-top: 20px;
		}
	</style>
</head>
<body>
<h1>Врачи</h1>
<div class="button-container">
	<?php foreach ($doctors as $doctor): ?>
		<a class="doctor-button" href="?proc=1&id=<?php echo $doctor['ID']; ?>">
			<?php echo $doctor['LAST_NAME'] . ' ' . $doctor['DOCNAME'] . ' ' . $doctor['SECOND_NAME']; ?>
		</a>
	<?php endforeach; ?>
</div>
 </div>

</body>
</html>
<?php
//echo '<pre>';
//echo "Hello!";
//echo '</pre>';

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';