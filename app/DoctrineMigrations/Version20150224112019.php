<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150224112019 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA157BD9C4B2E');
        $this->addSql('DROP TABLE componentAlternative');
        $this->addSql('DROP INDEX IDX_49FEA157BD9C4B2E ON component');
        $this->addSql('ALTER TABLE component ADD alternativeNumber INT NOT NULL, DROP componentAlternative_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE componentAlternative (id INT AUTO_INCREMENT NOT NULL, alternativeNumber INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component ADD componentAlternative_id INT DEFAULT NULL, DROP alternativeNumber');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA157BD9C4B2E FOREIGN KEY (componentAlternative_id) REFERENCES componentAlternative (id)');
        $this->addSql('CREATE INDEX IDX_49FEA157BD9C4B2E ON component (componentAlternative_id)');
    }
}
