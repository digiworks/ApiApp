//var global = global || this, self = self || this, window = window || this;
if(typeof console == "undefined"){
    var console = {warn: print, error: print, info: print};
}
//var exports = {};


if (typeof window === "undefined") {
    /**
     * for SSR use
     */
    var setTimeout = function (fnc,wait){
        
    }
}