#!/bin/bash
# Update script for Rangitaki from version 1.4.0 to 1.4.1

version="1.4.2"
new="./rbe-new"

echo -n "Downloading version $version from GitLab... "
git clone -q https://gitlab.com/mmk2410/rangitaki.git "$new"

if [[ $1 == "--debug" ]]; then
    cd $new
    git checkout master
    cd ../
fi
echo "done"

echo -n "Updating RCC... "
mv ./rcc/password.php ./
rm -rf ./rcc
mv $new/rcc ./
rm ./rcc/password.php
mv ./password.php ./rcc/
echo "done"

echo -n "Updating Changelog... "

if [ -f ./CHANGELOG.txt ]; then
    rm CHANGELOG.txt
fi

mv $new/CHANGELOG.md ./
echo "done"

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

echo "$version" > ./VERSION

echo "Your Rangitaki installation is updated to version $version"
