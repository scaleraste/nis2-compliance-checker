FROM ubuntu:latest
LABEL authors="mazza"

ENTRYPOINT ["top", "-b"]
