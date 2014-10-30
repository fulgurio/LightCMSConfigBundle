<?php
/*
 * This file is part of the LightCMSConfigBundle package.
 *
 * (c) Fulgurio <http://fulgurio.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fulgurio\LightCMSConfigBundle\Controller;

use Fulgurio\LightCMSConfigBundle\Form\Handler\ConfigCollectionHandler;
use Fulgurio\LightCMSConfigBundle\Form\Type\ConfigCollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminConfigController extends Controller
{
    /**
     * Parameters form
     */
    public function indexAction()
    {
        $configs = $this->getDoctrine()->getManager()->getRepository('FulgurioLightCMSConfigBundle:Config')->findAll();
        $form = $this->createForm(new ConfigCollectionType(), array('configs' => $configs));
        $formHandler = new ConfigCollectionHandler($this->getDoctrine(), $form, $this->getRequest());
        if ($formHandler->process($configs))
        {
            $this->get('session')->getFlashBag()->add(
                'notice',
                $this->get('translator')->trans('fulgurio.lightcms_config.edit_form.success_msg', array(), 'admin')
            );
            return $this->redirect($this->generateUrl('LightCMS_Admin_Config'));
        }
        return $this->render(
            'FulgurioLightCMSConfigBundle:AdminConfig:index.html.twig',
            array('form' => $form->createView()	)
        );
    }
}
