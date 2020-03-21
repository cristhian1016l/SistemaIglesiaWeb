drop database BDPrimitiva;
create database BDPrimitiva;
create database BDPrimitiva;
create table users (
  id int unique auto_increment primary key,
  CodCon varchar(8) not null,
  usuario varchar(191),
  email varchar(191) unique,
  password varchar(191),
  remember_token varchar(100),
  created_at timestamp,
  updated_at timestamp,
  condicion tinyint(1),
  foreign key (CodCon) references TabCon(CodCon));
  
  create table roles(
  id int unique auto_increment primary key,
  name varchar(191),
  description varchar(191)
  );
  
  create table role_user(
  id int unique auto_increment primary key,
  user_id int,
  role_id int
  );
  
  insert into roles(name, description) values('liderred', 'Usuario para ver los reportes del lider de casa de paz');
  insert into roles(name, description) values('lidercdp', 'Usuario para el líder de casa de paz');
  insert into roles(name, description) values('mentor', 'Usuario para ver todo relacionado a sus discìpulos');
  
  
  --PROCEDURES
  
  DELIMITER //
CREATE PROCEDURE mostrar_actividades()
BEGIN    
SELECT CodAct, TipAct, LugAct, HorEnt, PriAct FROM TabActividades;
END


DELIMITER //
CREATE PROCEDURE insertar_actividades(
IN CodAct nvarchar(3),
IN FecReg datetime,
IN TipAct nvarchar(30),
IN LugAct nvarchar(100),
IN Tipo nvarchar(2),
IN DiaActOtro nvarchar(7),
IN DiaMes nvarchar(2),
IN DiaSem nvarchar(2),
IN FecIni datetime,
IN FecFin datetime,
IN HorEnt datetime,
IN MinTol real,
IN ConAsi bit,
IN PriAct bit
)
BEGIN
insert into TabActividades(`CodAct`, `FecReg`, `TipAct`, `LugAct`, `Tipo`, `DiaActOtro`, `DiaMes`, `DiaSem`, `FecIni`, `FecFin`, `HorEnt`, `MinTol`, `ConAsi`, `PriAct`)
               values (CodAct, FecReg, TipAct, LugAct, Tipo, DiaActOtro, DiaMes, DiaSem, FecIni, FecFin, HorEnt, MinTol, ConAsi, PriAct);
END//

-- PROCEDIMIENTOS ALMACENADOS PARA CONGREGANTE --

DELIMITER //
CREATE PROCEDURE mostrar_miembros()
BEGIN
SELECT CodCon, ApeCon, NomCon, EstaEnProceso, FecNacCon, NumCel, TipCon, DirCon, ParticipaCasaPaz, FalCons, FalConsCP, FecReg, ID_RED FROM TabCon WHERE EstCon = 'ACTIVO' ORDER BY ApeCon ASC;
END//

----PROCEDIMIENTOS ALMACENADOS PARA CASAS DE PAZ

DELIMITER //
CREATE PROCEDURE mostrar_miembros_cdp(
IN CodCdp nvarchar(6)
)
BEGIN
SELECT c.CodCon, CONCAT(c.ApeCon, ' ', c.NomCon) As Nombres,
       c.EstaEnProceso, c.DirCon, c.TipCon, YEAR(CURDATE())-YEAR(c.FecNacCon) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(c.FecNacCon,'%m-%d'), 0 , -1 ) AS `EDAD_ACTUAL`, c.EstCon FROM TabMimCasPaz m INNER JOIN TabCon c ON m.CodCon = c.CodCon
WHERE m.CodCasPaz = CodCdp;
END//
use BDPrimitiva;
SELECT * FROM TabCasasDePaz WHERE ID_Red= '1'
SELECT * FROM TabRedes

