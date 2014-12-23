#!/bin/bash
set -e

name="chennanfei"
repo="docker"
image="$name/repo"
time=`date +%s`

workspace="$WS/$name"
mkdir $workspace

cd $workspace
git clone https://github.com/$name/$repo.git

cd $name
mvn package # generate a war file named did-demo.war

# start docker
wrapdocker &
sleep 5

# create new docker image
docker build -t chennanfei/did-demo .

echo Successfully created a new docker image
