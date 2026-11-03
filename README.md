# MarketGo: Flutter + PHP Multi-Vendor Mobile App

Flutter/Dart client and PHP/MySQL REST backend for buyer, seller and driver workflows.
The API is intentionally small and readable for a portfolio demonstration.

## Features
- Role-aware account model (buyer/seller/driver)
- Product catalogue API
- Seller-owned product CRUD API
- Buyer order creation and order history
- Driver assigned-order list and delivery status updates
- Flutter product listing and role dashboard navigation starter

## Setup
Import `database/marketgo.sql`, copy `backend/config/config.example.php` to `config.php`,
configure database credentials, and serve `backend/public` with Apache.
In `mobile/lib/services/api_client.dart`, set `baseUrl` for your emulator/device.
Run `flutter pub get`, then `flutter run`.

The sample auth uses database-backed bearer tokens. Production work should add token refresh/revocation,
email verification, rate limiting, server-side validation, image upload hardening and tests.
