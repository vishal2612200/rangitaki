#!/bin/bash
# Update script for Rangitaki from version 1.2.0 to 1.2.1
echo "Downloading version 1.2.1..."
mkdir ./rbe-new
cd ./rbe-new || exit
wget -c https://github.com/mmk2410/Rangitaki/archive/v1.2.1.zip
unzip v1.2.1.zip
rm v1.2.1.zip
mv ./rangitaki-1.2.1/* ./
rm ./rangitaki-1.2.1
cd ../ || exit
mkdir rbe-tmp
echo "Updating ressources..."
rm -rf ./res/php/
mv ./rbe-new/res/php ./res/
echo "Cleaning up..."
rm -rf ./rbe-new
rm -rf ./rbe-tmp
echo "Done!"
