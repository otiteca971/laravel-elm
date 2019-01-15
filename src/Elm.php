<?php

namespace Tightenco\Elm;

/**
 * Class Elm
 * @package Tightenco\Elm
 */
class Elm
{
    /**
     * Bind the given array of variables to the elm program,
     * render the script include,
     * and return the html.
     */
    public function make($app_name, $flags = [], $before="", $after="")
    {
        ob_start(); ?>

        <div id="<?= $app_name ?>"></div>

        <script>
            window.addEventListener('load', function () {
                <?= $before ?>
                <?php if (!empty($flags)) : ?>
                var app_<?= $app_name ?> = Elm.<?= $app_name ?>.init(
                    {
                        node: document.getElementById('<?= $app_name ?>'),
                        flags: JSON.parse(<?= json_encode($flags) ?>)
                    });
                <?php else : ?>
                var app_<?= $app_name ?> = Elm.<?= $app_name ?>.init(
                    {node: document.getElementById('<?= $app_name ?>')}
                );
                <?php endif; ?>
                <?= $after ?>
            });
        </script>

        <?php return ob_get_clean();
    }
}
