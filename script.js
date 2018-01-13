/* DOKUWIKI:include_once raphael.min.js */
/* DOKUWIKI:include_once flowchart.min.js */

jQuery(function(){

function draw (style){
	var sel = 'pre.flowchartjs';
	if (style) sel = sel + '.' + style;
	return function (opt){
		jQuery(sel).each(function (index){
			var classes = jQuery(this).attr('class');
			var id = classes.replace(/ /g, '_') + '_' + index;
			var obj = flowchart.parse( jQuery(this).text() );
			jQuery(this).replaceWith(
				jQuery('<div class="' + classes + '" id="' + id + '"></div>')
			);
			obj.drawSVG(id, opt);
		});
	};
}
/*
 * callback should indicate style info
 */
function draw1style (style, callback){
	jQuery.ajax('./lib/plugins/flowchartjs/styles/' + style + '.json', {dataType: 'json'})
		.done(function(d){
			callback(d);
		})
		.fail(function(j, s, e){
			callback(null);
		});
}

var classes = [];
jQuery('pre.flowchartjs').each(function(index){
	var cls = jQuery(this).attr('class');
	cls = cls.replace(/flowchartjs/, '');
	cls = cls.replace(/^\s+/, '');
	cls = cls.split(' ')[0];
	classes[cls] = 1;
	return true;
});

for (var cls in classes){
	draw1style(cls, callback=draw(cls));
}

});

