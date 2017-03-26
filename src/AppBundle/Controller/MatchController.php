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
     * @Rest\Route("matches/{id}")
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function getMatchAction(Match $match)
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
     * @Rest\Route("matches")
     * @Rest\View()
     */
    public function postMatchAction(Request $request)
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
     * Update existing match from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "AppBundle\Form\MatchType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Rest\Route("matches/{id}")
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function patchMatchAction(Request $request, Match $match)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $em EntityManagerInterface */

        $form = $this->createForm(MatchType::class, $match, array('method' => 'PATCH'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $match;
        }

        return $form;
    }

    /**
     * @ApiDoc()
     * @Rest\Route("matches/{id}")
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function deleteMatchAction(Match $match)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $em EntityManagerInterface */

        $em->remove($match);
        $em->flush();

        return array('success' => true);
    }
}