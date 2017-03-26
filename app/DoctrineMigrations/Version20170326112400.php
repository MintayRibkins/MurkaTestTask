<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170326112400 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE match_player (id INT AUTO_INCREMENT NOT NULL, match_id INT DEFAULT NULL, player_id INT DEFAULT NULL, INDEX IDX_397683642ABEACD6 (match_id), INDEX IDX_3976836499E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, rating_elo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competition (id INT AUTO_INCREMENT NOT NULL, winner_id INT DEFAULT NULL, start_time DATETIME NOT NULL, finish_time DATETIME NOT NULL, match_log LONGTEXT NOT NULL, INDEX IDX_B50A2CB15DFCD4B8 (winner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_player ADD CONSTRAINT FK_397683642ABEACD6 FOREIGN KEY (match_id) REFERENCES competition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE match_player ADD CONSTRAINT FK_3976836499E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competition ADD CONSTRAINT FK_B50A2CB15DFCD4B8 FOREIGN KEY (winner_id) REFERENCES player (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE match_player DROP FOREIGN KEY FK_3976836499E6F5DF');
        $this->addSql('ALTER TABLE competition DROP FOREIGN KEY FK_B50A2CB15DFCD4B8');
        $this->addSql('ALTER TABLE match_player DROP FOREIGN KEY FK_397683642ABEACD6');
        $this->addSql('DROP TABLE match_player');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE competition');
    }
}
