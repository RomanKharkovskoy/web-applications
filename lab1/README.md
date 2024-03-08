# Лабораторная работа по теме "Работа с заметками"
## Упражнение 1. Работа со страницей default.php 
1. Необходимо создать web-приложение для добавление заметок (последняя добавленная заметка будет отображаться в самом верху списка заметок)
2. Необходимо сделать так, чтобы последняя добавленная заметка отображалась в самом верху списка заметок. 
## Упражнение 2. Работа с комментариями к заметкам 
Добавить возможность добавлять комментарии к заметкам.

# Работа
## База данных
![alt text](pics/DB.png)

Для создания базы данных была выбрана СУБД PostgreSQL. Далее представлен код для создания таблиц

Таблица Users
```
CREATE TABLE users (
  user_id INT PRIMARY KEY,
  login VARCHAR(255) NOT NULL,
  hashed_password VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);
```
Таблица Notes
```
CREATE TABLE notes (
  note_id INT PRIMARY KEY,
  user_id INT NOT NULL,
  category_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (category_id) REFERENCES categories (category_id)
);
```
Таблица Categories
```
CREATE TABLE categories (
  category_id INT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL,
  note_count INT DEFAULT 0
);
```
Таблица Comments
```
CREATE TABLE comments (
  comment_id INT PRIMARY KEY,
  user_id INT NOT NULL,
  note_id INT NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users (user_id),
  FOREIGN KEY (note_id) REFERENCES notes (note_id)
);
```
Таблица Stats
```
CREATE TABLE stats (
  user_id INT PRIMARY KEY,
  note_count INT,
  popular_category VARCHAR(255)
);
```
