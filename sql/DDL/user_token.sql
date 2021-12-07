create table if not exists user_token
(
    id int(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id int(10) UNSIGNED not null,
    token varchar(255) not null,
    date_created datetime not null,
    date_expired datetime not null,

    constraint fk_token_user
        foreign key (user_id) references users (id)
            on delete cascade
)ENGINE = InnoDB;