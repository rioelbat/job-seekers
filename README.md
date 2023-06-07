# Job Seekers Platform

## Description

\*Registration involves the society platform (registering to the platform and applying for jobs), the company platform (giving jobs, viewing and accepting/rejecting registrations from the society), and the officer platform (updating company data, checking the validity of society data).

This module is only to create a society platform. Your job is creating a Society Job application REST API using one of provided PHP frameworks (Laravel).\*

This is a solution for a challenge from skill competition in 2023 to create REST API for a Society Job application.

## Specification

Laravel: ^10

## Prerequisites

Sample data: db-dump.sql
Sample API Call test: job_seekers.postman_collection.json & job_seekers.postman_environment.json

## Installation

For installation is using sail to contain this application to minimized the installation process

1. Copy the project and install dependencies

```
git clone https://github.com/rioelbat/job-seekers-api.git
cd job-seekers-api
composer update
```

2. Set .env

```
copy .env.example .env
```

3. Execute sail for this project

```
./vendor/bin/sail up
```

4. Prepare the database

```
./vendor/bin/sail mysql -u root -p job_seeker < prerequisite/db-dump.sql
```

## Problems and The Solution

-   [x] A1 - Login and Logout as society
-   [x] A2 - Request Data Validation
-   [x] A3 – Job Vacancy
-   [x] A4 – Applying for Jobs

### A1 - Login and Logout as society

### A2 - Request Data Validation

### A3 – Job Vacancy

### A4 – Applying for Jobs
