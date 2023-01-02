THIS_FILE := $(lastword $(MAKEFILE_LIST))

.PHONY: help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.DEFAULT_GOAL := help

#LINTERS
lint-csf: ## php-cs-fixer fix all (p= for additional params)
	php ./vendor/friendsofphp/php-cs-fixer/php-cs-fixer fix -v $(p)
lint-csf-dry: ## php-cs-fixer dry run
	make lint-csf p="--dry-run"