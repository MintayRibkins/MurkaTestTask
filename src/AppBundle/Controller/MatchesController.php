<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MatchesController extends Controller
{

    /**
     * Get existing matches from database with using filters.
     *
     * @ApiDoc()
     * @Rest\Route("/matches")
     * @Rest\QueryParam(name="page", requirements="\d+", default="1")
     * @Rest\QueryParam(name="player", requirements="\d+")
     * @Rest\QueryParam(name="date_from", requirements="\d\d\.\d\d\.\d\d\d\d", default=null, allowBlank=true)
     * @Rest\QueryParam(name="date_to", requirements="\d\d\.\d\d\.\d\d\d\d", default=null, allowBlank=true)
     * @ParamConverter("date_from", class="DateTime", converter="datetime", isOptional=true, options={"format": "d.m.Y"})
     * @ParamConverter("date_to", class="DateTime", converter="datetime", isOptional=true, options={"format": "d.m.Y"})
     * @Rest\View()
     */
    public function listAction(Request $request, $page = 1, $player = null)
    {
        $em = $this->getDoctrine()->getManager();
        /* @var $em EntityManagerInterface */

        $date_from = $request->attributes->get('date_from');
        $date_to = $request->attributes->get('date_to');

        $qb = $em->getRepository('AppBundle:Match')
            ->createQueryBuilder('m');

        if ($player) {
            $qb
                ->join('m.matchPlayers', 'mp', 'WITH', 'mp.player = :player')
                ->setParameter('player', $player);
        }

        if ($date_from && $date_to) {
            $qb
                ->andWhere('m.startTime BETWEEN :date_from AND :date_to')
                ->setParameter('date_from', $date_from)
                ->setParameter('date_to', $date_to);
        }

        $pagerfanta = new Pagerfanta(new DoctrineORMAdapter($qb, false));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($page);

        return array(
            'matches' => iterator_to_array($pagerfanta->getCurrentPageResults()),
            'count' => $pagerfanta->getNbResults(),
            'pages' => $pagerfanta->getNbPages(),
        );

    }
}