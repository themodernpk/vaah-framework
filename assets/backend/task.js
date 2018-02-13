Vue.config.delimiters = ["@{{", "}}"];

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