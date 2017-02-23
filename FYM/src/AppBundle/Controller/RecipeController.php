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
        // create new object Recipe
        $recipe = new Recipe();

        // create form and get data from that form
        $form = $this->createForm(new RecipeType(), $recipe);
        $form->handleRequest($request);

        // ADD VALIDATION TO FORM AND CHECK VALIDATION

        // if form was submitted
        if($form->isSubmitted()) {

            // create new object doctrine -> manager
            $em = $this->getDoctrine()->getManager();

            //set recipe from form including type of ingredients and their quantity
            $i = 0;
            foreach ($request->get('igredients') as $igredient) {
                $quantity = new Quantity();

                // find in database object equal id from igredients array[]
                $igredient = $this->getDoctrine()->getRepository('AppBundle:Igredient')->find($igredient);

                // set all attributes
                $quantity->setIgredient($igredient);
                $quantity->setQuantity($request->get('quantity')[$i]);
                $quantity->setRecipe($recipe);
//                $recipe->addIgredientQuantity($quantity);
                // tell database about new quantity object
                $em->persist($quantity);
                $i++;

            }

            // tell database about new recipe object and than save it and quantity object in database
            $em->persist($recipe);
            $em->flush();

            // after add new recipe, show it
            return $this->redirectToRoute('app_recipe_show', ['id' => $recipe->getId()]);
        }

        return ['form' => $form->createView()];
    }

    // method for show one recipe with get id
    /**
     * @Route("/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        // find in database recipe with get id
        $recipe = $this->getDoctrine()->getRepository('AppBundle:Recipe')->find($id);

        // if recipe doesn't exist throw exception
        if(!$recipe) {

            throw $this->createNotFoundException('Recipe not found');
        }

        // show recipe
        return ['recipe' => $recipe];
    }

    // method for show all recipes in database
    /**
     * @Route("/")
     * @Template()
     */
    public function showAllAction()
    {
        //find all recipes in database
        $recipes = $this->getDoctrine()->getRepository('AppBundle:Recipe')->findAll();

        // show all recipes as links(it is set in Twig)
        return ['recipes' => $recipes];
    }

    // edit recipe with get id
    /**
     * @@Route("/{id}/edit")
     * @Template("AppBundle:Recipe:create.html.twig")
     */
    public function editAction($id)
    {
        // find in database recipe with get id
        $recipe = $this->getDoctrine()->getRepository('AppBundle:Recipe')->find($id);
    }

}
