<?php
/**
 * DokuWiki Plugin sapnotelink (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Florian Lamml <info@florian-lamml.de>
 */
if (!defined('DOKU_INC')) die();
class action_plugin_sapnotelink extends DokuWiki_Action_Plugin {
    /**
     * Register the eventhandlers
     */
    function register(Doku_Event_Handler $controller) {
        if($this->getConf('sapnotelink_toolbar_icon')) $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array ());
    }
	
	/**
	* Insert Toolbar
    */
    function insert_button(Doku_Event $event, $param) {
        $event->data[] = array (
            'type'    => 'format',
            'title'   => $this->getLang('toolbar_icon'),
            'icon'    => '../../plugins/sapnotelink/images/sap.gif',
			'sample'  => '123456',
			'open'    => 'sap#',
			'close'   => '',
            'block'   => false
        );
    }
}