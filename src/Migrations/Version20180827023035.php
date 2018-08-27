<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180827023035 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE job (job_id INT AUTO_INCREMENT NOT NULL, service_id INT NOT NULL, title VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, execution_date DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, id_user INT NOT NULL, INDEX IDX_FBD8E0F8ED5CA9E6 (service_id), PRIMARY KEY(job_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (service_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F8ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (service_id)');

        $this->addSql('INSERT INTO service (service_id, name, created_at) VALUES (804040 , "Sonstige Umzugsleistungen", NOW())');
        $this->addSql('INSERT INTO service (service_id, name, created_at) VALUES (802030 , "Abtransport, Entsorgung und Entrumpelung", NOW())');
        $this->addSql('INSERT INTO service (service_id, name, created_at) VALUES (411070 , "Fensterreinigung", NOW())');
        $this->addSql('INSERT INTO service (service_id, name, created_at) VALUES (402020 , "Holzdielen schleifen", NOW())');
        $this->addSql('INSERT INTO service (service_id, name, created_at) VALUES (108140 , "Kellersanierung", NOW())');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F8ED5CA9E6');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE service');
    }
}
