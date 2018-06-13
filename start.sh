#!/bin/bash

cd docker_origami_review_api
docker-compose up -d nginx mysql phpmyadmin redis php-worker ipfs
cd ..
