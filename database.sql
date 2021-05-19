use ampip ;
create table if not exists datosDeUsuario
(
    id                  int auto_increment   primary key,
    key_corp            int          null,
    cargo               varchar(20)  null,
    telefonoOfficina    varchar(15)  null,
    celular             varchar(15)  null,
    direccionDeOfficina varchar(255) null,
    cumpleanios         varchar(10)  null,
    compartirDatos      tinyint(1)   null,
    habilitar           tinyint(1)   null,
    idAmpip             int          null
);

create table if not exists datosDelCorporativo
(
    id                         int auto_increment
        primary key,
    corporativo                varchar(50)  null,
    nombre_es                  varchar(50)  null,
    nombre_en                  varchar(50)  null,
    tipoDeSocio                varchar(25)  null,
    rfc                        varchar(15)  null,
    direccion                  varchar(255) null,
    cp                         int          null,
    colonia                    varchar(255) null,
    estado                     varchar(100) null,
    municipio                  varchar(100) null,
    celular                    varchar(15)  null,
    logo                       varchar(255) null,
    inversionAnualSiguiente    varchar(255) null,
    inversionRealizadaActual   varchar(255) null,
    inversionRealizadaAnterior varchar(255) null,
    validadoPor                varchar(255) null,
    fechaDeValidacion          datetime     null,
    fechaDeAlta                datetime     null,
    fechaDeBaja                datetime     null,
    status                     varchar(15)  null,
    habilitar                  varchar(15)  null
);

create table if not exists espacio_disponible
(
    id             int auto_increment
        primary key,
    tipo           varchar(10)  null,
    tipoDeDispo    varchar(20)  null,
    uso            varchar(20)  null,
    contacto       varchar(100) null,
    precioPromedio float        null,
    id_parque      int          null,
    medidaX        int          null,
    medidaY        int          null,
    medidaZ        int          null
);

create table if not exists extras
(
    id        int auto_increment
        primary key,
    id_entity int  not null,
    dataExtra text null
);

create table if not exists inquilino_nave
(
    id                int auto_increment
        primary key,
    corporativo       varchar(100) null,
    tipoDeNave        char         null,
    nombre_es         varchar(100) null,
    nombre_en         varchar(100) null,
    propietario       varchar(100) null,
    id_nave           int          null,
    nombreEmpresa     varchar(100) null,
    numEmpleados      int          null,
    paisOrigen        varchar(100) null,
    productoInsignia  varchar(100) null,
    sectorEmpresarial varchar(20)  null,
    id_SCIAN          varchar(100) null,
    id_DENUE          varchar(100) null,
    antiguedad        int          null,
    isAmpip           tinyint(1)   null,
    medidaX           int          null,
    medidaY           int          null,
    medidaZ           int          null
);

create trigger updateSPace
    before insert
    on inquilino_nave
    for each row
begin
    -- missing source code
end;

create trigger updateSizes
    before insert
    on inquilino_nave
    for each row
begin
    -- missing source code
end;

create table if not exists nave
(
    id        int auto_increment
        primary key,
    name      varchar(100) not null,
    parque_id int          not null
);

create table if not exists parque
(
    id                      int auto_increment
        primary key,
    key_corp                int          null,
    key_user                int          null,
    nombre_es               varchar(100) null,
    nombre_en               varchar(100) null,
    adminParq               varchar(100) null,
    parqProp                varchar(100) null,
    parqIntoParq            varchar(100) null,
    region                  varchar(100) null,
    mercado                 varchar(100) null,
    tipoDeIndustria         varchar(20)  null,
    superficieTotal         varchar(20)  null,
    superficieUrban         varchar(20)  null,
    superficieOcup          varchar(20)  null,
    superficieDisp          varchar(20)  null,
    tipoDePropiedad         varchar(20)  null,
    inicioOperaciones       date         null,
    numEmpleados            int          null,
    reconocimientoPracticas varchar(50)  null,
    ifraestructura          varchar(70)  null,
    numeroDeNaves           int          null,
    observacion             varchar(100) null,
    kmz                     varchar(255) null,
    planMaestro             varchar(100) null,
    contactName             varchar(100) null,
    contactEmail            varchar(100) null
);

create table if not exists parques_usuarios
(
    id        int auto_increment
        primary key,
    persona   int          not null,
    id_parque int          null,
    permiso   varchar(100) null
);

create table if not exists reclog
(
    id      int auto_increment
        primary key,
    user    varchar(200) null,
    message text         null,
    time    datetime     null
);

create table if not exists role
(
    id           int auto_increment
        primary key,
    name         varchar(128)  null,
    description  varchar(1024) null,
    date_created datetime      null,
    constraint name_idx
        unique (name)
);

create table if not exists user
(
    id                            int auto_increment
        primary key,
    email                         varchar(128)  null,
    full_name                     varchar(512)  null,
    password                      varchar(256)  null,
    status                        int           null,
    date_created                  datetime      null,
    pwd_reset_token               varchar(256)  null,
    pwd_reset_token_creation_date datetime      null,
    userForAmpip                  int           null,
    typeOfUser                    int default 1 null
);

create trigger set_data_user
    before insert
    on user
    for each row
begin
    -- missing source code
end;

create table if not exists user_role
(
    id      int auto_increment
        primary key,
    user_id int not null,
    role_id int not null,
    constraint user_role_role_id_fk
        foreign key (role_id) references role (id)
            on update cascade on delete cascade,
    constraint user_role_user_id_fk
        foreign key (user_id) references user (id)
            on update cascade on delete cascade
);

