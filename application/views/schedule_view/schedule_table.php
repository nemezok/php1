<h2><?php echo $current_object->address; ?></h2>

<?php
$times = get_time_intervals();
$days_range = 7;
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
			<?php if($insp = $current_object_inspections[$day][$time]): ?>
				<div class="cont">
					<div><?php echo 'Риэлтор: ' . $insp->realtor; ?></div>
					<div>Клиенты: 
						<?php if($insp->clients): ?>
						<ul>
							<?php foreach($insp->clients as $client): ?>
							<li><?php echo $client->name . '('.$client->phone.')'; ?></li>
							<?php endforeach; ?>
						</ul>
						<?php endif; ?>
					</div>
				</div>
				<?php if($insp->realtor_id == $_GET['rid']): ?>
					<div class="control">
						<form action="" method="post">
							<input name="remove_inspection" type="hidden">
							<input name="inspection_id" type="hidden" value="<?php echo $insp->ID; ?>">
							<button type="submit">Удалить</button>
						</form>
					</div>
				<?php endif; ?>
			<?php elseif(!$busy[$day][$time]): ?>
				<div class="control">
					<form action="#form" method="post">
						<input name="start_add_inspection" type="hidden">
						<input name="oid" type="hidden" value="<?php echo $_GET['oid'] ?>">
						<input name="rid" type="hidden" value="<?php echo $_GET['rid'] ?>">
						<input name="date" type="hidden" value="<?php echo $day; ?>">
						<input name="time" type="hidden" value="<?php echo $time; ?>">
						<button type="submit">Запланировать</button>
					</form>
				</div>
			<?php endif; ?>
			
			<?php if($insp = $current_realtor_inspections[$day][$time]): ?><div class="busy"></div><?php endif; ?>
		</div>
		<?php endfor; ?>
	</div>
	<?php endforeach; ?>
</div>

<p class="com1"><span></span> - Встречи выбранного риэлтора</p>