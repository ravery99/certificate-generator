<?php
class Layout {
    public static function render($title, $content) {
        ?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($title); ?></title>
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                body {
                    background-color: #f9fafb; 

                }
            </style>
        </head>

        <body class="flex justify-center items-center min-h-screen p-4 sm:p-8">
           

            <?php  require_once '../src/views/' . $viewPath . '.php'; ?> 

        </body>

        
        
        </html>
        <?php
    }
}
?>
