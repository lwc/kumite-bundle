<?php

namespace Kumite\KumiteBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('kumite')->children();

        $rootNode
            ->scalarNode('storage_adapter')->defaultValue('kumite.storage_adapter.doctrine')->cannotBeEmpty()->end()
            ->scalarNode('cookie_adapter')->defaultValue('kumite.cookie_adapter.symfony')->cannotBeEmpty()->end()
            ->arrayNode('tests')->normalizeKeys(false)
            ->isRequired()
            ->prototype('array')
            ->children()
            ->arrayNode('allocator')
            ->beforeNormalization()
            ->ifString()
            ->then(function ($v) {
                return array('method'=> $v);
            })
            ->end()
            ->children()
            ->scalarNode('method')->isRequired()->end()
            ->arrayNode('options')->prototype('scalar')->end()->end()
            ->end()->end()
            ->booleanNode('enabled')->end()
            ->scalarNode('default')->end()
            ->arrayNode('variants')->prototype('scalar')->end()->end()
            ->arrayNode('events')->prototype('scalar')->end()->end();

        return $treeBuilder;
    }
}
