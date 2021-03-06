<?php

namespace Netgen\Bundle\EzPlatformSearchExtraBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class NetgenEzPlatformSearchExtraExtension extends Extension
{
    /**
     * @param array $configs
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $activatedBundlesMap = $container->getParameter('kernel.bundles');

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../lib/Resources/config/')
        );

        if (array_key_exists('EzPublishLegacySearchEngineBundle', $activatedBundlesMap)) {
            $loader->load('search/legacy.yml');
        }

        if (array_key_exists('EzSystemsEzPlatformSolrSearchEngineBundle', $activatedBundlesMap)) {
            $loader->load('search/solr.yml');
        }

        $loader->load('search/common.yml');
        $loader->load('persistence.yml');
    }
}
