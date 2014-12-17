<?php
/*
 * This file is part of the LightCMSConfigBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSConfigBundle\Extension;

use Doctrine\Bundle\DoctrineBundle\Registry;

class TwigExtension extends \Twig_Extension
{
    /**
     * Doctrine component
     * @var Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;


    /**
     *
     * @param Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * (non-PHPdoc)
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getConfig', array($this, 'getConfig'))
        );
    }

    /**
     * Get config value
     *
     * @param string $metaKey
     * @return string
     */
    public function getConfig($metaKey)
    {
        $config = $this->doctrine->getRepository('FulgurioLightCMSConfigBundle:Config')->findOneBy(array('meta_key' => $metaKey));
        if ($config)
        {
            return $config->getMetaValue();
        }
        return NULL;
    }

    /**
     * (non-PHPdoc)
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'LightCMSConfig_extension';
    }
}