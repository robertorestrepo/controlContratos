<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Contrato;
use AppBundle\Entity\Categorias;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
    /**
     * @Route("/contratos/create", name="Registrar Contrato")
     */
    public function craeteAction(Request $request){
        $contrato = new Contrato();
        
        $form = $this->createFormBuilder($contrato)
                ->add('nombre', TextType::class, array('label' => 'Nombre Contrato', 'attr' => array('class' => 'form-control','id' => 'contrato', 'placeholder' => 'Nombre Contrato')))
                ->add('description', TextareaType::class, array('label' => 'Descripción del Contrato', 'attr' => array('class' => 'form-control','id' => 'description', 'placeholder' => 'Descripción')))
                ->add('fechaInicio', DateType::class, array('input'  => 'datetime','widget' => 'choice','label' => 'Fecha inicio del Contrato', 'attr' => array('class' => 'form-control','id' => 'fechaIni', 'placeholder' => 'Fecha Inicio')))
                ->add('fechaFin', DateType::class, array('input'  => 'datetime','widget' => 'choice','label' => 'Fecha final del Contrato', 'attr' => array('class' => 'form-control','id' => 'fechaFin', 'placeholder' => 'Fecha Fin')))
                ->add('categoria', EntityType::class, array(
                    'class' => 'AppBundle:Categorias',
                    'choice_label' => 'nombre',
                ))
                ->add('save', SubmitType::class, array('label' => 'Guardar' , 'attr' => array('class' => 'btn btn-default')))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($contrato);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }    
        
        return $this->render('crud/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/createCategorias", name="Registrar Categoria")
     */
    public function craeteCategoriaAction(Request $request){
        $categorias = new Categorias();
        
        $form = $this->createFormBuilder($categorias)
                ->add('nombre', TextType::class, array('label' => 'Nombre Categoria', 'attr' => array('class' => 'form-control','id' => 'categoria', 'placeholder' => 'Nombre Categoria')))
                ->add('save', SubmitType::class, array('label' => 'Guardar' , 'attr' => array('class' => 'btn btn-default')))
                ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorias);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }    
        
        return $this->render('crud/createCategorias.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
