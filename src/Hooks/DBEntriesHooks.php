<?php
namespace PoP\GraphQL\Hooks;

use PoP\Engine\Hooks\AbstractHookSet;
use PoP\UserState\FieldResolvers\GlobalFieldResolver;

class DBEntriesHooks extends AbstractHookSet
{
    protected function init()
    {
        $this->hooksAPI->addFilter(
            'PoP\API\DataloaderHooks:metaFields',
            array($this, 'moveEntriesUnderDBName')
        );
    }

    public function moveEntriesUnderDBName($metaFields)
    {
        $metaFields[] = '__schema';
        return $metaFields;
    }
}
