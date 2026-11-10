# Usar una imagen oficial de Node.js ligera (Alpine Linux)
FROM node:18-alpine

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /app

# Copiar los archivos de dependencias
COPY package*.json ./

# Instalar solo las dependencias de producción
RUN npm install --omit=dev

# Copiar el resto de los archivos (server.js, los .html, etc.)
COPY . .

# Exponer el puerto 3000 (por defecto local)
EXPOSE 3000

# Comando para iniciar el servidor
CMD ["node", "server.js"]