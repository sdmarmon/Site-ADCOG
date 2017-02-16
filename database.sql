create database if not exists adcog character set utf8 collate utf8_unicode_ci;
use adcog;

grant all privileges on adcog.* to 'adcog_user'@'localhost' identified by 'secret';
