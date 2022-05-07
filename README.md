## GitHub statistic app

## Requirements

Docker, docker-compose

## Installation

clone `git clone https://github.com/artemlukianov/github-statistic.git`

init `./bin/init.sh`

## Doc url

http://localhost:8080/api/doc.json

## Test curls
-----------------
User info <br />
`curl 'http://localhost:8080/api/statistics/compare?items[]=ng-book2/code&items[]=dgadiraju/code'` <br />
Response:
`"data": {
    "closedPullRequestsDiff": "(ng-book2/code) 2 vs (dgadiraju/code) 7",
    "openPullRequestsDiff": "(ng-book2/code) 0 vs (dgadiraju/code) 3",
    "starsDiff": "(ng-book2/code) 190 vs (dgadiraju/code) 179",
    "forksDiff": "(ng-book2/code) 142 vs (dgadiraju/code) 590",
    "watchersDiff": "(ng-book2/code) 190 vs (dgadiraju/code) 179",
    "releaseDateDiff": "(ng-book2/code) null vs (dgadiraju/code) null"
}`


