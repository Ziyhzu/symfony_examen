<?php

namespace App\Controller;

use App\Entity\Habitaciones;
use App\Entity\Reservas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/reservas', name: 'app_reservas_')]
class ReservasController extends AbstractController
{

    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('reservas/index.html.twig', [
            'controller_name' => 'ReservasController',
        ]);
    }


    // Ejemplo endpoint: http://localhost:8000/reservas/insertar-formulario
    #[Route('/insertar-formulario', name: 'insertar-formulario')]
    public function insertarFormulario(SessionInterface $session, EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {

        $reserva = new Reservas();
        $formulario = $this->createFormBuilder($reserva)
            ->add('cliente', TextType::class, ['attr' => ['label' => 'Cliente','class' => 'form-control']])
            ->add('fecha_entrada', DateType::class, ['label' => 'Fecha de entrada','widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('fecha_salida', DateType::class, ['label' => 'Fecha de salida','widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('activo', CheckboxType::class, ['data' => true, 'attr' => ['class' => 'form-control']])
            ->add('habitacion_id_fk', EntityType::class, ['label' => 'ID de la habitación reservada','class' => Habitaciones::class, 'choice_label' => 'habitacion_id_pk', 'attr' => ['class' => 'form-control'],])
            ->add('guardar', SubmitType::class, ['label' => 'Tipo de habitación','attr' => ['class' => 'form-control btn btn-primary w-25']])
            ->getForm();

        $formulario->handleRequest($solicitud);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $gestorEntidades->persist($reserva);
            $gestorEntidades->flush();

            $session->getFlashBag()->add('insert-form', 'Nueva habitacion con ID ' . $reserva->getReservasIdPk() .  ' insertada');

            return $this->redirectToRoute("app_reservas_consultar_twig");
        }

        return $this->render('reservas/insertarFormulario.html.twig', [
            'controller_name' => 'ReservasController',
            'miForm' => $formulario->createView(),
        ]);
    }




    // Ejemplo endpoint: http://localhost:8000/reservas/consultar-twig
    #[Route('/consultar-twig', name: 'consultar_twig')]
    public function consultarTwig(EntityManagerInterface $gestorEntidades): Response
    {
        $reservas = $gestorEntidades->getRepository(Reservas::class)->findAll();


        return $this->render('reservas/consultarTwig.html.twig', [
            'reservas' => $reservas,
        ]);
    }



    // Ejemplo endpoint: http://localhost:8000/reservas/consultar-json
    #[Route('/consultar-json', name: 'consultar-json')]
    public function consultarJson(EntityManagerInterface $gestorEntidades): Response
    {


        $repoReservas = $gestorEntidades->getRepository(Reservas::class);
        $reservas = $repoReservas->selectReservas();

        $json = [];
        foreach ($reservas as $reserva) {
            $json[] = [
                "id" => $reserva->getReservasIdPk(),
                "cliente" => $reserva->getCliente(),
                "fecha_entrada" => $reserva->getFechaEntrada(),
                "fecha_salida" => $reserva->getFechaSalida(),

            ];
        }
        return new JsonResponse($json);
    }



    // Ejemplo endpoint: http://localhost:8000/reservas/join-dos
    #[Route('/join-dos', name: 'join-dos')]
    public function consultarJoinDos(EntityManagerInterface $gestorEntidades): JsonResponse
    {


        $repoReservas = $gestorEntidades->getRepository(Reservas::class);
        $reservas = $repoReservas->joinDos();

        $json = [];
        foreach ($reservas as $reserva) {
            $json[] = [
                "cliente" => $reserva["cliente"],
                "comentario" => $reserva["comentario"],
                "nota" => $reserva["nota_valoracion"],

            ];
        }

        return new JsonResponse($json);
    }
}
