FROM ubuntu:latest  

RUN apt-get update  
RUN apt-get install -y nginx  

WORKDIR /var/www/html/template

VOLUME /var/www/html/template

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"] 