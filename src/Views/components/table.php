<?php

function table(string $table_name, array $columns, array $data, callable|null $actions = null, array $exclude_columns = [], int $perPage = 5)
{
    $exclude_columns = array_merge($exclude_columns, ["created_at", "updated_at"]);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $totalData = count($data);
    $totalPages = ceil($totalData / $perPage);
    $start = ($page - 1) * $perPage;
    $pagedData = array_slice($data, $start, $perPage);
?>

    <div class="w-full rounded-lg overflow-hidden">
        <?php if (empty($data)): ?>
            <h3 class="flex text-center justify-center items-center w-full text-gray-600 p-4">
                Tidak ada <?= $table_name ?> yang ditemukan.
            </h3>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-md overflow-hidden text-sm">
                    <thead>
                        <tr class=" bg-green-400  text-white font-medium text-left">
                            <th class="px-4 py-3 text-center">No.</th>
                            <?php foreach ($columns as $column): ?>
                                <th class="px-4 py-3 text-center"><?= $column ?></th>
                            <?php endforeach ?>
                            <?php if ($actions): ?>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $no = $start + 1; ?>
                        <?php foreach ($pagedData as $rows): ?>
                            <tr class="text-gray-700 hover:bg-gray-100 transition-all text-center ">
                                <td class="px-4 py-3"><?= $no++ ?>.</td>
                                <?php foreach ($rows as $key => $row): ?>
                                    <?php if (!in_array($key, $exclude_columns)): ?>
                                        <td class="px-4 py-3"><?= htmlspecialchars($row ?? '-') ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($actions): ?>
                                    <td class="px-4 py-3 flex justify-center space-x-2">
                                        <?= $actions($rows) ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <div class="w-full flex justify-center items-center mt-4">
                <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
                    <a href="?page=1"
                        class="px-4 py-2 text-gray-600 hover:bg-green-200 transition-all <?= $page == 1 ? 'opacity-50 pointer-events-none' : '' ?>">
                        «
                    </a>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>"
                            class="px-4 py-2 <?= $i == $page ? 'bg-green-400 text-white font-semibold' : 'text-gray-600 hover:bg-green-200 transition-all' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                    <a href="?page=<?= $totalPages ?>"
                        class="px-4 py-2 text-gray-600 hover:hover:bg-green-200 transition-all <?= $page == $totalPages ? 'opacity-50 pointer-events-none' : '' ?>">
                        »
                    </a>
                </div>
            </div>

        <?php endif ?>
    </div>
<?php
}
