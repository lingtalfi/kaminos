<?php


/**
 *
 * MODEL
 * ================
 * - nbMessages: int, the number of messages
 * - badgeColor: string, the badge color
 * - showAllMessagesLink: bool, whether or not to show the link to the user alerts
 * - allMessagesText: string, the text of the all messages link
 * - allMessagesLink: string, the uri of the all messages link
 * - messages: array:
 *          - ?link: string, uri to the message
 *          - ?title: string, title of the message
 *          - ?aux: string, little text (auxiliary info) to display next to the title
 *          - ?image: string, uri to an image to display
 *          - ?message: string, text of the message
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


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$prefixUri = "/theme/" . ApplicationParameters::get("theme");
$imgPrefix = $prefixUri . "/production";

?>
<li role="presentation" class="dropdown">
    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-green">6</span>
    </a>
    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        <li>
            <a>
                <span class="image"><img src="<?php echo $imgPrefix; ?>/images/img.jpg" alt="Profile Image" /></span>
                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
            </a>
        </li>
        <li>
            <a>
                <span class="image"><img src="<?php echo $imgPrefix; ?>/images/img.jpg" alt="Profile Image" /></span>
                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
            </a>
        </li>
        <li>
            <a>
                <span class="image"><img src="<?php echo $imgPrefix; ?>/images/img.jpg" alt="Profile Image" /></span>
                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
            </a>
        </li>
        <li>
            <a>
                <span class="image"><img src="<?php echo $imgPrefix; ?>/images/img.jpg" alt="Profile Image" /></span>
                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
            </a>
        </li>
        <li>
            <div class="text-center">
                <a>
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    </ul>
</li>