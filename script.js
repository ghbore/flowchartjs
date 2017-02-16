/* DOKUWIKI:include_once raphael.min.js */
/* DOKUWIKI:include_once flowchart.min.js */
/* DOKUWIKI:include_once style.js */

jQuery(function(){

jQuery('pre.flowchartjs').each(function(index){
	jQuery(this).removeClass('flowchartjs');
	var style = jQuery(this).attr('class');
	var id = '_flowchartjs_' + index;

	var obj = flowchart.parse( jQuery(this).text() );
	jQuery(this).replaceWith( jQuery('<div id="'+id+'"></div>') );

	var opt = '';
	if (style in flowchartjs_style){
		opt = flowchartjs_style[style];
	}

	obj.drawSVG(id, opt);
	return true;
});

});
