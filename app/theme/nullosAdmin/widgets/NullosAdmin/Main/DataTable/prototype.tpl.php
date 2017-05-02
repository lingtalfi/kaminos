<div class="x_panel">
    <div class="x_title">
        <h2>Boardered table
            <small>Bordered table subtitle</small>
        </h2>
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
    <div class="x_content">


        <?php

        use Models\DataTable\ArrayDataTableModel;


        $rows = [
            [
                "firstName" => "Mark",
                "lastName" => "Otto",
                "userName" => "@mdo",
            ],
            [
                "firstName" => "Jacob",
                "lastName" => "Thornton",
                "userName" => "@fat",
            ],
            [
                "firstName" => "Larry",
                "lastName" => "the Bird",
                "userName" => "@twitter",
            ],
        ];

        //        a(ArrayDataTableModel::create()
        //            ->setRic(['userName'])
        //            ->setHeaders(['firstName', 'lastName', 'userName'])
        //            ->setRows($rows)
        //            ->getArray());
        ?>


        <div class="datatable_wrapper">

            <div class="row">

                <div class="col-sm-12">
                    <div class="dt-buttons btn-group pull-right"><a
                                class="btn btn-default buttons-copy buttons-html5 btn-sm" tabindex="0"
                                aria-controls="datatable-buttons" href="#"><span>Copy</span></a><a
                                class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0"
                                aria-controls="datatable-buttons" href="#"><span>CSV</span></a><a
                                class="btn btn-default buttons-print btn-sm" tabindex="0"
                                aria-controls="datatable-buttons"
                                href="#"><span>Print</span></a></div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-6">
                    <div class="nipp_selector">
                        <label>Show <select class="form-control input-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="datatable_filter" class="dataTables_filter"><label>Search:<input
                                    class="form-control input-sm"
                                    placeholder=""
                                    aria-controls="datatable"
                                    type="search"></label></div>
                </div>
            </div>
            <table class="table table-ling table-hover  table-condensed">
                <thead>
                <tr>
                    <th class="sorting_asc">#</th>
                    <th class="sorting_asc">First Name</th>
                    <th class="sorting_asc">Last Name</th>
                    <th class="sorting_asc">Username</th>
                    <th></th>
                </tr>
                <tr class="search-row">
                    <td><input class="col-lg-12" type="text"></td>
                    <td><input class="col-lg-12" type="text"></td>
                    <td></td>
                    <td><input class="col-lg-12" type="text"></td>
                    <td>
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> Search
                        </button>
                    </td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td></td>
                </tr>
                </tbody>
            </table>


            <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="datatable_previous"><a href="#" aria-controls="datatable" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="datatable" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div>

        </div>
    </div>
</div>
