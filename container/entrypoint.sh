#!/bin/bash
set -e

echo "Waiting for PostgreSQL to be ready..."
until PGPASSWORD="$DB_PASSWORD" psql -h "$DB_HOST" -U "$DB_USER" -d postgres -c '\q' 2>/dev/null; do
	>&2 echo "PostgreSQL is unavailable - sleeping"
	sleep 2
done

>&2 echo "PostgreSQL is up - continuing"

# Install MediaWiki if LocalSettings.php doesn't exist
if [ ! -f /usr/share/mediawiki/LocalSettings.php ]; then
		echo "Installing MediaWiki..."
		php /usr/share/mediawiki/maintenance/install.php \
				--server "${SERVER}" \
				--scriptpath /w \
				--dbuser "$DB_USER" \
				--dbpass "$DB_PASSWORD" \
				--confpath /usr/share/mediawiki \
				--dbname "$DB_NAME" \
				--dbport "${DB_PORT}" \
				--dbserver "$DB_HOST" \
				--dbtype postgres \
				--lang en \
				--pass "${ADMIN_PASSWORD}" \
				"${SITENAME}" \
				"${ADMIN_USER}"
    
		# Set the default skin to Fedora
		sed -i 's/vector-2022/fedora/g' /usr/share/mediawiki/LocalSettings.php
    
		# Add debug options (commented out)
		echo "# error_reporting( -1 );" >> /usr/share/mediawiki/LocalSettings.php
		echo "# ini_set( 'display_errors', 1 );" >> /usr/share/mediawiki/LocalSettings.php
    
		echo "MediaWiki installation complete!"
fi

# Start PHP-FPM in the background
echo "Starting PHP-FPM..."
mkdir -p /run/php-fpm
php-fpm -D

# Execute the main container command
exec "$@"
