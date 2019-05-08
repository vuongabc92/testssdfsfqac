<?php

return [
    'defaultThemeName'         => 'twenty-seventeen',
    'uploadsFolder'            => 'uploads',
    'themesFolder'             => 'themes',
    'tmpFolder'                => 'tmp',
    'themesTmpFolder'          => 'themes_tmp',
    'avatarsFolder'            => 'uploads/avatars',
    'avatarDefault'            => 'uploads/avatars/__default.jpg',
    'coversFolder'             => 'uploads/covers',
    'coverDefault'             => 'uploads/covers/__default.jpg',
    'avatarMedium'             => 256,
    'avatarMaxFileSize'        => 5000,
    'avatarMaxFileSizeMessage' => 5,
    'coverMaxFileSize'         => 5000,
    'coverMaxFileSizeMessage'  => 5,
    'themeMaxFileSize'         => 10000,
    'themeMaxFileSizeMessage'  => 10,
    'dayLimitedToChangeSlug'   => 8,
    'unavailableCVUrls'        => [
        'setting',
        'config'
    ],
    'socialUrls' => [
        'facebook'    => 'facebook.com',
        'twitter'     => 'twitter.com',
        'instagram'   => 'instagram.com',
        'google-plus' => 'plus.google.com',
        'tumblr'      => 'tumblr.com',
        'vine'        => 'vine.co',
        'ello'        => 'ello.co',
        'linkedin'    => 'linkedin.com',
        'pinterest'   => 'pinterest.com',
        'vk'          => 'vk.com',
    ],
    'availableSocialIcons' => [
        'facebook'    => 'fab fa-facebook-f',
        'twitter'     => 'fab fa-twitter',
        'instagram'   => 'fab fa-instagram',
        'google-plus' => 'fab fa-google-plus',
        'tumblr'      => 'fab fa-tumblr',
        'vine'        => 'fab fa-vine',
        'ello'        => 'fab fa-ello',
        'linkedin'    => 'fab fa-linkedin',
        'pinterest'   => 'fab fa-pinterest',
        'vk'          => 'fab fa-vk',
    ],
    'availableSocial' => [
        'facebook'    => 'Facebook',
        'twitter'     => 'Twitter',
        'instagram'   => 'Instagram',
        'google-plus' => 'Google+',
        'tumblr'      => 'Tumblr',
        'vine'        => 'Vine',
        'ello'        => 'Ello',
        'linkedin'    => 'LinkedIn',
        'pinterest'   => 'Pinterest',
        'vk'          => 'VK'
    ],
    'avatarSizes' => array(
        'original' => 'Original',
        'small'  => array(
            'w'  => 128,
            'h'  => 128
        ),
        'medium' => array(
            'w' => 256,
            'h' => 256
        ),
        'big' => array(
            'w' => 512,
            'h' => 512
        )
    ),
    'coverSizes' => array(
        'original' => 'Original',
        'small'  => array(
            'w'  => 768,
            'h'  => 420
        ),
        'medium' => array(
            'w' => 960,
            'h' => 500
        ),
        'big' => array(
            'w' => 1220,
            'h' => 500
        )
    ),
    'themeFileExtensionsAllow' => ['html', 'js', 'css', 'png', 'jpg', 'gif', 'jpeg', 'otf', 'eot', 'svg', 'ttf', 'woff', 'woff2', 'json', 'txt'],
    'themeFilesRequired'       => ['index.html', 'screenshot.png', 'thumbnail.png'],
    'facebook_api' => [
        'app_id'                => '221184025235764',
        'app_secret'            => 'd60cfc566041554b9d320e5df640b02a',
        'default_graph_version' => 'v2.2',
    ],
    'google_api' => [
        'client_id'     => '916322774631-d01n4dg7trevpggg1r7ch5kgt93bgt7p.apps.googleusercontent.com',
        'client_secret' => 'p5Jw7_cEjBkGIRK68MiBIIia',
        'app_name'      => 'NEXT',
    ],
    'register_from' => [
        'facebook' => 'FACEBOOK',
        'google'   => 'GOOGLE',
    ],
    'wkhtmltopdf' => [ //Only compatible with version 0.12.4
        'no-outline',
        'javascript-delay' => 1000,
        'dpi'            => 100,
        'margin-top'     => 0,
        'margin-right'   => 0,
        'margin-bottom'  => 0,
        'margin-left'    => 0,
        'binary'         => '/usr/bin/wkhtmltopdf',
        'page-size'      => 'letter',
        'viewport-size'  => '1366x768',
        'ignoreWarnings' => true,
        'commandOptions' => array(
            'useExec' => true,
            'procEnv' => array(
                'LANG' => 'en_US.utf-8',
            ),
        )
    ],//More config from https://wkhtmltopdf.org/usage/wkhtmltopdf.txt 0.12.4
    'lazy_loading' => [
        'per_page' => 5
    ],
    'pdfMaxHeightPerPage' => 1320, //pixel
    'pdfWrapperClass'     => 'pdfWrapperClass',
    'pdfDownloadPrefix'   => 'octocv-',
    'pdfDefaultMargin'    => 5, //pixel
    'email' => [
        'support' => 'support@octocv.co'
    ],
    'jobDelay' => 3
];

//HOW TO INSTALL WKHTMLTOPDF 0.12.4
//https://gist.github.com/srmds/2507aa3bcdb464085413c650fe42e31d
//apt-get install libxrender1
//apt-get install libssl1.0-dev
//$ wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
//$ tar -xvf wkhtmltox-0.12.4_linux-generic-amd64.tar.xz
//$ cd wkhtmltox/bin/
//$ sudo mv wkhtmltopdf /usr/bin/wkhtmltopdf
//$ sudo mv wkhtmltoimage /usr/bin/wkhtmltoimage
//$ sudo chmod a+x /usr/bin/wkhtmltopdf
//$ sudo chmod a+x /usr/bin/wkhtmltoimage

//Install pdftk
//#!/bin/bash
//#
//# author: abu
//# date:   May 12 2018
//# description: bash script to install pdftk on Ubuntu 18.04 for amd64 machines
//##############################################################################
//#
//# change to /tmp directory
//cd /tmp
//# download packages
//wget http://mirrors.kernel.org/ubuntu/pool/main/g/gcc-6/libgcj17_6.4.0-8ubuntu1_amd64.deb \
//    http://mirrors.kernel.org/ubuntu/pool/main/g/gcc-defaults/libgcj-common_6.4-3ubuntu1_all.deb \
//    http://mirrors.kernel.org/ubuntu/pool/universe/p/pdftk/pdftk_2.02-4build1_amd64.deb \
//    http://mirrors.kernel.org/ubuntu/pool/universe/p/pdftk/pdftk-dbg_2.02-4build1_amd64.deb
//echo -e "Packages for pdftk downloaded\n\n"
//# install packages
//echo -e "\n\n Installing pdftk: \n\n"
//sudo apt-get install ./libgcj17_6.4.0-8ubuntu1_amd64.deb \
//./libgcj-common_6.4-3ubuntu1_all.deb \
//./pdftk_2.02-4build1_amd64.deb \
//./pdftk-dbg_2.02-4build1_amd64.deb
//echo -e "\n\n pdftk installed\n"
//echo -e "   try it in shell with: > pdftk \n"
//# delete deb files in /tmp directory
//rm ./libgcj17_6.4.0-8ubuntu1_amd64.deb
//rm ./libgcj-common_6.4-3ubuntu1_all.deb
//rm ./pdftk_2.02-4build1_amd64.deb
//rm ./pdftk-dbg_2.02-4build1_amd64.deb

//Install pdfjam
// wget http://archive.ubuntu.com/ubuntu/pool/universe/t/texlive-extra/texlive-extra-utils_2017.20180305-2_all.deb
// apt-get install ./texlive-extra-utils_2017.20180305-2_all.deb