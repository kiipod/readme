<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241121065641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE chats_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hashtags_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_hashtags_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_likes_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE posts_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reposts_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscribers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_posts_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chats (id INT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2D68180FF624B39D ON chats (sender_id)');
        $this->addSql('CREATE INDEX IDX_2D68180FE92F8F78 ON chats (recipient_id)');
        $this->addSql('CREATE TABLE comments (id INT NOT NULL, post_id INT NOT NULL, commentator_id INT DEFAULT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F9E962A4B89032C ON comments (post_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A506AFCC0 ON comments (commentator_id)');
        $this->addSql('CREATE TABLE hashtags (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post_hashtags (id INT NOT NULL, post_id INT DEFAULT NULL, hashtag_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9E0CA24E4B89032C ON post_hashtags (post_id)');
        $this->addSql('CREATE INDEX IDX_9E0CA24EFB34EF56 ON post_hashtags (hashtag_id)');
        $this->addSql('CREATE TABLE post_likes (id INT NOT NULL, post_id INT DEFAULT NULL, like_user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DED1C2924B89032C ON post_likes (post_id)');
        $this->addSql('CREATE INDEX IDX_DED1C292F4E399B6 ON post_likes (like_user_id)');
        $this->addSql('CREATE TABLE posts (id INT NOT NULL, creator_id INT DEFAULT NULL, type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, text TEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, video_link VARCHAR(255) DEFAULT NULL, author_quote VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, view_stats BIGINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_885DBAFA61220EA6 ON posts (creator_id)');
        $this->addSql('CREATE INDEX IDX_885DBAFAC54C8C93 ON posts (type_id)');
        $this->addSql('CREATE TABLE reposts (id INT NOT NULL, post_id INT DEFAULT NULL, repost_user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F0DDCD724B89032C ON reposts (post_id)');
        $this->addSql('CREATE INDEX IDX_F0DDCD722835C5AB ON reposts (repost_user_id)');
        $this->addSql('CREATE TABLE subscribers (id INT NOT NULL, subscriber_id INT NOT NULL, subscribed_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FCD16AC7808B1AD ON subscribers (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_2FCD16ACD7AB9EE ON subscribers (subscribed_id)');
        $this->addSql('CREATE TABLE type_posts (id INT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, avatar_file VARCHAR(255) DEFAULT NULL, roles JSON DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180FF624B39D FOREIGN KEY (sender_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chats ADD CONSTRAINT FK_2D68180FE92F8F78 FOREIGN KEY (recipient_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A506AFCC0 FOREIGN KEY (commentator_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_hashtags ADD CONSTRAINT FK_9E0CA24E4B89032C FOREIGN KEY (post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_hashtags ADD CONSTRAINT FK_9E0CA24EFB34EF56 FOREIGN KEY (hashtag_id) REFERENCES hashtags (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT FK_DED1C2924B89032C FOREIGN KEY (post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_likes ADD CONSTRAINT FK_DED1C292F4E399B6 FOREIGN KEY (like_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFA61220EA6 FOREIGN KEY (creator_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAC54C8C93 FOREIGN KEY (type_id) REFERENCES type_posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reposts ADD CONSTRAINT FK_F0DDCD724B89032C FOREIGN KEY (post_id) REFERENCES posts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reposts ADD CONSTRAINT FK_F0DDCD722835C5AB FOREIGN KEY (repost_user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscribers ADD CONSTRAINT FK_2FCD16AC7808B1AD FOREIGN KEY (subscriber_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscribers ADD CONSTRAINT FK_2FCD16ACD7AB9EE FOREIGN KEY (subscribed_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE chats_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hashtags_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_hashtags_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_likes_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE posts_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reposts_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscribers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_posts_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180FF624B39D');
        $this->addSql('ALTER TABLE chats DROP CONSTRAINT FK_2D68180FE92F8F78');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A4B89032C');
        $this->addSql('ALTER TABLE comments DROP CONSTRAINT FK_5F9E962A506AFCC0');
        $this->addSql('ALTER TABLE post_hashtags DROP CONSTRAINT FK_9E0CA24E4B89032C');
        $this->addSql('ALTER TABLE post_hashtags DROP CONSTRAINT FK_9E0CA24EFB34EF56');
        $this->addSql('ALTER TABLE post_likes DROP CONSTRAINT FK_DED1C2924B89032C');
        $this->addSql('ALTER TABLE post_likes DROP CONSTRAINT FK_DED1C292F4E399B6');
        $this->addSql('ALTER TABLE posts DROP CONSTRAINT FK_885DBAFA61220EA6');
        $this->addSql('ALTER TABLE posts DROP CONSTRAINT FK_885DBAFAC54C8C93');
        $this->addSql('ALTER TABLE reposts DROP CONSTRAINT FK_F0DDCD724B89032C');
        $this->addSql('ALTER TABLE reposts DROP CONSTRAINT FK_F0DDCD722835C5AB');
        $this->addSql('ALTER TABLE subscribers DROP CONSTRAINT FK_2FCD16AC7808B1AD');
        $this->addSql('ALTER TABLE subscribers DROP CONSTRAINT FK_2FCD16ACD7AB9EE');
        $this->addSql('DROP TABLE chats');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE hashtags');
        $this->addSql('DROP TABLE post_hashtags');
        $this->addSql('DROP TABLE post_likes');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE reposts');
        $this->addSql('DROP TABLE subscribers');
        $this->addSql('DROP TABLE type_posts');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
