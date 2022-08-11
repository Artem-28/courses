FROM node:lts-alpine

COPY . /app

WORKDIR /app

RUN npm install

EXPOSE 3003

CMD ["npm", "run", "serve"]
