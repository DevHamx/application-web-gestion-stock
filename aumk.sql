/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  7/30/2018 9:33:07 AM                     */
/*==============================================================*/
create database aumk;
use aumk;

drop table if exists ACHAT_FORNISSEUR;

drop table if exists ACHAT_REFERENCE;

drop table if exists ARTICLE;

drop table if exists CATEGORE1;

drop table if exists CATEGORE2;

drop table if exists PROFILE;

drop table if exists RECEPTION;

drop table if exists UTILISATEURS;

/*==============================================================*/
/* Table : ACHAT_FORNISSEUR                                     */
/*==============================================================*/
create table ACHAT_FORNISSEUR
(
   ID_ACHAT             int not null AUTO_INCREMENT,
   ID_ARTICLE           int not null,
   ID_LOGIN             int not null,
   ID_ACHAT_REF         int not null,
   DATE_ACHAT           date,
   QUANTITE_ACHAT       int,
   primary key (ID_ACHAT)
);

/*==============================================================*/
/* Table : ACHAT_REFERENCE                                      */
/*==============================================================*/
create table ACHAT_REFERENCE
(
   ID_ACHAT_REF         int not null AUTO_INCREMENT,
   FOURNISSEUR          varchar(1024),
   REFERENCE_NUMBER     varchar(1024),
   primary key (ID_ACHAT_REF)
);

/*==============================================================*/
/* Table : ARTICLE                                              */
/*==============================================================*/
create table ARTICLE
(
   ID_ARTICLE           int not null AUTO_INCREMENT,
   ID_CATEGORE2         int not null,
   NOM_ARTICLE          varchar(1024),
   primary key (ID_ARTICLE)
);

/*==============================================================*/
/* Table : CATEGORE1                                            */
/*==============================================================*/
create table CATEGORE1
(
   ID_CATEGORE1         int not null AUTO_INCREMENT,
   NOM_CATEGORE1        varchar(1024),
   primary key (ID_CATEGORE1)
);

/*==============================================================*/
/* Table : CATEGORE2                                            */
/*==============================================================*/
create table CATEGORE2
(
   ID_CATEGORE2         int not null AUTO_INCREMENT,
   ID_CATEGORE1         int not null,
   NOM_CATEGORE2        varchar(1024),
   primary key (ID_CATEGORE2)
);

/*==============================================================*/
/* Table : PROFILE                                              */
/*==============================================================*/
create table PROFILE
(
   ID_PROFILE           int not null AUTO_INCREMENT,
   TYPE_PROFILE         varchar(1024),
   primary key (ID_PROFILE)
);

/*==============================================================*/
/* Table : RECEPTION                                            */
/*==============================================================*/
create table RECEPTION
(
   ID_RECEPTION         int not null AUTO_INCREMENT,
   ID_ARTICLE           int not null,
   ID_LOGIN             int not null,
   DATE_RECEPTION       date,
   QUANTITE_RECEPTION   int,
   primary key (ID_RECEPTION)
);

/*==============================================================*/
/* Table : UTILISATEURS                                         */
/*==============================================================*/
create table UTILISATEURS
(
   ID_LOGIN             int not null AUTO_INCREMENT,
   ID_PROFILE           int not null,
   CIN                  varchar(1024),
   password             varchar(1024),
   NOM_UTILISATEUR      varchar(1024),
   PRENOM_UTILISATEUR   varchar(1024),
   TELE                 varchar(1024),
   primary key (ID_LOGIN)
);

alter table ACHAT_FORNISSEUR add constraint FK_AVOIR4 foreign key (ID_ACHAT_REF)
      references ACHAT_REFERENCE (ID_ACHAT_REF) on delete restrict on update restrict;

alter table ACHAT_FORNISSEUR add constraint FK_FAIRE foreign key (ID_LOGIN)
      references UTILISATEURS (ID_LOGIN) on delete restrict on update restrict;

alter table ACHAT_FORNISSEUR add constraint FK_STOCKAGE foreign key (ID_ARTICLE)
      references ARTICLE (ID_ARTICLE) on delete restrict on update restrict;

alter table ARTICLE add constraint FK_AVOIR_2 foreign key (ID_CATEGORE2)
      references CATEGORE2 (ID_CATEGORE2) on delete restrict on update restrict;

alter table CATEGORE2 add constraint FK_AVOIR foreign key (ID_CATEGORE1)
      references CATEGORE1 (ID_CATEGORE1) on delete restrict on update restrict;

alter table RECEPTION add constraint FK_DESTOCKAGE foreign key (ID_ARTICLE)
      references ARTICLE (ID_ARTICLE) on delete restrict on update restrict;

alter table RECEPTION add constraint FK_FAIRE2 foreign key (ID_LOGIN)
      references UTILISATEURS (ID_LOGIN) on delete restrict on update restrict;

alter table UTILISATEURS add constraint FK_AVOIR3 foreign key (ID_PROFILE)
      references PROFILE (ID_PROFILE) on delete restrict on update restrict;

INSERT INTO `profile` (`ID_PROFILE`, `TYPE_PROFILE`) VALUES ('1', 'admin'), ('2', 'personel'), ('3', 'responsable');
INSERT INTO `utilisateurs` (`ID_LOGIN`, `ID_PROFILE`, `CIN`, `password`, `NOM_UTILISATEUR`, `PRENOM_UTILISATEUR`, `TELE`) VALUES (NULL, '1', 'a', 'a', 'a', 'a', '06'), ('2', '2', 'b', 'b', 'b', 'b', '05');
INSERT INTO `categore1` (`ID_CATEGORE1`, `NOM_CATEGORE1`) VALUES ('1', 'Electronique'), ('2', 'Bureau');
INSERT INTO `categore2` (`ID_CATEGORE2`, `ID_CATEGORE1`, `NOM_CATEGORE2`) VALUES ('1', '1', 'Cellphones & Accessoires'), ('2', '1', 'CamÃ©ras & Accessoires'), ('3', '1', 'Ordinateurs & tablettes'), ('4', '1', 'TV, audio & surveillance'), ('5', '2', 'MatÃ©riel de bureau'), ('6', '2', 'Fournitures de bureau');
INSERT INTO `article` (`ID_ARTICLE`, `ID_CATEGORE2`, `NOM_ARTICLE`) VALUES ('1', '2', 'Samsung galaxy S9'), ('2', '2', 'Nikon 1 J5'), ('3', '3', 'HP Workstation z240'), ('4', '4', 'Samsung LED TV 55 inch'), ('5', '5', 'imprimante'), ('6', '6', 'stylo bic');

