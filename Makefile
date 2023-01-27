DOCKER_IMAGE_NAME ?= php:7.4-cli
MAKE_DIR := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
DOCKER_RUN := docker run --rm -v $(MAKE_DIR):/work --env NARAKEET_API_KEY -w /work  -eNARAKEET_API_KEY=$(NARAKEET_API_KEY)
RUN := $(DOCKER_RUN) $(DOCKER_IMAGE_NAME)

run:
	@[[ ! -z "$(NARAKEET_API_KEY)" ]] || (echo "NARAKEET_API_KEY not set" && exit 1)
	$(RUN) php audio.php
