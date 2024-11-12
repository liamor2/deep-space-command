<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112145914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agencies (id INT AUTO_INCREMENT NOT NULL, employees_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F65A4DC48520A30B (employees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employees (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, science INT NOT NULL, pilote INT NOT NULL, engineer INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions (id INT AUTO_INCREMENT NOT NULL, agency_id_id INT NOT NULL, employees_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, duration INT NOT NULL, state SMALLINT NOT NULL, difficulty SMALLINT NOT NULL, description LONGTEXT NOT NULL, launch_date DATETIME NOT NULL, INDEX IDX_34F1D47E71881179 (agency_id_id), INDEX IDX_34F1D47E8520A30B (employees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permissions (id INT AUTO_INCREMENT NOT NULL, parent_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_2DEDCC6FB3750AF4 (parent_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permissions_roles (permissions_id INT NOT NULL, roles_id INT NOT NULL, INDEX IDX_FDC136589C3E4F87 (permissions_id), INDEX IDX_FDC1365838C751C4 (roles_id), PRIMARY KEY(permissions_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, parent_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B63E2EC7B3750AF4 (parent_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, role_id_id INT NOT NULL, agency_id_id INT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_1483A5E988987678 (role_id_id), INDEX IDX_1483A5E971881179 (agency_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agencies ADD CONSTRAINT FK_F65A4DC48520A30B FOREIGN KEY (employees_id) REFERENCES employees (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E71881179 FOREIGN KEY (agency_id_id) REFERENCES agencies (id)');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47E8520A30B FOREIGN KEY (employees_id) REFERENCES employees (id)');
        $this->addSql('ALTER TABLE permissions ADD CONSTRAINT FK_2DEDCC6FB3750AF4 FOREIGN KEY (parent_id_id) REFERENCES permissions (id)');
        $this->addSql('ALTER TABLE permissions_roles ADD CONSTRAINT FK_FDC136589C3E4F87 FOREIGN KEY (permissions_id) REFERENCES permissions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE permissions_roles ADD CONSTRAINT FK_FDC1365838C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7B3750AF4 FOREIGN KEY (parent_id_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E988987678 FOREIGN KEY (role_id_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E971881179 FOREIGN KEY (agency_id_id) REFERENCES agencies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agencies DROP FOREIGN KEY FK_F65A4DC48520A30B');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E71881179');
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47E8520A30B');
        $this->addSql('ALTER TABLE permissions DROP FOREIGN KEY FK_2DEDCC6FB3750AF4');
        $this->addSql('ALTER TABLE permissions_roles DROP FOREIGN KEY FK_FDC136589C3E4F87');
        $this->addSql('ALTER TABLE permissions_roles DROP FOREIGN KEY FK_FDC1365838C751C4');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7B3750AF4');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E988987678');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E971881179');
        $this->addSql('DROP TABLE agencies');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE missions');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE permissions_roles');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
