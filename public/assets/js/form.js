/**
 * It's not real OOP, but the task doesn't require it anyway :)
 */

var form = {
		handle: function (e) {
			switch(e.target.id){
				case 'login':
					return this.submitLoginForm();
				case "editBook":
					return this.submitEditForm(e.target);
			}
		},
		
		error: function(error)
		{
			// need cooler error handling? add it here!
			$("#error").html(
				'<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' + error);
		},

		submitLoginForm: function() {
			var username = $('#username').val();
			var password = $('#password').val();
			
			if (!username || !password){
				form.error('Invalid login, please try again');
				return false;
			}
			$.post('../app.php', {
				route: 'login',
				username: username,
				password: password
			}, function (resp){
				if (resp) {
					render(resp);
				} else {
					form.error('Invalid login, please try again!');
				}
			})
		},
		
		submitEditForm: function (target){
			
			var formData = new FormData(target);
			formData.append('route', 'edit');
			
			var errorText = validateInfo(); //below
			if (errorText) {
				form.error(errorText);
				return false;
			}
			
			if (formData.get('key')){
				removeUnchanged();  //below
			}

		    $.ajax({
		        url: "../app.php",
		        type: 'POST',
		        data: formData,
		        async: true,
		        success: function (resp) {
					if (resp) {
						render(resp);
					} else {
						form.error('Server error!');
					}
		        },
		        cache: false,
		        contentType: false,
		        processData: false
			})
			
			function validateInfo(){
				var errorText = '';
				
				if (!formData.get('title')){
					errorText += ' Insert book title.';
				}
				
				if (!formData.get('author')){
					errorText += ' Insert book author.';
				}
				
				if (!formData.get('date') 
						|| !formData.get('date').match(/^(19|20)\d\d-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/))
				{
					errorText += ' Invalid date format.';
				}
				
				if (!formData.get('format') || !formData.get('format').match(/^A\d$/)){
					errorText += ' Invalid page format.';
				}
				
				if (isNaN(formData.get('pages'))){
					errorText += ' The number of pages must be a number.';
				}
				
				if (formData.get('isbn') < Math.pow(10,12) || formData.get('isbn') >= Math.pow(10,13)){
					errorText += ' ISBN must be valid 13 digget number.';
				}
				
				if (formData.get('resume').length < 100 || formData.get('resume').length > 65534){
					errorText += ' Enter at least a 100 characters resume.';
				}
				
				if (!formData.get('key') && 
						(!formData.get('file') || formData.get('file').size > 2097152 
								|| formData.get('file').type.indexOf('image') == -1))
				{
					errorText += ' Upload an image up to 2MB.';
				}
				return errorText;
			}
			
			function removeUnchanged(){

				var oldData = {
						title: $('#title').attr('old'),
						author: $('#author').attr('old'),
						date: $('#date').attr('old'),
						format: $('#format').attr('old'),
						pages: $('#pages').attr('old'),
						isbn: $('#isbn').attr('old'),
						resume: $('#resume').attr('old'),
				}
				
				if (formData.get('title') == oldData.title){
					formData.delete('title');
				}
				
				if (formData.get('author') == oldData.author){
					formData.delete('author');
				}
				
				if (formData.get('date') == oldData.date){
					formData.delete('date');
				}
				
				if (formData.get('format') == oldData.format){
					formData.delete('format');
				}
				
				if (formData.get('pages') == oldData.pages){
					formData.delete('pages');
				}
				
				if (formData.get('isbn') == oldData.isbn){
					formData.delete('isbn');
				}
				
				if (formData.get('resume') == oldData.resume){
					formData.delete('author');
				}
			}
		}
}