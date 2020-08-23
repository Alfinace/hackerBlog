<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200823134011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE languages CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE parcours ADD profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcours ADD CONSTRAINT FK_99B1DEE3CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profiles (id)');
        $this->addSql('CREATE INDEX IDX_99B1DEE3CCFA12B8 ON parcours (profile_id)');
        $this->addSql('ALTER TABLE experiences CHANGE periode periode VARCHAR(255) DEFAULT NULL COMMENT \'(DC2Type:dateinterval)\', CHANGE reference reference VARCHAR(255) DEFAULT NULL, CHANGE refer_contact refer_contact VARCHAR(13) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE profiles CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE contact contact VARCHAR(13) DEFAULT NULL, CHANGE cin cin INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE pins CHANGE user_id user_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE skills ADD profile_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profiles (id)');
        $this->addSql('CREATE INDEX IDX_D5311670CCFA12B8 ON skills (profile_id)');
        $this->addSql('ALTER TABLE likes CHANGE user_id user_id INT DEFAULT NULL, CHANGE pin_id pin_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE comments CHANGE user_id user_id INT DEFAULT NULL, CHANGE pin_id pin_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments CHANGE user_id user_id INT DEFAULT NULL, CHANGE pin_id pin_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE experiences CHANGE periode periode VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:dateinterval)\', CHANGE reference reference VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE refer_contact refer_contact VARCHAR(13) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE languages CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE likes CHANGE user_id user_id INT DEFAULT NULL, CHANGE pin_id pin_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE parcours DROP FOREIGN KEY FK_99B1DEE3CCFA12B8');
        $this->addSql('DROP INDEX IDX_99B1DEE3CCFA12B8 ON parcours');
        $this->addSql('ALTER TABLE parcours DROP profile_id');
        $this->addSql('ALTER TABLE pins CHANGE user_id user_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE profiles CHANGE lastname lastname VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE contact contact VARCHAR(13) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE cin cin INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670CCFA12B8');
        $this->addSql('DROP INDEX IDX_D5311670CCFA12B8 ON skills');
        $this->addSql('ALTER TABLE skills DROP profile_id, CHANGE created_at created_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
