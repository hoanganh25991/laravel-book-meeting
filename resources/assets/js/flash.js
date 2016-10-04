let endAnimationSignal = 'animationend';
let animation = 'fadeOutRight';
let flashDiv = $('.alert');
let flash = function(msg, level){
	level = level || 'info';

	flashDiv.html(msg);
	flashDiv.attr('class', `alert alert-${level}`);

	let interval = setInterval(()=>{
		flashDiv.addClass(`animated  ${animation}`);
		clearInterval(interval);
	}, 3000);

	flashDiv.one(endAnimationSignal, ()=>{
		// flashDiv.removeClass();
		console.log('animation end');
	});
};
window.flash = flash;