<?php

namespace dokuwiki\plugin\flowchartjs\test;
use DokuWikiTest;

/**
 * Render tests for the flowchartjs plugin
 *
 * @group plugin_flowchartjs
 * @group plugins
 */
class plugin_flowchartjs_render_test extends DokuWikiTest {
	public function test_render(){
        // print_r(plugin_list("", true));
        global $plugin_controller; $plugin_controller->enable("flowchartjs");
		$info = array();
		$instructions = p_get_instructions("xxx<flowchartjs>\n  _cfg_\n</flowchartjs>\nxxx");
        // print_r($instructions);
		$xhtml = p_render("xhtml", $instructions, $info);
        // print_r($xhtml);

		$expected = "\n<p>\nxxx\n</p>\n<pre class='flowchartjs '>\n  _cfg_\n</pre>\n<p>\nxxx\n</p>\n";

		$this->assertEquals($expected, $xhtml);
	}
}
//Setup VIM: ex: et ts=4 :
