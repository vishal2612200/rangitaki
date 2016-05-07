#!/bin/bash
# Update script for Rangitaki from version 1.3.0 to 1.4.0

version="1.4.0"
new="./rbe-new"

echo "Downloading version $version from GitLab..."
git clone https://gitlab.com/mmk2410/rangitaki.git "$new"

if [[ $1 == "--debug" ]]; then
    cd $new
    git checkout master
    cd ../
fi

echo "Updating ressources..."
rm -rf ./res/
mv $new/res/ ./

echo "Updating extensions..."
rm ./extensions/example.js
mv $new/extensions/* ./extensions/

echo "Importing binaries..."
mv $new/bin/ ./

echo "Importing source files..."
mv $new/src/ ./

echo "Updating extensions..."
rm ./themes/material-light.css
rm ./themes/material-dark.css
rm ./themes/background-img.css
mv $new/themes/* ./themes/

echo "Updating RCC..."
rm -rf ./rcc
mv $new/rcc ./
rm ./rcc/password.php

echo "Updating core..."
rm ./index.php
mv $new/index.php ./

echo "Preparing composer..."
rm -rf ./vendor/
rm composer.lock
rm composer.json
mv $new/vendor ./
mv $new/composer.lock ./
mv $new/composer.json ./

echo "Preparing npm..."
mv $new/package.json ./

echo "Updating Changelog..."

if [ -f ./CHANGELOG.txt ]; then
    rm CHANGELOG.txt
fi

mv $new/CHANGELOG.md ./

echo "Preparing gulp..."
mv $new/gulpfile.coffee ./

echo "Cleaning up..."
if [[  $1 != "--debug" ]]; then
    rm -rf $new
fi

echo "Update config file..."
php bin/config.php

if [ -d "./update-scripts" ]; then
    echo "Remove obsolete update scripts folder."
    rm -rf "./update-scripts"
fi

echo "Your Rangitaki installation is updated to version $version"
