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
        <span class="badge bg-{badgeColor}">{nbMessages}</span>
    </a>
    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        <?php foreach ($v['messages'] as $m):
            $sImg = "";
            if (array_key_exists('image', $m)) {
                $sImg = '<span class="image"><img src="' . htmlspecialchars($m['image']) . '" alt="Profile Image"/></span>';
            }

            $hasTitle = false;
            $sTitle = "&nbsp;"; // put a non breaking space, otherwise it breaks the design
            if (array_key_exists('title', $m)) {
                $sTitle = $m['title'];
                $hasTitle = true;
            }

            $hasAux = false;
            $sAux = "";
            if (array_key_exists('aux', $m)) {
                $sAux = $m['aux'];
                $hasAux = true;
            }


            $sLink = "";
            if (array_key_exists('link', $m)) {
                $sLink = ' href="' . htmlspecialchars($m['link']) . '"';
            }

            ?>
            <li>
                <a<?php echo $sLink; ?>>
                    <?php echo $sImg; ?>
                    <?php if (true === $hasTitle || true === $hasAux): ?>
                        <span>
                          <span><?php echo $sTitle; ?></span>
                          <span class="time"><?php echo $sAux; ?></span>
                    </span>
                    <?php endif; ?>
                    <?php if (array_key_exists('message', $m)): ?>
                        <span class="message"><?php echo $m['message']; ?></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach ?>
        <?php if (true === $v['showAllMessagesLink']): ?>
            <li>
                <div class="text-center">
                    <a href="{allMessagesLink}">
                        <strong>{allMessagesText}</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</li>