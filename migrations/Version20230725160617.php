<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725160617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conge (id_conge INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, statut_conge TINYINT(1) NOT NULL, duree_max INT NOT NULL, commentaire VARCHAR(255) NOT NULL, INDEX IDX_2ED893486B3CA4B (id_user), PRIMARY KEY(id_conge)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_de_paie (id_fiche INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, salaire_de_base DOUBLE PRECISION NOT NULL, prime_de_presence DOUBLE PRECISION NOT NULL, prime_de_rendement DOUBLE PRECISION NOT NULL, retenue_cnrps DOUBLE PRECISION NOT NULL, deduction_situation_familiale DOUBLE PRECISION NOT NULL, autre_deduction DOUBLE PRECISION NOT NULL, salaire_brut_imposable DOUBLE PRECISION NOT NULL, avance DOUBLE PRECISION NOT NULL, salaire_net DOUBLE PRECISION NOT NULL, heures_supplimentaires INT NOT NULL, INDEX IDX_B3236E136B3CA4B (id_user), PRIMARY KEY(id_fiche)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id_formation INT AUTO_INCREMENT NOT NULL, nom_formation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id_formation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id_participation INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_formation INT NOT NULL, INDEX IDX_AB55E24F6B3CA4B (id_user), INDEX IDX_AB55E24FC0759D98 (id_formation), PRIMARY KEY(id_participation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id_produit INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, date_importation DATE NOT NULL, date_expiration DATE NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id_produit)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, statut TINYINT(1) NOT NULL, mdp VARCHAR(255) NOT NULL, num_tel INT NOT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conge ADD CONSTRAINT FK_2ED893486B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE fiche_de_paie ADD CONSTRAINT FK_B3236E136B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FC0759D98 FOREIGN KEY (id_formation) REFERENCES formation (id_formation)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conge DROP FOREIGN KEY FK_2ED893486B3CA4B');
        $this->addSql('ALTER TABLE fiche_de_paie DROP FOREIGN KEY FK_B3236E136B3CA4B');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F6B3CA4B');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FC0759D98');
        $this->addSql('DROP TABLE conge');
        $this->addSql('DROP TABLE fiche_de_paie');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
