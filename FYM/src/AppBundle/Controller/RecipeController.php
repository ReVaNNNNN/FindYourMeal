<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Igredient;
use AppBundle\Entity\Quantity;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RecipeController extends Controller
{
    // method for: view form to create new recipe
    /**
     * @Route("/create")
     * @Template()
     * @Method("GET")
     */
    public function createAction()
    {
        $igredients = $this->getDoctrine()->getRepository('AppBundle:Igredient')->findAll();
        $recipe = new Recipe();

        $form = $this->createForm(new RecipeType(), $recipe);

        return ['form' => $form->createView(), 'igredients' => $igredients];
    }

    // method for: get form and save inserted data in database
    /**
     * @Route("/create")
     * @Template("AppBundle:Recipe:create.html.twig")
     * @Method("POST")
     */
    public function saveInDatabaseAction(Request $request)
    {
        $recipe = new Recipe();

        $form = $this->createForm(new RecipeType(), $recipe);
        $form->handleRequest($request);

        // ADD VALIDATION TO FORM AND CHECK VALIDATION
        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($request->get('igredients') as $igredient) {

                $quantity = new Quantity();
                $quantity->setIgredient($igredient);
                $em->persist($quantity);
//                print_r($igredient);

            // USUNALEM type hinting z setterow do igredients i quantity - co moze powodowac błedy
            }
            foreach ($request->get('quantity') as $quant) {

                $quantity = new Quantity();
                $quantity->setQuantity($quant);
                $em->persist($quantity);

            }
//            print_r($request->get('igredients'));
//            print_r($request->get('quantity'));
//            die;
            //
//            $quantity->setRecipe($request->request->get(''));
//            $quantity->setIgredient($request->request->get(''));
//            $quantity->setQuantity($request->request->get())

//            $em = $this->getDoctrine()->getManager();
            $em->persist($recipe);
//            $em->persist($quantity);
            $em->flush();

            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $recipe = $this->getDoctrine()->getRepository('AppBundle:Recipe')->find($id);

        if(!$recipe) {

            throw $this->createNotFoundException('Recipe not found');
        }

        return ['recipe' => $recipe];
    }

}
