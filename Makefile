THIS_FILE := $(lastword $(MAKEFILE_LIST))

.PHONY: help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

# PHP CS Fixer
lint-fix: ## php-cs-fixer fix all
	make lint p="--diff"
lint-fix-step: ## php-cs-fixer fix by step
	make lint p="--diff --stop-on-violation"
lint-dry: ## php-cs-fixer dry run all without diff
	make lint p="--diff --dry-run"
lint-dry-list: ## php-cs-fixer dry run by step
	make lint p="--dry-run"
lint-dry-step: ## php-cs-fixer dry run by step
	make lint p="--diff --dry-run --stop-on-violation"
lint: ## php-cs-fixer fix all (p= for additional params)
	php ./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix -v --allow-risky=yes $(p)

# PHPStan
phpstan: # Run PHPStan
	vendor/bin/phpstan analyse --xdebug

# PHPUnit
test-unit: ## Run unit tests. Use p= for specify additional params
	make test p="--testsuite unit $(p)"
test-unit-coverage: ## Run unit tests. Use p= for specify additional params
	make test-coverage p="--testsuite unit $(p)"
test-feature: ## Run feature tests
	make test p="--testsuite feature $(p)"
test-feature-coverage: ## Run unit tests. Use p= for specify additional params
	make test-coverage p="--testsuite feature $(p)"
test: ## Run all tests. Use f= for specify file; m= for specify method; p= for other params
	./vendor/bin/phpunit `if [ -z "$(m)" ]; then echo ""; else echo "--filter $m"; fi` $(f) $(p)
test-coverage: ## Run all tests with coverage report. Use p= for specify additional params
	XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text --coverage-clover .phpunit.cache/clover.xml --coverage-html .phpunit.cache/htmlreport $(p)