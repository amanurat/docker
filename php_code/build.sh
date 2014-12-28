#!/bin/bash

user="nanfei"
app="ucdream"
imageRepo="$user/$app:latest"
container="$user-$app"

# pull code
sudo git pull

# stop container
activeContainers=`sudo docker ps`
if [[ $activeContainers =~ ${container} ]]; then
    echo stopped container `sudo docker stop $container`
fi

# remove container
allContainers=`sudo docker ps -a`
if [[ $allContainers =~ ${container} ]]; then
    echo removed container `sudo docker rm $container`
fi

# remove image
echo removing existing image $imageRepo
sudo docker rmi $imageRepo

# build new image
echo building new image $imageRepo
sudo docker build -t $imageRepo .

# start the image
echo starting new contianer
containerId=`sudo docker run -v /home/ubuntu/apache2:/var/log/apache2 -d -p 80:80 --name $container $imageRepo`

echo Successfully update image $imageRepo and restarted the container $container
