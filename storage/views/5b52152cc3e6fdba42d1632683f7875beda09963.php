<div id="app">
    <input type="hidden" name="base_url" value="<?php echo  site_url(); ?>" >


    <!--header-->
    <div class="row">
        <div class="col-md-12">
            <h3 class="pull-left">Tasks <a href="#" data-toggle="modal" data-target="#EmailChangeLabelModal" class="btn btn-info btn-sm">Add</a></h3>

        </div>
    </div>
    <!--/header-->


    <!--errors-->
    <div class="alert alert-danger alert-float alert-dismissible" v-if="errors" >
        <button class="close" data-dismiss="alert" type="button">×</button>
        <ul>
            <li v-for="error in errors" >{{ error }}</li>
        </ul>
    </div>
    <!--errors-->

    <!--actions-->
    <div class="row m-t-20 input-group-sm">
        <div class="col-xs-12 col-md-2">
            <select class="form-control ">
                <option>Testing</option>
                <option>Testing</option>
                <option>Testing</option>
                <option>Testing</option>
                <option>Testing</option>
            </select>
        </div>

        <div class="col-xs-12 col-md-2">
            <select class="form-control ">
                <option>Testing</option>
                <option>Testing</option>
                <option>Testing</option>
                <option>Testing</option>
                <option>Testing</option>
            </select>
        </div>

        <div class="col-xs-12 col-md-4 pull-right ">
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <input class="form-control" type="text" placeholder="">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                          Search
                        </button>
                    </span>
                </div>
            </div>
        </div>

    </div>
    <!--/actions-->

    <div class="row">

        <div class="col-md-12">


            <input class="form-control" v-model="new_item.name" v-on:keyup.enter="create($event)" /><br/>


            <table class="table table-bordered table-striped">
                <tr v-if="list" v-for="item in list">
                    <td width="20">{{item.id}}</td>
                    <td>{{item.name}}</td>
                </tr>
            </table>

            <!--pagination-->
            <nav>
                <ul class="pagination_con pagination pagination-md">
                    <li class="page-item" v-bind:class="{'active':paginateIsActive(page)}"
                        v-on:click="paginate($event, page)" v-for="page in pagination">
                        <a class="page-link" href="#">{{ page }}</a>
                    </li>
                </ul>
            </nav>
            <!--/pagination-->

        </div>

    </div>




    <div class="modal fade example-modal-sm" id="EmailChangeLabelModal" role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" >Change Label</h4>
                </div>
                <div class="modal-body">

                    <div class="col-xs-12 col-xl-12 form-group">
                        <input type="text" class="form-control"  placeholder="Subject">
                        <p class="text-help">Enter relevant subject</p>
                    </div>

                    <div class="col-xs-12 col-xl-6 form-group">
                        <label class="form-control-label">Lead</label>
                        <select class="form-control" >
                            <option value="" >Select Label</option>

                        </select>
                    </div>

                    <div class="col-xs-12 col-xl-6 form-group">
                        <label class="form-control-label">Label</label>
                        <select class="form-control" >
                            <option value="" >Select Label</option>

                        </select>
                    </div>


                    <div class="col-xs-12 col-md-12 pull-xs-right">
                        <button v-on:click="threadCreate($event)" class="btn btn-primary"
                                type="submit">Submit</button>
                    </div>

                    <br clear="both"/>
                </div>
            </div>
        </div>
    </div>


</div>




<script>
    Vue.config.delimiters = ["{{", "}}"];

    const app = new VueCommon({
        el: '#app',
        data: {

            //---------------------Pagination
            pagination:{},
            current_page: 1,
            total_page: null,
            per_page: null,
            total_records: null,
            //---------------------End of Pagination

            title: "Title",
            urls: {},
            list: {},
            new_item: {},
            errors: null,


        },
        mounted: function () {
            //---------------------------------------------------------------
            //---------------------------------------------------------------
            //---------------------------------------------------------------
            this.urls.base = jQuery('input[name=base_url]').val();
            this.urls.rest = this.urls.base+"/wp-json/vaah";
            //---------------------------------------------------------------\
            this.listLoader();
            //---------------------------------------------------------------
        },
        methods: {
            //----------------------------------------------------------
            listLoader: function () {
                var url = this.urls.rest+"/task/list";
                var params = {page: this.current_page};
                console.log(params);
                this.processHttpRequest(url, params, this.listLoaderAfter);
            },
            //----------------------------------------------------------
            listLoaderAfter: function (response) {

                if(response.status == 'failed')
                {
                    this.errors = [];
                    this.errors = response.errors;
                } else
                {
                    this.list = response.data.list.data;
                    this.total_records = response.data.list.total;
                    this.current_page = response.data.list.current_page;
                    this.total_page = response.data.list.total_page;
                    this.per_page = response.data.list.per_page;
                    this.makePagination(response.data.list);
                }

                NProgress.done();

            },
            //----------------------------------------------------------
            create: function (event) {
                if(event)
                {
                    event.preventDefault();
                }
                var url = this.urls.rest+"/task/create";
                var params = this.new_item;

                console.log(params);

                this.processHttpRequest(url, params, this.createAfter);
            },
            //----------------------------------------------------------
            createAfter: function (response) {

                if(response.status == 'failed')
                {
                    this.errors = [];
                    this.errors = response.errors;
                } else
                {
                    this.new_item = {};
                    this.listLoader();
                }

                NProgress.done();
            }
            //----------------------------------------------------------
            //----------------------------------------------------------
            //----------------------------------------------------------
        }
    });



    (function (document, window, $) {


    })(document, window, jQuery);

</script>