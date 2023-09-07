create table if not exists chat.messages(
    id int AUTO_INCREMENT not null primary key,
    username varchar(30) not null,
    msg text not null,
    msgTime time default CURRENT_TIME not null
);

-- describe messages;