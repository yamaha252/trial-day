FROM httpd

COPY vhost.conf conf/httpd.conf

RUN mkdir -p docs/assessment.devuser.jldev
RUN chown -R www-data:www-data docs/assessment.devuser.jldev

COPY index.html docs/assessment.devuser.jldev/

RUN chmod 755 docs/assessment.devuser.jldev/index.html
