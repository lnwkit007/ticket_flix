# Build the application
FROM oven/bun:1.3.14
WORKDIR /app

# Copy package files and install dependencies
COPY package.json bun.lock ./
RUN bun install

# Copy the rest of the source code and build
COPY . .
RUN bun run build

# Expose port
EXPOSE 5173

# CMD to run the development server
CMD ["bun", "run", "dev"]