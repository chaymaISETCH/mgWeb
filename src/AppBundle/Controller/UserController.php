<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use AppBundle\Form\Type\UserFormType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ClientController
 *
 * @author imen
 */
class UserController extends FOSRestController {

    /**
     * Returns all users values.
     * 
     * @return View
     * 
     */
    public function getUsersAction() {
        $data = $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();

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
    public function getUserAction($id) {
        $data = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneById($id);

        if (!$data) {
            throw new HttpException(404, "user with the id $id not found");
        }
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
    public function postUserAction(Request $request) {
        $user = new User();
        $view = View::create();
        $form = $this->createForm(UserFormType::class, $user, array('method' => 'POST'));
        try {
            $form->setData($user);
            if ('POST' === $request->getMethod()) {
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $encoder = $this->container->get('security.password_encoder');
                    $passwordEncoded = $encoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($passwordEncoded);
                    $this->getDoctrine()->getManager()->persist($user);
                    $this->getDoctrine()->getManager()->flush();
                    $view->setStatusCode(204);
                } else {
                    $view->setStatusCode(400);
                    $view->setData(array($form));
                }
            } else {
                $view->setStatusCode(400);
                $view->setData(array($form));
            }
        } catch (\Exception $ex) {
            throw new HttpException(500, $ex->getMessage());
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    /**
     * Returns all enumeration values.
     * 
     * @return View
     * 
     */
    public function putUserAction(Request $request, $id) {

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneById($id);

        if (!$user) {
            throw new HttpException(404, "user with the id $id not found");
        }
        $view = View::create();
        $form = $this->createForm(UserFormType::class, $user, array('method' => 'PUT'));
        try {
            $form->setData($user);
            if ('PUT' === $request->getMethod()) {
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $encoder = $this->container->get('security.password_encoder');
                    $passwordEncoded = $encoder->encodePassword($user, $user->getPassword());
                    $user->setPassword($passwordEncoded);
                    $this->getDoctrine()->getManager()->persist($user);
                    $this->getDoctrine()->getManager()->flush();
                    $view->setStatusCode(204);
                } else {
                    $view->setStatusCode(400);
                    $view->setData(array($form));
                }
            } else {
                $view->setStatusCode(400);
                $view->setData(array($form));
            }
        } catch (\Exception $ex) {
            throw new HttpException(500, $ex->getMessage());
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

}
