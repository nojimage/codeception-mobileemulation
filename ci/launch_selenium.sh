#!/bin/sh

docker pull selenium/standalone-chrome
docker run --rm -d -p 4444:4444 -v /dev/shm:/dev/shm selenium/standalone-chrome
