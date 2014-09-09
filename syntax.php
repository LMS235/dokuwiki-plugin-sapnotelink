<?php
/**
 * DokuWiki Plugin sapnotelink (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Florian Lamml <info@florian-lamml.de>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_sapnotelink extends DokuWiki_Syntax_Plugin {


    public function getType() {
        return 'substition';
    }
	
    public function getPType() {
        return 'normal';
    }

    public function getSort() {
        return 256;
    }
	
    # reagiert auf alles was mit SAP# oder sap# beginnt und 1 - 10 Zahlen folgen
    public function connectTo($mode) {
	    $this->Lexer->addSpecialPattern('SAP#[0-9]{1,10}',$mode,'plugin_sapnotelink');
		$this->Lexer->addSpecialPattern('sap#[0-9]{1,10}',$mode,'plugin_sapnotelink');
    }


    public function handle($match, $state, $pos, Doku_Handler &$handler){
        $data = array($match, $state);

        return $data;
    }
		
	public function render($mode, Doku_Renderer &$renderer, $data) {
		# normale Ausgabe
        if($mode == 'xhtml'){
            $sapnote = explode('#', $data[0]);
            $url = $this->getConf('sapnoteurl')."/".$sapnote[1];
                $renderer->doc .= "<a href=\"".$url."\" target=\"_blank\"><img src=\"".DOKU_BASE."lib/plugins/sapnotelink/images/sap.gif\" alt=\"".$this->getLang('url_alt')." ".$sapnote[1]."\"> ".$sapnote[1]."</a>";
            return true;
        }
		# ODT Export
		elseif ($mode == 'odt'){
            $sapnote = explode('#', $data[0]);
                $renderer->doc .= "$sapnote[1]";
            return true;
        }
        return false;
    }
}
