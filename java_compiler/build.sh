#!/bin/bash
set -e

name="chennanfei"
repo="NFJava"
image="nanfei/$repo"
time=`date +%s`

workspace="$WS/$name"
mkdir $workspace

cd $workspace
git clone https://github.com/$name/$repo.git

cd $repo
mvn package # generate a war file named did-demo.war

# start docker
wrapdocker &
sleep 5

# create new docker image
docker build -t $image .

echo Successfully created a new docker image
