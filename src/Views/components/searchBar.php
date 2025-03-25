<?php

use App\Config\Config;

function searchBar(string $link, string $placeholder)
{
?>
    <div class="flex w-full flex-col space-y-6">
        <input type="text" id="live_search" placeholder="<?= $placeholder ?>" autocomplete="off"
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:text-ellipsis">

        <!-- <div id="loading" style="display: none;"
            class=" text-gray-300 font-extralight flex justify-center">
            Sedang memuat...
        </div> -->
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#live_search").keyup(function() {

                var input = $(this).val().trim();

                if (input != "") {
                    // $("#loading").show();

                    $.ajax({
                        url: "<?= Config::BASE_URL . $link ?>",
                        method: "POST",
                        data: {
                            input: input
                        },

                        success: function(data) {
                            $("#table").html(data);
                            // $("#loading").hide();
                        }
                    });
                } else {
                    $("#table").load("<?= $_SERVER['REQUEST_URI'] ?> #table > *");
                    // $("#loading").hide();
                }
            })
        });
    </script>

<?php } ?>