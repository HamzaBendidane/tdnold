CREATE TABLE DocumentRubrique (id_rubrique INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, abstract LONGTEXT NOT NULL, bord_inferieur INT NOT NULL, bord_superieur INT NOT NULL, couleur VARCHAR(255) NOT NULL, image_sponsor VARCHAR(255) NOT NULL, link_sponsor VARCHAR(255) NOT NULL, PRIMARY KEY(id_rubrique)) ENGINE = InnoDB;

CREATE TABLE Quiz (id_quiz INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, abstract LONGTEXT NOT NULL, rubrique INT NOT NULL, nombreProfils INT NOT NULL, createdAt DATETIME NOT NULL, published TINYINT(1) NOT NULL, PRIMARY KEY(id_quiz)) ENGINE = InnoDB;

CREATE TABLE QuestionQuiz (id_question INT AUTO_INCREMENT NOT NULL, in_quiz INT DEFAULT NULL, question LONGTEXT NOT NULL, reponses LONGTEXT NOT NULL, INDEX IDX_616E76D68EA9C5F6 (in_quiz), PRIMARY KEY(id_question)) ENGINE = InnoDB;

CREATE TABLE Article (id_article INT AUTO_INCREMENT NOT NULL, type_document INT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, abstract LONGTEXT NOT NULL, corps LONGTEXT NOT NULL, id_auteur INT NOT NULL, likes INT NOT NULL, hits INT NOT NULL, tags LONGTEXT NOT NULL, sponsor TINYINT(1) NOT NULL, statut INT NOT NULL, date_publication DATETIME NOT NULL, date_modification DATETIME NOT NULL, PRIMARY KEY(id_article)) ENGINE = InnoDB;

CREATE TABLE theme (for_document INT NOT NULL, for_type INT NOT NULL, for_rubrique INT NOT NULL, INDEX IDX_9775E7089D8AE3645F6B36BC (for_document, for_type), INDEX IDX_9775E708CA47606E (for_rubrique), PRIMARY KEY(for_document, for_type, for_rubrique)) ENGINE = InnoDB;
ALTER TABLE QuestionQuiz ADD CONSTRAINT FK_616E76D68EA9C5F6 FOREIGN KEY (in_quiz) REFERENCES Quiz(id_quiz);
ALTER TABLE theme ADD CONSTRAINT FK_9775E7089D8AE3645F6B36BC FOREIGN KEY (for_document, for_type) REFERENCES Article(id_article, type_document);
ALTER TABLE theme ADD CONSTRAINT FK_9775E708CA47606E FOREIGN KEY (for_rubrique) REFERENCES DocumentRubrique(id_rubrique)
