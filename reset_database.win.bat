@echo off
php spark migrate:rollback
php spark migrate
php spark db:seed AkunSeeder
php spark db:seed QrCodeSeeder
php spark db:seed VideoSeeder
php spark db:seed ActivitySeeder
php spark db:seed MarqueeTextSeeder
php spark db:seed TompelSeeder