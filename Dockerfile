FROM richarvey/php-apache-heroku:latest

# Laravelのファイルをコピー
COPY . /var/www/html

# 権限の設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 公開ディレクトリの設定
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1

# ポートの設定
EXPOSE 80