#!/bin/bash

# Stripe Webhook Setup Script for Laravel Herd
# Ez a script elindítja a Stripe CLI webhook listener-t

echo "🚀 Stripe Webhook Setup (Laravel Herd)"
echo "======================================"
echo ""

# Detect Herd domain
PROJECT_NAME="subscriber"
HERD_DOMAIN="${PROJECT_NAME}.test"
WEBHOOK_URL="https://${HERD_DOMAIN}/stripe/webhook"

echo "📦 Projekt: $PROJECT_NAME"
echo "🌐 Herd URL: $HERD_DOMAIN"
echo "🔗 Webhook: $WEBHOOK_URL"
echo ""

# Check if Stripe CLI is installed
if ! command -v stripe &> /dev/null
then
    echo "❌ Stripe CLI nincs telepítve!"
    echo ""
    echo "Telepítsd így:"
    echo "  brew install stripe/stripe-cli/stripe"
    echo ""
    exit 1
fi

echo "✅ Stripe CLI megtalálva!"
echo ""

# Check if user is logged in
if ! stripe config --list &> /dev/null 2>&1
then
    echo "🔐 Még nem vagy bejelentkezve a Stripe CLI-be."
    echo "   Jelentkezz be most..."
    echo ""
    stripe login
fi

echo ""
echo "📡 Webhook listener indítása..."
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "⚠️  FONTOS:"
echo "   1. Másold ki a 'webhook signing secret' értéket"
echo "   2. Formátum: whsec_xxxxxxxxxxxxxxxxxxxxx"
echo "   3. Add hozzá a .env fájlhoz:"
echo "      STRIPE_WEBHOOK_SECRET=whsec_xxxxxxxxxxxxxxxxxxxxx"
echo ""
echo "💡 Másik terminálban teszteld:"
echo "   stripe trigger customer.subscription.created"
echo "   stripe trigger checkout.session.completed"
echo ""
echo "📋 Logokat nézd:"
echo "   tail -f storage/logs/laravel.log"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# Start listening (skip certificate verification for local development)
stripe listen --forward-to "$WEBHOOK_URL" --skip-verify

# This will keep running until Ctrl+C is pressed
