<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180612205247 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sites_periods (sites_id INT NOT NULL, periods_id INT NOT NULL, INDEX IDX_7BD7B7B27838E496 (sites_id), INDEX IDX_7BD7B7B286F6C98C (periods_id), PRIMARY KEY(sites_id, periods_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sites_eras (sites_id INT NOT NULL, eras_id INT NOT NULL, INDEX IDX_26327B207838E496 (sites_id), INDEX IDX_26327B2046D05D5B (eras_id), PRIMARY KEY(sites_id, eras_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sites_periods ADD CONSTRAINT FK_7BD7B7B27838E496 FOREIGN KEY (sites_id) REFERENCES sites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sites_periods ADD CONSTRAINT FK_7BD7B7B286F6C98C FOREIGN KEY (periods_id) REFERENCES periods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sites_eras ADD CONSTRAINT FK_26327B207838E496 FOREIGN KEY (sites_id) REFERENCES sites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sites_eras ADD CONSTRAINT FK_26327B2046D05D5B FOREIGN KEY (eras_id) REFERENCES eras (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sites_periods');
        $this->addSql('DROP TABLE sites_eras');
    }
}
