FROM node:22-alpine3.20 AS base

# install pnpm
RUN wget -qO- https://get.pnpm.io/install.sh | PNPM_VERSION="9.15.2" ENV="$HOME/.shrc" SHELL="$(which sh)" sh - \
    && export PATH="/root/.local/share/pnpm:$PATH" \
    && pnpm -v

# Make pnpm available globally
ENV PATH="/root/.local/share/pnpm:$PATH"

RUN apk add --no-cache bash make
