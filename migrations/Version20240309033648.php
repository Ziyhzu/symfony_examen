<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309033648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE habitaciones (habitacion_id_pk INT AUTO_INCREMENT NOT NULL, tipo_habitacion VARCHAR(40) NOT NULL, numero_habitacion SMALLINT NOT NULL, precio_dia NUMERIC(5, 2) NOT NULL, activo TINYINT(1) NOT NULL DEFAULT 1, PRIMARY KEY(habitacion_id_pk)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservas (reserva_id_pk INT AUTO_INCREMENT NOT NULL, habitacion_id_fk INT DEFAULT NULL, cliente VARCHAR(40) NOT NULL, fecha_entrada DATE NOT NULL, fecha_salida DATE NOT NULL, activo TINYINT(1) NOT NULL DEFAULT 1, INDEX IDX_AA1DAB01442470C2 (habitacion_id_fk), PRIMARY KEY(reserva_id_pk)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (reviews_id_pk INT AUTO_INCREMENT NOT NULL, reserva_id_fk INT DEFAULT NULL, comentario VARCHAR(255) NOT NULL, nota_valoracion SMALLINT NOT NULL, activo TINYINT(1) NOT NULL DEFAULT 1, UNIQUE INDEX UNIQ_6970EB0FFF1189B0 (reserva_id_fk), PRIMARY KEY(reviews_id_pk)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservas ADD CONSTRAINT FK_AA1DAB01442470C2 FOREIGN KEY (habitacion_id_fk) REFERENCES habitaciones (habitacion_id_pk) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FFF1189B0 FOREIGN KEY (reserva_id_fk) REFERENCES reservas (reserva_id_pk) ON DELETE SET NULL');

        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Habitacion estandar", 101, 120.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Habitacion estandar", 102, 120.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Habitacion estandar", 103, 120.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Habitacion deluxe", 201, 130.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Habitacion deluxe", 202, 130.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Habitacion deluxe", 203, 130.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Apartamento estandar", 301, 105.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Apartamento estandar", 302, 105.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Apartamento estandar", 303, 105.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Apartamento luxury", 401, 145.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Apartamento luxury", 402, 145.00, 1)');
        $this->addSql('INSERT INTO habitaciones (tipo_habitacion, numero_habitacion, precio_dia, activo) VALUES ("Apartamento luxury", 403, 145.00, 1)');

        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Juan Pérez", "2024-03-10", "2024-03-13", 1, 1)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("María García", "2024-03-17", "2024-03-22", 1, 1)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Carlos López", "2024-03-26", "2024-04-03", 1, 1)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Laura Martínez", "2024-04-08", "2024-04-10", 1, 2)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Pedro Sánchez", "2024-04-16", "2024-04-22", 1, 2)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Ana Rodríguez", "2024-04-30", "2024-05-07", 1, 2)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Lucía Martínez", "2024-05-12", "2024-05-16", 1, 3)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Daniel Sánchez", "2024-05-21", "2024-05-28", 1, 3)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Elena López", "2024-06-04", "2024-06-10", 1, 3)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Diego Rodríguez", "2024-06-15", "2024-06-20", 1, 4)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Marta García", "2024-06-27", "2024-07-05", 1, 4)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Alejandro Pérez", "2024-07-14", "2024-07-24", 1, 4)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Luis Martínez", "2024-08-03", "2024-08-07", 1, 5)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Sara Sánchez", "2024-08-17", "2024-08-24", 1, 5)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Pablo López", "2024-09-01", "2024-09-10", 1, 5)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Carmen Martínez", "2024-03-10", "2024-03-14", 1, 6)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Jorge Sánchez", "2024-03-18", "2024-03-22", 1, 6)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Eva López", "2024-03-26", "2024-03-30", 1, 6)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Raúl Martínez", "2024-04-08", "2024-04-12", 1, 7)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Marta Sánchez", "2024-04-16", "2024-04-21", 1, 7)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Hugo López", "2024-04-28", "2024-05-02", 1, 7)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Alicia Martínez", "2024-05-10", "2024-05-14", 1, 8)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Mario Sánchez", "2024-05-20", "2024-05-25", 1, 8)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Laura López", "2024-06-01", "2024-06-06", 1, 8)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Diego Martínez", "2024-06-15", "2024-06-19", 1, 9)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Elena Sánchez", "2024-06-27", "2024-07-01", 1, 9)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Alejandro López", "2024-07-10", "2024-07-14", 1, 9)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Sara Martínez", "2024-07-26", "2024-07-30", 1, 10)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Pablo Sánchez", "2024-08-06", "2024-08-10", 1, 10)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Lucía López", "2024-08-20", "2024-08-24", 1, 10)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Andrea Martínez", "2024-03-10", "2024-03-14", 1, 11)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("David Sánchez", "2024-03-19", "2024-03-23", 1, 11)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Cristina López", "2024-03-27", "2024-03-31", 1, 11)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Sergio Martínez", "2024-04-08", "2024-04-12", 1, 12)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Laura Sánchez", "2024-04-17", "2024-04-21", 1, 12)');
        $this->addSql('INSERT INTO reservas (cliente, fecha_entrada, fecha_salida, activo, habitacion_id_fk) VALUES ("Diego López", "2024-04-26", "2024-04-30", 1, 12)');

        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Buena experiencia", 4, 1, 1)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Excelente servicio", 5, 1, 2)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Habitación limpia y cómoda", 4, 1, 3)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Personal amable", 4, 1, 4)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Servicio de desayuno mejorable", 3, 1, 5)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Buena relación calidad-precio", 4, 1, 6)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Volvería a reservar", 4, 1, 7)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Problemas con la calefacción", 2, 1, 8)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Vistas impresionantes", 5, 1, 9)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Ubicación conveniente", 4, 1, 10)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Espacio amplio y luminoso", 4, 1, 11)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Limpieza mejorable", 3, 1, 12)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Todo perfecto", 5, 1, 13)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Personal atento y servicial", 4, 1, 14)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Bonita decoración", 4, 1, 15)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Mala experiencia", 2, 1, 16)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Necesita mejoras en limpieza", 3, 1, 17)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Excelente ubicación", 5, 1, 18)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Comodidades básicas", 3, 1, 19)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Ruidoso por la noche", 2, 1, 20)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Estancia agradable", 4, 1, 21)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Servicio de habitaciones rápido", 4, 1, 22)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Habitación bien equipada", 4, 1, 23)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Buenas vistas desde la habitación", 5, 1, 24)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Desayuno variado", 4, 1, 25)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Personal amigable", 4, 1, 26)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Buena relación calidad-precio", 4, 1, 27)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Limpieza impecable", 5, 1, 28)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Cama cómoda", 4, 1, 29)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Excelente atención al cliente", 5, 1, 30)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("WiFi rápido y estable", 4, 1, 31)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Baño amplio y moderno", 5, 1, 32)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Servicio de limpieza diario", 4, 1, 33)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Buenas instalaciones deportivas", 4, 1, 34)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Check-in rápido y eficiente", 5, 1, 35)');
        $this->addSql('INSERT INTO reviews (comentario, nota_valoracion, activo, reserva_id_fk) VALUES ("Ubicación céntrica", 4, 1, 36)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservas DROP FOREIGN KEY FK_AA1DAB01442470C2');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FFF1189B0');
        $this->addSql('DROP TABLE habitaciones');
        $this->addSql('DROP TABLE reservas');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
