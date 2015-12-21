#!/bin/bash
# Script for updating Rangitaki 1.1.2 to 1.1.90
# WARNING: Rangitaki 1.1.90 is for testing purposes only
echo "WARNING: You're about to install a testing version of Rangitaki."
read -r -p "Do you want to continue? (y/N) " answer
if [[ "$answer" == "y" || "$answer" == "Y"  ]]; then
    echo "Getting the up-to-date version..."
    mkdir ./rbe-new
    cd ./rbe-new || exit
    wget -q -c https://github.com/mmk2410/Rangitaki/archive/v1.1.90.zip
    unzip -qq v1.1.90.zip
    rm v1.1.90.zip
    mv ./rangitaki-1.1.90/* ./
    rm -rf ./rangitaki-1.1.90
    cd ../ || exit
    echo "Updating ressources..."
    rm -rf ./res
    mv ./rbe-new/res ./
    echo "Update languages..."
    rm ./lang/en.php
    rm ./lang/de.php
    mv ./rbe-new/lang/en.php ./lang/
    mv ./rbe-new/lang/de.php ./lang/
    echo "Update themes..."
    rm ./themes/background-img.css
    rm ./themes/material-dark.css
    rm ./themes/material-light.css
    mv ./rbe-new/themes/background-img.css ./themes/
    mv ./rbe-new/themes/material-dark.css ./themes/
    mv ./rbe-new/themes/material-light.css ./themes/
    echo "Cleaning up..."
    rm -rf ./rbe-new
    echo "Done!"
fi
