<?php

namespace Nitra\NitraThemeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class NitraThemeExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('admingenerator.fieldguesser.doctrine.class', 'Nitra\NitraThemeBundle\Guesser\NitraFieldGuesser');
        
        // add NitraTheme form fields template
        $resources = $container->getParameter('twig.form.resources');
        $resources[] = 'NitraThemeBundle:Form:fields.html.twig';
        $container->setParameter('twig.form.resources', $resources);
    }

    public function getAlias()
    {
        return 'nitra_theme';
    }

}
