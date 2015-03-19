FROM ubuntu:latest

RUN mkdir /app
RUN chmod +x /app

COPY run.sh /app
RUN chmod +x /app/run.sh

CMD ["/app/run.sh"]
