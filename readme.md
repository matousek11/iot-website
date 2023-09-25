![Landing page screenshot](img/landing_page.png)

# Table of content

- [About](#about)
- [How to run](#how-to-run)
- [Functions](#functions)
  - [Pages](#pages)
    - [Landing page](#landing-page)
    - [Detail of sensor](#detail-of-sensor)
    - [User measurement insertion](#user-measurement-insertion)
  - [API](#api)
    - [JSON measurement insertion](#json-measurement-insertion)
    - [Temperature average from sensor](#temperature-average-from-sensor)
  - [Commands](#commands)
    - [Average temperature command](#average-temperature-command)

# About

PHP website with database for internet of things.

# How to run

1. Run docker
2. Make [.env](/.env.example) file
3. Run `docker compose up`
4. Set MIGRATION in .env to `true`
5. Run `php yii migrate`
6. Set MIGRATION in .env to `false`
7. Access website on port 8000

# Functions

## Pages

### Landing page

Displays list of all sensors in database.

### Detail of sensor

Takes id of sensor as parameter and displays last 20 measurements from sensor.

- url: `sensor/detail?id={sensorId}`

### User measurement insertion

Page with input form.

- url: `sensor/insert-data?id=1`

## API

### JSON measurement insertion

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

### Temperature average from sensor

To get json response with average temperature on specific sensor use url `api/temperature-average?id={sensorId}`.

response: `{"average":58.333333333333336}`

## Commands

### Average temperature command

To get average temperature on sensor from last 24 hours type `php yii sensor/average {sensorId}`.
