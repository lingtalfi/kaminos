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
        <img src="<?php echo $imgPrefix; ?>/images/img.jpg" alt="">John Doe
        <span class=" fa fa-angle-down"></span>
    </a>
    <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li><a href="javascript:;"> Profile</a></li>
        <li>
            <a href="javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
            </a>
        </li>
        <li><a href="javascript:;">Help</a></li>
        <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
    </ul>
</li>