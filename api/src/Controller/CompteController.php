<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Depot;
use App\Entity\Partenaire;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte",methods={"POST"})
     */
    public function compte(Request $request, SerializerInterface $serializer,
        EntityManagerInterface $entityManager, ValidatorInterface $validator) {
        $values = json_decode($request->getContent());
        if (isset($values->user_id)) {

            $depot = new Depot();

            $depot->setSomme($values->somme);
            $depot->setDate(new \DateTime('now'));

            $use = $this->getDoctrine()->getRepository(User::class)->find($values->user_id);
            $depot->setUser($use);

            $dep = $this->getDoctrine()->getRepository(Compte::class)->find($values->compte_id);
           
            var_dump($values);
            $dep->setSolde($dep->getSolde() + $values->somme);
            $depot->setCompte($dep);
            
            $errors = $validator->validate($depot);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, ['Content-Type' => 'Application/json']);
            }

            $entityManager->persist($depot);
            $entityManager->flush();

            $data = ['status' => 201, 'message' => 'compte alimenter'];
            return new JsonResponse($data, 201);
        }
        $data = ['status' => 500, 'message' => 'erreurs'];
        return new JsonResponse($data, 500);

    }
}
