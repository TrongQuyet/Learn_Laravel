local-build:
	docker-compose -f docker-compose.yaml build

local-install:
	docker-compose -f docker-compose.yaml run --rm php composer install
	docker-compose -f docker-compose.yaml run --rm npm npm install

local-up:
	docker-compose -f docker-compose.yaml up -d --remove-orphans

local-down:
	docker-compose -f docker-compose.yaml down
