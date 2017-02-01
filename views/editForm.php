<?php 
function eis ($key, $else = ""){ //eis = echo if set
	echo isset($GLOBALS['args']['data'][$key]) ? $GLOBALS['args']['data'][$key] : $else;
}
?>

<form id="editBook" method="post" action="javascript:void(0);" enctype="multipart/form-data">
	<p id="error"></p>

	<input type="hidden" id="key" class="hidden" name="key" value=<?php eis('key'); ?>>
	
	<div class="left col">
		<div>
			<input id="title" name="title" placeholder="Book title"
			 	value="<?php eis("title")?>" old="<?php eis("title")?>">
		</div>
		
		<div>
			<input id="author" name="author" placeholder="Author" 
				value="<?php eis('author')?>" old="<?php eis('author')?>">
		</div>
	</div>
		
	<div class="right col">
		<div>
			<input id="date" name="date" placeholder="Publish Date: YYYY-MM-DD"
			 	value="<?php eis('date')?>" old="<?php eis('date')?>">
	<!-- 		date inputs have poor browser support.		 -->
		</div>
		
		<div>
			<select id="format" name="format" old=<?php eis('format'); ?> >
				<option value=<?php eis('format')?>
					hidden selected="selected"><?php eis('format', 'Select Format'); ?></option>
				<option value="A4">A4</option>
				<option value="A5">A5</option>
			</select>
		</div>
	</div>
	
	<div class="left col">
		<div>
			<input type="number" id="pages" name="pages" placeholder="Page count"
				 value=<?php eis('pages')?> old=<?php eis('pages'); ?>>
		</div>
		
		<div>
			<input type="number" id="isbn" name="isbn" placeholder="ISBN" 
				value=<?php eis('isbn')?> old=<?php eis('isbn')?>>
		</div>
	</div>
	
	<div class="right col">
		<textarea class="resume" name="resume" placeholder="Resume" 
			old="<?php eis('resume'); ?>"><?php eis('resume', ''); ?></textarea>
	</div>
	
	<div class="submit">
		<label for="file"><i class="left fa fa-picture-o" aria-hidden="true"></i></label>
	   	<input id='file' type="file" name="file">
		<button type="submit" class="right">Submit <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
	</div>
</form>