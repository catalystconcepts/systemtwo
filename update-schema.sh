#!/usr/bin/bash

# recreate database schema
app/console doctrine:database:drop --force
app/console doctrine:database:create
app/console doctrine:schema:update --force

# load data fixtures
app/console doctrine:fixtures:load
