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
   
    
    this.init = function (){
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

    this.fetch = async function (url, data) {
        var result = {status: "", message: ""};
        headers = {
                "Content-Type": "application/json",
            };
        if(this.sessionStore().jwt){
            headers["Authorization"] = "Bearer " + this.readJWT().token;
        }
        await fetch(url, {
            method: "POST",
            headers: headers,
            body: JSON.stringify(data),
        })
                .then(response => response.json())
                .then(data => {
                    result.message = data;
                    result.status = "Success";
                })
                .catch((error) => {
                    result.message = error;
                    result.status = "Error";
                    console.error("Error:", error);
                });
        return result;
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
    
    this.storeJWT = function (jwt){
        this.sessionStore().setItem("jwt", JSON.stringify(jwt));
        this.createJWTCookie();
    }
    
    this.readJWT = function (){
        return JSON.parse(this.sessionStore().jwt);
    }
    
    this.createJWTCookie = function (){
        if(this.getCookie("token") == ""){
            this.createCookie("token", this.readJWT().token);
        }
    }
    
    this.createCookie = function (name, value, days){
        let expires;
        if (days) {
          let date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
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
}

const baseApp = new BaseApp();
baseApp.init();