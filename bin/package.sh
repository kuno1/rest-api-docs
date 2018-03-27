#!/usr/bin/env bash

echo "Build source..."
npm install
npm run package

echo "Build readme..."
curl -L https://raw.githubusercontent.com/fumikito/wp-readme/master/wp-readme.php | php

echo "Remove unwanted files."
dirs=(.git bower_components src bin node_modules .gitignore tests .travis.yml phpcs.ruleset.xml phpunit.xml.dist)
for dir in ${dirs[@]}; do
	echo "Remove $dir"
	rm -rf $dir
done


