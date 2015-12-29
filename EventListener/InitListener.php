<?php
namespace Acilia\Bundle\TranslationBundle\EventListener;

use Acilia\Bundle\TranslationBundle\Event\ResourcesEvent;
use Acilia\Bundle\TranslationBundle\Event\ResourceEvent;
use Acilia\Bundle\TranslationBundle\Library\Translation\Loader;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class InitListener
{
    protected $loader;
    protected $eventDispatcher;
    protected $translator;

    public function __construct(Loader $loader, EventDispatcherInterface $eventDispatcher, Translator $translator)
    {
        $this->loader = $loader;
        $this->eventDispatcher = $eventDispatcher;
        $this->translator = $translator;
        $translator->addLoader('array', new ArrayLoader());
    }

    public function onRequest(GetResponseEvent $event)
    {
        $resourcesEvent = new ResourcesEvent();
        $this->eventDispatcher->dispatch(ResourceEvent::EVENT_LOAD, $resourcesEvent);

        // initialize default translation
        $catalog = $this->loader->load(null, 'en', 0);
        $this->translator->setFallbackLocales([]);
        foreach ($catalog->getDomains() as $domain) {
            $this->translator->addResource('array', $catalog->all($domain), $catalog->getLocale(), $domain);
        }

        // Init each locale
        $this->translator->setFallbackLocales(['en']);
        if (count($resourcesEvent) > 0) {
            foreach($resourcesEvent->getResources() as $resourceEvent) {
                $catalog = $this->loader->load($resourceEvent->getResource(), $resourceEvent->getCulture(), $resourceEvent->getVersion());
                foreach ($catalog->getDomains() as $domain) {
                    $this->translator->addResource('array', $catalog->all($domain), $catalog->getLocale(), $domain);
                }
            }
        }
    }
}
