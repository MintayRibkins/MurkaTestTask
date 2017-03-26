<?php

namespace AppBundle\Controller;

use AppBundle\Form\MatchType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Match;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class MatchController extends FOSRestController
{
    /**
     * @ApiDoc()
     * @Rest\Route("matches/{id}", methods={"GET"})
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function viewAction(Match $match)
    {
        return $match;
    }

    /**
     * @ApiDoc(
     *   resource = true,
     *   input = "AppBundle\Form\MatchType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @Rest\Route("matches", methods={"POST"})
     * @Rest\View()
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $em EntityManagerInterface */

        $match = new Match();
        $form = $this->createForm(MatchType::class, $match);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($match);
            $em->flush();

            return $match;
        }

        return array(
            'form' => $form
        );
    }

    /**
     * @ApiDoc()
     * @Rest\Route("matches/{id}", methods={"POST"})
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function editAction(Match $match)
    {
        return $match;
    }

    /**
     * @ApiDoc()
     * @Rest\Route("matches/{id}", methods={"DELETE"})
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function deleteAction(Match $match)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $em EntityManagerInterface */

        $em->remove($match);
        $em->flush();

        return array('success' => true);
    }
}