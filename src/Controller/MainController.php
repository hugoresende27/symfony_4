<?php

namespace App\Controller;

use App\Message\BitcoinMessage;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    public function __construct(protected UserRepository $userRepository, private MessageBusInterface $message)
    {

    }
    /**
     * @Route("/", name="app_main")
     */
    public function index(): Response
    {
        $users = $this->userRepository->findAll();
        // dd($this->userRepository->findOneBy(["id"=> 1]));

          // Convert users to an array
        $userArray = array_map(fn($user) => $user->toArray(), $users);

        return $this->render('main/index.html.twig', [
            'users' => $userArray,
        ]);
    }

    /**
     * @Route("/user/{id}", methods={"DELETE"}, name="delete_user")
     */
    public function deleteUser(Request $request, $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        if (!is_null($user)) {
            $this->userRepository->remove($user ) ;

            // Return a success response
            return new JsonResponse(['status' => 'success', 'message' => 'User deleted successfully'], 200);
        }

        // Return an error response if the user was not found
        return new JsonResponse(['status' => 'error', 'message' => 'User not found'], 404);

    }



    /**
     * @Route("/send", methods={"GET"}, name="send")
     */
    public function send(): JsonResponse
    {
        $data = new BitcoinMessage('Some data related to Bitcoin');
        $this->message->dispatch($data);

        return new JsonResponse(['status' => 'Message sent!']);
    }


}
