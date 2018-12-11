<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210105839 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', status_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', type_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', creator_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, event_date DATETIME DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, number_of_players INT NOT NULL, INDEX IDX_B50A2CB1881ECFA7 (status_id_id), INDEX IDX_B50A2CB1714819A0 (type_id_id), INDEX IDX_B50A2CB1F05788E9 (creator_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition_user (competition_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_83D0485B7B39D312 (competition_id), INDEX IDX_83D0485BA76ED395 (user_id), PRIMARY KEY(competition_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition_tag (competition_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', tag_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_9B9F978B7B39D312 (competition_id), INDEX IDX_9B9F978BBAD26311 (tag_id), PRIMARY KEY(competition_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competitor (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', competition_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_id_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, INDEX IDX_E0D53BAA8CF3AC81 (competition_id_id), INDEX IDX_E0D53BAA9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encounter (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', competition_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, INDEX IDX_69D229CA8CF3AC81 (competition_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', encounter_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', competitor_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', score INT NOT NULL, INDEX IDX_32993751428583D1 (encounter_id_id), INDEX IDX_32993751236250DF (competitor_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', role_id_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D64988987678 (role_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1881ECFA7 FOREIGN KEY (status_id_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1714819A0 FOREIGN KEY (type_id_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB1F05788E9 FOREIGN KEY (creator_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE competition_user ADD CONSTRAINT FK_83D0485B7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_user ADD CONSTRAINT FK_83D0485BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_tag ADD CONSTRAINT FK_9B9F978B7B39D312 FOREIGN KEY (competition_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition_tag ADD CONSTRAINT FK_9B9F978BBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competitor ADD CONSTRAINT FK_E0D53BAA8CF3AC81 FOREIGN KEY (competition_id_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE competitor ADD CONSTRAINT FK_E0D53BAA9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE encounter ADD CONSTRAINT FK_69D229CA8CF3AC81 FOREIGN KEY (competition_id_id) REFERENCES competition (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751428583D1 FOREIGN KEY (encounter_id_id) REFERENCES encounter (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751236250DF FOREIGN KEY (competitor_id_id) REFERENCES competitor (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64988987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE competition_user DROP FOREIGN KEY FK_83D0485B7B39D312');
        $this->addSql('ALTER TABLE competition_tag DROP FOREIGN KEY FK_9B9F978B7B39D312');
        $this->addSql('ALTER TABLE competitor DROP FOREIGN KEY FK_E0D53BAA8CF3AC81');
        $this->addSql('ALTER TABLE encounter DROP FOREIGN KEY FK_69D229CA8CF3AC81');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751236250DF');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751428583D1');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64988987678');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1881ECFA7');
        $this->addSql('ALTER TABLE competition_tag DROP FOREIGN KEY FK_9B9F978BBAD26311');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1714819A0');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB1F05788E9');
        $this->addSql('ALTER TABLE competition_user DROP FOREIGN KEY FK_83D0485BA76ED395');
        $this->addSql('ALTER TABLE competitor DROP FOREIGN KEY FK_E0D53BAA9D86650F');
        $this->addSql('DROP TABLE competition');
        $this->addSql('DROP TABLE competition_user');
        $this->addSql('DROP TABLE competition_tag');
        $this->addSql('DROP TABLE competitor');
        $this->addSql('DROP TABLE encounter');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
    }
}
