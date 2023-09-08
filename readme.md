# About

PHP website with database for internet of things.

# How to run

1. Run docker
2. Run `make build-db`
3. Create database with name `iot-mysql`
4. Run `php yii migrate`
5. Run `make run-website`

# Functions

## Average temperature command

To get average temperature on sensor from last 24 hours type `php yii sensor/average {id}`.
