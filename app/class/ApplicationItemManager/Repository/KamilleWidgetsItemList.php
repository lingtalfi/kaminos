<?php


namespace ApplicationItemManager\Repository;


class KamilleWidgetsItemList extends AbstractItemList
{
    //--------------------------------------------
    // OVERRIDE THOSE METHODS
    //--------------------------------------------
    protected function createItemList()
    {
        return [
            'KamilleWidgets.BookedMeteo' => [
                'deps' => [],
                'description' => "Widget to display the weather conditions for your city",
            ],
        ];
    }
}