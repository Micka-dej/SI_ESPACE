<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180624104654 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE space_ship (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(30) NOT NULL, fuel_type VARCHAR(20) NOT NULL, size VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_parking (id INT AUTO_INCREMENT NOT NULL, matricule VARCHAR(30) NOT NULL, allowed_size VARCHAR(30) NOT NULL, slots INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_order (id INT AUTO_INCREMENT NOT NULL, spaceship_id INT NOT NULL, user_id INT NOT NULL, starting_date DATETIME NOT NULL, ending_date DATETIME NOT NULL, INDEX IDX_F82F8FDC4AD9556B (spaceship_id), INDEX IDX_F82F8FDCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_additional_service (order_id INT NOT NULL, additional_service_id INT NOT NULL, INDEX IDX_1CBAA2108D9F6D38 (order_id), INDEX IDX_1CBAA210F8E98E09 (additional_service_id), PRIMARY KEY(order_id, additional_service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, last_name VARCHAR(50) NOT NULL, first_name VARCHAR(50) NOT NULL, email VARCHAR(30) NOT NULL, planet VARCHAR(20) NOT NULL, username VARCHAR(30) NOT NULL, phone_number VARCHAR(20) NOT NULL, password VARCHAR(64) NOT NULL, credits INT NOT NULL, is_active TINYINT(1) NOT NULL, creation_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D6496B01BC5B (phone_number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE space_additional_service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creamio_log (id INT AUTO_INCREMENT NOT NULL, message LONGTEXT NOT NULL, level VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, context LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', level_name VARCHAR(255) NOT NULL, extra LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE space_order ADD CONSTRAINT FK_F82F8FDC4AD9556B FOREIGN KEY (spaceship_id) REFERENCES space_ship (id)');
        $this->addSql('ALTER TABLE space_order ADD CONSTRAINT FK_F82F8FDCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE order_additional_service ADD CONSTRAINT FK_1CBAA2108D9F6D38 FOREIGN KEY (order_id) REFERENCES space_order (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_additional_service ADD CONSTRAINT FK_1CBAA210F8E98E09 FOREIGN KEY (additional_service_id) REFERENCES space_additional_service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE space_order DROP FOREIGN KEY FK_F82F8FDC4AD9556B');
        $this->addSql('ALTER TABLE order_additional_service DROP FOREIGN KEY FK_1CBAA2108D9F6D38');
        $this->addSql('ALTER TABLE space_order DROP FOREIGN KEY FK_F82F8FDCA76ED395');
        $this->addSql('ALTER TABLE order_additional_service DROP FOREIGN KEY FK_1CBAA210F8E98E09');
        $this->addSql('DROP TABLE space_ship');
        $this->addSql('DROP TABLE space_parking');
        $this->addSql('DROP TABLE space_order');
        $this->addSql('DROP TABLE order_additional_service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE space_additional_service');
        $this->addSql('DROP TABLE creamio_log');
    }
}
