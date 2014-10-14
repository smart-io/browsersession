<?php
namespace Sinergi\BrowserSession;

use Doctrine\Common\Collections\ArrayCollection;

// todo: cache expiration
class BrowserSessionCache extends AbstractCacheable implements CacheableEventsInterface
{
    const CACHE_KEY = 'Sinergi\\BrowserSession\\BrowserSessionEntity.';

    /**
     * @return string
     */
    public function getCacheKey()
    {
        return self::CACHE_KEY;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return 'Sinergi\\BrowserSession\\BrowserSessionEntity';
    }

    /**
     * @param BrowserSessionEntity $object
     * @return BrowserSessionEntity
     */
    public function onFetch($object)
    {
        $variables = $object->getVariables();
        $object->setVariables($collection = new ArrayCollection());
        foreach ($variables as $variable) {
            $variable->setBrowserSession($object);
            $collection->set($variable->getKey(), $variable);
        }
        return $object;
    }
}
