FROM nginx:latest

COPY /docker/nginx/vhosts /etc/nginx/conf.d
ARG branch

RUN sed -i "s:PHP_PORT:9000:g" /etc/nginx/conf.d/default.conf
RUN sed -i "s:URHALAPHP:urhalaphp-$branch:g" /etc/nginx/conf.d/default.conf
