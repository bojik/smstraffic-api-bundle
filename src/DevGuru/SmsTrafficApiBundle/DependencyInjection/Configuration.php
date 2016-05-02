<?php

namespace DevGuru\SmsTrafficApiBundle\DependencyInjection;

use DevGuru\SmsTrafficApi\Client;
use DevGuru\SmsTrafficApiBundle\Config\SmsTrafficApiConfig;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dev_guru_sms_traffic_api');

        $rootNode
            ->children()
                ->scalarNode(SmsTrafficApiConfig::PARAM_LOGIN)->isRequired()->end()
                ->scalarNode(SmsTrafficApiConfig::PARAM_PASSWORD)->isRequired()->end()
                ->scalarNode(SmsTrafficApiConfig::PARAM_ORIGINATOR)->isRequired()->end()
                ->scalarNode(SmsTrafficApiConfig::PARAM_CLIENT_CLASS)->defaultValue(Client::class)->end()
                ->scalarNode(SmsTrafficApiConfig::PARAM_API_URL)->end()
            ->end();

        return $treeBuilder;
    }
}
