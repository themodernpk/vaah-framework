
var VueCommon = Vue.extend({
    methods: {
        //---------------------------------------------------------------------
        processHttpRequest: function (url, params, callback, method='POST') {

            NProgress.start();
            if(method=='GET')
            {
                this.$http.get(url, params)
                    .then(response => {
                        this.evaluateResponse(response, callback);
                    });

            } else
            {
                this.$http.post(url, params)
                    .then(response => {
                        this.evaluateResponse(response, callback);
                    });
            }
        },
        //---------------------------------------------------------------------
        evaluateResponse: function (response, callback) {
            callback(response.data)
        },
        //---------------------------------------------------------------------
        //---------------------------------------------------------------------
        success: function (message) {
            if(message === undefined)
            {
                message = "success"
            }
            alertify.success(message);
        },
        //---------------------------------------------------------------------
        findAndReplace: function(arr, key, data) {
            var index =null;
            for (var i = 0; i < arr.length; i++) {
                if(arr[i][key] == data[key])
                {
                    index = i;
                }
            }

            if(index != null)
            {
                arr[index] = data;
                return arr;
            }

            return false;
        },
        //---------------------------------------------------------------------
        updateArray: function(array, updatedElement) {
            const index = array.indexOf(updatedElement);
            array[index] = updatedElement;
            return array;
        },

        //---------------------------------------------------------------------
        removeFromArray: function(array, element) {
            const index = array.indexOf(element);
            return array.splice(index, 1);
        },
        //---------------------------------------------------------------------

        //---------------------------------------------------------------------
        existInArray: function(array, element) {
            const index = array.indexOf(element);

            if(index == -1)
            {
                return false;
            } else
            {
                return true;
            }
        },
        //---------------------------------------------------------------------

        existInArrayByKey: function (array, element, key) {
            var exist = false;
            if(!Array.isArray(array))
            {
                return false;
            }
            array.map(function(item) {

                if(item[key] == element[key])
                {
                    exist = true;
                }

            });

            return exist;
        },
        //---------------------------------------------------------------------
        splitString: function (string, characters) {

            if(string != "" && string != null)
            {
                if(string.length > characters){
                    string = string.substring(0,characters)+"...";
                }
            }

            return string;
        },
        //---------------------------------------------------------------------
        formatDate: function (value) {
            return moment(value).format('YYYY-MM-DD');
        },
        //---------------------------------------------------------------------
        fromNow: function (value) {
            return moment(value).fromNow();
        },
        //---------------------------------------------------------------------
        currentDate: function () {
            return moment().format('YYYY-MM-DD')
        },
        //---------------------------------------------------------------------
        currentDateTime: function () {
            return moment().format('YYYY-MM-DD HH:mm:ss')
        },
        //---------------------------------------------------------------------

        //---------------------------------------------------------------------
        dateTimeForHumans: function (value) {
            return moment(value).format('YYYY-MM-DD hh:mm A')
        },
        //---------------------------------------------------------------------
        checkPermission: function (slug) {
            return this.permissions.indexOf(slug) > -1 ? true : false;
        },
        //---------------------------------------------------------------------
        paginate: function (event, page) {
            event.preventDefault();
            this.current_page = page;
            this.listLoader();
        },
        //---------------------------------------------------------------------
        makePagination: function (data) {
            this.pagination = Pagination.Init(data.last_page, this.current_page, 3);
        },
        //---------------------------------------------------------------------
        paginateIsActive: function (page) {
            if(page == this.current_page)
            {
                return true;
            }
            return false;
        },
        //---------------------------------------------------------------------
        toIndianFormat: function (nStr) {

            if(nStr < 0)
            {
                return nStr;
            }

            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            var z = 0;
            var len = String(x1).length;
            var num = parseInt((len/2)-1);

            while (rgx.test(x1))
            {
                if(z > 0)
                {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                else
                {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                    rgx = /(\d+)(\d{2})/;
                }
                z++;
                num--;
                if(num == 0)
                {
                    break;
                }
            }
            return x1 + x2;
        },
        //---------------------------------------------------------------------
        currencyToSymbol: function (currency) {

            if(currency == "USD")
            {
                return "&#36;";
            } else if(currency == "INR")
            {
                return "&#8377;";
            } else
            {
                return currency;
            }
        },
        //---------------------------------------------------------------------
        setCookies: function (cookie_name, value, expiry_days) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + expiry_days);
            var c_value = escape(value) + ((expiry_days == null) ? "" : "; expires=" + exdate.toUTCString());
            document.cookie = cookie_name + "=" + value;
        },
        //---------------------------------------------------------------------
        getCookies: function (cookie_name) {
            var i, x, y, ARRcookies = document.cookie.split(";");
            for (i = 0; i < ARRcookies.length; i++) {
                x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
                y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
                x = x.replace(/^\s+|\s+$/g, "");
                if (x == cookie_name) {
                    return unescape(y);
                }
            }
        },
        //---------------------------------------------------------------------
        deleteCookies: function (cookie_name) {
                this.setCookies(cookie_name,undefined,-1);
        },
        //---------------------------------------------------------------------
        shiftToTop: function (arr, key, value)
        {
            var index =null;
            for (var i = 0; i < arr.length; i++) {
                if(arr[i][key] == value)
                {
                    index = i;
                }
            }

            if(index != null)
            {
                var old_index = index;
                var new_index = 0;

                if (new_index >= arr.length) {
                    var k = new_index - arr.length;
                    while ((k--) + 1) {
                        arr.push(undefined);
                    }
                }
                arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
                return arr; // for testing purposes
            }



        },
        //---------------------------------------------------------------------
        timeDifferenceInSeconds: function (started_at,ended_at) {
            var ms = moment(ended_at,"YYYY-MM-DD HH:mm:ss").diff(moment(started_at, "YYYY-MM-DD HH:mm:ss"));
            var seconds = ms/1000;
            return seconds;
        },
        //---------------------------------------------------------------------
        secondsToHoursMinutsSeconds: function (seconds) {

            var ms = seconds*1000;
            var d = moment.duration(ms);
            var time = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");

            return time;
        },
        //---------------------------------------------------------------------
        getTimeDifferenceInHHMMSS(started_at, ended_at)
        {
            var seconds = this.timeDifferenceInSeconds(started_at, ended_at);
            var time = this.secondsToHoursMinutsSeconds(seconds);
            return time;
        },
        //---------------------------------------------------------------------
        secondsToHours: function (seconds) {

            var ms = seconds*1000;
            var d = moment.duration(ms);
            var time = d.asHours();

            return time;
        },
        //---------------------------------------------------------------------
        //---------------------------------------------------------------------
    }

});