# 1行目は必ずこれだけにしてください（余計なFROMは消す）
FROM php:8.4-apache

# 必要なツール（unzipなど）をインストール
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Apacheのドキュメントルート（公開フォルダ）をLaravelのpublicに変更
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ApacheのRewriteモジュールを有効にする
RUN a2enmod rewrite

# アプリのファイルをコピー
COPY . /var/www/html

# Composerをインストールして実行
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 権限の設定
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ポートの設定
EXPOSE 80