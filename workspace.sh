#!/bin/bash

cd docker_origami_review_api
docker-compose exec --user 1000 workspace bash
cd ..
