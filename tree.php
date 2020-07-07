<?php

/**
 * Builds a tree from the $catalogue array
 * @param array $data of [int 'id', int|null 'parentId', string 'title']
 * @return array
 */
function buildTree(array $catalogue): array
{
    $tree = [];

    foreach ($catalogue as $item) {
        $branch = [$item['title'] => []];

        while (!empty($item['parentId'])) {
            $findItemId = array_search($item['parentId'], array_column($catalogue, 'id'));
            $item = $catalogue[$findItemId] ?? [];

            if (isset($item['title'])) {
                $branch = [$item['title'] => $branch];
            }
        }

        $tree = array_merge_recursive($tree, $branch);
    }

    return $tree;
}

$queries = [[
        ['id' => 1, 'parentId' => null, 'title' => 'cars'],
        ['id' => 2, 'parentId' => null, 'title' => 'fruits'],
        ['id' => 3, 'parentId' => 1, 'title' => 'tesla'],
        ['id' => 4, 'parentId' => 2, 'title' => 'apple'],
        ['id' => 5, 'parentId' => 1, 'title' => 'toyota'],
        ['id' => 6, 'parentId' => 2, 'title' => 'banana'],
        ['id' => 7, 'parentId' => 4, 'title' => 'red chief'],
        ['id' => 8, 'parentId' => 3, 'title' => 'model s'],
        ['id' => 9, 'parentId' => 4, 'title' => 'golden'],
        ['id' => 10, 'parentId' => 3, 'title' => 'model 3'],
    ], [
        ['id' => 5, 'parentId' => 1, 'title' => 'toyota'],
        ['id' => 6, 'parentId' => 2, 'title' => 'banana'],
        ['id' => 10, 'parentId' => 3, 'title' => 'model 3'],
        ['id' => 7, 'parentId' => 4, 'title' => 'red chief'],
        ['id' => 8, 'parentId' => 3, 'title' => 'model s'],
        ['id' => 1, 'parentId' => null, 'title' => 'cars'],
        ['id' => 3, 'parentId' => 1, 'title' => 'tesla'],
        ['id' => 4, 'parentId' => 2, 'title' => 'apple'],
        ['id' => 2, 'parentId' => null, 'title' => 'fruits'],
        ['id' => 9, 'parentId' => 4, 'title' => 'golden'],
    ], [
        ['id' => 1, 'parentId' => 3, 'title' => 'banana'],
        ['id' => 2, 'parentId' => 8, 'title' => 'red chief'],
        ['id' => 3, 'parentId' => null, 'title' => 'fruits'],
        ['id' => 4, 'parentId' => 10, 'title' => 'model s'],
        ['id' => 5, 'parentId' => null, 'title' => 'cars'],
        ['id' => 6, 'parentId' => 8, 'title' => 'golden'],
        ['id' => 7, 'parentId' => 10, 'title' => 'model 3'],
        ['id' => 8, 'parentId' => 3, 'title' => 'apple'],
        ['id' => 9, 'parentId' => 5, 'title' => 'toyota'],
        ['id' => 10, 'parentId' => 5, 'title' => 'tesla'],
    ],
];

foreach ($queries as $query) {
    echo '<pre>' . var_export(buildTree($query), true) . '</pre>';
}
