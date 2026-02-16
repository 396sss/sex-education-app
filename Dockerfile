# PHP 8.2 と Apache が入った公式のイメージを使います
FROM php:8.2-apache

# 必要なツール（unzipなど）をインストール
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Apacheのドキュメントルート（公開フォルダ）をLaravelのpublicに変更
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ApacheのRewriteモジュールを有効にする（LaravelのURLを動かすのに必要）
RUN a2enmod rewrite

# アプリのファイルをコピー
COPY . /var/www/html

# Composer（PHPの部品管理ツール）をインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# フォルダの権限設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ポートの設定
EXPOSE 80