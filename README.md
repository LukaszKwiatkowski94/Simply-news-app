# Simply News App

## Installation

1. Clone Repo
```
git clone https://github.com/LukaszKwiatkowski94/Simply-news-app.git
```

In the main directory

2. Install composer
```
composer install
```

3. Update the autoloader
```
composer dump-autoload
```

4. Run server
```
composer run-server
```

5. Go to page
```
http://localhost:8800
```

## Database

1. Create a database

2. Create the users table
```
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(70) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

3. Create the news table
```
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `author` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_last_updated` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

4. Other settings
```
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
  
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
```

5. Get an administrator
-> Create a user in the app using a form.
-> Change the value in the table "users" column "is_admin" from "0" to "1" for the user you want to become an administrator.
