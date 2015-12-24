#!/bin/bash
# Update script for Rangitaki from version 1.0.0 to 1.2.0
echo "Downloading version 1.2.0..."
mkdir ./rbe-new
cd ./rbe-new || exit
wget -c https://github.com/mmk2410/Rangitaki/archive/v1.2.0.zip
unzip v1.2.0.zip
rm v1.2.0.zip
mv ./rangitaki-1.2.0/* ./
rm ./rangitaki-1.2.0
cd ../ || exit
mkdir rbe-tmp
echo "Updating RCC..."
cp ./rcc/password.php ./rbe-tmp/
rm -rf ./rcc
mv ./rbe-new/rcc ./
rm ./rcc/password.php
mv ./rbe-tmp/password.php ./rcc/
echo "Updating ressources..."
rm -rf ./res
mv ./rbe-new/res ./
echo "Updating core..."
rm ./index.php
mv ./rbe-new/index.php ./
echo "Updating themes..."
rm ./themes/material-light.css
mv ./rbe-new/themes/material-light.css ./themes
echo "Creating empty extension directory..."
mkdir ./extensions
echo "Update themes..."
rm ./themes/background-img.css
rm ./themes/material-dark.css
rm ./themes/material-light.css
mv ./rbe-new/themes/background-img.css ./themes/
mv ./rbe-new/themes/material-dark.css ./themes/
mv ./rbe-new/themes/material-light.css ./themes/
echo "Update config file..."
echo "// pagination: how many articles should be on one page" >> ./config.php
echo "// set to 0 to disable it" >> ./config.php
echo "\$pagination = 0;" >> ./config.php
echo "Update languages..."
rm ./lang/en.php
rm ./lang/de.php
mv ./rbe-new/lang/en.php ./lang/
mv ./rbe-new/lang/de.php ./lang/
echo "Cleaning up..."
rm -rf ./rbe-new
rm -rf ./rbe-tmp
echo "Done!"
