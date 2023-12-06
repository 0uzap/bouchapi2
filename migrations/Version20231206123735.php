<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206123735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_vente ADD id_vente_id INT NOT NULL');
        $this->addSql('ALTER TABLE detail_vente ADD CONSTRAINT FK_F57AE1152D1CFB9F FOREIGN KEY (id_vente_id) REFERENCES vente (id)');
        $this->addSql('CREATE INDEX IDX_F57AE1152D1CFB9F ON detail_vente (id_vente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_vente DROP FOREIGN KEY FK_F57AE1152D1CFB9F');
        $this->addSql('DROP INDEX IDX_F57AE1152D1CFB9F ON detail_vente');
        $this->addSql('ALTER TABLE detail_vente DROP id_vente_id');
    }
}
