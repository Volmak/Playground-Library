
<nav class="pages">
	<ul>
		<?php
		for ($i = 1; $i <= $args['pages']; $i++){
			if ($args['pages'] < 11){
				echo $i == ($args['current'] + 1) ? "<li class=\"active\"> [$i] </li>" : "<li> [$i] </li>";
			} else if ($args['current'] > 6 && $args['current'] < $args['pages'] - 5){
				if ($i < 4 || ($i > $args['current'] - 1 && $i < $args['current'] + 3) || $i > $args['pages'] - 3){
					echo $i == ($args['current'] + 1) ? "<li class=\"active\"> [$i] </li>" : "<li> [$i] </li>";
				}
			} else {
				if ($i < 5 || ($i > $args['current'] - 2 && $i < $args['current'] + 4) || $i > $args['pages'] - 4){
					echo $i == ($args['current'] + 1) ? "<li class=\"active\"> [$i] </li>" : "<li> [$i] </li>";
				}
			}
		}
		?>
	</ul>
</nav>