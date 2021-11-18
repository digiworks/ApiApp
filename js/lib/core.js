//Core Class

/**
 * 
 * @returns {baseI18n}
 */
function baseI18n(){
    this.i18n = i18next;
    const { initReactI18next, useTranslation } = ReactI18next;
    
    this.init = function (){
        this.i18n.use(initReactI18next);
        this.i18n.init({
          resources: {},
          lng: "en", 
          interpolation: {
            escapeValue: false 
          }
        });
    }
    
    this.t =  function(text, namespace = ""){
        const { t, i18n } = useTranslation(namespace);
        return t(text);
    }
    
    this.loadResourceBundle = function (lng, ns, resources, deep, overwrite){
        this.i18n.addResourceBundle(lng, ns, resources, deep, overwrite);
    }
}

/**
 * 
 * @returns {BaseApp}
 */
function BaseApp() {

    this.localStore;
    this.sessionStorage;
    this.validator = new ReactValidator({locale:"it"});  
    this.i18n = new baseI18n();
   
   /* url of api gateway or empty if application is the gateway*/
    this.apiGateway = "";
    
    this.init = function (conf = {}){
        this.i18n.init();
        if(this.isWeb()){
            this.localStorage = window.localStorage;
            this.sessionStorage = window.sessionStorage
        }
    }
    
    this.redirect = function (goto) {
        if (goto != "" && this.isWeb()) {
            window.location = goto;
        }
    }
    
    this.buildApiUrl = function(url) {
        return this.apiGateway + url;
    }
    
    this.fetch = async function (url, data) {
        var result = {status: "", message: ""};
        headers = {
                "Content-Type": "application/json"
            };
        if(this.sessionStore().jwt){
            headers["Authorization"] = "Bearer " + this.readJWT().token;
        }
        await fetch(this.buildApiUrl(url), {
            method: "POST",
            headers: headers,
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            result.message = data;
            result.status = "success";
        })
        .catch((error) => {
            result.message = error;
            result.status = "error";
            console.error("Error:", error);
        });
        return result;
    }
    
    this.urlStream = function (url){
        return this.buildApiUrl("api/file/stream") + "?file=" + url +"&type=1";
    }

    this.formDataToObject = function (formdata)
    {
        var object = {};
        formdata.forEach((value, key) => {
            // Reflect.has in favor of: object.hasOwnProperty(key)
            if(!Reflect.has(object, key)){
                object[key] = value;
                return;
            }
            if(!Array.isArray(object[key])){
                object[key] = [object[key]];    
            }
            object[key].push(value);
        });
        return object;
    }
    
    this.isSsr = function () {
        return (typeof window === "undefined");
    }

    this.isWeb = function () {
        return (typeof window !== "undefined");
    }

    this.goBack = function () {
        if (typeof window !== "undefined"){
            window.history.back();
        }
    }

    this.goHome = function () {
        if (typeof window !== "undefined") {
            window.location = "/";
        }
    }
    
    this.store = function() {
        return this.localStorage;
    }
    
    this.sessionStore = function(){
        return this.sessionStorage;
    }
    
    this.queryString = function (){
        const windowUrl = window.location.search;
        return new URLSearchParams(windowUrl);
    }
    
    this.formValidator = function (){
        return this.validator;
    }
    this.translations = function(){
        return this.i18n;
    }
    
    this.login = function(jwt){
        this.storeJWT(jwt);
    }
    
    this.logout = function (){
        this.removeJWT();
    }
    
    this.storeJWT = function (jwt){
        this.sessionStore().setItem("jwt", JSON.stringify(jwt));
        this.createJWTCookie();
    }
    
    this.removeJWT = function (){
        this.sessionStore().removeItem("jwt");
        this.eraseJWTCookie();
    }
     
    this.readJWT = function (){
        return JSON.parse(this.sessionStore().jwt);
    }
    
    this.createJWTCookie = function (){
        if(this.getCookie("token") == ""){
            this.createCookie("token", this.readJWT().token, this.readJWT().expires);
        }
    }
    
    this.eraseJWTCookie = function (){
         if(this.getCookie("token") != ""){
             this.eraseCookie("token");
         }
    }
    
    this.createCookie = function (name, value, expiresDate){
        let expires;
        if (expiresDate) {
          let date = new Date();
          date.setTime(expiresDate * 1000);
          expires = "; expires=" + date.toUTCString();
        } else {
          expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }
    
    this.getCookie = function (name){
        if (document.cookie.length > 0) {
            let c_start = document.cookie.indexOf(name + "=");
            if (c_start !== -1) {
              c_start = c_start + name.length + 1;
              let c_end = document.cookie.indexOf(";", c_start);
              if (c_end === -1) {
                c_end = document.cookie.length;
              }
              return unescape(document.cookie.substring(c_start, c_end));
            }
          }
          return "";
    }
    
    this.eraseCookie = function (name){
        this.createCookie(name,"",-1);
    }
}

const baseApp = new BaseApp();
baseApp.init();