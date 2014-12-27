#!/bin/bash

app="ucdream"
tag="latest"

# stop container
sudo docker stop $app

# remove container
sudo docker rm $app

# remove image
sudo docker rmi nanfei/$app:$tag

# build new image
sudo docker build -t nanfei/$app .

# start the image
sudo docker run -d -p 80:80 --name $app nanfei/$app:$tag
