#!/bin/bash

cd laradock
docker-compose exec --user 1000 workspace bash
cd ..
