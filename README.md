## GitHub statistic app

## Requirements

Docker, docker-compose

## Installation

clone `git clone https://github.com/artemlukianov/github-statistic.git`

init `./bin/init.sh`

## Usage

Enter to container `docker-compose exec app bash`

## Doc url

http://localhost:8080/api/doc.json

## Test curls
-----------------
User info <br />
`curl 'http://localhost:8080/api/statistics/compare?items[]=ng-book2/code&items[]=dgadiraju/code'` <br />


