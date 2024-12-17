# Postman Examples for Order API

## Base URL
`http://your-api-domain.com/api` (Replace with your actual API domain)

### Authentication
All endpoints require the user to be authenticated. Include the Bearer token in the `Authorization` header.

```
Authorization: Bearer <your_access_token>
```

---

## Endpoints

### 1. List All Orders
**Endpoint:** `GET /orders`

**Headers:**
```
Authorization: Bearer <your_access_token>
Content-Type: application/json
```

**Response Example:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "order_number": "c7b9d8c8-44f5-45db-aef8-123456789abc",
            "status": "pending",
            "total_amount": 150.5,
            "shipping_amount": 10.0,
            "tax_amount": 5.0,
            "discount_amount": 0.0,
            "created_at": "2024-12-17T10:00:00Z"
        }
    ]
}
```

---

### 2. Get a Specific Order
**Endpoint:** `GET /orders/{id}`

**Headers:**
```
Authorization: Bearer <your_access_token>
Content-Type: application/json
```

**Response Example:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "order_number": "c7b9d8c8-44f5-45db-aef8-123456789abc",
        "status": "pending",
        "total_amount": 150.5,
        "shipping_amount": 10.0,
        "tax_amount": 5.0,
        "discount_amount": 0.0,
        "shippingAddress": {
            "id": 1,
            "address_line_1": "123 Main St",
            "city": "New York",
            "zip_code": "10001"
        },
        "billingAddress": {
            "id": 2,
            "address_line_1": "456 Elm St",
            "city": "Boston",
            "zip_code": "02118"
        },
        "orderItems": [
            {
                "id": 1,
                "product_id": 3,
                "quantity": 2,
                "price_per_unit": 50.0,
                "total_price": 100.0
            }
        ]
    }
}
```

---

### 3. Place a New Order
**Endpoint:** `POST /orders`

**Headers:**
```
Authorization: Bearer <your_access_token>
Content-Type: application/json
```

**Request Body Example:**
```json
{
    "shipping_address_id": 1,
    "billing_address_id": 2,
    "total_amount": 150.5,
    "shipping_amount": 10.0,
    "tax_amount": 5.0,
    "discount_amount": 0.0,
    "notes": "Please deliver between 9 AM and 12 PM.",
    "order_items": [
        {
            "product_id": 3,
            "quantity": 2,
            "price_per_unit": 50.0
        },
        {
            "product_id": 5,
            "quantity": 1,
            "price_per_unit": 45.5
        }
    ]
}
```

**Response Example:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "order_number": "c7b9d8c8-44f5-45db-aef8-123456789abc",
        "status": "pending",
        "total_amount": 150.5,
        "shipping_amount": 10.0,
        "tax_amount": 5.0,
        "discount_amount": 0.0,
        "created_at": "2024-12-17T10:00:00Z"
    }
}
```

---

### 4. Update Order Status
**Endpoint:** `PUT /orders/{id}`

**Headers:**
```
Authorization: Bearer <your_access_token>
Content-Type: application/json
```

**Request Body Example:**
```json
{
    "status": "shipped"
}
```

**Response Example:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "order_number": "c7b9d8c8-44f5-45db-aef8-123456789abc",
        "status": "shipped",
        "total_amount": 150.5,
        "created_at": "2024-12-17T10:00:00Z"
    }
}
```

---

## Notes
- Replace `{id}` in URLs with the actual order ID.
- Ensure that valid `shipping_address_id` and `billing_address_id` values exist in your database.
- Always include the `Authorization` header with a valid token.
- For invalid requests, the API responds with status codes `422` (validation error) or `404` (not found).

