#!/bin/bash

user="nanfei"
app="ucdream"
imageRepo="$user/$app:latest"
container="$user-$app"

# stop container
activeContainers=`sudo docker ps`
if [[ $activeContainers =~ ${container} ]]; then
    sudo docker stop $container
fi

# remove container
allContainers=`sudo docker ps -a`
if [[ $allContainers =~ ${container} ]]; then
    sudo docker rm $container
fi

# remove image
sudo docker rmi $imageRepo

# build new image
sudo docker build -t $imageRepo .

# start the image
containerId=`sudo docker run -d -p 80:80 --name $container $imageRepo`

echo Successfully update image $imageRepo and restarted the container $container
