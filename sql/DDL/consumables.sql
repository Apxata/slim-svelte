create table if not exists consumables
(
    id int(10) UNSIGNED auto_increment PRIMARY KEY,
    name varchar(255) not null,
    code varchar(255) not null,
    date_created  datetime not null,
    deleted tinyint default 0
);



