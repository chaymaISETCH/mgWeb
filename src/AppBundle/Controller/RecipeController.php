<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Recipe;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Description of ClientController
 *
 * @author imen
 */
class RecipeController extends FOSRestController {

    /**
     * Returns all users values.
     * 
     * @return View
     * 
     */
    public function getRecipesAction() {
        $data = $this->getDoctrine()->getManager()->getRepository(Recipe::class)->findAll();
       
  

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
    public function getRecipeAction($id) {
        $data = $this->getDoctrine()->getManager()->getRepository(Recipe::class)->findOneById($id);

        if (!$data) {
            throw new HttpException(404, "product with the id $id not found");
        }
        $view = View::create()
                ->setStatusCode(200)
                ->setData($data);

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    
}
