<?php

return [
	'feedManufacture' => 'web/manufacturer/feed-manufacture',
    '' => 'web/default/index',
    'push' => 'web/default/push',
    'novinis' => 'web/test/index',
    'novinis/<page:\d+>' => 'web/test/index',
    'error' => 'web/default/error',
    '505' => 'web/default/error505',
    'kontakti' => 'web/default/contact',
    'shop' => 'web/default/shop',
    'credits' => 'web/default/credits',
    'dostavka-ta-oplata' => 'web/default/delivery',
    'pro-kompaniyu' => 'web/default/about',
    'partneri' => 'web/default/partners',
    'history' => 'web/default/history',
	'save-with-us' => 'web/default/save-with-us',
	'info' => 'web/info/index',
	'info/<id>' => 'web/info/category',
    'info/<id>/<article_id>' => 'web/info/view',
	'info/<info_id>' => 'web/info/index',
    'info/view/<info_tabs_id>' => 'web/info/view',
    'vidguki' => 'web/reviews/index',
    'bonusplus' => 'web/default/bonusplus',
    'add-like' => 'web/reviews/add-like',
    'novini/p/<page:\d+>' => 'web/news/index',
    'novini' => 'web/news/index',
    'novini/<news_id>' => 'web/news/view',
    'novosti/p/<page:\d+>' => 'web/news/index',
    'novosti' => 'web/news/index',
    'novosti/<news_id>' => 'web/news/view',
    'articles/p/<page:\d+>' => 'web/articles/index',
    'articles' => 'web/articles/index',
    'articles/<article_id>' => 'web/articles/view',
    'osobistij-kabinet/recovery-sms/<type>' => 'web/user/recovery-sms',
	'osobistij-kabinet/index/<category_id:\d+>/m/<manufacturer_ids>/f/<filter_ids>' => 'web/user/index',
    'osobistij-kabinet/index/<category_id:\d+>/f/<filter_ids>' => 'web/user/index',
    'osobistij-kabinet/index/<category_id:\d+>/m/<manufacturer_ids>' => 'web/user/index',
	'osobistij-kabinet/index/<category_id:\d+>' => 'web/user/index',
    'osobistij-kabinet/<action>' => 'web/user/<action>',
    //'osobistij-kabinet/<action>' => 'web/user/<action>',
    'internet-magazin' => 'web/categories/index',
    'internet-magazin/cart/view' => 'web/cart/index',
    'internet-magazin/cart/<action>' => 'web/cart/<action>',
    'internet-magazin/cure' => 'web/categories/cure',
    'internet-magazin/cure/<cure_id>' => 'web/categories/cure',
    'internet-magazin/brand' => 'web/categories/brands',
    'internet-magazin/brand/<brand_id>' => 'web/categories/brand',
    'internet-magazin/category/view/<category_id>' => 'web/categories/subcategory',
//	'top-sales' => 'web/products/sales/topsales',

    [
        'pattern' => 'top-sales',
        'route' => 'web/products/sales',
        'defaults' => ['filter' => 'topsale']
    ],
    [
        'pattern' => 'discounts',
        'route' => 'web/products/sales',
        'defaults' => ['filter' => 'is_on_sale']
    ],
	[
        'pattern' => 'black-friday',
        'route' => 'web/products/sales',
        'defaults' => ['filter' => 'b_friday']
    ],
    [
        'pattern' => 'best-price',
        'route' => 'web/products/sales',
        'defaults' => ['filter' => 'super']
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/m/<manufacturer_ids>/f/<filter_ids>',
        'route' => 'web/products/index',
        'defaults' => ['page' => 1],
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/m/<manufacturer_ids>/f/<filter_ids>/p/<page:\d*>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/m/<manufacturer_ids>/f/<filter_ids>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/m/<manufacturer_ids>',
        'route' => 'web/products/index',
        'defaults' => ['page' => 1],
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/m/<manufacturer_ids>/p/<page:\d*>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/m/<manufacturer_ids>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/f/<filter_ids>',
        'route' => 'web/products/index',
        'defaults' => ['page' => 1],
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/<filter_ids>/p/<page:\d*>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/f/<filter_ids>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/<category_id>/<page:\d*>',
        'route' => 'web/products/index',
        'defaults' => ['page' => 1],
    ],
    [
        'pattern' => 'internet-magazin/<category_id>',
        'route' => 'web/products/index',
    ],
    [
        'pattern' => 'internet-magazin/brands',
        'route' => 'web/manufacturer/index',
    ],
    'internet-magazin/product/view/<category_id>/<product_id>' => 'web/products/view',
    'forum' => 'web/forum/index',
    'forum/<forum_id>' => 'web/forum/view',
    'sitemap.xml' => 'web/sitemap/xml',
    'sitemap' => 'web/sitemap/html',
    'page' => 'web/page/index',
    'page/<category_id>' => 'web/page/view',

    'zasobi-zakhistu-roslin-<city_id>' => 'web/default/shieldcity',

    'dobriva-<city_id>' => 'web/default/groundcity',

    'nasinnya-<city_id>' => 'web/default/semillacity',
    
    'api/stock' => 'api/stock/index'

];
