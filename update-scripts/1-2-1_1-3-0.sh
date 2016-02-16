#!/bin/bash
# Update script for Rangitaki from version 1.2.1 to 1.3.0

version="1.3.0"
tmp="./rbe-tmp"
new="./rbe-new"
conf="./config.php"

echo "Downloading version $version from GitHub..."
mkdir $new
cd $new || exit
wget -c https://github.com/mmk2410/Rangitaki/archive/v"$version".zip

echo "Extracting"
unzip v"$version".zip
rm v"$version".zip
mv ./rangitaki-"$version"/* ./
rm ./rangitaki-"$version"
cd ../ || exit
mkdir $tmp

echo "Updating ressources..."
rm -rf ./res/php/
mv $new/res/php ./res/

echo "Updating RCC..."
cp ./rcc/password.php $tmp
rm -rf ./rcc
mv $new/rcc ./
rm ./rcc/password.php
mv $tmp/password.php ./rcc/

echo "Updating core..."
rm ./index.php
mv $new/index.php ./

echo "Preparing composer..."
mv $new/vendor ./
mv $new/composer.lock ./
mv $new/composer.json ./

echo "Creating empty feeds directory..."
mkdir ./feed

echo "Cleaning up..."
rm -rf $new
rm -rf $tmp

echo "Update config file..."
echo "// Blog URL - set here the url of your blog" >> $conf
echo -n 'Enter the blog URL:'
read -r url
echo "\$blogurl = \"$url\";" >> $conf

echo "Your Rangitaki installation is updated to version $version"
