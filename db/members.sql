create table members (
    num int not null auto_increment,
    id char(15) not null,
    pass char(15) not null,
    level int,
    point int,
    primary key(num)
);
