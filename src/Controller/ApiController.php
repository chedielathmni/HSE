<?php

namespace App\Controller;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Transporter;
use App\Repository\TransporterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class ApiController extends AbstractController
{

    /**
     * @Route("/api/transporter", name="api_getTransporters", methods={"GET"})
     */
    public function getTransporters(TransporterRepository $repository) : Response
    {
        return $this->json($repository->findAll(), 200, [], ['groups' => 'read:tr']);
    }

    /**
     * @Route("/api/transporter", name="api_postTransporter", methods={"POST"})
     */
    public function postTransporter(Request $req, SerializerInterface $serializer, EntityManagerInterface $em,
    ValidatorInterface $validator) {


        try {
        $transporter = $serializer->deserialize($req->getContent(), Transporter::class, 'json');

        $encodedPassword = $this->encodePassword($transporter, $transporter->getPassword());
        $transporter->setPassword($encodedPassword);

        if(count($validator->validate($transporter)) > 0) {
            return $this->json($validator->validate($transporter), 400);
        }

        $em->persist($transporter);
        $em->flush();
        
        return $this->json($transporter, 201, [], ['groups' => 'read:tr']);

        } 
        catch(NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }


    /**
     * @Route("/api/login", name="api_login", methods={"POST"})
     */
    public function login (Request $req, TransporterRepository $repository, SerializerInterface $serializer) {

        try {
            $transporter = $serializer->deserialize($req->getContent(), Transporter::class, 'json');
            $apiKey = $req->query->get('apikey');

            $old = $repository->findOneBy(array('phoneNumber' => $transporter->getPhoneNumber()));
            $test = $this->encodePassword($transporter, $transporter->getPassword()) == $old->getPassword();

            $token = new PreAuthenticatedToken(
                $transporter,
                $apiKey,
                'providerkey'
            );

            dd($token);

            return $this->json($token, 200, []);
        } 
        catch(NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }


    private function encodePassword($transporter, $password)
    {
        $passwordEncoderFactory = new EncoderFactory([
            Transporter::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
        ]);

        $encoder = $passwordEncoderFactory->getEncoder($transporter);

        return $encoder->encodePassword($password, $transporter->getSalt());
    }
}
