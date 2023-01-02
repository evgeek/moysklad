THIS_FILE := $(lastword $(MAKEFILE_LIST))

.PHONY: help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

#LINTERS
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