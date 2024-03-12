# EXAMEN SYMFONY

- El proyecto fue realizado en Windows usando WSL2, lo que significa que realmente el proyecto fue realizado en un entorno linux.
- El proceso de creación del entorno fue el explicado durante las clases. No se instalo ninguna dependencia extra.

```console
# La URL del repositorio es https://github.com/Ziyhzu/symfony_examen.git
```

- Nos aseguramos que MySql esta activo:
   - sudo service mysql start
   - sudo service mysql stop
   - sudo service mysql restart

```console
cd /var/www/html

# Una vez descargado el repositorio, lo descomprimimos y movemos la carpeta "islantilla" al directorio /var/www/html

#Accedemos a la carpeta del proyecto:
cd /var/www/html/islantilla

composer install

symfony server:start

php bin/console doctrine:database:create

# IMPORTANTE: El proyecto ya incluye un archivo de migracion editado para que funcione correctamente el proyecto.

php bin/console doctrine:migrations:migrate
```

## ENDPOINT

```console
#ENTIDAD HABITACIONES

# Insertar datos con endpoint
http://localhost:8000/habitaciones/insertar-endpoint/Habitacion deluxe/204/130/1

# Insertar datos con formulario
http://localhost:8000/habitaciones/insertar-formulario

# Modificar datos con endpoint
http://localhost:8000/habitaciones/modificar-endpoint/Habitacion estandar/125.00

# Consultar tabla con twig
http://localhost:8000/habitaciones/consultar-twig

# Consultar tabla con JSON
http://localhost:8000/habitaciones/consultar-json

# Borrado fisico
http://localhost:8000/habitaciones/borrado-fisico/1
```

```console
#ENTIDAD RESERVAS

# Insertar datos con formulario
http://localhost:8000/reservas/insertar-formulario

# Consultar tabla con twig
http://localhost:8000/reservas/consultar-twig

# Consultar tabla con JSON
http://localhost:8000/reservas/consultar-json
```

```console
#ENTIDAD REVIEWS

# Insertar datos con formulario
http://localhost:8000/reviews/insertar-formulario

# Consultar tabla con twig
http://localhost:8000/reviews/consultar-twig

# Consultar tabla con JSON
http://localhost:8000/reviews/consultar-json
```

```console
#CONSULTAS JOIN

# Clientes + tipo de habitacion + dias de hospedaje (Twig)
http://localhost:8000/habitaciones/join-uno

# Clientes + su comentario + su nota de valoracion (JSON)
http://localhost:8000/reservas/join-dos
```