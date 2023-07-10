<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629134549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_greenhouse (booking_id INT NOT NULL, greenhouse_id INT NOT NULL, INDEX IDX_45F2926A3301C60 (booking_id), INDEX IDX_45F2926A38FCB0EB (greenhouse_id), PRIMARY KEY(booking_id, greenhouse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_booking (user_id INT NOT NULL, booking_id INT NOT NULL, INDEX IDX_B801F3D4A76ED395 (user_id), INDEX IDX_B801F3D43301C60 (booking_id), PRIMARY KEY(user_id, booking_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_greenhouse ADD CONSTRAINT FK_45F2926A3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_greenhouse ADD CONSTRAINT FK_45F2926A38FCB0EB FOREIGN KEY (greenhouse_id) REFERENCES greenhouse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_booking ADD CONSTRAINT FK_B801F3D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_booking ADD CONSTRAINT FK_B801F3D43301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking_greenhouse DROP FOREIGN KEY FK_45F2926A3301C60');
        $this->addSql('ALTER TABLE booking_greenhouse DROP FOREIGN KEY FK_45F2926A38FCB0EB');
        $this->addSql('ALTER TABLE user_booking DROP FOREIGN KEY FK_B801F3D4A76ED395');
        $this->addSql('ALTER TABLE user_booking DROP FOREIGN KEY FK_B801F3D43301C60');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_greenhouse');
        $this->addSql('DROP TABLE user_booking');
    }
}
