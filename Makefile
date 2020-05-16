
init:
	docker-compose up -d && docker-compose exec php composer create-project symfony/skeleton ./

start:
	docker-compose up -d

stop: 
	docker-compose down

remove:
	docker-compose down && docker system prune -af && rm -rf src && rm -rf data 
