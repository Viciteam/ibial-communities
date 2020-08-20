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
        {
            "invitee": 1,
            "team_id": 1,
            "connection": [
                {
                    "user_id": 1,
                    "position": "Lead Dev"
                },
                {
                    "user_id": 2,
                    "position": "Developer"
                }
            ]
        }
    - Output: 
- [x] DisConnect
    - URL: `/api/teams/uninvite`
    - Method: {+ POST +}
    - Parameters:
        {
            "users": [4]
        }
    - Output: 
- [x] Add Teams Info
    - URL: `/api/teams/add`
    - Method: {+ POST +}
    - Parameters:
        {
            "business_id": 1,
            "name": "Team 1 - front end",
            "description": "Developlent for team 1",
            "created_by": 1,
            "attributes": {
                "privacy": "open"
            }
        }
    - Output: 
- [x] Roles & permissions
    - URL: `/api/manage/`
    - Method: {+ POST +}
    - Parameters:
        {
            "roles": [
                {
                    "member_id": 3,
                    "change_to": "leader"
                },
                {
                    "member_id": 4,
                    "change_to": "junior"
                }
            ],
            "permissions": [
                {
                    "member_id": 4,
                    "change_to": "editor"
                }
            ]
        }
    - Output: 
- [x] Members
    - URL: `/api/teams/members`
    - Method: {- GET -}
    - Parameters:
        {
            "team": 1,
            "filter": {
                "role": "leader",
                "permission": "editor"
            }
        }	
    - Output: 


