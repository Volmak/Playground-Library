<?php 
$texts = [
		'index' => '<i class="fa fa-arrow-left" aria-hidden="true"></i> ' . where(),
		'add' => 'Add_Book <i class="fa fa-book" aria-hidden="true"></i>',
		'logout' => 'Logout <i class="fa fa-key" aria-hidden="true"></i>',
		'table' => '<i class="fa fa-arrow-left" aria-hidden="true"></i> Back',
];
function where(){
	return empty($_SESSION['loggedIn']) ? 'Log_In' : 'Table';
}
?>


<header>
	<div class="organization">
		<img class="organization_logo" src="assets/images/logo.png">
		<div class="organization_name">
			<span>Playground</span> <span>Library</span>
		</div>
	</div>
	<div class="btns">
	
	<?php	for ($i = 0; $i < count($args); $i++){ ?>
		
		<button id="btn<?=$i;?>" class="<?=$args[$i]?>">
			<?= $texts[$args[$i]]?>
		</button>
		
	<?php }?>
	</div>
</header>