#!/bin/bash
# Update script for Rangitaki from version 1.4.3 to 1.4.4

version="1.4.4"
new="./rbe-new"

echo -n "Downloading version $version from GitLab... "
git clone -q https://gitlab.com/mmk2410/rangitaki.git "$new"

if [[ $1 == "--debug" ]]; then
    cd $new
    git checkout -q master
    cd ../
fi
echo "done"

echo -n "Updating RCC... "
mv ./rcc/password.php ./password.php
rm -rf ./rcc/
mv $new/rcc ./
rm ./rcc/password.php
mv ./password.php ./rcc/password.php
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
