FROM node:20-slim as build-stage
ENV PNPM_HOME="/pnpm"
ENV PATH="$PNPM_HOME:$PATH"
RUN corepack enable
WORKDIR /app
RUN curl -fsSL https://get.pnpm.io/install.sh | sh -
COPY package*.json .
RUN pnpm install 
COPY . /app
RUN pnpm run build

FROM nginx:stable-alpine as production-stage
COPY --from=build-stage /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off"]
