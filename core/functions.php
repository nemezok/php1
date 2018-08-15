<?php
global $times;
$times = array(
	'',
	'9:00 - 10:00',
	'10:00 - 11:00',
	'11:00 - 12:00',
	'12:00 - 13:00',
	'13:00 - 14:00',
	'14:00 - 15:00',
	'15:00 - 16:00',
	'16:00 - 17:00',
	'17:00 - 18:00',
	'18:00 - 19:00'
);
function inspections_table ($object = null, $inspections = null, $days_range = 7, $busy = null) {
	//print_r($inspections);
	global $times;
	$h24 = 24*60*60;
	$days = range(time()-$h24, (time()+$days_range*$h24), $h24);
	?>
	<div class="table">
		<div class="row">
			<?php for($t=0; $t<=10; $t++): ?>
			<div class="cell"><?php echo $times[$t]; ?></div>
			<?php endfor; ?>
		</div>

		<?php foreach($days as $ts): $day = date('Y-m-d', $ts); ?>
		<div class="row">
			<div class="cell"><?php echo date('d.m', $ts); ?></div>
			<?php for($time=1; $time<=10; $time++): ?>
			<div class="cell">
				<div class="control">
					<form action="" method="post">
						<input name="start_add_inspection" type="hidden">
						<input name="object_id" type="hidden" value="<?php echo $_GET['oid'] ?>">
						<input name="realtor_id" type="hidden" value="<?php echo $_GET['rid'] ?>">


						<a href="">Забронировать</a>
					<a href="">Удалить</a>
				</div>
				<?php if($insp = $inspections[$day][$time]): ?>
				<div class="cont">
					<div><?php echo 'Риэлтор: ' . $insp->realtor ?></div>
					<div>Клиенты: 
						<?php if($insp->clients): ?>
						<ul>
							<?php foreach($insp->clients as $client): ?>
							<li><?php echo $client[0] . '('.$client[1].')'; ?></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<?php if($insp = $busy[$day][$time]): ?>
				<div class="busy"></div>
				<?php endif; ?>
			</div>
			<?php endfor; ?>
		</div>
		<?php endforeach; ?>
	</div>
<?php
}
?>