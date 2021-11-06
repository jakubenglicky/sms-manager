cs:
	vendor/bin/phpcs src/ tests --standard=vendor/pd/coding-standard/src/PeckaCodingStandard/ruleset.xml

unit-tests:
	vendor/bin/tester -C tests/

phpstan:
	vendor/bin/phpstan analyse -l 8 src/

