FROM fedora:42

RUN dnf install -y \
    mediawiki \
    postgresql \
    postgresql-devel \
    php-pgsql \
    php-intl \
    httpd \
    php-fpm \
    bash-completion \
    vim \
    && dnf clean all

# apache configuration for mediawiki
COPY container/mediawiki.conf /etc/httpd/conf.d/mediawiki.conf

# directory for the fedora skin
RUN mkdir -p /usr/share/mediawiki/skins/Fedora

COPY Fedora/ /usr/share/mediawiki/skins/Fedora/

EXPOSE 80

# entrypoint script
COPY container/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/sbin/httpd", "-DFOREGROUND"]
