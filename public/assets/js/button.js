/**
 * It's not real OOP, but the task doesn't require it anyway :)
 */

var button = {
		handle: function (e) { 
			var t = $(e.target);

			if(t.hasClass('add')){
				return this.clickAddButton();
			}
			if(t.hasClass('edit')){
				return this.clickEditButton(t)
			}
			if(t.hasClass('delete')){
				return this.clickDeleteButton(t)
			}
			if(t.hasClass('table')){
				return this.clickBackToTableButton();
			}
			if(t.hasClass('logout')){
				return this.clickLogoutButton();
			}
			if(t.hasClass('index')){
				return this.clickIndexButton();
			}
			return false;
		},
		
		clickIndexButton: function() {
			$.get('../app.php', {
				route: 'index',
			}, function (resp){
				if (resp) {
					render (resp);
				}
			})
		},

		clickAddButton: function() {
			$.get('../app.php', {
				route: 'editForm',
			}, function (resp){
				if (resp) {
					render (resp);
				}
			})
		},
		
		
		clickEditButton: function(target){
			var article = target.closest('article');
			var data = {
					key: article.attr('id').replace("book", ''),
					title: article.find('.title').eq(0).html(),
					author: article.find('.author').eq(0).html(),
					date: article.find('.date').eq(0).html().replace(" Published: ", ''),
					format: article.find('.format').eq(0).html(),//.replace(" Format: ", ''),
					pages: article.find('.pages').eq(0).html(),//.replace(" Pages: ", ''),
					isbn: article.find('.isbn').eq(0).html(),//.replace(" ISBN: ", ''),
					resume: article.find('.resume').eq(0).text(),
			};

			$.get('../app.php', {
				route: 'editForm',
				data: data
			}, function (resp){
				if (resp) {
					render (resp);
				}
			})
		},
		
		
		clickDeleteButton: function(target){
			var article = target.closest('article');
			var title = article.find('.title').eq(0).html();
			
			if(!confirm("Are you sure? " + title + " will be deleted!")){
				return;
			}
			
			$.post('../app.php', {
				route: 'delete',
				id: article.attr('id'),
				/**
				 * add params here
				 */
			}, function (resp){
				if (resp) {
					append (resp);
				}
				article.remove();
			})
		},
		

		clickBackToTableButton: function(){
			$.get('../app.php', {
				route: 'table',
			}, function (resp){
				if (resp) {
					render (resp);
				}
			})
		},
		
		clickLogoutButton: function () {
			$.post('../app.php', {
				route: 'logout',
			}, function (resp){
				if (resp) {
					render (resp);
				}
			})
		}
}