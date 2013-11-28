<?php
/**
 * Loads the home page.
 *
 * @package marvin
 * @subpackage controllers
 */
class MarvinLocationCreateManagerController extends MarvinBaseManagerController {
    public function process(array $scriptProperties = array()) {

    }
    public function getPageTitle() { return $this->modx->lexicon('marvin'); }
    public function loadCustomCssJs() {
        $this->addCss($this->marvin->config['cssUrl'].'superboxselect.css');

        $this->addLastJavascript('http://maps.google.com/maps/api/js?sensor=false');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/SuperBoxSelect.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/marvin.combo.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/gmappanel.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/extra/map.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/location/marvin.panel.location.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/location/create.js');

        if (isset($this->scriptProperties['type']) && intval($this->scriptProperties['type']) > 0) {
            $type = intval($this->scriptProperties['type']);
        } else {
            /** @var MarvinLocationType $t */
            $t = $this->modx->getObject('MarvinLocationType', array('default' => 1));
            if (!$t) {
                $t = $this->modx->getObject('MarvinLocationType');
            }

            $type = $t->id;
        }

        $c = $this->modx->newQuery('MarvinField');
        $c->where(array('location_type' => $type));
        $c->sortby('position', 'ASC');

        $fields = $this->modx->getCollection('MarvinField', $c);

        $fieldsArray = array();

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $fArray = $field->toArray();
            $fArray['value'] = '';
            $fieldsArray[] = $fArray;
        }

        $this->addHtml('
        <script type="text/javascript">
        // <![CDATA[
        Marvin.customFields = '.$this->modx->toJSON($fieldsArray).';
        Marvin.locationType = '.$type.';
        // ]]>
        </script>');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'location/location.tpl'; }
}
