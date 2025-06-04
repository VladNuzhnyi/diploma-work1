FROM node:10-alpine

RUN apk add --no-cache python2 make g++ 

WORKDIR /app
COPY ./frontend/package*.json ./
RUN npm install

COPY ./frontend .

EXPOSE 8081

CMD ["npm", "run", "serve"]
