<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206124006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_vente ADD id_produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_vente ADD CONSTRAINT FK_F57AE115AABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_F57AE115AABEFE2C ON detail_vente (id_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_vente DROP FOREIGN KEY FK_F57AE115AABEFE2C');
        $this->addSql('DROP INDEX IDX_F57AE115AABEFE2C ON detail_vente');
        $this->addSql('ALTER TABLE detail_vente DROP id_produit_id');
    }
}
