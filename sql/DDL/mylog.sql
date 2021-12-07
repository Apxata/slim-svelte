create table if not exists global_log
(
    id int(10) UNSIGNED auto_increment PRIMARY KEY,
    message varchar(255) not null,
    log_type varchar(255) null

);
