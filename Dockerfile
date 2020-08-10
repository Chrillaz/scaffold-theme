FROM mysql:5.7

ADD /config/mysql/ /docker-entrypoint-initdb.d
