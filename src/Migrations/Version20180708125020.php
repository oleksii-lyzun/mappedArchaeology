<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180708125020 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books ADD authors VARCHAR(255) NOT NULL, ADD is_active TINYINT(1) NOT NULL, ADD annotation VARCHAR(500) NOT NULL, ADD link VARCHAR(255) NOT NULL, DROP author_last_name, DROP author_first_name, CHANGE published_house publisher VARCHAR(75) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE books ADD author_last_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD author_first_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP authors, DROP is_active, DROP annotation, DROP link, CHANGE publisher published_house VARCHAR(75) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
