<?php

function table(string $table_name, array $columns, array $data, callable|null $actions = null, array $exclude_columns = [])
{
    $exclude_columns = array_merge($exclude_columns, ["created_at", "updated_at"]);

?>
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
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="<?= count($columns) + ($actions ? 2 : 1) - count($exclude_columns) ?>"
                        class="text-center text-gray-700 p-4 normal-case">
                        Tidak ada <?= $table_name ?> yang ditemukan.
                    </td>
                </tr>
            <?php else: ?>
                <?php $no = 1; ?>
                <?php foreach ($data as $rows): ?>
                    <tr class='text-center text-gray-700 hover:bg-gray-200 transition'>


                        <td class='border border-gray-300 px-4 py-2'><?= $no++ ?>.</td>

                        <?php foreach ($rows as $key => $row): ?>
                            <?php if (!in_array($key, $exclude_columns)): ?>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row ?? '-') ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if ($actions): ?>
                            <td class="border border-gray-300 px-4 py-2 flex justify-center space-x-2">
                                <?= $actions($rows) ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
<?php
}
?>