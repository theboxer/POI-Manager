<?php
/**
 * Loads the home page.
 *
 * @package marvin
 * @subpackage controllers
 */
class MarvinLocationUpdateManagerController extends MarvinBaseManagerController {
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
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/feedback/marvin.grid.feedback.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/feedback/marvin.window.feedback.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/comment/marvin.grid.comment.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/comment/marvin.window.comment.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/photo/marvin.grid.photo.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/widgets/photo/marvin.window.photo.js');
        $this->addLastJavascript($this->marvin->config['jsUrl'].'mgr/sections/location/create.js');

        /** @var MarvinLocation $location */
        $location = $this->modx->getObject('MarvinLocation',$this->scriptProperties['id']);
        if (empty($location)) {
            return $this->modx->lexicon('marvin.field.err_ns_location');
        }

        $c = $this->modx->newQuery('MarvinField');
        $c->where(array('location_type' => $location->type));
        $c->sortby('position', 'ASC');

        $fields = $this->modx->getCollection('MarvinField', $c);

        $fieldsArray = array();

        /** @var MarvinField $field */
        foreach ($fields as $field) {
            $fArray = $field->toArray();

            $value = $field->getMany('Values', array('location' => $this->scriptProperties['id']));
            if (count($value) == 1) {
                foreach($value as $v){
                    $fArray['value'] = $v->value;
                    break;
                }
            } else {
                $fArray['value'] = '';
            }

            $fieldsArray[] = $fArray;
        }

        $this->addHtml('
        <script type="text/javascript">
        // <![CDATA[
        Marvin.customFields = '.$this->modx->toJSON($fieldsArray).';
        Marvin.locationType = '.$location->type.';
        // ]]>
        </script>');
    }
    public function getTemplateFile() { return $this->marvin->config['templatesPath'].'location/location.tpl'; }
}
