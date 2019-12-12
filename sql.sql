--
-- Structure de la table `wp_likes`
--
CREATE TABLE IF NOT EXISTS `wp_likes`(
  `likes_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `likes_post_ID` bigint(20) NOT NULL,
  `likes_author` varchar(100) NOT NULL,
  `likes_author_email` varchar(100) NOT NULL,
  `likes_author_url` varchar(100) NOT NULL,
  `likes_count` bigint(20),
  `user_id`  bigint(20) NOT NULL,
  PRIMARY KEY (`likes_ID`),
  KEY `fk_likepost_id` (`likes_post_ID`)
)

INSERT INTO `wp_likes` (`likes_ID`, `likes_post_ID`, `likes_author`, `likes_author_email`, `likes_author_url`, `likes_count`, `user_id`) VALUES ('31', '31', 'Youssef Mhamdi', 'sdfsdgfsfg@gmail.com', 'http://localhost/phpmyadmin/tbl_change.php?db=test&table=wp_likes', '10', '1');
/**
*	
*	Reset likes_ID 

*/
SET @num := 0;
UPDATE wp_likes SET likes_ID = @num := (@num+1);
ALTER TABLE wp_likes AUTO_INCREMENT = 1;