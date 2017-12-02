<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Product;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Description of ClientController
 *
 * @author imen
 */
class ProductController extends FOSRestController {

    /**
     * Returns all users values.
     * 
     * @return View
     * 
     */
    public function getProductsAction() {
        $data = $this->getDoctrine()->getManager()->getRepository(Product::class)->findAll();



        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);


        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * Returns all users values.
     * 
     * @return View
     * 
     */
    public function getProductsWithValidPromotionAction() {
        $repository = $this->getDoctrine()->getManager()->getRepository(Product::class);
        $date = date("Y-m-d H:i:s");
        
        $data = $repository->createQueryBuilder('p')
                ->join('p.promotions', 'pr')
                ->where(':date BETWEEN pr.beginDate AND pr.endDate')
                ->setParameter('date', $date)
                ->getQuery()
                ->getResult();

        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);


        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * Returns all enumeration values.
     * 
     * @return View
     * 
     */
    public function getProductAction($id) {
        $data = $this->getDoctrine()->getManager()->getRepository(Product::class)->findOneById($id);

        if (!$data) {
            throw new HttpException(404, "product with the id $id not found");
        }
        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

}
