window.addEvent('domready',function() {
	$$('td.*_event').each(function(element,index) {
		var content = element.get('title').split('::');
		element.store('tip:title', content[0]);
		element.store('tip:text', content[1]);
	});
	
	var scheduleTip = new Tips($$('td.*_event'), {
			className: '*_event',
			fixed: false
	});

	scheduleTip.addEvents({
		'show': function(tip) {
			tip.fade('in');
		},
		'hide': function(tip) {
			tip.fade('out');
		}
	});
});
