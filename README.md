# RSS Application Example

## Installation

```
git clone https://github.com/bukachuk/rss.git && cd rss
```

Create new database
```
mysqladmin create rss
```
Install the required dependencies
```
composer install
```
Set database configuration and smtp server
```
vi app/config/parameters.yml
```
Create database schema
```
bin/console doctrine:schema:create
```
Run php development server
```
bin/console server:start
```

