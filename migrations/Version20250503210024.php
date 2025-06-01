<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250503210024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE categories (
            id INT AUTO_INCREMENT NOT NULL, 
            name VARCHAR(255) NOT NULL, 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );

        $this->addSql('CREATE TABLE items (
            id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, 
            price DOUBLE PRECISION NOT NULL, 
            date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', 
            user_id INT DEFAULT NULL,
            category_id INT NOT NULL, 
            CONSTRAINT FK_1F1B251EA76ED395 FOREIGN KEY (user_id) REFERENCES users (id),
            CONSTRAINT FK_1F1B251EA76ED396 FOREIGN KEY (category_id) REFERENCES categories (id),
            INDEX IDX_1F1B251EA76ED395 (user_id),
            INDEX IDX_1F1B251EA76ED396 (category_id),
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE items');
        $this->addSql('DROP TABLE categories');
    }
}
