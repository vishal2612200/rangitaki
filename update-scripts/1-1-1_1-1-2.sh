#!/bin/bash
# Script for updating Rangitaki 1.1.0 to 1.1.1
# WARNING: Rangitaki 1.1.1 is for testing purposes only
echo "WARNING: You're about to install a testing version of Rangitaki."
read -r -p "Do you want to continue? (y/N) " answer
if [[ "$answer" == "y" || "$answer" == "Y"  ]]; then
    # Getting the up to date version
    mkdir ./rbe-new
    cd ./rbe-new || exit
    wget -c https://github.com/mmk2410/Rangitaki/archive/v1.1.2.zip
    unzip v1.1.2.zip
    rm v1.1.2.zip
    mv ./rangitaki-1.1.2/* ./
    rm -rf ./rangitaki-1.1.2
    cd ../ || exit
    rm -rf ./res
    mv ./rbe-new/res ./
    # Updating index.php
    rm ./index.php
    mv ./rbe-new/index.php ./
    # Update themes
    rm ./themes/background-img.css
    rm ./themes/material-dark.css
    rm ./themes/material-light.css
    mv ./rbe-new/themes/background-img.css ./themes/
    mv ./rbe-new/themes/material-dark.css ./themes/
    mv ./rbe-new/themes/material-light.css ./themes/
    # Update config file
    echo "// pagination: how many articles should be on one page" >> ./config.php
    echo "// set to 0 to disable it" >> ./config.php
    echo "$pagination = 0;" >> ./config.php
    # cleaning up
    rm -rf ./rbe-new
fi
