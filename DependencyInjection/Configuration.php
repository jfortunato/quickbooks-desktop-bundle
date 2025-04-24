<?php

namespace Jfortunato\QuickBooksDesktopBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('jfortunato_quick_books_desktop');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('user')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('pass')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->enumNode('log_level')
                    ->values(array('QUICKBOOKS_LOG_DEVELOP', 'QUICKBOOKS_LOG_DEBUG', 'QUICKBOOKS_LOG_VERBOSE', 'QUICKBOOKS_LOG_NORMAL', 'QUICKBOOKS_LOG_NONE'))
                    ->defaultValue('QUICKBOOKS_LOG_DEVELOP')
                ->end()
                ->enumNode('soap_server')
                    ->values(array('QUICKBOOKS_SOAPSERVER_BUILTIN', 'QUICKBOOKS_SOAPSERVER_PHP'))
                    ->defaultValue('QUICKBOOKS_SOAPSERVER_BUILTIN')
                ->end()
                ->arrayNode('handler_options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('deny_concurrent_logins')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('deny_reallyfast_logins')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('driver_options')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('max_log_history')
                            ->defaultValue(32000)
                        ->end()
                        ->integerNode('max_queue_history')
                            ->defaultValue(1024)
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
