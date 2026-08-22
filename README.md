# OmniBilling

**One billing interface. Many gateways.**

Stop rewriting your payment layer every time the business changes processor. OmniBilling gives Laravel a single, stable API for payments, subscriptions and customers — and swaps the gateway underneath by configuration.

```php
// The same call, whichever gateway is configured.
$subscription = Billing::customer($user)
    ->subscribe('pro-monthly')
    ->withTrial(14)
    ->create();
```

---

## Why this exists

Payment integrations rot in a predictable way. You wire Stripe directly into your controllers, then the business opens in a new market where Stripe is not available, and suddenly the payment logic is spread across forty files.

OmniBilling puts a boundary there. Your application talks to one interface; drivers translate to each provider.

| | |
|---|---|
| **Unified API** | Payments, subscriptions, customers and refunds behave the same across every driver. |
| **Swappable drivers** | Change gateway by configuration, not by rewriting the app. |
| **Laravel-native** | Facades, events, migrations and queued webhooks — nothing exotic to learn. |
| **Webhook handling** | Provider events normalised into a single set of Laravel events. |

## Available drivers

| Driver | Package |
|---|---|
| Stripe | [`innoboxrr/omni-billing-stripe`](https://github.com/innoboxrr/omni-billing-stripe) |
| PayPal | [`innoboxrr/omni-billing-paypal`](https://github.com/innoboxrr/omni-billing-paypal) |

Writing another driver means implementing one contract. Nothing in your application changes.

---

## Install

```bash
composer require innoboxrr/omni-billing
composer require innoboxrr/omni-billing-stripe   # pick your driver
php artisan vendor:publish --tag=omni-billing-config
php artisan migrate
```

Set the active driver in `config/omni-billing.php` or via `OMNI_BILLING_DRIVER` in `.env`.

---

## Built by

[Innobox R&R](https://github.com/innoboxrr) — extracted from production billing systems, not written speculatively. Part of a catalogue of 52 open-source packages on Packagist and npm.

**[innobox.systems](https://innobox.systems)**
