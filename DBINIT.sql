
DROP DATABASE IF EXISTS library_db;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `library_db` ;
USE `library_db` ;

-- -----------------------------------------------------
-- Table `library_db`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`member` (
  `memberID` INT NOT NULL AUTO_INCREMENT,
  `Mfirst` VARCHAR(45) NULL,
  `Mlast` VARCHAR(45) NOT NULL,
  `Street` VARCHAR(45) NOT NULL,
  `number` VARCHAR(10) NOT NULL,
  `postalCode` VARCHAR(10) NOT NULL,
  `Mbirthdate` DATE NOT NULL,
  PRIMARY KEY (`memberID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`publisher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`publisher` (
  `pubName` VARCHAR(45) NOT NULL,
  `estYear` INT NULL,
  `street` VARCHAR(45) NOT NULL,
  `number` VARCHAR(10) NOT NULL,
  `postalCode` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`pubName`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`book`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`book` (
  `ISBN` CHAR(13) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `pubYear` INT NULL,
  `numpages` INT NULL,
  `pubName` VARCHAR(45) NULL,
  PRIMARY KEY (`ISBN`),
  CONSTRAINT `pubNameBook`
    FOREIGN KEY (`pubName`)
    REFERENCES `library_db`.`publisher` (`pubName`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`author`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`author` (
  `authID` INT NOT NULL AUTO_INCREMENT,
  `AFirst` VARCHAR(45) NULL,
  `ALast` VARCHAR(45) NOT NULL,
  `Abirthdate` DATE NULL,
  PRIMARY KEY (`authID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`copy`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`copy` (
  `ISBN` CHAR(13) NOT NULL,
  `copyNr` INT NOT NULL,
  `shelf` INT NOT NULL,
  PRIMARY KEY (`ISBN`, `copyNr`),
  CONSTRAINT `ISBNbOOK`
    FOREIGN KEY (`ISBN`)
    REFERENCES `library_db`.`book` (`ISBN`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`employee` (
  `empID` INT NOT NULL AUTO_INCREMENT,
  `EFirst` VARCHAR(45) NOT NULL,
  `ELast` VARCHAR(45) NOT NULL,
  `salary` INT NOT NULL,
  PRIMARY KEY (`empID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`permanent_employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`permanent_employee` (
  `empID` INT NOT NULL,
  `hiringDate` DATE NOT NULL,
  PRIMARY KEY (`empID`),
  CONSTRAINT `empIDPer`
    FOREIGN KEY (`empID`)
    REFERENCES `library_db`.`employee` (`empID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`borrows`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`borrows` (
  `memberID` INT NOT NULL,
  `ISBN` CHAR(13) NOT NULL,
  `copyNr` INT NOT NULL,
  `date_of_borrowing` DATE NOT NULL,
  `date_of_return` DATE NULL,
  PRIMARY KEY (`memberID`, `copyNr`, `ISBN`, `date_of_borrowing`),
  CONSTRAINT `memberIDBorrows`
    FOREIGN KEY (`memberID`)
    REFERENCES `library_db`.`member` (`memberID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ISBNBorrows`
    FOREIGN KEY (`ISBN`)
    REFERENCES `library_db`.`book` (`ISBN`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `(ISBN,copyNr)`
    FOREIGN KEY (`ISBN` , `copyNr`)
    REFERENCES `library_db`.`copy` (`ISBN` , `copyNr`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`category` (
  `categoryName` VARCHAR(45) NOT NULL,
  `supercategoryName` VARCHAR(45) NULL,
  PRIMARY KEY (`categoryName`),
  CONSTRAINT `supercategoryName`
    FOREIGN KEY (`supercategoryName`)
    REFERENCES `library_db`.`category` (`categoryName`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`belongs_to`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`belongs_to` (
  `ISBN` CHAR(13) NOT NULL,
  `categoryName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ISBN`, `categoryName`),
  CONSTRAINT `categoryNameBelongs`
    FOREIGN KEY (`categoryName`)
    REFERENCES `library_db`.`category` (`categoryName`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ISBNBelongs`
    FOREIGN KEY (`ISBN`)
    REFERENCES `library_db`.`book` (`ISBN`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`reminder`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`reminder` (
  `empID` INT NOT NULL,
  `memberID` INT NOT NULL,
  `ISBN` CHAR(13) NOT NULL,
  `copyNr` INT NOT NULL,
  `date_of_borrowing` DATE NOT NULL,
  `date_of_reminder` DATE NOT NULL,
  PRIMARY KEY (`empID`, `memberID`, `ISBN`, `copyNr`, `date_of_borrowing`, `date_of_reminder`),
  CONSTRAINT `empIDRem`
    FOREIGN KEY (`empID`)
    REFERENCES `library_db`.`employee` (`empID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `memberIDRem`
    FOREIGN KEY (`memberID`)
    REFERENCES `library_db`.`member` (`memberID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ISBNRem`
    FOREIGN KEY (`ISBN`)
    REFERENCES `library_db`.`book` (`ISBN`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `(ISBN,copyNr)Rem`
    FOREIGN KEY (`ISBN` , `copyNr`)
    REFERENCES `library_db`.`copy` (`ISBN` , `copyNr`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `borrowing`
    FOREIGN KEY (`memberID`, `copyNr`, `ISBN`, `date_of_borrowing`)
    REFERENCES `library_db`.`borrows` (`memberID`, `copyNr`, `ISBN`, `date_of_borrowing`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`written_by`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`written_by` (
  `ISBN` CHAR(13) NOT NULL,
  `authID` INT NOT NULL,
  PRIMARY KEY (`ISBN`, `authID`),
  CONSTRAINT `ISBNWr`
    FOREIGN KEY (`ISBN`)
    REFERENCES `library_db`.`book` (`ISBN`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `authIDWr`
    FOREIGN KEY (`authID`)
    REFERENCES `library_db`.`author` (`authID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library_db`.`temporary_employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library_db`.`temporary_employee` (
  `empID` INT NOT NULL,
  `contractNr` INT NOT NULL,
  PRIMARY KEY (`empID`),
  CONSTRAINT `empIDTemp`
    FOREIGN KEY (`empID`)
    REFERENCES `library_db`.`employee` (`empID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

USE `library_db` ;

/*Trigger 1: A member can't borrow more than 5 books or borrow while there is a late unreturned copy*/

DROP TRIGGER IF EXISTS book_bor;
DELIMITER $$
CREATE TRIGGER book_bor
BEFORE INSERT ON borrows
FOR EACH ROW
BEGIN
IF EXISTS (SELECT B.memberID, count(*)
           FROM borrows AS B
		   WHERE B.date_of_return IS NULL 
           GROUP BY B.memberID
           HAVING count(*) > 4 AND B.memberID = NEW.memberID)
OR EXISTS (SELECT B.memberID
           FROM borrows AS B
		   WHERE B.date_of_return IS NULL AND CURDATE() > DATE_ADD(B.date_of_borrowing,INTERVAL 30 DAY)
           AND B.memberID = NEW.memberID)
THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Too many unreturned copies or there is a late unreturned copy';
END IF;
END; $$
DELIMITER ;


/*Trigger 2:A borrowed book cannot be deleted*/
DROP TRIGGER IF EXISTS book_del;
DELIMITER $$
CREATE TRIGGER book_del
BEFORE DELETE ON book
FOR EACH ROW
BEGIN
IF EXISTS (SELECT * 
           FROM borrows AS B
           WHERE OLD.ISBN = B.ISBN AND B.date_of_return IS NULL)
THEN 
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cant do it';
END IF;
END; $$
DELIMITER ;

CREATE VIEW adult_members AS 
SELECT * 
FROM member 
WHERE DATEDIFF(CURDATE(),DATE_ADD(Mbirthdate, INTERVAL 18 YEAR) )>0;

CREATE VIEW popular_books AS 
SELECT B.title,B.ISBN, B.pubName,B.numpages, COUNT(*)
FROM book AS B, borrows AS BO
WHERE B.ISBN = BO.ISBN
GROUP BY B.ISBN
HAVING COUNT(*)>=3
ORDER BY COUNT(*);

/*Authors*/

INSERT INTO author (AFirst, ALast, Abirthdate) VALUES ('H.P.', 'Lovecraft','1890-08-20'),
 ('Albert', 'Camus','1913-11-07'),
 ('Stephen', 'King','1947-09-21'),
 ('Nikos', 'Kazantzakis','1883-02-18'),
 ('George', 'Orwell','1903-01-21'),
 ('Harper', 'Lee','1926-04-28'),
 ('J.R.R', 'Tolkien','1892-01-03'),
 ('J.K.', 'Rowling','1865-07-31'),
 ('Stephan', 'Zweig','1881-11-28'),
 ('Umberto', 'Eco','1932-01-05');

/*Categories*/



 INSERT INTO category VALUES('Fiction',NULL),
 ('Nonfiction',NULL),
 ('Adventure','Fiction'),
 ('Speculative','Fiction'),
 ('Biography','Nonfiction'),
 ('History','Nonfiction'),
 ('Poetry','Nonfiction'),
 ('Scientific','Nonfiction'),
 ('Epic','Adventure'),
 ('World','Adventure'),
 ('Novel','Fiction'),
 ('Fantasy','Fiction'),
 ('Horror','Fiction'),
 ('Mystery','Fiction'),
 ('Science','Fiction'),
 ('Academic','History'),
 ('Popular','History'),
 ('Ancient','Poetry'),
 ('Modern','Poetry'),
 ('Rhapsodies','Poetry');


/*Members*/

INSERT INTO member (MFirst, MLast,Street,Number,postalCode, Mbirthdate) VALUES 
('John', 'Lewis','Tithonou',11,'11854','1997-12-4'),
('Kostas', 'Antonopoulos','Ippothontidon',84,'22364','1993-11-3'),
('Evlavia', 'Mavridi','Markopoulou',2,'74854','1964-10-25'),
('Antonis', 'Antoniou','Gennimata',25,'75589','1984-2-25'),
('Nancy', 'Iannou','Armaou',122,'19965','2000-5-24'),
('Giogos', 'Azam','Aksimandrou',31,'12252','1977-12-4'),
('Jawad', 'Masa','Ermou',110,'13354','1989-1-24'),
('Manolis', 'Andreas','Kassiopis',5,'22566','1944-11-15'),
('Sven', 'Malafeev','Filippou',215,'11589','2002-12-4'),
('Elli', 'Markou','Thisseos',11,'11854','2009-12-4');


                
/*Employees*/

INSERT INTO employee (EFirst, ELast, salary) VALUES 
('Kostas', 'Giorgopoulos', 1000),
('Fani', 'Prokopi', 1000),
('Mionel', 'Lessi', 99),
('Jose', 'Segura', 7900),
('Ohi', 'Mark', 999),
('Aretha', 'Jones', 1000),
('Ognjen', 'Dubrovgniac', 340),
('George', 'Kapeletiotis', 3000),
('Fanis', 'Bekas', 1025),
('Dimitris', 'Mitropoulos', 1030),
('Maria', 'Eleniotou', 1000),
('Nektar', 'Cozy', 1000),
('Panagiotis', 'Kaloudis', 900),
('Vasilis', 'Trapalis', 1000),
('Ioanna', 'Konnou', 1000);

INSERT INTO temporary_employee VALUES (9, 27200),
 (10, 14545),
 (11, 33434),
 (12, 11634),
 (13, 34598),
 (14, 41928),
 (15, 44453);

INSERT INTO permanent_employee VALUES 
(1, '2016-12-22'),
(2, '2010-10-21'),
(3, '2010-03-19'),
(4, '2019-10-10'),
(5, '2010-10-20'),
(6, '2013-03-11'),
(7, '2016-01-10'),
(8, '2010-10-10');



/*Publisher*/
INSERT INTO publisher VALUES 
('Daskalos', 2000, 'Astydamantos', '31', '11364'),
('Psyxakias', 1950, 'Ermou', '666', '27200'),
('Papakis', 1973, 'Fylis', '42', '37307'),
('Saravalas', 1940, 'Oylof Palme', '62', '14253'),
('Ellinoekdotiki', 1952, 'Akadhmias', '225', '53663'),
('Alto', 1950, 'Ermou', '667', '27200'),
('Psyxoyla', 1750, 'Athinas', '3', '11634'),
('Kritis', 1950, 'Thessalias', '5', '45600');

/*Books*/

 INSERT INTO book VALUES('9781907776120','To Kill a Mockingbird',1960,128,'Kritis'),
 ('9781785150289','Go Set A Watchman',2015,320,'Kritis'),
 ('9780099541486','The Name Of The Rose',1983,528,'Psyxoyla'),
 ('9781611456899','Belief or Nonbelief?',2000,128,'Psyxoyla'),
 ('9781782690221','The Story of the Betrothed',2017,104,'Psyxoyla'),
 ('9780847841219','The Book of Legendary Lands',2013,432,'Psyxoyla'),
 ('9780547577531','The Prague Cemetery',2010,437,'Ellinoekdotiki'),
 ('9780544635081','Numero Zero',2015,192,'Ellinoekdotiki'),
 ('9780099481379','Baudolino',2000, 230, 'Kritis'),
 ('9780545010221','Harry Potter and the Deathly Hallows',2007, 607, 'Saravalas'),
 ('9781408855690','Harry Potter and the Order of the Phoenix',2003, 626, 'Ellinoekdotiki'),
 ('9780141187945','The Fall', 1985,90, 'Alto'),
 ('9781681771359','The Stranger', 1984,144, 'Alto'),
 ('9781444720723','The Shining', 1977,512, 'Kritis'),
 ('9781473666948','It', 1986,1184, 'Saravalas'),
 ('9781444720716','Misery',1987, 550, 'Ellinoekdotiki'),
 ('9781784755287','The Bazaar of Bad Dreams',2014, 1000, 'Daskalos'),
 ('9780571241705','Zorba the Greek', 2008,352, 'Psyxakias'),
 ('9780571178568','The Last Temptation',1952, 608, 'Kritis'),
 ('9789603824688','1984',1949, 344, 'Psyxakias'),
 ('9780141393056','Animal Farm',1945, 128, 'Psyxakias'),
 ('9781974998135','The Call of Cthulhu', 1928,420, 'Psyxakias'),
 ('9781785992735','H. P. Lovecrafts Tales of Terror',2017, 999, 'Daskalos'),
 ('9780261102149','The Book of Lost Tales Pt. 2', 1983,400, 'Psyxoyla');



/*Copies*/

/*Harper Lee*/
INSERT INTO copy VALUES
('9781444720716', 1, 99),
('9781444720716', 2, 99),
('9781444720716', 3, 99),
('9781444720716', 4, 99),
('9780847841219', 1, 115),
('9780847841219', 2, 115),
('9780847841219', 3, 115),
('9780847841219', 4, 115),
('9780847841219', 5, 115),
('9780261102149', 1, 110),
('9780261102149', 2, 110),
('9780261102149', 3, 110),
('9780261102149', 4, 110),
('9780544635081', 1, 110),
('9780544635081', 2, 110),
('9780544635081', 3, 110),
('9780544635081', 4, 110),
('9781907776120', 1, 110),
('9781907776120', 2, 110),
('9781907776120', 3, 110),
('9781907776120', 4, 110),
('9781785150289', 1, 110),
('9781785150289', 2, 110),
('9781785150289', 3, 110),
('9781785150289', 4, 110),
('9781785150289', 5, 110),
('9780099481379', 1, 115),
('9780099481379', 2, 115),
('9780099481379', 3, 115),
('9780099481379', 4, 115),
('9780099481379', 5, 115),
('9780099481379', 6, 115),
('9780099481379', 7, 115),
('9780099541486', 1, 115),
('9780099541486', 2, 115),
('9780099541486', 3, 115),
('9780099541486', 4, 115),
('9780099541486', 5, 115),
('9781611456899', 1, 115),
('9781611456899', 2, 115),
('9781782690221', 1, 20),
('9781782690221', 2, 20),
('9781782690221', 3, 20),
('9781782690221', 4, 20),
('9781782690221', 5, 20),
('9780547577531', 1, 22),
('9780547577531', 2, 22),
('9780547577531', 3, 22),
('9780547577531', 4, 22),
('9780547577531', 5, 22),
('9780545010221', 1, 80),
('9780545010221', 2, 80),
('9780545010221', 3, 80),
('9780545010221', 4, 80),
('9780545010221', 5, 80),
('9780545010221', 6, 80),
('9780545010221', 7, 80),
('9780545010221', 8, 80),
('9780545010221', 9, 80),
('9780545010221', 10, 80),
('9780545010221', 11, 80),
('9780545010221', 12, 80),
('9780545010221', 13, 80),
('9781408855690', 1, 81),
('9781408855690', 2, 81),
('9781408855690', 3, 81),
('9781408855690', 4, 81),
('9781408855690', 5, 81),
('9781408855690', 6, 81),
('9781408855690', 7, 81),
('9781408855690', 8, 81),
('9781408855690', 9, 81),
('9781408855690', 10, 81),
('9781408855690', 11, 81),
('9781408855690', 12, 81),
('9781408855690', 13, 81),
('9780141187945', 1, 24),
('9780141187945', 2, 24),
('9780141187945', 3, 24),
('9780141187945', 4, 24),
('9780141187945', 5, 24),
('9781681771359', 1, 25),
('9781681771359', 2, 25),
('9781444720723', 1, 25),
('9781444720723', 2, 25),
('9781473666948', 1, 26),
('9781473666948', 2, 26),
('9781473666948', 3, 26),
('9781473666948', 4, 26),
('9781473666948', 5, 26),
('9781473666948', 6, 26),
('9781473666948', 7, 26),
('9781473666948', 8, 26),
('9781473666948', 9, 26),
('9781473666948', 10, 26),
('9781473666948', 11, 26),
('9781473666948', 12, 26),
('9781473666948', 13, 26),
('9780571241705', 1, 31),
('9780571241705', 2, 31),
('9780571241705', 3, 31),
('9780571241705', 4, 31),
('9780571241705', 5, 31),
('9780571241705', 6, 31),
('9780571241705', 7, 31),
('9780571178568', 1, 31),
('9780571178568', 2, 31),
('9780571178568', 3, 31),
('9789603824688', 1, 35),
('9789603824688', 2, 35),
('9789603824688', 3, 35),
('9789603824688', 4, 35),
('9789603824688', 5, 35),
('9780141393056', 1, 35),
('9781974998135', 1, 43),
('9781974998135', 2, 43);




/*Belongs*/

INSERT INTO belongs_to VALUES 
('9781974998135', 'Horror'),
('9780545010221', 'Fantasy'),
('9780571241705', 'Nonfiction'),
('9780141187945', 'Fiction'),
('9781681771359', 'Fiction'),
('9781444720723', 'Horror'),
('9781473666948', 'Horror'),
('9789603824688', 'Science'),

('9780141393056', 'Fantasy'),
('9781408855690', 'Fantasy'),
('9780571178568', 'Nonfiction'),
('9781611456899', 'Nonfiction'),
('9781444720716', 'Horror'),
('9781784755287', 'Horror'),
('9781785992735', 'Horror'),
('9780261102149', 'Fantasy'),
('9780099481379','History'),
('9780544635081', 'Mystery'),
('9780547577531', 'History');




INSERT INTO written_by VALUES 
('9781974998135', 1),
('9780141187945', 2),
('9781681771359', 2),
('9781473666948', 3),
('9781444720723', 3),
('9781444720716', 3),
('9780571178568', 4),
('9780571241705', 4),
('9780141393056', 5),
('9789603824688', 5),
('9781907776120', 6),
('9781784755287', 6),
('9780261102149', 7),
('9780545010221', 8),
('9781408855690', 8),
('9781611456899', 10),
('9780099541486', 10),
('9780547577531', 10),
('9781782690221', 10),
('9780847841219', 10),
('9780544635081', 10),
('9781785992735',1),
('9781785150289',6);

INSERT INTO borrows VALUES 
(1,'9781907776120', 1,'2017-11-20','2017-12-30'),
(1,'9781785150289', 2,'2017-11-30','2017-12-20'),

(2,'9780099541486', 1,'2019-05-30',NULL), /*5 copies at the same time - cannot borrow*/
(2,'9780261102149', 1,'2019-05-29',NULL),
(2,'9780544635081', 1,'2019-05-25',NULL),
(2,'9780099541486', 2,'2019-05-25',NULL),
(2,'9780099541486', 3,'2019-05-11',NULL),

(3,'9780099481379', 1,'2017-8-15','2017-9-30'),
(3,'9780099481379', 2,'2017-8-15','2017-9-30'),

(5,'9780545010221', 2,'2018-9-15','2018-9-30'),
(5,'9781408855690', 3,'2018-5-12','2018-5-20'),
(5,'9780141187945', 1,'2018-9-15','2018-9-30'),
(5,'9781681771359', 1,'2018-9-15','2018-9-30'),
(5,'9780099541486', 2,'2019-05-30',NULL), /*5 copies at the same time - cannot borrow*/
(5,'9780261102149', 2,'2019-05-29',NULL),
(5,'9780544635081', 2,'2019-05-25',NULL),
(5,'9780544635081', 3,'2019-05-11',NULL), 
(5,'9780544635081', 4,'2019-05-11',NULL),

(6,'9780547577531', 1,'2014-5-24','2014-7-24'),
(6,'9780847841219', 1,'2016-6-24','2016-8-27'),
(6,'9780547577531', 2,'2017-5-24','2017-7-24'),
(6,'9780847841219', 1,'2011-5-2','2011-7-24'),
(6,'9781444720716', 1,'2011-5-2','2017-7-24'),
(6,'9780847841219', 2,'2019-5-11','2019-5-30'),
(6,'9780544635081', 2,'2019-4-11', NULL), /*1 late copy - now cannot borrow*/

(7,'9789603824688', 1,'2013-5-24','2013-7-24'),
(7,'9789603824688', 1,'2015-6-24','2015-7-24'),
(7,'9789603824688', 2,'2017-5-24','2017-7-24'),
(7,'9780141393056', 1,'2011-5-2','2011-7-24'),
(7,'9780571178568', 1,'2011-5-2','2017-7-24'),
(7,'9780099481379', 7,'2019-5-11','2019-5-30'),
(7,'9781974998135', 1,'2019-4-1',NULL), /*1 late copy - cannot borrow another 1*/

(8,'9781473666948', 5,'2019-5-24',NULL), /*4 copies at the same time - can borrow another 1*/
(8,'9780571241705', 5,'2019-5-24',NULL),
(8,'9780571178568', 1,'2019-5-24',NULL),
(8,'9780571178568', 2,'2019-5-24',NULL),
(8,'9780571178568', 1,'2017-5-24','2017-7-24');

INSERT INTO reminder VALUES
(1,1,'9781907776120', 1,'2017-11-20','2017-12-1'),
(1,1,'9781785150289', 2,'2017-11-30','2017-12-1'),
(3,8,'9781473666948', 5,'2019-5-24','2019-5-27'),
(3,8,'9780571241705', 5,'2019-5-24','2019-5-27'),
(3,8,'9780571178568', 1,'2019-5-24','2019-5-27'),
(5,7,'9780141393056', 1,'2011-5-2','2011-6-1'),
(5,7,'9780571178568', 1,'2011-5-2','2011-6-1'),
(10,7,'9780099481379', 7,'2019-5-11','2019-5-28');
