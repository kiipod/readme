<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119141919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hashtag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_hashtag_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE post_like_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE repost_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE subscriber_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_post_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
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
        $this->addSql('CREATE TABLE posts (id INT NOT NULL, creator_id INT DEFAULT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, text TEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, video_link VARCHAR(255) DEFAULT NULL, author_quote VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, view_stats BIGINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_885DBAFA61220EA6 ON posts (creator_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFAC54C8C93 ON posts (type_id)');
        $this->addSql('CREATE TABLE reposts (id INT NOT NULL, post_id INT DEFAULT NULL, repost_user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F0DDCD724B89032C ON reposts (post_id)');
        $this->addSql('CREATE INDEX IDX_F0DDCD722835C5AB ON reposts (repost_user_id)');
        $this->addSql('CREATE TABLE subscribers (id INT NOT NULL, subscriber_id INT NOT NULL, subscribed_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FCD16AC7808B1AD ON subscribers (subscriber_id)');
        $this->addSql('CREATE INDEX IDX_2FCD16ACD7AB9EE ON subscribers (subscribed_id)');
        $this->addSql('CREATE TABLE type_posts (id INT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, email VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, avatar_file VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
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
        $this->addSql('ALTER TABLE repost DROP CONSTRAINT fk_dd3446c54b89032c');
        $this->addSql('ALTER TABLE repost DROP CONSTRAINT fk_dd3446c52835c5ab');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT fk_b6bd307ff624b39d');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT fk_b6bd307fe92f8f78');
        $this->addSql('ALTER TABLE post_like DROP CONSTRAINT fk_653627b84b89032c');
        $this->addSql('ALTER TABLE post_like DROP CONSTRAINT fk_653627b8f4e399b6');
        $this->addSql('ALTER TABLE subscriber DROP CONSTRAINT fk_ad005b697808b1ad');
        $this->addSql('ALTER TABLE subscriber DROP CONSTRAINT fk_ad005b69d7ab9ee');
        $this->addSql('ALTER TABLE post_hashtag DROP CONSTRAINT fk_675d9d524b89032c');
        $this->addSql('ALTER TABLE post_hashtag DROP CONSTRAINT fk_675d9d52fb34ef56');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT fk_5a8a6c8d61220ea6');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT fk_5a8a6c8dc54c8c93');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c4b89032c');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c506afcc0');
        $this->addSql('DROP TABLE repost');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE post_like');
        $this->addSql('DROP TABLE subscriber');
        $this->addSql('DROP TABLE hashtag');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE post_hashtag');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE type_post');
        $this->addSql('DROP TABLE comment');
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
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hashtag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_hashtag_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE post_like_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE repost_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE subscriber_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE repost (id INT NOT NULL, post_id INT DEFAULT NULL, repost_user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_dd3446c52835c5ab ON repost (repost_user_id)');
        $this->addSql('CREATE INDEX idx_dd3446c54b89032c ON repost (post_id)');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_b6bd307fe92f8f78 ON message (recipient_id)');
        $this->addSql('CREATE INDEX idx_b6bd307ff624b39d ON message (sender_id)');
        $this->addSql('CREATE TABLE post_like (id INT NOT NULL, post_id INT DEFAULT NULL, like_user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_653627b8f4e399b6 ON post_like (like_user_id)');
        $this->addSql('CREATE INDEX idx_653627b84b89032c ON post_like (post_id)');
        $this->addSql('CREATE TABLE subscriber (id INT NOT NULL, subscriber_id INT NOT NULL, subscribed_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ad005b69d7ab9ee ON subscriber (subscribed_id)');
        $this->addSql('CREATE INDEX idx_ad005b697808b1ad ON subscriber (subscriber_id)');
        $this->addSql('CREATE TABLE hashtag (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, avatar_file VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE post_hashtag (id INT NOT NULL, post_id INT DEFAULT NULL, hashtag_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_675d9d52fb34ef56 ON post_hashtag (hashtag_id)');
        $this->addSql('CREATE INDEX idx_675d9d524b89032c ON post_hashtag (post_id)');
        $this->addSql('CREATE TABLE post (id INT NOT NULL, creator_id INT DEFAULT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, text TEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, video_link VARCHAR(255) DEFAULT NULL, author_quote VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, view_stats BIGINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_5a8a6c8dc54c8c93 ON post (type_id)');
        $this->addSql('CREATE INDEX idx_5a8a6c8d61220ea6 ON post (creator_id)');
        $this->addSql('CREATE TABLE type_post (id INT NOT NULL, name VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, post_id INT NOT NULL, commentator_id INT DEFAULT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9474526c506afcc0 ON comment (commentator_id)');
        $this->addSql('CREATE INDEX idx_9474526c4b89032c ON comment (post_id)');
        $this->addSql('ALTER TABLE repost ADD CONSTRAINT fk_dd3446c54b89032c FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE repost ADD CONSTRAINT fk_dd3446c52835c5ab FOREIGN KEY (repost_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT fk_b6bd307ff624b39d FOREIGN KEY (sender_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT fk_b6bd307fe92f8f78 FOREIGN KEY (recipient_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_like ADD CONSTRAINT fk_653627b84b89032c FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_like ADD CONSTRAINT fk_653627b8f4e399b6 FOREIGN KEY (like_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT fk_ad005b697808b1ad FOREIGN KEY (subscriber_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT fk_ad005b69d7ab9ee FOREIGN KEY (subscribed_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_hashtag ADD CONSTRAINT fk_675d9d524b89032c FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_hashtag ADD CONSTRAINT fk_675d9d52fb34ef56 FOREIGN KEY (hashtag_id) REFERENCES hashtag (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8d61220ea6 FOREIGN KEY (creator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8dc54c8c93 FOREIGN KEY (type_id) REFERENCES type_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c4b89032c FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c506afcc0 FOREIGN KEY (commentator_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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
    }
}
