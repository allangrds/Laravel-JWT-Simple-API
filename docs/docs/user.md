## Retrieve - `/user`


| Permission level  |   URL| Method  | Format   |  HTTP Status Code |
|---|---|---|---|---|
|  User |  `/user` |   `GET` |  `json` |  `200`, `401` |

#### Headers
|  Field | Content  |
|---|---|
|  Content-Type | application/json  |
|  Authorization | Bearer `{token}` |


#### Response Content
|  Field | Type  |Detail   |
|---|---|---|
|  `id`|  Integer |  User's id |
|  `name`|  String |  User's name |
|  `email`|  String |  User's email |
|  `email_verified_at`|  Datetime |  User's email verification datetime |
|  `created_at`|  Datetime |  User's created at |
|  `updated_at`|  Datetime |  User's updated at |

#### Example

**Event**: User `POST` to `/user`  
**Header Content**:
```
Content-Type: application/json
Authorization: Bearer {token}
```

**HTTP Status Code**: `201`  
**Response Content**:
```
{
    "id": 1,
    "name": "Allan",
    "email": "allan.ramos@pagar.me",
    "email_verified_at": null,
    "created_at": "2019-03-22 14:41:18",
    "updated_at": "2019-03-22 14:41:18"
}
```