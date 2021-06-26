COMPOSER      = composer
YARN          = yarn
PHP_CS_FIXER  = ./vendor/bin/php-cs-fixer
PHPSTAN       = ./vendor/bin/phpstan
PHP_UNIT      = ./vendor/bin/phpunit

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Coding standards ——————————————————————————————————————————————————————
analyse-php: ## Analyse PHP
	$(PHPSTAN) analyse

lint-php: ## Lint files with php-cs-fixer
	$(PHP_CS_FIXER) fix --dry-run

fix-php: ## Fix files with php-cs-fixer
	$(PHP_CS_FIXER) fix

lint-js: ## Lint file with eslint
	$(YARN) lint

fix-js: ## Fix files with eslint
	$(YARN) lint-fix

fix-all: fix-php fix-js ## Fix all files

test: ## Test app
	$(PHP_UNIT)