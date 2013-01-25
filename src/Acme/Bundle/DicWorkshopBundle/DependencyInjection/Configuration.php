<?php

namespace Acme\Bundle\DicWorkshopBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('acme_dic_workshop');

        $rootNode
            ->children()
                ->scalarNode('endpoint')
                    ->info('Defines the webservice endpoint.')
                    ->defaultValue('http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml')
                    ->cannotBeEmpty()
                    ->validate()
                        ->ifTrue(function($value) {
                            return !filter_var($value, \FILTER_VALIDATE_URL);
                        })
                        ->thenInvalid('The endpoint must be a valid URL.')
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
