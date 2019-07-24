<?php

require_once(dirname(__FILE__) . '/../../bootstrap.php');

$products = provideSampleProducts();

try {
    $sdk->getCatalogService()->addProducts($products);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
