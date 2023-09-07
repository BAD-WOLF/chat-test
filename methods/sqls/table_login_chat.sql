CREATE TABLE IF NOT EXISTS chat.login_chat (
    id int AUTO_INCREMENT not null primary key,
    username varchar(50) not null unique,
    passwd varchar(30)
);

show tables in chat;