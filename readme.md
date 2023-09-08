# About

PHP website with database for internet of things.

# How to run

1. Run docker
2. Run `make build-db`
3. Create database with name `iot-mysql`
4. Run `php yii migrate`
5. Run `make run-website`

# Functions

## New json measurement insertion

In order to be able to post request with new measurement obtain csrf token on url `api/get-token` and add it as a header into post request like this:

- key: `X-CSRF-Token`
- value: `{obtained token}`

Send post request on `api/insert-data?id={sensorId}`.

#### Structure of JSON request:

| name        | type              |
| ----------- | ----------------- |
| temperature | float             |
| humidity    | float             |
| time        | unix(int) or null |

`{"temperature": 20.3, "humidity": 74.6, "time": 654561561}`

## Temperature average from sensor

To get json response with average temperature on specific sensor use url `api/temperature-average?id={sensorId}`.

response: `{"average":58.333333333333336}`

## Average temperature command

To get average temperature on sensor from last 24 hours type `php yii sensor/average {sensorId}`.
