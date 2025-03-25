<?php

function table(string $table_name, array $columns, array $data, callable|null $actions = null, array $exclude_columns = [], int $perPage = 5)
{
    $exclude_columns = array_merge($exclude_columns, ["created_at", "updated_at"]);

    // Ambil halaman saat ini dari parameter GET
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $totalData = count($data);
    $totalPages = ceil($totalData / $perPage);
    $start = ($page - 1) * $perPage;
    $pagedData = array_slice($data, $start, $perPage);
    ?>
    
    <div class="w-full">
        <?php if (empty($data)): ?>
            <h3 class="flex justify-center w-full text-gray-700 p-4 normal-case">
                Tidak ada <?= $table_name ?> yang ditemukan.
            </h3>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg text-sm">
                    <thead>
                        <tr class="bg-pink-700 text-white">
                            <th class="border border-gray-300 px-4 py-2">No.</th>
                            <?php foreach ($columns as $column): ?>
                                <th class="border border-gray-300 px-4 py-2">
                                    <?= $column ?>
                                </th>
                            <?php endforeach ?>
                            <?php if ($actions): ?>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $start + 1; ?>
                        <?php foreach ($pagedData as $rows): ?>
                            <tr class='text-center text-gray-700 hover:bg-gray-200'>
                                <td class='border border-gray-300 px-4 py-2'><?= $no++ ?>.</td>
                                <?php foreach ($rows as $key => $row): ?>
                                    <?php if (!in_array($key, $exclude_columns)): ?>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <?= htmlspecialchars($row ?? '-') ?>
                                        </td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($actions): ?>
                                    <td class="border border-gray-300 px-4 py-2 flex justify-center space-x-2">
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
                <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                    <!-- First Page -->
                    <a href="?page=1" 
                       class="px-4 py-2 border-r border-gray-300 text-blue-600 hover:bg-gray-200 <?= $page == 1 ? 'opacity-50 pointer-events-none' : '' ?>">
                       Sebelumnya
                    </a>

                    <!-- Previous Page -->
                    <a href="?page=<?= max(1, $page - 1) ?>" 
                       class="px-4 py-2 border-r border-gray-300 text-blue-600 hover:bg-gray-200 <?= $page == 1 ? 'opacity-50 pointer-events-none' : '' ?>">
                        «
                    </a>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" 
                           class="px-4 py-2 border-r border-gray-300 <?= $i == $page ? 'bg-blue-600 text-white font-bold' : 'text-blue-600 hover:bg-gray-200' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Next Page -->
                    <a href="?page=<?= min($totalPages, $page + 1) ?>" 
                       class="px-4 py-2 border-r border-gray-300 text-blue-600 hover:bg-gray-200 <?= $page == $totalPages ? 'opacity-50 pointer-events-none' : '' ?>">
                        »
                    </a>

                    <!-- Last Page -->
                    <a href="?page=<?= $totalPages ?>" 
                       class="px-4 py-2 text-blue-600 hover:bg-gray-200 <?= $page == $totalPages ? 'opacity-50 pointer-events-none' : '' ?>">
                        Selanjutnya
                    </a>
                </div>
            </div>

        <?php endif ?>
    </div>
<?php
}
