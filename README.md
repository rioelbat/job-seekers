# Job Seekers Platform

## Description

```
Registration involves the society platform (registering to the platform and applying for jobs), the company platform (giving jobs, viewing and accepting/rejecting registrations from the society), and the officer platform (updating company data, checking the validity of society data).

This module is only to create a society platform. Your job is creating a Society Job application REST API using one of provided PHP frameworks (Laravel).
```

This is a solution for a challenge from vocational school skill competition in 2023 to create REST API for a Society Job application.

## Specification

Laravel: ^10

## Prerequisite

-   Sample data: db-dump.sql
-   Sample API Call test: job_seekers.postman_collection.json & job_seekers.postman_environment.json

## Installation

For installation is using sail to contain this application to minimized the installation process

1. Copy the project and install dependencies to the local

```
git clone https://github.com/rioelbat/job-seekers-api.git
cd job-seekers-api
composer update
```

2. Set .env for local project

```
copy .env.example .env
```

3. Execute sail for the project

```
./vendor/bin/sail up
```

4. Prepare the database

```
./vendor/bin/sail mysql -u root -p job_seeker < prerequisite/db-dump.sql
```

## Problems and The Solution

-   [x] [A1 - Login and Logout as society](https://github.com/rioelbat/job-seekers-api#a1---login-and-logout-as-society)
-   [x] [A2 - Request Data Validation](https://github.com/rioelbat/job-seekers-api#a2---request-data-validation)
-   [x] [A3 – Job Vacancy](https://github.com/rioelbat/job-seekers-api#a3---job-vacancy)
-   [x] [A4 – Applying for Jobs](https://github.com/rioelbat/job-seekers-api#a4---applying-for-jobs)

### A1 - Login and Logout as society

-   [x] A1a - Society Login & If login success

-   [x] A1b - Society Login & If ID Card Number or Password incorrect

-   [x] A1c - Society Logout & If logout success

-   [x] A1d - Society Logout & If logout invalid token

### A2 - Request Data Validation

-   [x] A2a - Request data validations & If request data validation success

-   [x] A2b - Request data validations & If invalid token

-   [x] A2c - Get society data validation & If success

-   [x] A2d - Get society data validation & If invalid token

### A3 – Job Vacancy

-   [x] A3a - Get all job vacancy by choosen job category & If success

-   [x] A3b - Get all job vacancy by choosen job category & If invalid token

-   [x] A3c - Get job vacancy detail by vacancy ID and date & If success

-   [x] A3d - Get job vacancy detail by vacancy ID and date & If invalid token

### A4 – Applying for Jobs

-   [x] A4a - Applying for jobs & If success

-   [x] A4b - Applying for jobs & If invalid token

-   [x] A4c - Applying for jobs & If the society validation data hasn’t accepted by validator

-   [x] A4d - Applying for jobs & If invalid fields

-   [x] A4e - Applying for jobs & If have been 2x applying

-   [x] A4f - Get all of society job applications & If success

-   [x] A4d - Get all of society job applications & If invalid token
