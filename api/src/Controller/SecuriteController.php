<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Compte;
use App\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

/**
 * @Route("/api")
 */
class SecuriteController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if (isset($values->username, $values->password)) {

            //$random = random_int(10000000, 99999999);

            $user = new User();
            $form=$this->createForm(FormType::class, $user);
            $form->handleRequest($request);
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setProfil($values->profil);
            $profil=$user->getProfil();
            $role=[];
            if($profil == "admin"){
                $role=["ROLE_ADMIN"];
            }
            elseif($profil == "superadmin"){
                $role=["ROLE_SUPER_ADMIN"];
            }
            elseif($profil == "user"){
                $role=["ROLE_USER"];
            }
            elseif($profil == "caissier"){
                $role=["ROLE_CAISSIER"];
            }
            $user->setRoles($role);
            $user->setNom($values->nom);
            $entrep=$values->nom;
            $recup=substr($entrep,0,2);
            while(true){
                if(time() % 1 == 0){
                    $alea = rand(100000000,999999999);
                    break;
                }
                slep(1);
            }
            $concat=$recup.$alea;
            $user->setPrenom($values->prenom);
            $user->setTel($values->tel);
            $user->setMail($values->mail);
            $user->setAdresse($values->adresse);
            $user->setStatut($values->statut);
            $user->setNinea($values->ninea);
            $entityManager = $this->getDoctrine()->getManager();
            $errors = $validator->validate($user);

            $partenaire = new Partenaire();
            $partenaire->setNom($values->nom);
            $partenaire->setNinea($values->ninea);
            $partenaire->setAdresse($values->adresse);
            $partenaire->setTel($values->tel);
            $partenaire->setMail($values->mail);
            $partenaire->setUser($user);

            $compte = new Compte();
            $compte->setSolde($values->solde);
            $compte->setNumcompte($concat);
            $compte->setPartenaire($partenaire);


            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json',
                ]);
            }
            $entityManager->persist($user);
            $entityManager->persist($partenaire);
            $entityManager->persist($compte);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé',
            ];
            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner les clés username et password',
        ];
        return new JsonResponse($data, 500);
    }
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

}
