# Личный проект «Readme»

<p align="left">
<img src="https://img.shields.io/badge/php-%5E8.3-blue">
<img src="https://img.shields.io/badge/PostgreSQL-16-316192">
<img src="https://img.shields.io/badge/Symfony-6.4-black">
</p>

---

_Не удаляйте и не обращайте внимание на файлы:_<br>
`.editorconfig`, `.gitattributes`, `.gitignore`

---
## О проекте

Сервис предоставляет пользователям возможность публиковать сообщения в своём блоге. Главная особенность сервиса — это формат постов. При публикации пользователь выбирает один из пяти доступных форматов записи. Такой формат публикации является чем-то средним между микроблогингом и полноценными, большими блог-постами.

В зависимости от выбранного формата, запись пользователя оформляется особенным образом.

## Основные сценарии использования сайта:

- Публикация и репост записей в своём блоге;
- Комментирование чужих записей;
- Подписка на пользователей;
- Просмотр своей ленты;
- Поиск записей по тегам, тексту либо просмотр популярных постов;
- Переписка с другими пользователями

## Начало работы

1. Клонируйте репозиторий:

```bash
git clone git@github.com:kiipod/readme.git readme
```

2. Перейдите в директорию проекта:

```bash
cd readme
```

3. Скопируйте .env-файл:

```
cp .env.dev.example .env
```

4. Запустите проект с помощью docker-compose:

```
make docker-up
```

5. Выполните команды для сборки и выполнения миграции:

```
make migrate
```

6. Заполните БД фейковыми данными:

```
make fixt-load
```

7. Остановить все службы docker:

```
make docker-down
```

## Техническое задание

[Посмотреть техническое задание проекта](tz.md)