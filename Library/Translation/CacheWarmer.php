<?php
namespace Acilia\Bundle\TranslationBundle\Library\Translation;

use Acilia\Bundle\TranslationBundle\Event\ResourceEvent;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

class CacheWarmer implements CacheWarmerInterface
{
    protected $eventDispatcher;
    protected $loader;

    public function __construct($eventDispatcher, $loader)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->loader = $loader;
    }

    public function warmUp($cacheDir)
    {
        $resourcesEvent = new ResourcesEvent();
        $this->eventDispatcher->dispatch(ResourceEvent::EVENT_WARMUP, $resourcesEvent);

        foreach ($resourcesEvent->getResources() as $resourceEvent) {
            $this->loader->load($resourceEvent->getResource(), $resourceEvent->getCulture(), $resourceEvent->getVersion());
        }
    }

    public function isOptional()
    {
        return true;
    }
}
