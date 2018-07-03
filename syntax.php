<?php
/**
 * flowchartjs plugin: draw flowcart based on flowcart.js
 *
 * Syntax: <flowchartjs style>...</flowchartjs> - will draw a flowchart
 * 
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     ghbore <gaoh@pku.edu.cn>
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_flowchartjs extends DokuWiki_Syntax_Plugin {

	function getType(){ return 'protected'; }
	function getPType(){ return 'block'; }
	function getSort(){ return 999; }
	function connectTo($mode) {
    	$this->Lexer->addEntryPattern('<flowchartjs.*?>(?=.*?</flowchartjs>)', $mode, 'plugin_flowchartjs');
	}
	function postConnect() {
		$this->Lexer->addExitPattern('</flowchartjs>', 'plugin_flowchartjs');
	}
	function handle($match, $state, $pos, $handler){
		switch ($state) {
			case DOKU_LEXER_ENTER : 
				$style = trim(substr($match, 12, -1));
				return array($state, $style);
			case DOKU_LEXER_UNMATCHED :
		  		return array($state, $match);
			case DOKU_LEXER_EXIT :
				return array($state, '');
		}
	}
	function render($mode, $renderer, $data) {
		if($mode == 'xhtml'){
			list($state, $match) = $data;
			switch ($state){
				case DOKU_LEXER_ENTER:
					$renderer->doc .= "<pre class='flowchartjs $match'>";
					break;
				case DOKU_LEXER_UNMATCHED:
					$renderer->doc .= $match;
					break;
				case DOKU_LEXER_EXIT:
					$renderer->doc .= "</pre>";
					break;
			}
			return true;
		}
		return false;
	}
}

//Setup VIM: ex: et ts=4 :
