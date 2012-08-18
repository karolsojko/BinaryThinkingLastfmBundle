<?php

namespace BinaryThinking\LastfmBundle\DependencyInjection;

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
     * @codeCoverageIgnore
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('binary_thinking_lastfm');
        
        $rootNode->children()
                ->scalarNode('client_apikey')->isRequired()->end()
                ->scalarNode('client_secret')->isRequired()->end()
        ->end();

        return $treeBuilder;
    }
}
