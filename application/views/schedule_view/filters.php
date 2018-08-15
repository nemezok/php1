<form action="">
	<select name="rid">
		<option value="">Риэлтор</option>
		<?php foreach($realtor_list as $r): ?>
		<option
			value="<?php echo $r->ID; ?>"
			<?php if(isset($_GET['rid']) && $_GET['rid'] == $r->ID) echo 'selected'; ?>
		>
			<?php echo $r->name; ?>
		</option>
		<?php endforeach; ?>
	</select>

	<select name="oid">
		<option value="">Объект</option>
		<?php foreach($object_list as $o): ?>
		<option
			value="<?php echo $o->ID; ?>"
			<?php if(isset($_GET['oid']) && $_GET['oid'] == $o->ID) echo 'selected'; ?>
		>
			<?php echo $o->address; ?>
		</option>
		<?php endforeach; ?>
	</select>
	
	<button type="submit">Фильтр</button>
</form>