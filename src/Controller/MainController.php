<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    public function __construct(protected UserRepository $userRepository)
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
    public function deleteUser(Request $request, $id): void
    {
        $this->userRepository->remove($id);
    }
}
