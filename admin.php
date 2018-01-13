<?php
/**
 * Flowchartjs Admin Plugin 
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Hua GAO <gaoh@pku.edu.cn>
 */
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC.'lib/plugins/');

require_once(DOKU_PLUGIN . 'admin.php');

/**
 * All DokuWiki plugins to extend the admin function
 * need to inherit from this class
 */
class admin_plugin_flowchartjs extends DokuWiki_Admin_Plugin {

    /**
     * Carry out required processing
     */
    public function handle() {
    	if (!isset($_FILES['_new']) && !isset($_POST['_del'])) return;
        if (! checkSecurityToken()) return;
	if (isset($_FILES['_new']) && $_FILES['_new']['error'] == 0){
		if ('json' != pathinfo($_FILES['_new']['name'], PATHINFO_EXTENSION)){
			msg($_FILES['_new']['name'].' is not a json file', 2);
		}else {
			move_uploaded_file($_FILES['_new']['tmp_name'],
				DOKU_PLUGIN.'flowchartjs/styles/'.$_FILES['_new']['name']);
			msg($_FILES['_new']['name'].' has been successfully uploaded', 1);
		}
	}
	if (isset($_POST['_del'])){
		foreach ($_POST['_del'] as $s){
			if (unlink(DOKU_PLUGIN.'flowchartjs/styles/'.$s.'.json')){
				msg($s." has been successfully deleted", 1);
			}else {
				msg('It\'s failed to delete '.$s, 2);
			}
		}
	}
    }

    /**
     * Output html of the admin page
     */
    public function html() {
    	echo $this->locale_xhtml('intro');
        $form = new Doku_Form(array('method'=>'post', 'enctype'=>'multipart/form-data'));
	$form->addElement( form_makeFileField(
		'_new', 'Add new or update flowchart style (in JSON format)'
	));
	$form->addElement('<div>Or/and delete styles:</div>');
	$styles = array_map(function ($fn){return pathinfo($fn, PATHINFO_FILENAME);},
			glob(DOKU_PLUGIN.'flowchartjs/styles/*.json')
		);
	foreach ($styles as $s){
		$form->addElement( form_makeCheckboxField(
			'_del[]', $s, $s
		));
		$form->addElement('<br />');
	}
	$form->addElement( form_makeButton('submit', 'admin', 'Update') );
	$form->printForm();
    }

    /**
     * Return true for access only by admins (config:superuser) or false if managers are allowed as well
     *
     * @return bool
     */
    public function forAdminOnly() {
        return false;
    }
}

//Setup VIM: ex: et ts=4 :
