--
-- ER/Studio 8.0 SQL Code Generation
-- Project :      neurobit.DM1
--
-- Date Created : Wednesday, October 10, 2018 10:16:49
-- Target DBMS : MySQL 5.x
--

-- 
-- TABLE: asignacion 
--

CREATE TABLE asignacion(
    id            INT         AUTO_INCREMENT,
    tiempo        INT         NOT NULL,
    disponible    TINYINT(1)    NOT NULL,
    equipo        INT         NOT NULL,
    prueba        INT         NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: equipo 
--

CREATE TABLE equipo(
    id             INT             AUTO_INCREMENT,
    nombre         VARCHAR(100)    NOT NULL,
    descripcion    TEXT,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: especialidad 
--

CREATE TABLE especialidad(
    id             INT             AUTO_INCREMENT,
    nombre         VARCHAR(100)    NOT NULL,
    descripcion    TEXT,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: indicacion 
--

CREATE TABLE indicacion(
    id           INT    AUTO_INCREMENT,
    solicitud    INT    NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: paciente 
--

CREATE TABLE paciente(
    id             INT             AUTO_INCREMENT,
    ci             VARCHAR(11)     NOT NULL,
    nombre         VARCHAR(100)    NOT NULL,
    sexo           TINYINT(1)        NOT NULL,
    edad           INT             NOT NULL,
    ingresado      TINYINT(1)        DEFAULT 0 NOT NULL,
    procedencia    INT             NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: planificacion 
--

CREATE TABLE planificacion(
    id             INT     AUTO_INCREMENT,
    fecha          DATE    NOT NULL,
    hora_inicio    TIME    NOT NULL,
    hora_fin       TIME    NOT NULL,
    asignacion     INT     NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: procedencia 
--

CREATE TABLE procedencia(
    id                 INT             AUTO_INCREMENT,
    nombre             VARCHAR(100)    NOT NULL,
    descripcion        TEXT,
    fuera_provincia    TINYINT(1)        NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: prueba 
--

CREATE TABLE prueba(
    id             INT             AUTO_INCREMENT,
    nombre         VARCHAR(100)    NOT NULL,
    descripcion    TEXT,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: solicitud 
--

CREATE TABLE solicitud(
    id                       INT             AUTO_INCREMENT,
    especialista             VARCHAR(100)    NOT NULL,
    motivo_consulta          VARCHAR(100)    NOT NULL,
    impresion_diagnostica    TEXT            NOT NULL,
    sintomas                 TEXT,
    signos                   TEXT,
    paciente                 INT             NOT NULL,
    especialidad             INT             NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: turno 
--

CREATE TABLE turno(
    id               INT     AUTO_INCREMENT,
    hora_inicio      TIME    NOT NULL,
    planificacion    INT     NOT NULL,
    PRIMARY KEY (id)
)ENGINE=INNODB
;



-- 
-- TABLE: turno_indicacion 
--

CREATE TABLE turno_indicacion(
    turno            INT         NOT NULL,
    indicacion       INT         NOT NULL,
    fecha_real       DATETIME,
    observaciones    TEXT        NOT NULL,
    PRIMARY KEY (turno, indicacion)
)ENGINE=INNODB
;



-- 
-- TABLE: asignacion 
--

ALTER TABLE asignacion ADD CONSTRAINT Refprueba27 
    FOREIGN KEY (prueba)
    REFERENCES prueba(id)
;

ALTER TABLE asignacion ADD CONSTRAINT Refequipo28 
    FOREIGN KEY (equipo)
    REFERENCES equipo(id)
;


-- 
-- TABLE: indicacion 
--

ALTER TABLE indicacion ADD CONSTRAINT Refsolicitud30 
    FOREIGN KEY (solicitud)
    REFERENCES solicitud(id)
;


-- 
-- TABLE: paciente 
--

ALTER TABLE paciente ADD CONSTRAINT Refprocedencia34 
    FOREIGN KEY (procedencia)
    REFERENCES procedencia(id)
;


-- 
-- TABLE: planificacion 
--

ALTER TABLE planificacion ADD CONSTRAINT Refasignacion32 
    FOREIGN KEY (asignacion)
    REFERENCES asignacion(id)
;


-- 
-- TABLE: solicitud 
--

ALTER TABLE solicitud ADD CONSTRAINT Refpaciente19 
    FOREIGN KEY (paciente)
    REFERENCES paciente(id)
;

ALTER TABLE solicitud ADD CONSTRAINT Refespecialidad35 
    FOREIGN KEY (especialidad)
    REFERENCES especialidad(id)
;


-- 
-- TABLE: turno 
--

ALTER TABLE turno ADD CONSTRAINT Refplanificacion37 
    FOREIGN KEY (planificacion)
    REFERENCES planificacion(id)
;


-- 
-- TABLE: turno_indicacion 
--

ALTER TABLE turno_indicacion ADD CONSTRAINT Refturno38 
    FOREIGN KEY (turno)
    REFERENCES turno(id)
;

ALTER TABLE turno_indicacion ADD CONSTRAINT Refindicacion39 
    FOREIGN KEY (indicacion)
    REFERENCES indicacion(id)
;


