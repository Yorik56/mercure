<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use \Firebase\JWT\JWT;
use Symfony\Component\Mercure\Authorization;
class HomeController extends AbstractController
{
    #[Route('/chat', name: 'chat')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    #[Route('/token', name: 'token')]
    public function token(Request $request, Authorization $authorization): Response
    {
        $key = "RfUjXn2r5u8x/A?D(G+KaPdSgVkYp3s6";
        $payload = [
            'mercure' => [
                'publish' => ['*'],
            ],
        ];
        $jwt = JWT::encode($payload, $key, 'HS256', 'jwt'); // holds valid jwt now

        return $this->json($jwt);

    }

    #[Route('/push', name: 'push')]
    public function push(HubInterface $hub): Response
    {
        $update = new Update(
            '/chat',
            json_encode(['data' => 0])
        );
//
        $hub->publish($update);


        return new Response($this->generateUrl("chat"));
    }
}
