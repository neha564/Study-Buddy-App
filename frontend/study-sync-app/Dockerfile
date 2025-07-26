# Use the official Node.js image for building the app
FROM node:18 AS build

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to install dependencies
COPY package*.json ./

# Install the app dependencies
RUN npm install

# Copy the rest of the application files
COPY . .

# Build the Vue.js application
RUN npm run build

# Use Nginx to serve the application
FROM nginx:alpine

# Copy the build output to the Nginx server's public folder
COPY --from=build /app/dist /usr/share/nginx/html

# Expose port 80 to access the app
EXPOSE 80

# Start Nginx when the container runs
CMD ["nginx", "-g", "daemon off;"]
