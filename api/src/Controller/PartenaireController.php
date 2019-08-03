<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class PartenaireController extends AbstractController
{
    // /**
    //  * @Route("/partenaire", name="partenaire",methods={"POST"})
    //  */

    // public function ajout(Request $request, EntityManagerInterface $entityManager)
    // {
    //     $values = "";

    //     $random = random_int(10000000, 99999999);

    //     $values = json_decode($request->getContent());
    //     if (isset($values->username, $values->password)) {
    //         $partenaire = new Partenaire();
    //         $partenaire->setNom($values->nom);
    //         $partenaire->setNinea($values->ninea);
    //         $partenaire->setAdresse($values->adresse);
    //         $partenaire->setTel($values->tel);
    //         $partenaire->setMail($values->mail);
    //         $partenaire->setUser($values->user);

    //         $compte = new Compte();
    //         $compte->setSolde($values->solde);
    //         $compte->setNucompte($random);
    //         $compte->setPartenaire($partenaire);

    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($partenaire);
    //         $entityManager->persist($compte);
    //         //$entityManager->persist($depot);
    //         $entityManager->flush();

    //         return new Response(
    //             'enregistrer un niveau avec id: ' . $partenaire->getId() . ' et un nouveau compte avec id: ' . $compte->getId() . ' et un nouveau depot avec id: ' . $depot->getId()
    //         );
    //     }
    // }
    /**
     * @Route("/listpart",name="listparte",methods={"GET"})
     */
    // public function listpart(PartenaireRepository $partenaireRepository, SerializerInterface $serializer)
    // {
    //     $parte = $partenaireRepository->findAll();
    //     $data = $serializer->serialize($parte, 'json');
    //     return new Response($data, 200, ['Content-Type' => 'Application/json']);
    // }
}
