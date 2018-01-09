FROM cutephp/alpine
MAINTAINER cutephp cutephp@163.com
RUN apk add redis
EXPOSE 6379
#以非保护模式启动
CMD ["redis-server","--protected-mode no"]