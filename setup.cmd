#!/bin/bash
# Windows CMD/PowerShell equivalent: setup.cmd

@echo off
REM Setup script for Prendas de Natal with Dracula Theme

echo.
echo ========================================
echo  Prendas de Natal - Setup Dracula
echo ========================================
echo.

REM Colors (approximation for Windows)
echo [STEP 1] Installing PHP dependencies...
call composer install

echo.
echo [STEP 2] Installing NPM dependencies...
call npm install

echo.
echo [STEP 3] Building assets...
call npm run build

echo.
echo [STEP 4] Setting up database...
if not exist .env (
    copy .env.example .env
)

echo.
echo [STEP 5] Generating app key...
php artisan key:generate

echo.
echo [STEP 6] Running migrations...
php artisan migrate

echo.
echo ========================================
echo  Setup completo!
echo ========================================
echo.
echo Proximos passos:
echo.
echo 1. Inicie o servidor Laravel:
echo    php artisan serve
echo.
echo 2. Em outro terminal, compile assets em tempo real:
echo    npm run dev
echo.
echo 3. Acesse http://localhost:8000
echo.
echo Aproveite o novo design Dracula!
echo.
pause
