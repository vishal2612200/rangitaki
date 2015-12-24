#!/bin/bash
# Script for updating Rangitaki 1.1.90 to 1.2.0
echo "Getting the up-to-date version..."
mkdir ./rbe-new
cd ./rbe-new || exit
wget -q -c https://github.com/mmk2410/Rangitaki/archive/v1.2.0.zip
unzip -qq v1.1.2.0.zip
rm v1.2.0.zip
mv ./rangitaki-1.2.0/* ./
rm -rf ./rangitaki-1.2.0
cd ../ || exit
echo "Updating core"
rm ./index.php
mv ./rbe-new/index.php ./
echo "Cleaning up..."
rm -rf ./rbe-new
echo "Done!"
