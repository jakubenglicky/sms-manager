.PHONY: phpstan cs test phpunit

phpstan:
	./vendor/bin/phpstan analyse --level max src tests

cs:
	./vendor/bin/phpcs src tests

test:
	./vendor/bin/tester tests

phpunit:
	./vendor/bin/phpunit tests/ClientTestUnit.php --fail-on-deprecation
