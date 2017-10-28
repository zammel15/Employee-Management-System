<?php

namespace CvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CvBundle\Entity\Personne;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use CvBundle\Form\PersonneType;

class DefaultController extends Controller
{
    public function indexAction($id)
    {
       $personne = $this->getDoctrine()->getEntityManager()->getRepository('CvBundle:Personne')->find($id);




        return $this->render('CvBundle:Premier:cv.html.twig',array('personne'=>$personne));
    }

    public function editeAction($nom , $prenom , $age)
    {
        return $this->render('CvBundle:Default:edite.html.twig',array('nom'=>$nom , 'prenom'=>$prenom , 'age'=>$age));
    }

    public function templateAction()
    {
        return $this->render('CvBundle:Premier:template.html.twig');
    }

    public function cvsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $per = $em->getRepository('CvBundle:Personne')->findAll();

        foreach ($per as $p) {
            dump($p);
        }

        return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));
    }

    public function addcvAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('CvBundle:Personne');


        $p1 = new Personne("aymen" , "prenom1" , 31 , '/edmin/images/user.png');
        $p2 = new Personne("nom2" , "prenom2" , 41 , '/edmin/images/qsdq.png');
        $p3 = new Personne("nom3" , "prenom3" , 23 , 'img.jpg');
        $p4 = new Personne("nom4" , "prenom4" , 25 , 'user.png');
        $p5 = new Personne("nom5" , "prenom5" , 56 , '/edmin/images/user.png');
        $cvs = array($p1, $p2, $p3, $p4, $p5);
        foreach($cvs as $persone){
        $em->persist($persone);
        }

        $em->flush();

        //$per = $em->getRepository('CvBundle:Personne')->find($p1.id);
        $per = $em->getRepository('CvBundle:Personne')->findAll();

        foreach ($per as $p) {
            dump($p);
        }

        dump($per);


        //return $this->render('CvBundle:Premier:cv.html.twig',array('personne'=>$per));
        return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));
    }

    public function deletePersAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('CvBundle:Personne');

        $per = $em->getRepository('CvBundle:Personne')->find($id);


            $em->remove($per);

        $em->flush();



        return $this->redirectToRoute('cvs_homepage');
    }

    public function addPersAction($nom , $prenom , $age , $path)
    {
        $personne = new Personne($nom, $prenom , $age , $path);

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('CvBundle:Personne');
        $em->persist($personne);
        $em->flush();
        return $this->render('CvBundle:Premier:cv.html.twig',array('personne'=>$personne));
    }

    public function updatePersAction($id , $nom , $prenom , $age , $path)
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('CvBundle:Personne');



        $per = $em->getRepository('CvBundle:Personne')->find($id);
        $per->setNom($nom);
        $per->setPrenom($prenom);
        $per->setAge($age);
        $per->setPath($path);


      //  $em->remove($per);
        //$em->persist($personne);
        $em->persist($per);
        $em->flush();


        $per = $em->getRepository('CvBundle:Personne')->findAll();
        return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));

    }

    /*public function addPerssAction(Request $request){

    // just setup a fresh $personne object (remove the dummy data)
    $personne = new Personne();

    $form = $this->createFormBuilder($personne)
        ->add('Nom', TextType::class)
        ->add('Prenom', TextType::class)
        ->add('Age', IntegerType::class)
        ->add('Path', TextType::class)
        ->add('save', SubmitType::class, array('label' => 'Ajouter personne'))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$personne` variable has also been updated
        $personne = $form->getData();

        // ... perform some action, such as saving the personne to the database
        // for example, if Personne is a Doctrine entity, save it!
        $em = $this->getDoctrine()->getManager();
        $em->persist($personne);
        $em->flush();

       // $per = $em->getRepository('CvBundle:Personne')->findAll();
        //return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));

        return $this->redirectToRoute('cvs_homepage');
    }

    return $this->render('CvBundle:Premier:addPers.html.twig', array('form' => $form->createView(),));
    }*/

    /*public function updatePerssAction($id,Request $request){


        $personne = $advert = $this->getDoctrine()
            ->getManager()
            ->getRepository('CvBundle:Personne')
            ->find($id);

       // createBuilder(FormType::class, $advert);
        $form = $this->createFormBuilder($personne)
            ->add('Nom', TextType::class)
            ->add('Prenom', TextType::class)
            ->add('Age', IntegerType::class)
            ->add('Path', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Modifier cv'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$personne` variable has also been updated
            $upersonne = $form->getData();

            // ... perform some action, such as saving the personne to the database
            // for example, if Personne is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($upersonne);
            $em->flush();

            // $per = $em->getRepository('CvBundle:Personne')->findAll();
            //return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));

            return $this->redirectToRoute('cvs_homepage');
        }

        return $this->render('CvBundle:Premier:addPers.html.twig', array('form' => $form->createView(),));
    }*/


    public function updatePerssAction($id,Request $request){


        $personne = $advert = $this->getDoctrine()
            ->getManager()
            ->getRepository('CvBundle:Personne')
            ->find($id);

        // createBuilder(FormType::class, $advert);
        $form = $this->createForm(PersonneType::class, $personne);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$personne` variable has also been updated
            $upersonne = $form->getData();

            // ... perform some action, such as saving the personne to the database
            // for example, if Personne is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($upersonne);
            $em->flush();

            // $per = $em->getRepository('CvBundle:Personne')->findAll();
            //return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));

            return $this->redirectToRoute('cvs_homepage');
        }

        return $this->render('CvBundle:Premier:addPers.html.twig', array('form' => $form->createView(),));
    }

    public function addPerssAction(Request $request){

        // just setup a fresh $personne object (remove the dummy data)
        $personne = new Personne();

        $form = $this->createForm(PersonneType::class, $personne);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$personne` variable has also been updated
            $personne = $form->getData();

            // ... perform some action, such as saving the personne to the database
            // for example, if Personne is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($personne);
            $em->flush();

            // $per = $em->getRepository('CvBundle:Personne')->findAll();
            //return $this->render('CvBundle:Premier:cvs.html.twig',array('cvs'=>$per));

            return $this->redirectToRoute('cvs_homepage');
        }

        return $this->render('CvBundle:Premier:addPers.html.twig', array('form' => $form->createView(),));
    }



}
