use prueba;

create table usuario(
rut char(12) primary key,
nombre varchar(30) not null,
clave varchar(30) not null);

create table especialidad(
id int auto_increment primary key,
especialidad varchar(30)
);

create table doctor(
rut char(12) primary key,
nombre varchar(20),
especialidad int,
foreign key (especialidad) references especialidad(id));

create table turno(
id int auto_increment primary key,
dia varchar(20),
hora_inicio varchar(20),
hora_salida varchar(20),
tiempo_turno varchar(20),
rut_doctor char(12),
foreign key (rut_doctor) references doctor(rut)
);

create table reserva(
id int auto_increment primary key,
fecha varchar(20),
hora varchar(20),
rut char(12),
rut_doc char(12),
foreign key (rut) references usuario(rut),
foreign key (rut_doc) references doctor(rut)
);

insert into usuario values ('20-1', 'Braulio Gajardo' ,'123456');

insert into especialidad values (null,'Consulta General'),(null,'Radiografias'),(null,'Fisioterapia'),(null,'Toma de Muestras');

insert into doctor values ('11-1','Dr Fernando Almedo',3),('22-2', 'Dra Cristina Ramirez', 1),('33-3', 'Dra Fransisca Colon', 1),('44-4', 'Dra Camila Bascuñan', 1),('55-5', 'Dr Alvaro Baltazar',2),('66-6', 'Dr Claudio Faundez', 4);

insert into turno values (null,'21-02-2023','10:00', '18:00', '15', '22-2'),(null,'22-02-2023','10:00', '18:00', '15', '22-2'),(null,'23-02-2023','10:00', '18:00', '15', '22-2'),
(null,'21-02-2023','18:15', '22:00', '15', '33-3'),(null,'22-02-2023','18:15', '22:00', '15', '33-3'),(null,'23-02-2023','18:15', '22:00', '15', '33-3'),(null,'21-02-2023','12:00', '15:00', '30', '44-4'),(null,'25-02-2023','08:00', '13:00', '20', '11-1')