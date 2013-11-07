<?php
class MarvinCategoryUpdateManagerController extends ResourceUpdateManagerController {
    /** @var MarvinCategory $resource */
    public $resource;

    public function getLanguageTopics() {
        return array('resource','marvin:default');
    }

    /**
     * Register custom CSS/JS for the page
     * @return void
     */
    public function loadCustomCssJs() {
        $managerUrl = $this->context->getOption('manager_url', MODX_MANAGER_URL, $this->modx->_userConfig);
        $marvinAssetsUrl = $this->modx->getOption('marvin.assets_url',null,$this->modx->getOption('assets_url',null,MODX_ASSETS_URL).'components/marvin/');
        $connectorUrl = $marvinAssetsUrl.'connector.php';
        $marvinJsUrl = $marvinAssetsUrl.'js/mgr/';

        $this->addJavascript($managerUrl.'assets/modext/util/datetime.js');
        $this->addJavascript($managerUrl.'assets/modext/widgets/element/modx.panel.tv.renders.js');
        $this->addJavascript($managerUrl.'assets/modext/widgets/resource/modx.grid.resource.security.local.js');
        $this->addJavascript($managerUrl.'assets/modext/widgets/resource/modx.panel.resource.tv.js');
        $this->addJavascript($managerUrl.'assets/modext/widgets/resource/modx.panel.resource.js');
        $this->addJavascript($managerUrl.'assets/modext/sections/resource/update.js');

        $this->addJavascript($marvinJsUrl.'marvin.js');
        $this->addLastJavascript($marvinJsUrl.'sections/category/update.js');
        $this->addLastJavascript($marvinJsUrl.'widgets/category/marvin.panel.category.js');

        $this->loadExtendedFields();

        $this->addHtml('
        <script type="text/javascript">
        // <![CDATA[
        Marvin.assetsUrl = "'.$marvinAssetsUrl.'";
        Marvin.connectorUrl = "'.$connectorUrl.'";
        MODx.config.publish_document = "'.$this->canPublish.'";
        MODx.onDocFormRender = "'.$this->onDocFormRender.'";
        MODx.ctx = "'.$this->resource->get('context_key').'";
        Ext.onReady(function() {
            MODx.load({
                xtype: "marvin-page-category-update"
                ,resource: "'.$this->resource->get('id').'"
                ,record: '.$this->modx->toJSON($this->resourceArray).'
                ,publish_document: "'.$this->canPublish.'"
                ,preview_url: "'.$this->previewUrl.'"
                ,locked: '.($this->locked ? 1 : 0).'
                ,lockedText: "'.$this->lockedText.'"
                ,canSave: '.($this->canSave ? 1 : 0).'
                ,canEdit: '.($this->canEdit ? 1 : 0).'
                ,canCreate: '.($this->canCreate ? 1 : 0).'
                ,canDuplicate: '.($this->canDuplicate ? 1 : 0).'
                ,canDelete: '.($this->canDelete ? 1 : 0).'
                ,show_tvs: '.(!empty($this->tvCounts) ? 1 : 0).'
                ,mode: "update"
            });
        });
        // ]]>
        </script>');
        /* load RTE */
        $this->loadRichTextEditor();
    }

    public function loadExtendedFields() {
        /** @var MarvinCategoryExtendedFields $extendedFields */
        $extendedFields = $this->resource->ExtendedFields;
        if($extendedFields){
            $extendedFieldsArray = $extendedFields->toArray();
            unset($extendedFieldsArray['category']);
            unset($extendedFieldsArray['id']);

            $this->resourceArray = array_merge($extendedFieldsArray, $this->resourceArray);
        }
    }
}