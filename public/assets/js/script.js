/**
 * 
 */

function render (html) {
	$('#inner_container').html(html); 
}

function append (html) {
	$('#content').append(html); 
}
	
$(document).ready(function () {
	
	$.get('../app.php', {route: 'index'}, function (resp) {
		render(resp);
	});
	
	$(document).on('submit', function(e){
		e.preventDefault();
		form.handle(e);
	});
	
	$(document).on('click', 'button', function(e){
		button.handle(e);
	});
	$(document).on('click', '.pages li:not(.active)', function(e){
		$.get('../app.php', {
			route: 'tablePage',
			page: e.target.innerHTML.replace('[', '').replace(']', '')
		}, function (resp){
			if (resp) {
				render (resp);
			}
		})
	});
})