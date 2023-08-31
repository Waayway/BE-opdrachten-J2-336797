-- ##################
-- Door: Thijs van Waaij
-- ##################
-- - Step 1; Create a new Database
DROP DATABASE IF EXISTS `be-p4`;

CREATE DATABASE IF NOT EXISTS `be-p4`;

-- * Use Database for inserting;
USE `be-p4-opdr-1`;

-- - Step 2: create new table typevoertuig.
DROP TABLE IF EXISTS typevoertuig;

CREATE TABLE IF NOT EXISTS typevoertuig (
    id                  TINYINT UNSIGNED    NOT NULL AUTO_INCREMENT,
    typevoertuig        VARCHAR(100)        NOT NULL,
    rijbewijscategorie  VARCHAR(3)          NOT NULL,

    CONSTRAINT          PK_typevoertuig_Id  PRIMARY KEY CLUSTERED(id)
) ENGINE=InnoDB;

-- - Step 3: Fill table Typevoertuig with data
INSERT INTO typevoertuig (
    typevoertuig,
    rijbewijscategorie
)
VALUES 
("Personenauto", "B" ),
("Vrachtwagen" , "C" ),
("Bus"         , "D" ),
("Bromfiets"   , "AM");

-- - Step 4: Create new table voertuig

DROP TABLE IF EXISTS voertuig;

CREATE TABLE IF NOT EXISTS voertuig (
    id              TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    kenteken        VARCHAR(8)          NOT NULL,
    type            VARCHAR(50)         NOT NULL,
    bouwjaar        DATE                NOT NULL,
    brandstof       VARCHAR(15)         NOT NULL,
    typevoertuigID  TINYINT UNSIGNED    NOT NULL,
    CONSTRAINT      PK_voertuig_Id      PRIMARY KEY CLUSTERED(id),
    CONSTRAINT      FK_typevoertuigID   FOREIGN KEY (typevoertuigID) REFERENCES typevoertuig (id)
) ENGINE=InnoDB;

-- - Step 5 Insert data into table voertuig

-- Id(PK)	Kenteken	Type	Bouwjaar	Brandstof	TypeVoertuigId (FK)
INSERT INTO voertuig (
kenteken,
type,
bouwjaar,
brandstof,
typevoertuigID
) 
VALUES
("AU-67-IO",  "Golf",           "2017-06-12",     "Diesel",     1),
("TR-24-OP",  "DAF",            "2019-05-23",     "Diesel",     2),
("TH-78-KL",  "Mercedes",       "2023-01-01",     "Benzine",    1),
("90-KL-TR",  "Fiat 500",       "2021-09-12",     "Benzine",    1),
("34-TK-LP",  "Scania",         "2015-03-13",     "Diesel",     2),
("YY-OP-78",  "BMW M5",         "2022-05-13",     "Diesel",     1),
("UU-HH-JK",  "M.A.N",          "2017-12-03",     "Diesel",     2),
("ST-FZ-28",  "Citroën",        "2018-01-20",     "Elektrisch", 1),
("123-FR-T",  "Piaggio ZIP",	"2021-02-01",     "Benzine",    4),
("DRS-52-P",  "Vespa",          "2022-03-21",     "Benzine",    4),
("STP-12-U",  "Kymco",          "2022-07-02",     "Benzine",    4),
("45-SD-23",  "Renault",        "2023-01-01",     "Diesel",     3);

-- - Step 6 Create table instructeurs

DROP TABLE IF EXISTS instructeurs;

CREATE TABLE IF NOT EXISTS instructeurs (
    id              TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    voornaam        VARCHAR(50)         NOT NULL,
    tussenvoegsel   VARCHAR(10)         NULL,
    achternaam      VARCHAR(50)         NOT NULL,
    telefoon        CHAR(12)            NOT NULL,
    datumInDienst   DATE                NOT NULL,
    aantalSterren   TINYINT UNSIGNED    NULL,
    CONSTRAINT PK_instructeursID PRIMARY KEY CLUSTERED(id)
) ENGINE=InnoDB;

-- - Step 7 Insert data into instructeurs

INSERT INTO instructeurs (
    voornaam,
    tussenvoegsel,
    achternaam,
    telefoon,
    datumInDienst,
    aantalSterren
) VALUES
("Li",        null,    "Zhan",      "06-28493827", "2015-04-17", 3),
("Leroy",     null,    "Boerhaven", "06-39398734", "2018-06-25", 1),
("Yoeri",     "Van",   "Veen",      "06-24383291", "2010-05-12", 3),
("Bert",      "Van",   "Sali",      "06-48293823", "2023-01-10", 4),
("Mohammed",  "El",    "Yassidi",   "06-34291234", "2010-06-14", 5);

-- - Step 8 Create linking table voertuig-instructeur
DROP TABLE IF EXISTS voertuiginstructeur;

CREATE TABLE IF NOT EXISTS voertuiginstructeur (
    id              TINYINT UNSIGNED            NOT NULL    AUTO_INCREMENT,
    voertuigID      TINYINT UNSIGNED            NOT NULL,
    instructeurID   TINYINT UNSIGNED            NOT NULL,
    datumToekenning DATE                        NOT NULL,
    CONSTRAINT      PK_voertuiginstructeurID    PRIMARY KEY CLUSTERED(id),
    CONSTRAINT      FK_voertuigID    FOREIGN KEY (voertuigID)    REFERENCES voertuig    (id),
    CONSTRAINT      FK_instructeurID FOREIGN KEY (instructeurID) REFERENCES instructeurs(id)
) ENGINE=InnoDB;

-- - Step 9 Insert into voertuig-instructeur

INSERT INTO voertuiginstructeur (voertuigID, instructeurID, datumToekenning) 
VALUES
(1,     5,  "2017-06-18"),
(3,     1,  "2021-09-26"),
(9,     1,  "2021-09-27"),
(3,     4,  "2022-08-01"),
(5,     1,  "2019-08-30"),
(10,    5,  "2020-02-02");



-- - Proeftoets aanvullung,

-- - Step 10 Create table lespakket

CREATE TABLE IF NOT EXISTS lespakket (
    id                  TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    naam                VARCHAR(50)         NOT NULL,
    aantalLessen        TINYINT UNSIGNED    NOT NULL,
    rijbewijscategorie  VARCHAR(2)          NOT NULL,
    prijs               DECIMAL(6,2)        NOT NULL,
    CONSTRAINT PK_lespakketID PRIMARY KEY CLUSTERED(id)
) ENGINE=InnoDB;

-- - Step 11 Insert data into table lespakket
-- Id (PK)	Pakket Naam	AantalLessen	Rijbewijscategorie	Prijs
-- 1	Personenauto Extra	40	B	2700
-- 2	Vrachtwagen Subliem	60	C	5400
-- 3	Bus Extraordinaire	80	D	7300
-- 4	Bromfiets Deluxe	10	AM	230

INSERT INTO lespakket (id, naam, aantalLessen, rijbewijscategorie, prijs) VALUES 
(1, "Personenauto Extra", 40, "B", 2700),
(2, "Vrachtwagen Subliem", 60, "C", 5400),
(3, "Bus Extraordinaire", 80, "D", 7300),
(4, "Bromfiets Deluxe", 10, "AM", 230);



-- - Step 12 Create table leerling

CREATE TABLE IF NOT EXISTS leerling (
id                  TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
voornaam            VARCHAR(50)         NOT NULL,
tussenvoegsel       VARCHAR(10)         NULL,
achternaam          VARCHAR(50)         NOT NULL,
mobiel              CHAR(12)            NOT NULL,
CONSTRAINT PK_leerlingID PRIMARY KEY CLUSTERED(id)
) ENGINE=InnoDB;

-- - Step 13 Insert data into table leerling
-- Id(PK)	Voornaam	Tussenvoegsel	Achternaam	Mobiel
-- 1	Bas	De	Bakker	06-28493827
-- 2	Terence		Draaijer	06-39398734
-- 3	Samuel		Werchter	06-24383291
-- 4	Sharida		Tetehuka	06-48293823

-- 5	Fatma		Yilmaz	06-34291234

INSERT INTO leerling (id, voornaam, tussenvoegsel, achternaam, mobiel) VALUES
(1, "Bas", "De", "Bakker", "06-28493827"),
(2, "Terence", null, "Draaijer", "06-39398734"),
(3, "Samuel", null, "Werchter", "06-24383291"),
(4, "Sharida", null, "Tetehuka", "06-48293823"),
(5, "Fatma", null, "Yilmaz", "06-34291234");

-- - Step 14 Create linking table lespakket-leerling

CREATE TABLE IF NOT EXISTS lespakketleerling (
    id                      TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    lespakketID             TINYINT UNSIGNED    NOT NULL,
    leerlingID              TINYINT UNSIGNED    NOT NULL,
    startdatumrijlessen     DATE                NOT NULL,
    datumrijbewijsgehaald   DATE                NULL,
    CONSTRAINT PK_lespakketleerlingID PRIMARY KEY CLUSTERED(id),
    CONSTRAINT FK_lespakketID FOREIGN KEY (lespakketID) REFERENCES lespakket(id),
    CONSTRAINT FK_leerlingID FOREIGN KEY (leerlingID) REFERENCES leerling(id)
) ENGINE=InnoDB;

-- - Step 15 Insert data into table lespakket-leerling
-- Id (PK)	LesPakketId (FK)	LeerlingId (FK)	StartDatumRijlessen	DatumRijbewijsBehaald
-- 1	1	5	23-05-2023	NULL
-- 2	4	1	3-06-2022	5-8-2022
-- 3	1	1	2-06-2023	NULL
-- 4	3	4	1-01-2023	NULL
-- 5	5	2	30-11-2022	23-05-2023
-- 6	2	3	06-06-2022	06-06-2023


INSERT INTO lespakketleerling (lespakketID, leerlingID, startdatumrijlessen, datumrijbewijsgehaald) VALUES
(1, 5, "2023-05-23", null),
(4, 1, "2022-06-03", "2022-08-05"),
(1, 1, "2023-06-02", null),
(3, 4, "2023-01-01", null),
(1, 2, "2022-11-30", "2023-05-23"),
(2, 3, "2022-06-06", "2023-06-06");


-- # Toets toevoeging
-- - Step 16 Create table examinator

CREATE TABLE IF NOT EXISTS examinator (
    id                 TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    voornaam           VARCHAR(50)         NOT NULL,
    tussenvoegsel      VARCHAR(10)         NULL,
    achternaam         VARCHAR(50)         NOT NULL,
    mobiel             CHAR(11)            NOT NULL,
    CONSTRAINT PK_examinatorID PRIMARY KEY CLUSTERED(id)
) ENGINE=InnoDB;

-- - Step 17 Insert data into table examinator

INSERT INTO examinator (voornaam, tussenvoegsel, achternaam, mobiel) VALUES
("Manuel", "van", "Meekeren", "06-28493823"),
("Lissette", "den", "Dongen", "06-24383299"),
("Jurswailly", null, "Luciano", "06-48293846"),
("Naswha",null,"Salawi","06-34291219");

-- - Step 18 Create table examen

CREATE TABLE IF NOT EXISTS examen (
    id                 TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    studentId          INT UNSIGNED        NOT NULL UNIQUE,
    rijschool          VARCHAR(200)        NOT NULL,
    stad               VARCHAR(50)         NOT NULL,
    rijbewijscategorie VARCHAR(2)          NOT NULL,
    datum              DATE                NOT NULL,
    uitslag            BOOLEAN             NOT NULL,
    CONSTRAINT PK_examenID PRIMARY KEY CLUSTERED(id)
) ENGINE=InnoDB;

-- - Step 19 Insert data into table examen

INSERT INTO examen (studentId, rijschool, stad, rijbewijscategorie, datum, uitslag) VALUES
(100234, "VolGasVooruit", "Rotterdam", "B", "2023-04-03", true),
(123432, "InZijnVierDoorDeBocht", "Sliedrecht", "C", "2023-03-01", true),
(103234, "LinksomRechtsom", "Dordrecht", "D", "2023-05-15", true),
(106452, "OpDeVluchtStrook", "Zwijndrecht", "AM", "2023-05-08", false),
(104546, "RechtDoorEnGaan", "Rotterdam", "B", "2023-04-17", false),
(100333, "AltijdGeslaagd", "Dordrecht", "B", "2023-05-12", true),
(124444, "RijlesVoorJou", "Rotterdam", "B", "2023-04-12", true);

-- - Step 20 Create table examenPerExaminator

CREATE TABLE IF NOT EXISTS examenPerExaminator (
    id                TINYINT UNSIGNED    NOT NULL    AUTO_INCREMENT,
    examenId          TINYINT UNSIGNED    NOT NULL,
    examinatorId      TINYINT UNSIGNED    NOT NULL,
    CONSTRAINT PK_examenPerExaminatorID PRIMARY KEY CLUSTERED(id),
    CONSTRAINT FK_examenId FOREIGN KEY (examenId) REFERENCES examen(id),
    CONSTRAINT FK_examinatorId FOREIGN KEY (examinatorId) REFERENCES examinator(id)
) ENGINE=InnoDB;

-- - Step 21 Insert data into table examenPerExaminator

INSERT INTO examenPerExaminator (examenId, examinatorId) VALUES 
(1, 3),
(3, 3),
(2, 2),
(4, 1),
(7, 3),
(6, 2),
(5, 4);