<?php
/*
 * This file is part of the LightCMSConfigBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSConfigBundle\Form\Handler;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class ConfigCollectionHandler
{
    private $doctrine;
    private $form;
    private $request;

    public function __construct(RegistryInterface $doctrine, Form $form, Request $request)
    {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->request = $request;
    }

    /**
     * Processing form values
     *
     * @param Collection $configs
     * @return boolean
     */
    public function process(Array $configs)
    {
        if ($this->request->getMethod() == 'POST')
        {
            $this->form->handleRequest($this->request);
            if ($this->form->isValid())
            {
                $now = new \DateTime();
                $em = $this->doctrine->getManager();
                foreach ($configs as $config)
                {
                    if ($config->getId() == FALSE) {
                        $config->setCreatedAt($now);
                    }
                    else {
                        $config->setUpdatedAt($now);
                    }
                    $em->persist($config);
                    $em->flush();
                }
                return TRUE;
            }
            return FALSE;
        }
    }
}