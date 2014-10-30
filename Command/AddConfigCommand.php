<?php
/*
 * This file is part of the LightCMSConfigBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSConfigBundle\Command;

use Fulgurio\LightCMSConfigBundle\Entity\Config;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddConfigCommand extends ContainerAwareCommand
{
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
        $this
            ->setName('config:add')
            ->setDescription('Add new configuration')
            ->addArgument('label', InputArgument::REQUIRED, 'Label')
            ->addArgument('value', InputArgument::REQUIRED, 'Value')
        ;
    }

    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::execute()
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $doctrine = $this->getContainer()->get('doctrine');
        $metaKey = $input->getArgument('label');
        $metaValue = $input->getArgument('value');

        $entry = $doctrine->getRepository('FulgurioLightCMSConfigBundle:Config')->findOneBy(array('meta_key' => $metaKey));
        if ($entry)
        {
            throw new \Exception($metaKey . ' already exists');
        }
        $config = new Config();
        $config->setMetaKey($metaKey);
        $config->setMetaValue($metaValue);
        $config->setCreatedAt(new \DateTime());
        $em = $doctrine->getManager();
        $em->persist($config);
        $em->flush();
    }
}