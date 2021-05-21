#!/usr/bin/env sh

set -e

cd `dirname $0`

vendor/bin/php-cs-fixer --using-cache=no fix --allow-risky=yes --config .php-cs-fixer.php "$@"
