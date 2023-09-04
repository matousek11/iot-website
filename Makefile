build-db:
	docker pull mysql && docker run -p 13306:3306 --name iot-mysql -e MYSQL_ROOT_PASSWORD=password -d mysql:latest
stop-db:
	docker stop iot-mysql
run-website:
	cd website && php yii serve --port=8080