<?php


use Core\Services\A;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XConfig;
use Module\NullosAdmin\ThemeHelper\ThemeHelper;

/**
 * //--------------------------------------------
 * // CONF EXAMPLE
 * //--------------------------------------------
 *
 * 'maincontent.dataTable' => [
 *      'grid' => "1",
 *      'tpl' => "NullosAdmin/Main/DataTable/default",
 *      'conf' => [
 *              "showHeader" => false, // default: true
 *              "title" => null, // default: null
 *              "subtitle" => "Users list",
 *              "description" => null, // default: null
 *              "profileId" => "NullosAdmin/users",
 *      ],
 * ],
 */

ThemeHelper::inst()->useLib("dataTable");


$uri = XConfig::get("DataTable.uriAjaxHandler");
$renderer = 'Module\NullosAdmin\ModelRenderers\DataTable\NullosDataTableRenderer';


A::addBodyEndJsCode('jquery', '
function initDataTable() {
    console.log("init datatable");
    $(\'.datatable_view\').dataTable({
        uri: ' . json_encode($uri) . ',
        renderer: "' . str_replace('\\', '\\\\', $renderer) . '"
    });
}

initDataTable();

');

?>

<div class="x_panel">
    <?php if (true === $v['showHeader']): ?>
        <div class="x_title">
            <?php if (null !== $v['title']): ?>
                <h2>{title}
                    <?php if (array_key_exists('subtitle', $v)): ?>
                        <small>{subtitle}</small>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    <?php endif; ?>
    <div class="x_content">
        <?php if (null !== $v['description']): ?>
            <p class="text-muted font-13 m-b-30">
                {description}
            </p>
        <?php endif; ?>
        <div class="datatable_view" data-id="{profileId}"></div>
    </div>
</div>