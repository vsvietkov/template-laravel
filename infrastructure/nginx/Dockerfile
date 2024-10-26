FROM nginx:1.27-alpine AS base

COPY /infrastructure/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

FROM base AS development

EXPOSE 80
STOPSIGNAL SIGTERM
CMD ["nginx", "-g", "daemon off;"]
