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

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveConfigCommand extends ContainerAwareCommand
{
    /**
     * (non-PHPdoc)
     * @see \Symfony\Component\Console\Command\Command::configure()
     */
    protected function configure()
    {
            $this
            ->setName('config:remove')
            ->setDescription('Remove configuration')
            ->addArgument('label', InputArgument::REQUIRED, 'Label')
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

        $entry = $doctrine->getRepository('FulgurioLightCMSConfigBundle:Config')->findOneBy(array('meta_key' => $metaKey));
        if (!$entry)
        {
            throw new \Exception($metaKey . ' doesn\'t exist');
        }
        $em = $doctrine->getManager();
        $em->remove($entry);
        $em->flush();
    }
}