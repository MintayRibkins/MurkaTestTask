<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Match;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchController extends Controller
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