<?php /*
В агентстве недвижимости продают квартиры.
При выборе квартиры клиент с риэлтором идут на объект и осматривают его.
При планировании просмотров риэлтор смотрит на расписание и выбирает время для посещения объекта. 

Требуется спроектировать такое расписание для риэлторов, учитывая что:
	1. Один риэлтор может находиться одновременно только на одном объекте
	2. Один клиент может находиться одновременно только на одном объекте
	3. Одновременно на один объект могут придти несколько клиентов с одним риэлтором.

Входные данные:
	● Таблица риэлторов
	● Таблица объектов
	● Таблица клиентов
	● Количество доступных интервалов в день - 10

Описать схему таблиц БД
Описать способ хранения данных
Описать алгоритм формирования расписания для показа конкретному риэлтору
Описать алгоритм назначения просмотра по объекту в расписании
*/

//$DB = mysqli_connect('localhost', 'root', '', 'test2') or die (mysql_error());
global $mysqli;
$mysqli = new mysqli("localhost", "root", "", "test2");

foreach(array_diff(scandir(dirname(__FILE__) . '/core/'), array('.', '..')) as $file)
	require_once(dirname(__FILE__) . '/core/' . $file); ?>

<?php
include('/filters.php');
include('/schedule_table.php');
include('/add_inspection_form.php');
?>


<style>
*{box-sizing: border-box;}
.table{font-size:13px;}
.table .row{display: flex;}
.table .cell{
	position:relative;
	flex: 1;
	/* overflow: hidden; */
	border: 1px solid #d8d8d8;
	margin: 2px;
	display: flex;
	padding: 5px;
}
.table .cell > div{
	width: 0;
	flex: 1;
	margin: -5px;
	padding: 3px;
	background: #d0d0d0;
}
.table .cell .busy{
    position: absolute;
    background: red;
    top: 6px;
    right: 6px;
}
.table .cell .control{
	background:rgba(255, 255, 255, 0.5);
	display:none;
	position:absolute;
	width:100%;
	height:100%;
}
.table .cell:hover .control{
	display:block;
}
.table ul{
	margin: 0;
	padding: 0;
	padding-left: 5px;
	list-style: none;
}

.add_inspection{}
.add_inspection select,
.add_inspection input{
    width: 100%;
    max-width: 150px;
    display: block;
    margin-bottom: 5px;
    padding: 3px 2px;
}

.com1 span{
	display: inline-block;
    width: 6px;
    height: 6px;
    background: red;
}
</style>