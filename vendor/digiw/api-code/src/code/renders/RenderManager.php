<?php

namespace code\renders;

use code\applications\ApiAppFactory;
use code\components\Component;
use code\service\ServiceInterface;
use code\service\ServiceTypes;

class RenderManager implements ServiceInterface {

    const RENDER_CONFIGURATIONS = "render";

    /** @var JSRender */
    private $render;

    /**
     * 
     * @return Render
     */
    public function getRender() {
        return $this->render;
    }

    /**
     * 
     */
    public function init() {
        $conf = ApiAppFactory::getApp()->getService(ServiceTypes::CONFIGURATIONS)->get(static::RENDER_CONFIGURATIONS);
        $engine = ApiAppFactory::getApp()->newInstance($conf['engine']['class']);
        $this->render = ApiAppFactory::getApp()->newInstance($conf['class'], [$engine]);
        if (isset($conf['translator'])) {
            $translator = ApiAppFactory::getApp()->newInstance($conf['translator']['class'], [$engine]);
            $this->render->DOMTransformer($translator);
        }

        if (isset($conf['templates'])) {
            if (isset($conf['templates']['deafult'])) {
                $this->render->setDefualtThemeName($conf['templates']['deafult']);
            }
            foreach ($conf['templates']['themes'] as $key => $theme) {
                $th = ApiAppFactory::getApp()->newInstance($theme['class'], [$theme['path']]);
                $this->render->addTheme($th, $key);
            }
        }
        $components = ApiAppFactory::getApp()->getComponents();
        if (isset($conf['stylesheets'])) {
            $this->render->addStylesheets($conf['stylesheets']);
            /** @var Component $component */
            foreach($components as $component){
                $this->render->addStylesheets($component->loadStylesheets());
            }
        }

        if (isset($conf['imports'])) {
            $this->render->addImports($conf['imports']);
            /** @var Component $component */
            foreach($components as $component){
                $this->render->addImports($component->loadImports());
            }
            $this->render->loadImports();
        }
        if (isset($conf['onlyServerTrasnformation'])) {
            $this->render->setOnlyServerTrasnformation($conf['onlyServerTrasnformation']);
        }
    }

}
