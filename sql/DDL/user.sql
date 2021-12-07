create table if not exists users
(
    id int(10) UNSIGNED auto_increment PRIMARY KEY,
    email varchar(255) not null,
    password_hash varchar(255) not null,
    date_created datetime not null,
    nickname varchar(255) null
);

create unique index users_email_uindex
    on users (email);

create index users_password_hash_index
    on users (password_hash);

