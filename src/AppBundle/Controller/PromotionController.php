<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Promotion;
use Symfony\Component\HttpKernel\Exception\HttpException;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;

/**
 * Description of PromotionController
 *
 * @author imen
 */
class PromotionController extends FOSRestController {

    /**
     * Returns all users values.
     * 
     * @return View
     * 
     */
    public function getPromotionsAction() {
        $data = $this->getDoctrine()->getManager()->getRepository(Promotion::class)->findAll();

        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * @QueryParam(name="date", description="date")
     */
    public function getPromotionsDateAction(ParamFetcher $paramFetcher) {

        $repository = $this->getDoctrine()->getRepository(Promotion::class);
        
        
        $date = date("Y-m-d", $paramFetcher->get('date'));
        $query = $repository->createQueryBuilder('p')
                ->select("count(p.id)")
                ->where(':date BETWEEN p.beginDate AND  p.endDate')
                ->setParameter('date', $date)
                ->getQuery();

        $productCount = $query->getSingleScalarResult();
        $isDisponible = false;
        if($productCount > 0){
            $isDisponible = true;
        }
        $view = View::create()
                ->setStatusCode(200)
                ->setData(array("isDisponible" => $isDisponible));

        return $this->get('fos_rest.view_handler')->handle($view);
    }
    
    /**
     * Returns all enumeration values.
     * 
     * @return View
     * 
     */
    public function getPromotionAction($id) {
        $data = $this->getDoctrine()->getManager()->getRepository(Promotion::class)->findOneById($id);

        if (!$data) {
            throw new HttpException(404, "promotion with the id $id not found");
        }
        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    

}
