/* DOKUWIKI:include_once raphael.min.js */
/* DOKUWIKI:include_once flowchart.min.js */

jQuery(function(){

function draw (style){
	var sel = 'pre.flowchartjs';
	if (style != '') sel = sel + '.' + style;
	return function (opt){
		jQuery(sel).each(function (index){
			var cls = jQuery(this).attr('class').replace(/^\s+|\s+$/, '').replace(/\s+/g, ' ').split(' ');
			var obj = flowchart.parse( jQuery(this).text() );
			var classes = cls.length == 1? cls[0]: cls[0] + ' ' + cls[1];
			var id = classes.replace(/ /g, '_') + '_' + index;
			jQuery(this).replaceWith(
				jQuery('<div class="' + classes + '" id="' + id + '"></div>')
			);
			obj.drawSVG(id, opt);

			div_size_style = "";
			if (cls.length >= 3) div_size_style = div_size_style + "width: " + cls[2] + ";";
			if (cls.length >= 4) div_size_style = div_size_style + "height: " + cls[3] + ";";
			if (div_size_style != "") jQuery('div#' + id).attr('style', div_size_style);
			
			jQuery('div#' + id + ' svg').attr(
				'style',
				jQuery('div#' + id + ' svg').attr('style') + ' height: 100%; width: 100%;'
			);
		});
	};
}
/*
 * callback should indicate style info
 */
function draw1style (style, callback){
	jQuery.ajax(DOKU_BASE + 'lib/plugins/flowchartjs/styles/' + style + '.json', {dataType: 'json'})
		.done(function(d){
			callback(d);
		})
		.fail(function(j, s, e){
			callback(null);
		});
}

var classes = [];
jQuery('pre.flowchartjs').each(function(index){
	var cls = jQuery(this).attr('class').replace(/^\s+|\s+$/g, '').replace(/\s+/g, ' ').split(' ');
	if (cls.length == 1) classes[''] = 1;
	else classes[cls[1]] = 1;
	return true;
});

for (var cls in classes){
	draw1style(cls, callback=draw(cls));
}

});

