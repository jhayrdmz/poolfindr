# Poolfindr

## Project pre-requisite

1. Docker
2. IDE Tool ( VSCode, JetBrains, SublimeTxt or Any Text Editor Tool).

## Installation Guide & Instructions

1. Clone or pull project docker repository.

   ```shell
    git clone [REPO LINK HERE]
   ```

2. Go to project directory.

   ```shell
    cd poolfindr
   ```

3. Copy environment variables

   ```shell
   cp .env.example .env
   ```

4. Build API and Front docker containers \
   API

   ```shell
   cd apps/poolfindr-backend
   docker build -t poolfindr-backend .
   ```

   Frontend

   ```shell
   cd apps/poolfindr-frontend
   docker build -t poolfindr-frontend .
   ```

5. Run All Containers

   ```shell
   docker-compose up -d
   ```

6. Verify all running containers

   ```shell
   docker ps
   ```

7. Migrate database

   ```shell
   docker exec -it poolfindr-backend /bin/bash
   php artisan migrate:fresh
   ```

8. URLs - Backend: `http://localhost:8000` , Frontend: `http://localhost:3000`
