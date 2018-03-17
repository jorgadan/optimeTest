<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\Type\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/", name="category_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Category:index.html.twig',array(
            'categories' => $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Category')->findAll()
        ));
    }

    /**
     * @Route("/edit/{id}", name="category_edit")
     */
    public function editAction(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category)
            ->add('submit', SubmitType::class, array('label'=>'form.edit', 'attr'=>array('class'=>'btn btn-success pull-right')));
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $this->get('doctrine.orm.entity_manager')->persist($category);
                $this->get('doctrine.orm.entity_manager')->flush();
                return $this->redirectToRoute('category_index');
            }
        }
        return $this->render('AppBundle:Category:edit.html.twig',array(
            'edit_form' => $form->createView(),
            'category' => $category
        ));
    }

    /**
     * @Route("/new", name="category_new")
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $category->setActive(true);
        $form = $this->createForm(CategoryType::class, $category)
            ->add('submit', SubmitType::class, array('label'=>'form.create', 'attr'=>array('class'=>'btn btn-success pull-right')));
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $this->get('doctrine.orm.entity_manager')->persist($category);
                $this->get('doctrine.orm.entity_manager')->flush();
                return $this->redirectToRoute('category_index');
            }
        }
        return $this->render('AppBundle:Category:new.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
