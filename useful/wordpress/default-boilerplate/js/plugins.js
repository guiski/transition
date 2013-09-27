// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/* ==========================================================================
   Functions
   ========================================================================== */
{
    /*
    * Cookie
    */
    {
        function setCookie (c_name, value, exseg) {
            var exdate = new Date();

            exdate.setTime(exdate.getTime() + (exseg*1000));

            var c_value = escape(value) + ((exseg==null) ? "" : "; expires="+exdate.toGMTString());

            document.cookie = c_name + "=" + c_value+"; path=/";
        }

        function getCookie (c_name) {
            var c_value = document.cookie,
                c_start = c_value.indexOf(" " + c_name + "=");

            if (c_start == -1) {
              c_start = c_value.indexOf(c_name + "=");
            }

            if (c_start == -1) {
              c_value = null;
            } else {
                c_start = c_value.indexOf("=", c_start) + 1;
                var c_end = c_value.indexOf(";", c_start);

                if (c_end == -1) {
                    c_end = c_value.length;
                }
                c_value = unescape(c_value.substring(c_start,c_end));
            }

            return c_value;
        }

    } //end cookie
} // end funcitons




// Place any jQuery/helper plugins in here.
