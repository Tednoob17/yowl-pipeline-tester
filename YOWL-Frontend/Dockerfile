FROM node:22.6.0 AS build-stage
WORKDIR /app
COPY . .
RUN npm install
CMD ["npm", "run", "dev", "--", "--host"]

