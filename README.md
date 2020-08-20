<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

[[_TOC_]]

## About Businesss Microservice

Micro Service for business model and information

## Installation process

After Cloning Project:

- [x] git checkout develop
- [x] npm install
- [x] composer install
- [x] php artisan migrate
- [x] php artisan key:generate
- [x] php artisan passport:keys


##  Endpoints

- [x] Add Business Info
    - URL: `/api/company/add`
    - Method: {+ POST +}
    - Parameters:
        {
            "business_id": 1,
            "name": "Sample Company 1",
            "logo": "",
            "description": "this is a sample description",
            "hashtag": [
                "sample2Company",
                "GetMorePark"
            ],
            "location": "Davao City",
            "skills": [
                "vb.net",
                "laravel",
                "c++"
            ],
            "language": [
                "english",
                "thai",
                "filipino"
            ],
            "attributes": {
                "interest": [
                    "development",
                    "tech",
                    "sample"
                ]
            }
        }
    - Output: 
- [x] Suggested Hashtags
    - URL: `/api/hashtags/suggest`
    - Method: {- GET -}
    - Parameters:
        {
            "skills": [
                "laravel",
                "vb.net"
            ],
            "attributes": {
                "interest": [
                    "development",
                    "tech",
                    "sample"
                ]
            }
        }
    - Output: 
- [x] Connect
    - URL: `/api/teams/invite`
    - Method: {+ POST +}
    - Parameters:
    - Output: 
- [x] DisConnect
    - URL: `/api/teams/uninvite`
    - Method: {+ POST +}
    - Parameters:
    - Output: 
- [x] Add Teams Info
    - URL: `/api/teams/add`
    - Method: {+ POST +}
    - Parameters:
    - Output: 
- [x] Roles & permissions
    - URL: `/api/manage/`
    - Method: {+ POST +}
    - Parameters:
    - Output: 
- [x] Members
    - URL: `/api/teams/members`
    - Method: {- GET -}
    - Parameters:
    - Output: 


## DB Tables

list of DB tables

