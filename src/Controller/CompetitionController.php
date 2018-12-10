<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Competition;
// CHECK CARCONTROLLER

class CompetitionController
{
    /**
     * @Route("/competition/create", name="create_competition", methods={"GET", "POST"})
     */
    public function createCompetition(Request $request)
    {
        $car = new Competition();
        $form = $this->createForm(CompetitionFormType::class, $competition, ['standalone' => true]);
        // Work on Doctrine FormType to make line 16 valid
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // persist
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($car);
            $manager->flush();
            
            // redirect
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render(
            'Competition/Create.html.twig',
            ['formObj' => $form->createView()]
            );
    }   
    
    /**
     * @Route("/competition/{competition}", name="competition_details")
     */
    public function competitionDetail(competition $competition)
    {
        $arr = [
            'name' => $competition->getName(),
            'date' => $competition->getEventDate(),
            'players' => $competition->getNumberOfPlayers()
        ];
        return new Response(implode(', ', $arr));
    }
}

