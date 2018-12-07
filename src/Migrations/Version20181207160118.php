<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181207160118 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', status_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', type_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, event_date DATETIME DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_B50A2CB1881ECFA7 (status_id_id), INDEX IDX_B50A2CB1714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition_user (competition_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_83D0485B7B39D312 (competition_id), INDEX IDX_83D0485BA76ED395 (user_id), PRIMARY KEY(competition_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition_tag (competition_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', tag_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_9B9F978B7B39D312 (competition_id), INDEX IDX_9B9F978BBAD26311 (tag_id), PRIMARY KEY(competition_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competitor (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', competition_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_E0D53BAA9D86650F (user_id_id), INDEX IDX_E0D53BAA8CF3AC81 (competition_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competitor_encounter (competitor_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', encounter_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_7B0D92AF78A5D405 (competitor_id), INDEX IDX_7B0D92AFD6E2FADC (encounter_id), PRIMARY KEY(competitor_id, encounter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encounter (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', competition_id_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', score1 INT DEFAULT NULL, score2 INT DEFAULT NULL, date DATETIME DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, INDEX IDX_69D229CA8CF3AC81 (competition_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', password VARCHAR(255) NOT NULL, salt VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', role_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1881ECFA7 FOREIGN KEY (status_id_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE competition_user ADD CONSTRAINT FK_83D0485B7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_user ADD CONSTRAINT FK_83D0485BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_tag ADD CONSTRAINT FK_9B9F978B7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_tag ADD CONSTRAINT FK_9B9F978BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competitor ADD CONSTRAINT FK_E0D53BAA9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE competitor ADD CONSTRAINT FK_E0D53BAA8CF3AC81 FOREIGN KEY (competition_id_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE competitor_encounter ADD CONSTRAINT FK_7B0D92AF78A5D405 FOREIGN KEY (competitor_id) REFERENCES competitor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competitor_encounter ADD CONSTRAINT FK_7B0D92AFD6E2FADC FOREIGN KEY (encounter_id) REFERENCES encounter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE encounter ADD CONSTRAINT FK_69D229CA8CF3AC81 FOREIGN KEY (competition_id_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition_user DROP FOREIGN KEY FK_83D0485B7B39D312');
        $this->addSql('ALTER TABLE competition_tag DROP FOREIGN KEY FK_9B9F978B7B39D312');
        $this->addSql('ALTER TABLE competitor DROP FOREIGN KEY FK_E0D53BAA8CF3AC81');
        $this->addSql('ALTER TABLE encounter DROP FOREIGN KEY FK_69D229CA8CF3AC81');
        $this->addSql('ALTER TABLE competitor_encounter DROP FOREIGN KEY FK_7B0D92AF78A5D405');
        $this->addSql('ALTER TABLE competitor_encounter DROP FOREIGN KEY FK_7B0D92AFD6E2FADC');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1881ECFA7');
        $this->addSql('ALTER TABLE competition_tag DROP FOREIGN KEY FK_9B9F978BBAD26311');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1714819A0');
        $this->addSql('ALTER TABLE competition_user DROP FOREIGN KEY FK_83D0485BA76ED395');
        $this->addSql('ALTER TABLE competitor DROP FOREIGN KEY FK_E0D53BAA9D86650F');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE competition_user');
        $this->addSql('DROP TABLE competition_tag');
        $this->addSql('DROP TABLE competitor');
        $this->addSql('DROP TABLE competitor_encounter');
        $this->addSql('DROP TABLE encounter');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_role');
    }
}
