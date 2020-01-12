<?php
namespace PoP\GraphQL;

use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\Root\Component\CanDisableComponentTrait;
use PoP\ComponentModel\Container\ContainerBuilderUtils;
use PoP\GraphQLAPIRequest\Component as GraphQLAPIRequestComponent;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    // const VERSION = '0.1.0';
    use YAMLServicesTrait, CanDisableComponentTrait;

    /**
     * Initialize services
     */
    public static function init()
    {
        if (self::isEnabled()) {
            parent::init();
            self::initYAMLServices(dirname(__DIR__));
        }
    }

    protected static function resolveEnabled()
    {
        return GraphQLAPIRequestComponent::isEnabled();
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        // Initialize classes
        ContainerBuilderUtils::instantiateNamespaceServices(__NAMESPACE__.'\\Hooks');
        ContainerBuilderUtils::attachFieldResolversFromNamespace(__NAMESPACE__.'\\FieldResolvers');
    }
}
