<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240926070137 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE burger_oignon DROP FOREIGN KEY FK_A40C5A0417CE5090');
        $this->addSql('ALTER TABLE burger_oignon DROP FOREIGN KEY FK_A40C5A048F038184');
        $this->addSql('ALTER TABLE oignon_burger DROP FOREIGN KEY FK_E8CA36048F038184');
        $this->addSql('ALTER TABLE oignon_burger DROP FOREIGN KEY FK_E8CA360417CE5090');
        $this->addSql('DROP TABLE burger_oignon');
        $this->addSql('DROP TABLE oignon_burger');
        $this->addSql('ALTER TABLE burger ADD oignon_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D8F038184 FOREIGN KEY (oignon_id) REFERENCES oignon (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D8F038184 ON burger (oignon_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE burger_oignon (burger_id INT NOT NULL, oignon_id INT NOT NULL, INDEX IDX_A40C5A0417CE5090 (burger_id), INDEX IDX_A40C5A048F038184 (oignon_id), PRIMARY KEY(burger_id, oignon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE oignon_burger (oignon_id INT NOT NULL, burger_id INT NOT NULL, INDEX IDX_E8CA36048F038184 (oignon_id), INDEX IDX_E8CA360417CE5090 (burger_id), PRIMARY KEY(oignon_id, burger_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE burger_oignon ADD CONSTRAINT FK_A40C5A0417CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger_oignon ADD CONSTRAINT FK_A40C5A048F038184 FOREIGN KEY (oignon_id) REFERENCES oignon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oignon_burger ADD CONSTRAINT FK_E8CA36048F038184 FOREIGN KEY (oignon_id) REFERENCES oignon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oignon_burger ADD CONSTRAINT FK_E8CA360417CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D8F038184');
        $this->addSql('DROP INDEX IDX_EFE35A0D8F038184 ON burger');
        $this->addSql('ALTER TABLE burger DROP oignon_id');
    }
}
