<?php
namespace Acilia\Bundle\TranslationBundle\Library\Translation;

use Acilia\Bundle\TranslationBundle\Event\ResourcesEvent;
use Acilia\Bundle\TranslationBundle\Event\ResourceEvent;
use Symfony\Bundle\FrameworkBundle\Translation\Translator as BaseTranslator;

class Translator extends BaseTranslator
{
    protected function loadCatalogue($locale)
    {
        $loader = $this->container->get('acilia.translation.loader');
        $dispatcher = $this->container->get('event_dispatcher');

        $resourcesEvent = new ResourcesEvent();
        $dispatcher->dispatch(ResourceEvent::EVENT_LOAD, $resourcesEvent);

        // initialize default translation
        $this->catalogues['en'] = $loader->load(null, 'en', 0);

        if (count($resourcesEvent) > 0) {
            if ($this->container->getParameter('kernel.debug') === true
                && $this->container->hasParameter('acilia_translation.disabled')
                && $this->container->getParameter('acilia_translation.disabled') === true) {

                $this->catalogues['en'] = $loader->load(null, 'en', 0);
            } else {
                foreach($resourcesEvent->getResources() as $resourceEvent) {
                    $this->catalogues[$resourceEvent->getCulture()] = $loader->load($resourceEvent->getResource(), $resourceEvent->getCulture(), $resourceEvent->getVersion());
                }
            }
        }
    }
}
