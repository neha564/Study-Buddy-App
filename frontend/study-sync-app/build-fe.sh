#!/bin/bash

# Navigate to the frontend directory
cd frontend/study-sync-app

# Build the Docker image for the frontend
echo "Building the frontend Docker image..."
docker build -t studysync-frontend .

# Run the Docker container for the frontend
echo "Running the frontend container..."
docker run -d --name studysync-frontend -p 8080:80 studysync-frontend

# Show running containers
docker ps
