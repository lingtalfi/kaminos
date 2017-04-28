<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\InputTextControl;

class DatetimePickerInputTextControl extends InputTextControl
{

    private $jsConf;

    public function __construct()
    {
        parent::__construct();
        $this->type = "datetimePicker";
        $this->jsConf = [
            "singleDatePicker" => true,
            "timePicker" => false,
            "timePickerIncrement" => 1,
            "timePicker24Hour" => true,
            "timePickerSeconds" => true,
            "autoApply" => true,
            "alwaysShowCalendars" => true,
            "locale" => [
                'format' => "YYYY/MM/DD HH:mm:ss",
                "separator" => " - ",
                "applyLabel" => "Apply",
                "cancelLabel" => "Cancel",
                "fromLabel" => "From",
                "toLabel" => "To",
                "customRangeLabel" => "Custom",
                "weekLabel" => "W",
                "daysOfWeek" => [
                    "Su",
                    "Mo",
                    "Tu",
                    "We",
                    "Th",
                    "Fr",
                    "Sa",
                ],
                "monthNames" => [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December"
                ],
                "firstDay" => 1,
            ],
        ];
    }

    public function setJsConfiguration(array $jsConf)
    {
        $this->jsConf = $jsConf;
        return $this;
    }

    public function injectJsConfigurationKey(array $conf)
    {
        $this->jsConf = array_replace_recursive($this->jsConf, $conf);
        return $this;
    }

    public function setJsConfigurationKey($key, $value)
    {
        $this->jsConf[$key] = $value;
        return $this;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function prepareArray(array &$array)
    {
        $array['js'] = $this->jsConf;
    }
}