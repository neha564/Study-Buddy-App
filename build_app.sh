#!/bin/bash

# Navigate to the root directory (ensure docker-compose.yml is there)
cd "$(dirname "$0")"

# Bring down any existing containers to ensure a fresh start
echo "Stopping and removing any existing containers..."
docker-compose down

# Build and start all services (backend, frontend, and MongoDB)
echo "Building and starting all services (Backend, Frontend, MongoDB)..."
docker-compose up --build -d

# Check if the containers are running
echo "Checking running containers..."
docker ps
