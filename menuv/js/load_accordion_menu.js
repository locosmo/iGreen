 ( function($) {

$(document).ready(function($){

	$('#accordion-1').dcAccordion({
		eventType: 'click',
		autoClose: true,
		saveState: true,
		disableLink: true,
		speed: 'slow',
		showCount: true,
		autoExpand: true,
		cookie	: 'dcjq-accordion-1',
		classExpand	 : 'dcjq-current'
	});
});

} ) ( jQuery );
