#!/bin/bash
# Update script for Rangitaki from version 1.4.0 to 1.4.1

version="1.4.1"
new="./rbe-new"

echo -n "Downloading version $version from GitLab... "
git clone -q https://gitlab.com/mmk2410/rangitaki.git "$new"

if [[ $1 == "--debug" ]]; then
    cd $new
    git checkout master
    cd ../
fi
echo "done"

echo -n "Updating ressources... "
rm -rf ./res/
mv $new/res/ ./
echo "done"

echo -n "Updating binaries... "
rm -rf ./bin
mv $new/bin/ ./
echo "done"

echo -n "Updating source files... "
rm -rf ./src
mv $new/src/ ./
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

echo -n "Updating npm... "
mv $new/package.json ./
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
