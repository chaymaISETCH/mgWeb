<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Carte;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Description of carteController
 *
 * @author imen
 */
class CarteController extends  FOSRestController {
    
    
    /**
     * Returns all enumeration values.
     * 
     * @return View
     * 
     */
    public function getCarteAction($number) {
        $data = $this->getDoctrine()->getManager()->getRepository(Carte::class)->findOneByNumber($number);

        if (!$data) {
            throw new HttpException(404, "carte with the id $number not found");
        }
        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);

        return $this->get('fos_rest.view_handler')->handle($view);
    }
}
