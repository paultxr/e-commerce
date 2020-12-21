<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221101932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail ADD command_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_detail ADD CONSTRAINT FK_ED896F4633E1689A FOREIGN KEY (command_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_ED896F4633E1689A ON order_detail (command_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_detail DROP FOREIGN KEY FK_ED896F4633E1689A');
        $this->addSql('DROP INDEX IDX_ED896F4633E1689A ON order_detail');
        $this->addSql('ALTER TABLE order_detail DROP command_id');
    }
}
