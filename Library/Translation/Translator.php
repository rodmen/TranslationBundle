<?php
namespace Acilia\Bundle\TranslationBundle\Library\Translation;

use Acilia\Bundle\TranslationBundle\Event\ResourceEvent;
use Symfony\Bundle\FrameworkBundle\Translation\Translator as BaseTranslator;

class Translator extends BaseTranslator
{
    protected function loadCatalogue($locale)
    {
        $loader = $this->container->get('acilia.translation.loader');
        $dispatcher = $this->container->get('event_dispatcher');

        $resourceEvent = new ResourceEvent();
        $dispatcher->dispatch(ResourceEvent::EVENT_LOAD, $resourceEvent);

        if ($resourceEvent->getResource()) {
            if ($this->container->getParameter('kernel.debug') === true && $this->container->hasParameter('acilia_translation.disabled') && $this->container->getParameter('acilia_translation.disabled') === true) {
                $this->catalogues[$resourceEvent->getCulture()] = $loader->load(null, 'en', 0);
            } else {
                $this->catalogues[$resourceEvent->getCulture()] = $loader->load($resourceEvent->getResource(), $resourceEvent->getCulture(), $resourceEvent->getVersion());
            }
        } else {
            $this->catalogues['en'] = $loader->load(null, 'en', 0);
        }
    }
}
