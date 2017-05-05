<?php



use Module\NullosAdmin\ThemeHelper\ThemeHelper;

ThemeHelper::inst()->useLib("dataTable");


?>
<div class="x_panel">
    <div class="x_title">
        <h2>Default Example
            <small>Users</small>
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
        <p class="text-muted font-13 m-b-30">
            DataTables has most features enabled by default, so all you need to do to use it with your own tables is to
            call the construction function: <code>$().DataTable();</code>
        </p>


        <div class="datatable_wrapper form-inline dt-bootstrap no-footer">
            <div class="row">
                <div class="col-sm-4">
                    <div class="datatable_nipp">
                        <label>Show <select aria-controls="datatable"
                                            class="nipp-selector form-control input-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label>
                    </div>
                </div>


                <div class="col-sm-4 text-center">
                    <div class="dt-buttons btn-group">
                        <a
                                class="btn btn-default buttons-html5 btn-sm" tabindex="0"
                                aria-controls="datatable-buttons" href="#">
                            <span class="fa fa-beer"></span>
                            <span>Copy</span>
                        </a>

                        <a
                                class="btn btn-default buttons-html5 btn-sm" tabindex="0"
                                aria-controls="datatable-buttons" href="#"><span>CSV</span></a><a
                                class="btn btn-default btn-sm" tabindex="0"
                                aria-controls="datatable-buttons"
                                href="#"><span>Print</span></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="datatable_quickpage">
                        <label>Search:<input
                                    class="quickpage-input form-control input-sm" placeholder=""
                                    aria-controls="datatable"
                                    type="search">
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered dataTable no-footer" role="grid"
                           aria-describedby="datatable_info">
                        <thead>
                        <tr role="row">
                            <th class="sort-item sort-asc" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-sort="ascending"
                                aria-label="Name: activate to sort column descending">Name
                            </th>
                            <th class="sort-item sort-nosort" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-label="Position: activate to sort column ascending">Position
                            </th>
                            <th class="" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-label="Office: activate to sort column ascending">Office
                            </th>
                            <th class="sort-item sort-nosort" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-label="Age: activate to sort column ascending">Age
                            </th>
                            <th class="sort-item sort-nosort" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-label="Start date: activate to sort column ascending">Start
                                date
                            </th>
                            <th class="sort-item sort-nosort" tabindex="0" aria-controls="datatable" rowspan="1"
                                colspan="1"
                                aria-label="Salary: activate to sort column ascending">Salary
                            </th>
                            <th></th>
                        </tr>


                        <tr class="search-row">
                            <td><input class="col-lg-12" type="text"></td>
                            <td><input class="col-lg-12" type="text"></td>
                            <td><input class="col-lg-12" type="text"></td>
                            <td></td>
                            <td><input class="col-lg-12" type="text"></td>
                            <td><input class="col-lg-12" type="text"></td>
                            <td>
                                <button type="button" class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                                <button type="button" class="btn btn-default btn-xs">
                                    <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                            </td>
                        </tr>
                        </thead>


                        <tbody>


                        <tr role="row" class="odd">
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs"
                                            type="button" aria-expanded="false">
                                        <span class="glyphicon glyphicon-search"></span>
                                        Default <span class="caret"></span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                            <td></td>
                        </tr>
                        <tr role="row" class="even">
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009/10/09</td>
                            <td>
                                <button  class="btn btn-success btn-xs"
                                        type="button" aria-expanded="false">
                                    <span class="glyphicon glyphicon-heart"></span> Heart
                                </button>
                            </td>
                            <td></td>
                        </tr>
                        <tr role="row" class="odd">
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="even">
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012/10/13</td>
                            <td>$132,000</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="odd">
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011/06/07</td>
                            <td>$206,850</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="even">
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td>$372,000</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="odd">
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011/05/03</td>
                            <td>$163,500</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="even">
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011/12/12</td>
                            <td>$106,450</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="odd">
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011/12/06</td>
                            <td>$145,600</td>
                            <td></td>
                        </tr>
                        <tr role="row" class="even">
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="datatable_bulk">
                        <label><select aria-controls="datatable"
                                       class="bulk-selector form-control input-sm">
                                <option value="10">Delete all items</option>
                                <option value="25">Copy all items to clipboard</option>
                            </select> entries</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="datatable_info" role="status" aria-live="polite">Showing 1 to 10 of
                        57 entries
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="datatable_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="paginate_button"><a href="#"
                                                           aria-controls="datatable"
                                                           data-dt-idx="0"
                                                           tabindex="0">First</a>
                            </li>
                            <li class="paginate_button disabled" id="datatable_previous"><a href="#"
                                                                                            aria-controls="datatable"
                                                                                            data-dt-idx="0"
                                                                                            tabindex="0">Previous</a>
                            </li>
                            <li class="paginate_button active"><a href="#" aria-controls="datatable" data-dt-idx="1"
                                                                  tabindex="0">1</a></li>
                            <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="2"
                                                            tabindex="0">2</a></li>
                            <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="3"
                                                            tabindex="0">3</a></li>
                            <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="4"
                                                            tabindex="0">4</a></li>
                            <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="5"
                                                            tabindex="0">5</a></li>
                            <li class="paginate_button "><a href="#" aria-controls="datatable" data-dt-idx="6"
                                                            tabindex="0">6</a></li>
                            <li class="paginate_button" id="datatable_next"><a href="#" aria-controls="datatable"
                                                                               data-dt-idx="7"
                                                                               tabindex="0">Next</a></li>
                            <li class="paginate_button" id="datatable_next"><a href="#" aria-controls="datatable"
                                                                               data-dt-idx="8"
                                                                               tabindex="0">Last</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>