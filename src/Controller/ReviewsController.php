<?php

namespace App\Controller;

use App\Entity\Reservas;
use App\Entity\Reviews;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/reviews', name: 'app_reviews_')]
class ReviewsController extends AbstractController
{


    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('reviews/index.html.twig', [
            'controller_name' => 'ReviewsController',
        ]);
    }


    // Ejemplo endpoint: http://localhost:8000/reviews/insertar-formulario
    #[Route('/insertar-formulario', name: 'insertar-formulario')]
    public function insertarFormulario(SessionInterface $session, EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {

        $review = new Reviews();
        $formulario = $this->createFormBuilder($review)
            ->add('comentario', TextType::class, ['label' => 'Comentario sobre la reserva','attr' => ['class' => 'form-control']])
            ->add('nota_valoracion', IntegerType::class, ['label' => 'Nota de valoración (Del 0 al 5)','attr' => ['class' => 'form-control']])
            ->add('activo', CheckboxType::class, ['data' => true, 'attr' => ['class' => 'form-control']])
            ->add('reserva_id_fk', EntityType::class, ['label' => 'ID de la reserva (IMPORTANTE: No se puede volver a valorar una reserva. Una valoracion por reserva)','class' => Reservas::class, 'choice_label' => function (Reservas $reserva) {
                    return $reserva->getReservasIdPk();
                },
                'attr' => ['class' => 'form-control'],
            ])
            ->add('guardar', SubmitType::class, ['attr' => ['class' => 'form-control btn btn-primary w-25']])
            ->getForm();

        $formulario->handleRequest($solicitud);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $gestorEntidades->persist($review);
            $gestorEntidades->flush();

            $session->getFlashBag()->add('insert-form', 'Nueva habitacion con ID ' . $review->getReviewsIdPk() .  ' insertada');

            return $this->redirectToRoute("app_reviews_consultar_twig");
        }

        return $this->render('reviews/insertarFormulario.html.twig', [
            'controller_name' => 'ReviewsController',
            'miForm' => $formulario->createView(),
        ]);
    }




    // Ejemplo endpoint: http://localhost:8000/reviews/consultar-twig
    #[Route('/consultar-twig', name: 'consultar_twig')]
    public function consultarTwig(EntityManagerInterface $gestorEntidades): Response
    {
        $reviews = $gestorEntidades->getRepository(Reviews::class)->findAll();


        return $this->render('reviews/consultarTwig.html.twig', [
            'reviews' => $reviews,
        ]);
    }


    // Ejemplo endpoint: http://localhost:8000/reviews/consultar-json
    #[Route('/consultar-json', name: 'consultar-json')]
    public function consultarJson(EntityManagerInterface $gestorEntidades): Response
    {


        $repoReviews = $gestorEntidades->getRepository(Reviews::class);
        $reviews = $repoReviews->selectReviews();

        $json = [];
        foreach ($reviews as $review) {
            $json[] = [
                "id" => $review->getReviewsIdPk(),
                "Comentacion" => $review->getComentario(),
                "Nota de valoracion" => $review->getNotaValoracion(),

            ];
        }
        return new JsonResponse($json);
    }
}
