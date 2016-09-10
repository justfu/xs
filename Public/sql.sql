-- 创建用户表
create table xs_user2(
id int unsigned PRIMARY KEY auto_increment,
username varchar(10) comment '用户名',
password varchar(50) comment '用户密码',
email varchar(20) comment '用户邮箱',
logo varchar(200) comment '用户头像',
tel varchar(11) comment '用户手机号',
addtime int comment '用户加入时间'
)charset utf8 engine = innodb;

-- 创建收藏表
create table xs_collect(
id int unsigned not null PRIMARY KEY auto_increment,
uid int not null comment '用户ID',
book_id int not null comment '收藏书籍id',
chapter_id int DEFAULT 0 comment '章节id',
time int comment '保存时间'
)charset utf8 engine = myisam;