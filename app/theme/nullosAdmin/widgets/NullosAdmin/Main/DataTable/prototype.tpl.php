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
        </div>
    </div>
</div>
