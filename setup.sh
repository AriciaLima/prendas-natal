#!/bin/bash

# Script para setup rápido do projeto com o tema Dracula

echo "🎄 Prendas de Natal - Setup Tema Dracula"
echo "========================================"
echo ""

# Cores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}📦 Instalando dependências...${NC}"
composer install
npm install

echo ""
echo -e "${BLUE}🏗️ Compilando assets...${NC}"
npm run build

echo ""
echo -e "${BLUE}🗄️ Configurando base de dados...${NC}"
cp .env.example .env 2>/dev/null || echo "✓ .env já existe"
php artisan key:generate 2>/dev/null || echo "✓ Chave já gerada"
php artisan migrate

echo ""
echo -e "${GREEN}✨ Setup completo!${NC}"
echo ""
echo -e "${YELLOW}Para iniciar o servidor:${NC}"
echo -e "  ${BLUE}php artisan serve${NC}"
echo ""
echo -e "${YELLOW}Para compilar assets em tempo real:${NC}"
echo -e "  ${BLUE}npm run dev${NC}"
echo ""
echo -e "${GREEN}🎉 Acesse http://localhost:8000${NC}"
