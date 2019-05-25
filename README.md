# simple_blog
simple blog using singleton


For propper work need to create database (MySQL 5.7.24) w/ name "users_db" and: <br>
  1.table "users" <br>
    -"id" column <br>
    -"email" column <br>
    -"password" column <br>
    -"salt" column <br>
  2.table "posts" <br>
    -"id" column <br>
    -"title" column <br>
    -"body" column <br>
    -"date" column <br>
    -"user_id" column <br>
  3.table "comments" <br>
    -"id" column <br>
    -"body" column <br>
    -"timestamp" column <br>
    -"post_id" column <br>
    -"user_id" column <br>
