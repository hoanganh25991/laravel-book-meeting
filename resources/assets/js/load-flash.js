let f_overlay = $('.f_overlay');

let flashDiv;
let isCreateNew = false;
if(f_overlay.find('.alert').length == 0){
	flashDiv = $('<div class="alert alert-info"></div>');
	flashDiv.appendTo(f_overlay);
	flashDiv.addClass('hidden');
	isCreateNew = true;
}else
	flashDiv = $('.alert');

let flashDivClass = flashDiv.attr('class');
//only hide flashMsg when it NOT important
let isImportantMsg = flashDivClass.includes('alert-important');

if(!isCreateNew){
	let waitFor = 3000;
	let interval = setInterval(function(){
		let animation = 'animated fadeOutRight';
		if(isImportantMsg){
			animation = '';
		}
		flashDiv.addClass(animation);

		clearInterval(interval);
	}, waitFor);
}