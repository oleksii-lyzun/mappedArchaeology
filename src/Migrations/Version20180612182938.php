<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180612182938 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cultures_periods (cultures_id INT NOT NULL, periods_id INT NOT NULL, INDEX IDX_87B69555697E5AF8 (cultures_id), INDEX IDX_87B6955586F6C98C (periods_id), PRIMARY KEY(cultures_id, periods_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cultures_periods ADD CONSTRAINT FK_87B69555697E5AF8 FOREIGN KEY (cultures_id) REFERENCES cultures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cultures_periods ADD CONSTRAINT FK_87B6955586F6C98C FOREIGN KEY (periods_id) REFERENCES periods (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE periods ADD era_id INT NOT NULL');
        $this->addSql('ALTER TABLE periods ADD CONSTRAINT FK_671798A2707300A1 FOREIGN KEY (era_id) REFERENCES eras (id)');
        $this->addSql('CREATE INDEX IDX_671798A2707300A1 ON periods (era_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cultures_periods');
        $this->addSql('ALTER TABLE periods DROP FOREIGN KEY FK_671798A2707300A1');
        $this->addSql('DROP INDEX IDX_671798A2707300A1 ON periods');
        $this->addSql('ALTER TABLE periods DROP era_id');
    }
}
