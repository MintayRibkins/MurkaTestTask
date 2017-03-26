<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Match;
use FOS\RestBundle\Controller\Annotations\Route;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MatchController
{

    /**
     * @ApiDoc()
     * @Route("matches/{id}", methods={"GET"})
     * @ParamConverter("match", class="AppBundle:Match")
     * @Rest\View()
     */
    public function viewAction(Match $match)
    {
        return $match;
    }
}