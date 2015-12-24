#!/bin/bash
# Script for updating Rangitaki 1.1.0 to 1.1.1
# WARNING: Rangitaki 1.1.1 is for testing purposes only
echo "WARNING: You're about to install a testing version of Rangitaki."
read -r -p "Do you want to continue? (y/N) " answer
if [[ "$answer" == "y" || "$answer" == "Y"  ]]; then
    # Getting the up to date version
    mkdir ./rbe-new
    cd ./rbe-new || exit
    wget -c https://github.com/mmk2410/Rangitaki/archive/v1.1.1.zip
    unzip v1.1.1.zip
    rm v1.1.1.zip
    mv ./rangitaki-1.1.1/* ./
    rm -rf ./rangitaki-1.1.1
    cd ../ || exit
    # Creating temporary directory
    mkdir rbe-tmp
    # Updating rcc
    cp ./rcc/password.php ./rbe-tmp/
    rm -rf ./rcc
    mv ./rbe-new/rcc ./
    mv ./rbe-tmp/password.php ./rcc/
    # Updating ressources
    rm -rf ./res
    mv ./rbe-new/res ./
    # Updating index.php
    rm ./index.php
    mv ./rbe-new/index.php ./
    # creating empty extension directory
    mkdir ./extensions
    # cleaning up
    rm -rf ./rbe-new
    rm -rf ./rbe-tmp
fi
