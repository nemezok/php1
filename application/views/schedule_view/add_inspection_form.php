<?php
if(!isset($_POST['start_add_inspection'])){ return; }

$oid = $_POST['oid'];
$rid = $_POST['rid'];
$date = $_POST['date'];
$time = $_POST['time'];
?>

<h2>Запланировать встречу</h2>

<form id="form" class="add_inspection" action="" method="POST">
	<input name="add_inspection" type="hidden">
	<input name="object_id" type="hidden" value="<?php echo $oid; ?>">
	<input name="realtor_id" type="hidden" value="<?php echo $rid; ?>">

	<input name="date" type="date" value="<?php echo $date; ?>">

	<select name="time">
		<option disabled selected>Время</option>
		<?php for($t=1; $t<=10; $t++): ?>
		<option value="<?php echo $t; ?>" <?php if($t == $time) echo 'selected'; ?>><?php echo $times[$t]; ?></option>
		<?php endfor; ?>
	</select>

	<?php for($i=0; $i<3; $i++): ?>
	<select name="clients[]">
		<option disabled selected>Клиент</option>
		<?php foreach($client_list as $client): ?>
		<option value="<?php echo $client->ID; ?>"><?php echo $client->name; ?></option>
		<?php endforeach; ?>
	</select>
	<?php endfor; ?>

	<button type="submit">Запланировать</button>
</form>