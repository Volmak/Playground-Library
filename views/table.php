<?php
foreach ($args as $article)
{
?>
	<article class="book" id="book<?= $article['id']?>">
		<div class="half">
			<div class="left col">
				<img src="<?= COVERS_FOLDER . $article['cover']?>">
			</div>
			<div class="right col">
				<p class="title big_info"><?= $article['title']?></p>
				<p class="author big_info"><?= $article['author']?></p>
				<p class="date small_info"> Published: <?= $article['published']?></p>
				<div class="inlbl">
					<p class="small_info"> Format: </p>
					<p class="small_info"> Pages: </p>
					<p class="small_info"> ISBN: </p>
				</div>
				<div class="inlbl">
					<p class="format small_info"> <?= $article['format']?></p>
					<p class="pages small_info"> <?= $article['pages']?></p>
					<p class="isbn small_info"> <?= $article['isbn']?></p>
				</div>
				<div class="inlbl"> <p>
					<button class="delete option"><i class="fa fa-minus-circle" aria-hidden="true"></i> Delete</button>
					<button class="edit option"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </button>
				</p></div>
			</div>
		</div>
		<div>
			<div><p class="resume"><?= $article['resume']?></p></div>
		</div>
	</article>
<?php } ?>