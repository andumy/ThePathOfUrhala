FROM mysql:latest

ARG db_username
ARG db_rootpass

RUN mkdir /var/log/mysql
RUN chown -R 775 /var/log/mysql

RUN echo "GRANT ALL PRIVILEGES ON *.* TO '$db_username'@'%' WITH GRANT OPTION;" >> /docker-entrypoint-initdb.d/permissions.sql