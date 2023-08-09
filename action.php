<?php
/**
 * Action Component for the flowchartjs Plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Hua Gao <ghbore@gmail.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');

require_once(DOKU_PLUGIN.'action.php');
require_once(DOKU_INC.'inc/confutils.php');

class action_plugin_flowchartjs extends DokuWiki_Action_Plugin {
    function register(Doku_Event_Handler $controller){
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
    }

    function insert_button (Doku_Event $event, $param) {
        $event->data[] = array(
            'type' => 'format',
            'title' => 'flowchartjs',
            'icon' => '../../plugins/flowchartjs/images/toolbar/fc.png',
            'open' => '<flowchartjs >\n',
            'sample' => '\n',
            'close' => '</flowchartjs>\n',
        );
        $event->data[] = array(
            'type' => 'picker',
            'title' => 'flowchartjs style',
            'icon' => '../../plugins/flowchartjs/images/toolbar/fcs.png',
	    'list' => array_map(function ($fn){return pathinfo($fn, PATHINFO_FILENAME);},
	    		glob(DOKU_PLUGIN.'flowchartjs/styles/*.json')
	    	),
        );
    }
}

//Setup VIM: ex: et ts=4 :
