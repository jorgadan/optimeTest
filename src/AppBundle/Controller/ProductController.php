<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\Type\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/", name="product_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Product:index.html.twig',array(
            'products' => $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Product')->findActive()
        ));
    }

    /**
     * @Route("/edit/{id}", name="product_edit")
     */
    public function editAction(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product)
            ->add('submit', SubmitType::class, array('label'=>'form.edit', 'attr'=>array('class'=>'btn btn-success pull-right')));
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $this->get('doctrine.orm.entity_manager')->persist($product);
                $this->get('doctrine.orm.entity_manager')->flush();
                return $this->redirectToRoute('product_index');
            }
        }
        return $this->render('AppBundle:Product:edit.html.twig',array(
            'edit_form' => $form->createView(),
            'product' => $product
        ));
    }

    /**
     * @Route("/new", name="product_new")
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product)
            ->add('submit', SubmitType::class, array('label'=>'form.create', 'attr'=>array('class'=>'btn btn-success pull-right')));
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $this->get('doctrine.orm.entity_manager')->persist($product);
                $this->get('doctrine.orm.entity_manager')->flush();
                return $this->redirectToRoute('product_index');
            }
        }
        return $this->render('AppBundle:Product:new.html.twig',array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     */
    public function deleteAction(Product $product)
    {
        $this->get('doctrine.orm.entity_manager')->remove($product);
        $this->get('doctrine.orm.entity_manager')->flush();

        return $this->redirectToRoute('product_index');
    }
}
