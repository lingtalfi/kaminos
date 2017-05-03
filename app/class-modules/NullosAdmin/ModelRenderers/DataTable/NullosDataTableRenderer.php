<?php


namespace Module\NullosAdmin\ModelRenderers\DataTable;


use ModelRenderers\DataTable\Util\DataTableRendererUtil;
use ModelRenderers\DropDown\BootstrapDropDownRenderer;
use ModelRenderers\Renderer\AbstractRenderer;
use Module\NullosAdmin\ModelRenderers\DropDown\NullosDropDownRenderer;

/**
 *
 * The following flavours are available to nullosAdmin:
 *
 * - default: blank (default)
 * - primary: blue
 * - success: green
 * - info: cyan
 * - warning: orange
 * - danger: red
 * - dark: dark blue-gray
 * - link: transparent
 *
 */
class NullosDataTableRenderer extends AbstractRenderer
{

    public static function create()
    {
        return new static();
    }


    public function render()
    {
        ob_start();
        $a = $this->model;
//        a($a);

        $visibleColumns = $a['headers'];
        foreach ($a['hidden'] as $columnId) {
            unset($visibleColumns[$columnId]);
        }


        $nbVisibleColumns = count($visibleColumns);
        if (true === $a['isSearchable']) {
            $nbVisibleColumns++;
        }
        if (true === $a['checkboxes']) {
            $nbVisibleColumns++;
        }

        $storeAttr = DataTableRendererUtil::getStoreAttributes($a);


        $n = 0;
        if (true === $a['showActionButtons']) {
            $n++;
        }
        if (true === $a['showNipp']) {
            $n++;
        }
        if (true === $a['showQuickPage']) {
            $n++;
        }
        $columnWidth = 12 / $n;


        ?>
        <div class="datatable_wrapper form-inline dt-bootstrap no-footer">
            <div
                <?php echo DataTableRendererUtil::toDataAttributes($storeAttr); ?>
                    class="data-store" style="display: none"></div>
            <div class="row">


                <?php if (true === $a['showNipp']): ?>
                    <div class="col-sm-<?php echo $columnWidth; ?>">
                        <div class="datatable_nipp">
                            <label>
                                <?php echo DataTableRendererUtil::getNippSelector($a, ['attr' => [
                                    'aria-controls' => "datatable",
                                    'class' => "nipp-selector form-control input-sm",
                                ]]); ?>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if (true === $a['showActionButtons']): ?>
                    <div class="col-sm-<?php echo $columnWidth; ?> text-center">
                        <div class="btn-group btn-group-sm">
                            <?php foreach ($a['actionButtons'] as $id => $actionButton):
                                if (array_key_exists("useSelectedRows", $actionButton) && true === $actionButton['useSelectedRows']) {
                                    $actionButton['textUseSelectedRowsEmptyWarning'] = $a['textUseSelectedRowsEmptyWarning'];
                                }
                                ?>
                                <button
                                        class="actionbutton-button btn btn-default buttons-html5 btn-sm"
                                    <?php echo DataTableRendererUtil::toDataAttributes($actionButton); ?>
                                        data-id="<?php echo $id; ?>"
                                        type="button"
                                        tabindex="0"
                                        aria-controls="datatable-buttons" href="#">
                                    <?php if (array_key_exists('icon', $actionButton)): ?>
                                        <span class="<?php echo $actionButton['icon']; ?>"></span>&nbsp;
                                    <?php endif; ?>
                                    <span><?php echo $actionButton['label']; ?></span>
                                </button>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if (true === $a['showQuickPage']): ?>
                    <div class="col-sm-<?php echo $columnWidth; ?>">
                        <div class="datatable_quickpage">
                            <label><?php echo $a['textQuickPage']; ?><input
                                        class="quickpage-input form-control input-sm" placeholder=""
                                        value="<?php echo $a['page']; ?>"
                                        aria-controls="datatable"
                                        type="search">
                            </label>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-sm-12">


                    <table class="table table-striped table-bordered dataTable no-footer" role="grid"
                           aria-describedby="datatable_info">
                        <thead>
                        <tr role="row">
                            <?php if (true === $a['checkboxes']): ?>
                                <th><input type="checkbox" class="checkboxes-toggler"></th>
                            <?php endif; ?>


                            <?php foreach ($visibleColumns as $columnId => $label): ?>
                                <?php
                                $class = '';
                                if (true === $a['isSortable'] && false === in_array($columnId, $a['unsortable'], true)) {
                                    $class = 'sort-item';
                                    $dir = "nosort";
                                    if (array_key_exists($columnId, $a['sortValues'])) {
                                        $dir = $a["sortValues"][$columnId];
                                    }
                                    $class .= ' sort-' . $dir;
                                }
                                ?>
                                <th data-id="<?php echo $columnId; ?>" class="<?php echo $class; ?>"
                                    tabindex="0"><?php echo $label; ?></th>
                            <?php endforeach; ?>

                            <?php if (true === $a['isSearchable']): ?>
                                <th></th>
                            <?php endif; ?>
                        </tr>

                        <?php if (true === $a['isSearchable']): ?>
                            <tr class="search_row">
                                <?php if (true === $a['checkboxes']): ?>
                                    <td></td>
                                <?php endif; ?>
                                <?php foreach ($visibleColumns as $columnId => $label): ?>
                                    <td>
                                        <?php if (false === in_array($columnId, $a['unsearchable'])): ?>
                                            <?php
                                            $val = (array_key_exists($columnId, $a['searchValues'])) ? $a['searchValues'][$columnId] : "";
                                            ?>
                                            <input data-id="<?php echo $columnId; ?>" class="search-input col-lg-12"
                                                   type="text"
                                                   value="<?php echo htmlspecialchars($val); ?>">
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                <td>
                                    <button type="search-button button" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-search"></span> <?php echo $a['textSearch']; ?>
                                    </button>
                                    <button type="search-clear-button button" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-remove"></span> <?php echo $a['textSearchClear']; ?>
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </thead>
                        <tbody>
                        <?php if (count($a['rows']) > 0): ?>
                            <?php
                            $ii = 1;
                            foreach ($a['rows'] as $row):
                                $sClass = (1 === $ii++ % 2) ? 'odd' : 'even';
                                ?>
                                <tr role="row" class="<?php echo $sClass; ?>">

                                    <?php if (true === $a['checkboxes']):
                                        $ricString = DataTableRendererUtil::getRicValueStringByRow($a['ric'], $row);
                                        ?>
                                        <td><input class="ric-checkbox" type="checkbox"
                                                   data-id="<?php echo $ricString; ?>">
                                        </td>
                                    <?php endif; ?>

                                    <?php foreach ($row as $k => $v): ?>
                                        <?php if (array_key_exists($k, $visibleColumns)): ?>
                                            <?php if (is_array($v)): ?>
                                                <td><?php echo $this->renderRowSpecial($v, $row); ?></td>
                                            <?php else: ?>
                                                <td><?php echo $v; ?></td>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach ?>


                                    <?php if (true === $a['isSearchable']): ?>
                                        <td></td>
                                    <?php endif; ?>


                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="message">
                                <td colspan="<?php echo $nbVisibleColumns; ?>"><?php echo $a['textNoResult']; ?></td>
                            </tr>
                        <?php endif; ?>


                        </tbody>
                    </table>

                </div>
            </div>


            <?php if (true === $a['showBulkActions']):
                $args = [
                    'show' => $a['showEmptyBulkWarning'],
                    'warning' => $a['textEmptyBulkWarning'],
                ];
                ?>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="datatable_bulk">
                            <label>
                                <select
                                    <?php echo DataTableRendererUtil::toDataAttributes($args); ?>
                                        aria-controls="datatable"
                                        class="bulk-selector form-control input-sm">
                                    <option value="0"><?php echo $a['textBulkActionsTeaser']; ?></option>
                                    <?php foreach ($a['bulkActions'] as $identifier => $action): ?>
                                        <option data-id="<?php echo $identifier; ?>" <?php echo DataTableRendererUtil::toDataAttributes($action); ?>
                                                value="<?php echo $identifier; ?>"><?php echo $action['label']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <div class="row">
                <div class="col-sm-5">
                    <?php if (true === $a['showCountInfo']): ?>
                        <div class="datatable_info" role="status" aria-live="polite">
                            <?php echo DataTableRendererUtil::getCountInfoText($a); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-7">
                    <?php if (true === $a['showPagination']): ?>
                        <div class="datatable_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <?php $this->displayPagination($a); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
        <?php

        return ob_get_clean();
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function displayPagination(array $model)
    {

        if ('all' === $model['nipp']) {
            ?>
            <li class="paginate_button active"><a href="#"
                                                  data-id="1"
                                                  class="pagination-link"
                                                  aria-controls="datatable"
                                                  tabindex="0">1</a>
            </li>
            <?php
        } else {


            $navigators = $model['paginationNavigators'];

            $nbPages = ceil($model['nbTotalItems'] / $model['nipp']);
            $sDisabled = (1 === (int)$model['page']) ? 'disabled' : '';
            $sDisabledNext = ((int)$nbPages === (int)$model['page']) ? 'disabled' : '';

            if (in_array('first', $navigators, true)): ?>
                <li class="paginate_button"><a href="#"
                                               class="pagination-first"
                                               data-id="1"
                                               aria-controls="datatable"
                                               tabindex="0"><?php echo $model['textPaginationFirst']; ?></a>
                </li>
            <?php endif;

            if (in_array('prev', $navigators, true)):
                $prev = $model['page'] - 1;
                if ($prev < 1) {
                    $prev = 1;
                }
                ?>
                <li class="paginate_button <?php echo $sDisabled; ?>"><a
                            data-id="<?php echo $prev; ?>"
                            class="pagination-prev"
                            href="#"
                            aria-controls="datatable"
                            tabindex="0"><?php echo $model['textPaginationPrev']; ?></a>
                </li>
            <?php endif;


            list($min, $max) = DataTableRendererUtil::getPaginationMinMax($model);
            for ($i = $min; $i <= $max; $i++) {
                $class = ((int)$i === (int)$model['page']) ? 'active' : "";
                ?>
                <li class="paginate_button <?php echo $class; ?>"><a href="#"
                                                                     data-id="<?php echo $i; ?>"
                                                                     class="pagination-link"
                                                                     aria-controls="datatable"
                                                                     tabindex="0"><?php echo $i; ?></a>
                </li>
                <?php
            }


            if (in_array('next', $navigators, true)):
                $next = $model['page'] + 1;
                if ($next > $nbPages) {
                    $next = $nbPages;
                }
                ?>
                <li class="paginate_button <?php echo $sDisabledNext; ?>"><a
                            data-id="<?php echo $next; ?>"
                            class="pagination-next"
                            href="#"
                            aria-controls="datatable"
                            tabindex="0"><?php echo $model['textPaginationNext']; ?></a>
                </li>
            <?php endif;


            if (in_array('last', $navigators, true)):
                ?>
                <li class="paginate_button"><a href="#"
                                               class="pagination-last"
                                               data-id="<?php echo $nbPages; ?>"
                                               aria-controls="datatable"
                                               tabindex="0"><?php echo $model['textPaginationLast']; ?></a>
                </li>
                <?php
            endif;
        }
    }

    protected function renderRowSpecial(array $special, array $row)
    {
        $s = '';
        $type = $special['type'];
        $data = $special['data'];

        switch ($type) {
            case 'link':
                $s .= $this->renderLink($data);
                break;
            case 'links':
                foreach ($data as $oneData) {
                    $s .= $this->renderLink($oneData);
                }
                break;
            case 'dropdown':
                echo NullosDropDownRenderer::create()->setModel($data)->render();
                break;
            default:
                $this->onError("Unknown special type: $type");
                break;
        }
        return $s;
    }

    protected function renderLink(array $data)
    {
        $label = (array_key_exists('label', $data)) ? $data['label'] : "";
        $icon = (array_key_exists('icon', $data)) ? $data['icon'] : "";
        $flavour = (array_key_exists('flavour', $data)) ? $data['flavour'] : "default";

        $s = '<button class="btn btn-' . $flavour . ' btn-xs special-link" type="button" aria-expanded="false" ' . DataTableRendererUtil::toDataAttributes($data) . '>';
        if ('' !== $icon) {
            $s .= '<span class="' . $icon . '"></span>&nbsp;&nbsp;';
        }
        $s .= $label;
        $s .= '</button>';


        return $s;
    }

    protected function onError($msg)
    {
        throw new \Exception("DataTableRenderer error: " . $msg);
    }

}