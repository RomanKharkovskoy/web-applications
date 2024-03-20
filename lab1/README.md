# Лабораторная работа по теме "Работа с заметками"
## Упражнение 1. Работа со страницей default.php 
1. Необходимо создать web-приложение для добавление заметок (последняя добавленная заметка будет отображаться в самом верху списка заметок)
2. Необходимо сделать так, чтобы последняя добавленная заметка отображалась в самом верху списка заметок. 
## Упражнение 2. Работа с комментариями к заметкам 
Добавить возможность добавлять комментарии к заметкам.

# Работа
## База данных

Для создания базы данных была выбрана СУБД PostgreSQL. Далее представлен код для создания таблиц

Таблица users
```
CREATE TABLE users (
  user_id INT PRIMARY KEY,
  login VARCHAR(255) NOT NULL,
  hashed_password VARCHAR(255) NOT NULL,
);
```
Таблица notes
```
CREATE TABLE notes (
    id SERIAL PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Таблица comments
```
CREATE TABLE comments (
    id SERIAL PRIMARY KEY,
    note_id INTEGER REFERENCES notes(id),
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
