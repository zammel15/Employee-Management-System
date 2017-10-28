<?php

namespace TodoListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{


    public function indexAction(Request $request)
    {


        $session = $request->getSession();


        if(!$session->has('todos')){

            $todos = array(
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            );

            $session->set('todos',$todos);
        }
            return $this->render('TodoListBundle:Default:index.html.twig');


    }




    public function addAction(Request $request, $cle , $valeur)
    {
        $session = $request->getSession();


        if($session->has('todos')){


            $todos = $session->get('todos');
            $todos[$cle] = $valeur;
            $session->set('todos',$todos);
            $session->getFlashBag()->add('notification', 'todo ajouté ..');

        }else{
            $session->getFlashBag()->add('error', 'todo non ajouté ..');
        }

        return $this->render('TodoListBundle:Default:index.html.twig');


    }


    public function deleteAction(Request $request, $cle)
    {
        $session = $request->getSession();


        if($session->has('todos')){



            $todos = $session->get('todos');

            if(array_key_exists ($cle, $todos )){

                unset($todos[$cle]) ;
                $session->set('todos',$todos);
                $session->getFlashBag()->add('notification', 'todo supprimé ..');

            }else{

                $session->getFlashBag()->add('error', 'cle n\'existe pas ..');
            }



        }else{
            $session->getFlashBag()->add('error', 'todo non supprimé ..');
        }
        return $this->render('TodoListBundle:Default:index.html.twig');


    }




    public function editeAction(Request $request, $cle , $valeur)
    {
        $session = $request->getSession();


        if($session->has('todos')){

            $todos = $session->get('todos');

            if(array_key_exists ($cle, $todos )){

                $todos = $session->get('todos');
                $todos[$cle] = $valeur ;
                $session->set('todos',$todos);
                $session->getFlashBag()->add('notification', 'todo modifié ..');

            }else{

                $session->getFlashBag()->add('error', 'cle n\'existe pas ..');
            }

        }else{
            $session->getFlashBag()->add('error', 'todo non modifié ..');
        }

        return $this->render('TodoListBundle:Default:index.html.twig');


    }



    public function resetAction(Request $request)
    {
        $session = $request->getSession();


        if($session->has('todos')){


            $todos = $session->clear();

        }else{
            $session->getFlashBag()->add('error', 'todo non renitialisé ..');
        }

        return $this->forward('TodoListBundle:Default:index');


    }



}
