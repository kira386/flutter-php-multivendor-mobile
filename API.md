# MarketGo API

Use JSON request bodies. Login provides a bearer token; pass it in the Authorization header.

- `POST /api/register.php`: name, email, password, role
- `POST /api/login.php`: email, password
- `GET /api/products.php`: public catalogue
- `POST /api/products.php`: seller creates product
- `DELETE /api/products.php?id=ID`: seller deletes own product
- `GET /api/orders.php`: buyer's or driver's orders
- `POST /api/orders.php`: buyer places an order using `{ "product_id": 1 }`
- `PATCH /api/driver_status.php`: driver sends `{ "order_id": 1, "status": "picked_up" }`

Flutter emulator base URL uses `10.0.2.2`; physical phones must use the development computer's LAN IP.
