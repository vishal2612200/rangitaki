#!/bin/bash
# Update script for Rangitaki from version 1.4.2 to 1.4.3
# Also works from 1.4.0 to 1.4.3

version="1.4.3"
new="./rbe-new"

echo -n "Downloading version $version from GitLab... "
git clone -q https://gitlab.com/mmk2410/rangitaki.git "$new"

if [[ $1 == "--debug" ]]; then
    cd $new
    git checkout -q master
    cd ../
fi
echo "done"

echo -n "Updating ressources... "
rm -rf ./res/
mv $new/res/ ./
echo "done"

echo -n "Updating source files... "
rm ./src/coffee/app.coffee
mv $new/src/coffee/app.coffee ./src/coffee/
mv $new/src/sass-themes/nextDESIGN.sass ./src/sass-themes/
echo "done"

echo -n "Updating RCC... "
rm -rf ./rcc
mv $new/rcc ./
rm ./rcc/password.php
echo "done"

echo -n "Updating core... "
rm ./index.php
mv $new/index.php ./
echo "done"

echo -n "Updating binaries... "
rm -rf ./bin
mv $new/bin/ ./
echo "done"

echo -n "Updating themes... "
rm ./themes/material-light.css*
rm ./themes/material-dark.css*
rm ./themes/background-img.css*
mv $new/themes/* ./themes/
echo "done"

echo -n "Updating npm... "
mv $new/package.json ./
echo "done"

echo -n "Updating Changelog... "

if [ -f ./CHANGELOG.txt ]; then
    rm CHANGELOG.txt
fi

mv $new/CHANGELOG.md ./
echo "done"

echo -n "Cleaning up... "
if [[  $1 != "--debug" ]]; then
    echo -n "Cleaning up... "
    rm -rf $new
    echo "done"
fi

if [ -d "./update-scripts" ]; then
    echo -n "Remove obsolete update scripts folder... "
    rm -rf "./update-scripts"
    echo "done"
fi

echo "Your Rangitaki installation is updated to version $version"
