FROM nginx:1.21.4

USER root

RUN apt-get update && apt-get -y --no-install-recommends install \
    wget  \
    make  \
    build-essential  \
    manpages-dev  \
    libpcre3-dev  \
    zlib1g-dev  \
    libssl-dev  \
    libxslt-dev  \
    libgd-dev  \
    libgeoip-dev  \
    libperl-dev

RUN mkdir /tmp/naxsi && cd /tmp/naxsi \
    && wget https://github.com/nbs-system/naxsi/archive/refs/tags/1.3.tar.gz \
    && tar -xzf 1.3.tar.gz

COPY naxsi/MakeFile /tmp/naxsi/naxsi-1.3/naxsi_src/Makefile

RUN cd /tmp/naxsi/naxsi-1.3/naxsi_src && make

RUN cd /tmp/nginx \
    && ./configure \
    --with-compat \
    --add-dynamic-module=/tmp/naxsi/naxsi-1.3/naxsi_src \
    && make modules

RUN cp /tmp/nginx/objs/ngx_http_naxsi_module.so /etc/nginx/modules

CMD ["/bin/sh", "-c", "nginx -g 'daemon off;'"]