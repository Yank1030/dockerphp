<?php
// Ajax以外からのアクセスを遮断
$request = isset($_SERVER['HTTP_X_REQUESTED_WITH'])
    ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
if ($request !== 'xmlhttprequest') exit;

$text = filter_input(INPUT_GET, 'text');
header('Content-type: application/json; charset=utf-8');
echo json_encode(['text' => $text . ', World!']);