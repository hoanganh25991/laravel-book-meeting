let endAnimationSignal = 'animationend';
let animation = 'fadeOutRight';
let flash = function(msg, level){
	level = level || 'info';
	let flashDiv = $('.alert');
	
	flashDiv.text(msg);
	flashDiv.removeClass();
	flashDiv.addClass(`alert alert-${level}`);
	let interval = setInterval(()=>{
		flashDiv.addClass(`animated  ${animation}`);
		clearInterval(interval);
	}, 3000);

	flashDiv.one(endAnimationSignal, ()=>{
		flashDiv.removeClass(`${animation}`);
	});
};
window.flash = flash;