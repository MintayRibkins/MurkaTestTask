<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchesController extends Controller
{

    /**
     * @ApiDoc()
     * @Route("/matches")
     * @Method("GET")
     * @Rest\View()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $em EntityManagerInterface */

        $qb = $em->getRepository('AppBundle:Match')->createQueryBuilder('m')->setMaxResults(10);

        return array('matches' => $qb->getQuery()->getResult());

    }
}