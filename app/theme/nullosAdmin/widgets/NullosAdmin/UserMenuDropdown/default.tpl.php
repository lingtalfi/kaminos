<?php
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$prefixUri = "/theme/" . ApplicationParameters::get("theme");
$imgPrefix = $prefixUri . "/production";

/**
 *
 * MODEL
 * =========
 *
 * - text: text of the item
 * - ?link: string, uri
 * - ?icon: string, class of the icon (for instance fa fa-sign-out)
 * - ?badge: array
 *      - text: string, text of the badge
 *      - color: string, color of the badge
 *
 *
 *
 *
 * available badge colors:
 *
 * - red
 * - blue
 * - orange
 * - purple
 * - blue-sky
 *
 */
?>
<li class="">
    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <img src="{userImgSrc}" alt="">{userName}
        <span class=" fa fa-angle-down"></span>
    </a>
    <ul class="dropdown-menu dropdown-usermenu pull-right">
        <?php foreach ($v['items'] as $item):
            $sLink = "javascript:;";
            if (array_key_exists('link', $item)) {
                $sLink = $item['link'];
            }

            $icon = "";
            if (array_key_exists('icon', $item)) {
                $icon = '<i class="' . $item['icon'] . ' pull-right"></i>';
            }

            $badge = "";
            if (array_key_exists('badge', $item)) {
                $badge = '<span class="badge bg-' . $item['badge']['color'] . ' pull-right">' . $item['badge']['text'] . '</span>';
            }

            ?>
            <li><a href="<?php echo $sLink; ?>">
                    <?php echo $icon; ?>
                    <?php echo $badge; ?>
                    <?php echo $item['text']; ?>
                </a></li>
        <?php endforeach ?>
    </ul>
</li>