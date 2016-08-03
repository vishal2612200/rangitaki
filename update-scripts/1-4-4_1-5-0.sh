#!/bin/bash
# Update script for Rangitaki from version 1.4.4 to 1.5.0

version="1.5.0"
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

echo -n "Updating languages... "
rm -rf ./lang/de.php
rm -rf ./lang/en.php
mv $new/lang/* ./lang/
echo "done"

echo -n "Updating source files... "
rm ./src/sass/rangitaki.sass
mv $new/src/sass/rangitaki.sass ./src/sass/
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
rm ./themes/nextDESIGN.css*
mv $new/themes/* ./themes/
echo "done"

echo -n "Updating npm... "
mv $new/package.json ./
echo "done"

echo -n 'Updating config script... '
echo "social:" >> ./config.yaml
echo "    twitter: ''" >> ./config.yaml
sed -i "s/design:/design:\n    excerpt: 'off'/" config.yaml
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
echo "Run php ./bin/init.php to use set the values for the new features."
