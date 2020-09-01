FROM node:12.16.1

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY front/package.json ./
COPY front/package-lock.json ./
RUN npm install --silent

COPY ./front ./

CMD ["npm", "start"]