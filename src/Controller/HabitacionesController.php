<?php

namespace App\Controller;

use App\Entity\Habitaciones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

#[Route('/habitaciones', name: 'app_habitaciones_')]
class HabitacionesController extends AbstractController
{


    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('habitaciones/index.html.twig', [
            'controller_name' => 'HabitacionesController',
        ]);
    }



    // Ejemplo endpoint: http://localhost:8000/habitaciones/insertar-endpoint/Habitacion deluxe/204/130/1
    #[Route('/insertar-endpoint/{tipo_habitacion}/{numero_habitacion}/{precio_dia}/{activo}', name: 'insertar_endpoint')]
    public function insertarEndpointHabitacion(String $tipo_habitacion, int $numero_habitacion, float $precio_dia, int $activo, SessionInterface $session, EntityManagerInterface $gestorEntidades): Response
    {
        $habitacion = new Habitaciones();
        $habitacion->setTipoHabitacion($tipo_habitacion);
        $habitacion->setNumeroHabitacion($numero_habitacion);
        $habitacion->setPrecioDia($precio_dia);
        $habitacion->setActivo($activo);

        $gestorEntidades->persist($habitacion);
        $gestorEntidades->flush();

        $session->getFlashBag()->add('insert', 'Nueva habitacion con ID ' . $habitacion->getHabitacionIdPk() .  ' insertada');

        return $this->redirectToRoute('app_habitaciones_consultar_twig');
    }


    // Ejemplo endpoint: http://localhost:8000/habitaciones/insertar-formulario
    #[Route('/insertar-formulario', name: 'insertar-formulario')]
    public function insertarFormulario(SessionInterface $session, EntityManagerInterface $gestorEntidades, Request $solicitud): Response
    {

        $habitacion = new Habitaciones();
        $formulario = $this->createFormBuilder($habitacion)
            ->add('tipo_habitacion', TextType::class, ['attr' => ['label' => 'Tipo de habitación','class' => 'form-control']])
            ->add('numero_habitacion', IntegerType::class, ['label' => 'Número de Habitación (valor máximo 999)', 'attr' => ['class' => 'form-control']])
            ->add('precio_dia', NumberType::class, ['label' => 'Precio diario (valor máximo 999)', 'attr' => ['class' => 'form-control']])
            ->add('activo', CheckboxType::class, ['data' => true, 'attr' => ['class' => 'form-control']])
            ->add('guardar', SubmitType::class, ['attr' => ['class' => 'form-control btn btn-primary w-25']])
            ->getForm();

        $formulario->handleRequest($solicitud);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $gestorEntidades->persist($habitacion);
            $gestorEntidades->flush();

            $session->getFlashBag()->add('insert-form', 'Nueva habitacion con ID ' . $habitacion->getHabitacionIdPk() .  ' insertada');

            return $this->redirectToRoute("app_habitaciones_consultar_twig");
        }

        return $this->render('habitaciones/insertarFormulario.html.twig', [
            'controller_name' => 'HabitacionesController',
            'miForm' => $formulario->createView(),
        ]);
    }




    // Ejemplo endpoint: http://localhost:8000/habitaciones/modificar-endpoint/Habitacion estandar/125.00
    #[Route('/modificar-endpoint/{tipo_habitacion}/{precio}', name: 'modificar-endpoint')]
    public function modificarEndpointHabitacion(SessionInterface $session, EntityManagerInterface $gestorEntidades, String $tipo_habitacion, float $precio): Response
    {

        $nuevoPrecio = $precio;
        $repoHabitaciones = $gestorEntidades->getRepository(Habitaciones::class);
        $actualizarHabitacion = $repoHabitaciones->findBy(['tipo_habitacion' => $tipo_habitacion]);

        foreach ($actualizarHabitacion as $habitacion) {
            $habitacion->setPrecioDia($nuevoPrecio);
        }

        $gestorEntidades->flush();

        $session->getFlashBag()->add('modificar', 'Datos actualizados');

        return $this->redirectToRoute('app_habitaciones_consultar_twig');
    }




    // Ejemplo endpoint: http://localhost:8000/habitaciones/consultar-twig
    #[Route('/consultar-twig', name: 'consultar_twig')]
    public function consultarTwig(EntityManagerInterface $gestorEntidades): Response
    {
        $habitaciones = $gestorEntidades->getRepository(Habitaciones::class)->findAll();

        return $this->render('habitaciones/consultarTwig.html.twig', [
            'habitaciones' => $habitaciones,
        ]);
    }


    // Ejemplo endpoint: http://localhost:8000/habitaciones/consultar-json
    #[Route('/consultar-json', name: 'consultar-json')]
    public function consultarJson(EntityManagerInterface $gestorEntidades): Response
    {


        $repoHabitaciones = $gestorEntidades->getRepository(Habitaciones::class);
        $habitaciones = $repoHabitaciones->selectHabitaciones();

        $json = [];
        foreach ($habitaciones as $habitacion) {
            $json[] = [
                "id" => $habitacion->getHabitacionIdPk(),
                "Tipo de habitacion" => $habitacion->getTipoHabitacion(),
                "Numero de habitacion" => $habitacion->getNumeroHabitacion(),
                "Precio por dia" => $habitacion->getPrecioDia(),

            ];
        }
        return new JsonResponse($json);
    }



    // Ejemplo endpoint: http://localhost:8000/habitaciones/borrado-fisico/1
    #[Route('/borrado-fisico/{id}', name: 'borrado-fisico')]
    public function borradoFisico(SessionInterface $session, EntityManagerInterface $gestorEntidades, int $id): Response
    {

        $repoHabitaciones = $gestorEntidades->getRepository(Habitaciones::class);
        $borrarHabitacion = $repoHabitaciones->find($id);
        $gestorEntidades->remove($borrarHabitacion);

        $gestorEntidades->flush();

        $session->getFlashBag()->add('borrar', 'Registro borrado');

        return $this->redirectToRoute('app_habitaciones_consultar_twig');
    }



    // Ejemplo endpoint: http://localhost:8000/habitaciones/join-uno
    #[Route('/join-uno', name: 'join-uno')]
    public function consultarJoinUno(SessionInterface $session, EntityManagerInterface $gestorEntidades): Response
    {
        $repoHabitaciones = $gestorEntidades->getRepository(Habitaciones::class);
        $habitaciones = $repoHabitaciones->joinUno();

        $session->getFlashBag()->add('joinuno', 'Lista de clientes (tabla Reservas) con el tipo de habitación que reservó (tabla Habitaciones) y el tiempo de hospedaje (tabla Reservas + calculo matematico)');

        return $this->render('habitaciones/joinuno.html.twig', [
            'habitaciones' => $habitaciones,
        ]);
    }
}
