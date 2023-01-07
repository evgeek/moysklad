THIS_FILE := $(lastword $(MAKEFILE_LIST))

.PHONY: help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

# PHP CS Fixer
lint-csf: ## php-cs-fixer fix all (p= for additional params)
	php ./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix -v --allow-risky=yes $(p)
lint-csf-fix: ## php-cs-fixer fix all
	make lint-csf p="--diff"
lint-csf-fix-step: ## php-cs-fixer fix by step
	make lint-csf p="--diff --stop-on-violation"
lint-csf-dry: ## php-cs-fixer dry run all without diff
	make lint-csf p="--diff --dry-run"
lint-csf-dry-list: ## php-cs-fixer dry run by step
	make lint-csf p="--dry-run"
lint-csf-dry-step: ## php-cs-fixer dry run by step
	make lint-csf p="--diff --dry-run --stop-on-violation"

# PHPStan
phpstan: # Run PHPStan
	vendor/bin/phpstan analyse --xdebug

# PHPUnit
test-run: ## Run all tests
	@make mk-test-run t=all
test-coverage: ## Run all tests with coverage report
	@make mk-test-coverage t=all
test-unit-run: ## Run unit tests
	@make mk-test-run t=unit
test-unit-coverage: ## Run unit tests with coverage report
	@make mk-test-coverage t=unit p="--strict-coverage"
test-feature-run: ## Run feature tests
	@make mk-test-run t=feature
test-feature-coverage: ## Run feature tests with coverage report
	@make mk-test-coverage t=feature

# Inner commands
mk-test-run: ## Run testsuite tests
	./vendor/bin/phpunit --testsuite $(t) $(p)
mk-test-coverage: ## Run testsuite coverage
	XDEBUG_MODE=coverage ./vendor/bin/phpunit --coverage-text --coverage-clover .phpunit.cache/clover.xml --coverage-html .phpunit.cache/htmlreport --testsuite $(t) $(p)