define deploy-c
	docker-compose exec -T app bash -c
endef

define nginxproxy-c
	docker-compose -f docker-compose-nginxproxy.yml exec -T app bash -c
endef

init:
	docker-compose build --no-cache
	docker-compose up -d
	$(deploy-c) 'composer install'
	$(deploy-c) 'touch database/database.sqlite'
	$(deploy-c) 'chmod 777 -R storage bootstrap/cache database'
	$(deploy-c) 'php artisan migrate:refresh --seed'
up:
	docker-compose up -d
down:
	docker-compose down
bash:
	docker-compose exec app bash
mysql:
	docker-compose exec mysql bash -c 'mysql -u root -proot docker_db'

nginxproxy-up:
	docker-compose -f docker-compose-nginxproxy.yml up -d
nginxproxy-ps:
	docker-compose -f docker-compose-nginxproxy.yml ps
nginxproxy-down:
	docker-compose -f docker-compose-nginxproxy.yml down
nginxproxy-bash:
	docker-compose -f docker-compose-nginxproxy.yml exec app bash
nginxproxy-init:
	docker-compose -f docker-compose-nginxproxy.yml build --no-cache
	docker-compose -f docker-compose-nginxproxy.yml up -d
	$(nginxproxy-c) 'composer install'
	$(nginxproxy-c) 'touch database/database.sqlite'
	$(nginxproxy-c) 'chmod 777 -R storage bootstrap/cache database'
	$(nginxproxy-c) 'php artisan migrate:refresh --seed'
