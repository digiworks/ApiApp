!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports,require("react")):"function"==typeof define&&define.amd?define(["exports","react"],t):t((e="undefined"!=typeof globalThis?globalThis:e||self).ReactHookForm={},e.React)}(this,(function(e,t){"use strict";function r(e){if(e&&e.__esModule)return e;var t=Object.create(null);return e&&Object.keys(e).forEach((function(r){if("default"!==r){var s=Object.getOwnPropertyDescriptor(e,r);Object.defineProperty(t,r,s.get?s:{enumerable:!0,get:function(){return e[r]}})}})),t.default=e,Object.freeze(t)}var s=r(t),a=e=>"checkbox"===e.type,n=e=>e instanceof Date,i=e=>null==e;const o=e=>"object"==typeof e;var c=e=>!i(e)&&!Array.isArray(e)&&o(e)&&!n(e),u=e=>e.substring(0,e.search(/.\d/))||e,l=(e,t)=>[...e].some(e=>u(t)===e),d=e=>e.filter(Boolean),f=e=>void 0===e,g=(e,t,r)=>{if(c(e)&&t){const s=d(t.split(/[,[\].]+?/)).reduce((e,t)=>i(e)?e:e[t],e);return f(s)||s===e?f(e[t])?r:e[t]:s}};const m="blur",y="change",b="onBlur",h="onChange",_="onSubmit",p="onTouched",v="all",j="max",x="min",F="maxLength",O="minLength",A="pattern",w="required",V="validate";var S=(e,t)=>{const r=Object.assign({},e);return delete r[t],r};const k=s.createContext(null),D=()=>s.useContext(k);var C=(e,t,r,s=!0)=>{function a(a){return()=>{if(a in e)return t[a]!==v&&(t[a]=!s||v),r&&(r[a]=!0),e[a]}}const n={};for(const t in e)Object.defineProperty(n,t,{get:a(t)});return n},E=e=>c(e)&&!Object.keys(e).length,B=(e,t,r)=>{const s=S(e,"name");return E(s)||Object.keys(s).length>=Object.keys(t).length||Object.keys(s).find(e=>t[e]===(!r||v))},U=e=>Array.isArray(e)?e:[e],T=(e,t)=>!e||!t||U(e).some(e=>e&&(e.startsWith(t)||t.startsWith(e)));const M=e=>{e.current&&(e.current.unsubscribe(),e.current=void 0)};function N(e){const t=s.useRef(),r=s.useRef(()=>{});r.current=(({_unsubscribe:e,props:t})=>()=>{t.disabled?M(e):e.current||(e.current=t.subject.subscribe({next:t.callback}))})({_unsubscribe:t,props:e}),!e.skipEarlySubscription&&r.current(),s.useEffect(()=>(r.current(),()=>M(t)),[])}function R(e){const t=D(),{control:r=t.control,disabled:a,name:n}=e||{},[i,o]=s.useState(r._formState),c=s.useRef({isDirty:!1,dirtyFields:!1,touchedFields:!1,isValidating:!1,isValid:!1,errors:!1}),u=s.useRef(n);return u.current=n,N({disabled:a,callback:e=>T(u.current,e.name)&&B(e,c.current)&&o(Object.assign(Object.assign({},r._formState),e)),subject:r._subjects.state,skipEarlySubscription:!0}),C(i,r._proxyFormState,c.current,!1)}function L(e){const t=D(),{name:r,control:n=t.control,shouldUnregister:i}=e,[o,u]=s.useState(g(n._formValues,r,g(n._defaultValues,r,e.defaultValue))),d=R({control:n||t.control,name:r}),f=s.useRef(r);f.current=r,N({subject:n._subjects.control,callback:e=>(!e.name||f.current===e.name)&&u(g(e.values,f.current))});const b=n.register(r,Object.assign(Object.assign({},e.rules),{value:o})),h=s.useCallback((e,t)=>{const r=g(n._fields,e);r&&(r._f.mount=t)},[n]);return s.useEffect(()=>(h(r,!0),()=>{const e=n._options.shouldUnregister||i;(l(n._names.array,r)?e&&!n._stateFlags.action:e)?n.unregister(r):h(r,!1)}),[r,n,i,h]),{field:{onChange:e=>{const t=(e=>c(e)&&e.target?a(e.target)?e.target.checked:e.target.value:e)(e);u(t),b.onChange({target:{value:t,name:r},type:y})},onBlur:()=>{b.onBlur({target:{value:o,name:r},type:m})},name:r,value:o,ref:e=>{const t=g(n._fields,r);e&&t&&e.focus&&(t._f.ref={focus:()=>e.focus(),setCustomValidity:t=>e.setCustomValidity(t),reportValidity:()=>e.reportValidity()})}},formState:d,fieldState:{invalid:!!g(d.errors,r),isDirty:!!g(d.dirtyFields,r),isTouched:!!g(d.touchedFields,r),error:g(d.errors,r)}}}var W=(e,t,r,s,a)=>t?Object.assign(Object.assign({},r[e]),{types:Object.assign(Object.assign({},r[e]&&r[e].types?r[e].types:{}),{[s]:a||!0})}):{},P=e=>/^\w*$/.test(e),q=e=>d(e.replace(/["|']|\]/g,"").split(/\.|\[/));function I(e,t,r){let s=-1;const a=P(t)?[t]:q(t),n=a.length,i=n-1;for(;++s<n;){const t=a[s];let n=r;if(s!==i){const r=e[t];n=c(r)||Array.isArray(r)?r:isNaN(+a[s+1])?{}:[]}e[t]=n,e=e[t]}return e}const $=(e,t,r)=>{for(const s of r||Object.keys(e)){const r=g(e,s);if(r){const e=r._f,s=S(r,"_f");if(e&&t(e.name)){if(e.ref.focus&&f(e.ref.focus()))break;if(e.refs){e.refs[0].focus();break}}else c(s)&&$(s,t)}}};var H=(e,t,r={})=>r.shouldFocus||f(r.shouldFocus)?r.focusName||`${e}.${f(r.focusIndex)?t:r.focusIndex}.`:"",z=(e,t,r)=>e.map((e,s)=>{const a=t.current[s];return Object.assign(Object.assign({},e),a?{[r]:a[r]}:{})}),G=()=>{const e="undefined"==typeof performance?Date.now():1e3*performance.now();return"xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g,t=>{const r=(16*Math.random()+e)%16|0;return("x"==t?r:3&r|8).toString(16)})},J=(e=[],t)=>e.map(e=>Object.assign(Object.assign({},e[t]?{}:{[t]:G()}),e));function K(e,t){return[...U(e),...U(t)]}var Q=e=>Array.isArray(e)?e.map(()=>{}):void 0;function X(e,t,r){return[...e.slice(0,t),...U(r),...e.slice(t)]}var Y=(e,t,r)=>Array.isArray(e)?(f(e[r])&&(e[r]=void 0),e.splice(r,0,e.splice(t,1)[0]),e):[];function Z(e,t){return[...U(t),...U(e)]}var ee=(e,t)=>f(t)?[]:function(e,t){let r=0;const s=[...e];for(const e of t)s.splice(e-r,1),r++;return d(s).length?s:[]}(e,U(t).sort((e,t)=>e-t)),te=(e,t,r)=>{e[t]=[e[r],e[r]=e[t]][0]},re=(e,t,r)=>(e[t]=r,e);var se=e=>"function"==typeof e;function ae(e){let t;const r=Array.isArray(e);if(e instanceof Date)t=new Date(e);else if(e instanceof Set)t=new Set(e);else{if(!r&&!c(e))return e;t=r?[]:{};for(const r in e){if(se(e[r])){t=e;break}t[r]=ae(e[r])}}return t}var ne=e=>i(e)||!o(e);function ie(e,t){if(ne(e)||ne(t))return e===t;if(n(e)&&n(t))return e.getTime()===t.getTime();const r=Object.keys(e),s=Object.keys(t);if(r.length!==s.length)return!1;for(const a of r){const r=e[a];if(!s.includes(a))return!1;if("ref"!==a){const e=t[a];if(n(r)&&n(e)||c(r)&&c(e)||Array.isArray(r)&&Array.isArray(e)?!ie(r,e):r!==e)return!1}}return!0}var oe=e=>({isOnSubmit:!e||e===_,isOnBlur:e===b,isOnChange:e===h,isOnAll:e===v,isOnTouch:e===p}),ce=e=>"boolean"==typeof e,ue=e=>e instanceof HTMLElement,le=e=>"select-multiple"===e.type,de=e=>"radio"===e.type,fe=e=>"string"==typeof e,ge="undefined"!=typeof window&&void 0!==window.HTMLElement&&"undefined"!=typeof document,me=e=>ue(e)&&document.contains(e);class ye{constructor(){this.tearDowns=[]}add(e){this.tearDowns.push(e)}unsubscribe(){for(const e of this.tearDowns)e();this.tearDowns=[]}}class be{constructor(e,t){this.observer=e,this.closed=!1,t.add(()=>this.closed=!0)}next(e){this.closed||this.observer.next(e)}}class he{constructor(){this.observers=[]}next(e){for(const t of this.observers)t.next(e)}subscribe(e){const t=new ye,r=new be(e,t);return this.observers.push(r),t}unsubscribe(){this.observers=[]}}function _e(e,t){const r=P(t)?[t]:q(t),s=1==r.length?e:function(e,t){const r=t.slice(0,-1).length;let s=0;for(;s<r;)e=f(e)?s++:e[t[s++]];return e}(e,r),a=r[r.length-1];let n;s&&delete s[a];for(let t=0;t<r.slice(0,-1).length;t++){let s,a=-1;const i=r.slice(0,-(t+1)),o=i.length-1;for(t>0&&(n=e);++a<i.length;){const t=i[a];s=s?s[t]:e[t],o===a&&(c(s)&&E(s)||Array.isArray(s)&&!s.filter(e=>c(e)&&!E(e)||ce(e)).length)&&(n?delete n[t]:delete e[t]),n=s}}return e}var pe=e=>"file"===e.type;const ve={value:!1,isValid:!1},je={value:!0,isValid:!0};var xe=e=>{if(Array.isArray(e)){if(e.length>1){const t=e.filter(e=>e&&e.checked&&!e.disabled).map(e=>e.value);return{value:t,isValid:!!t.length}}return e[0].checked&&!e[0].disabled?e[0].attributes&&!f(e[0].attributes.value)?f(e[0].value)||""===e[0].value?je:{value:e[0].value,isValid:!0}:je:ve}return ve},Fe=(e,{valueAsNumber:t,valueAsDate:r,setValueAs:s})=>f(e)?e:t?""===e?NaN:+e:r?new Date(e):s?s(e):e;const Oe={isValid:!1,value:null};var Ae=e=>Array.isArray(e)?e.reduce((e,t)=>t&&t.checked&&!t.disabled?{isValid:!0,value:t.value}:e,Oe):Oe;function we(e){const t=e.ref;if(!(e.refs?e.refs.every(e=>e.disabled):t.disabled))return pe(t)?t.files:de(t)?Ae(e.refs).value:le(t)?[...t.selectedOptions].map(({value:e})=>e):a(t)?xe(e.refs).value:Fe(f(t.value)?e.ref.value:t.value,e)}function Ve(e,t,r,s,a){let n=-1;for(;++n<e.length;){for(const s in e[n])Array.isArray(e[n][s])?(!r[n]&&(r[n]={}),r[n][s]=[],Ve(e[n][s],g(t[n]||{},s,[]),r[n][s],r[n],s)):!i(t)&&ie(g(t[n]||{},s),e[n][s])?I(r[n]||{},s):r[n]=Object.assign(Object.assign({},r[n]),{[s]:!0});s&&!r.length&&delete s[a]}return r}var Se=(e,t,r)=>function e(t,r){if(ne(t)||ne(r))return r;for(const s in r){const a=t[s],n=r[s];try{t[s]=c(a)&&c(n)||Array.isArray(a)&&Array.isArray(n)?e(a,n):n}catch(e){}}return t}(Ve(e,t,r.slice(0,e.length)),Ve(t,e,r.slice(0,e.length))),ke=(e,t)=>!d(g(e,t,[])).length&&_e(e,t),De=e=>fe(e)||s.isValidElement(e),Ce=e=>e instanceof RegExp;function Ee(e,t,r="validate"){if(De(e)||Array.isArray(e)&&e.every(De)||ce(e)&&!e)return{type:r,message:De(e)?e:"",ref:t}}var Be=e=>c(e)&&!Ce(e)?e:{value:e,message:""},Ue=async(e,t,r,s)=>{const{ref:n,refs:o,required:u,maxLength:l,minLength:d,min:f,max:g,pattern:m,validate:y,name:b,valueAsNumber:h,mount:_,disabled:p}=e._f;if(!_||p)return{};const v=o?o[0]:n,S=e=>{s&&v.reportValidity&&(v.setCustomValidity(ce(e)?"":e||" "),v.reportValidity())},k={},D=de(n),C=a(n),B=D||C,U=(h||pe(n))&&!n.value||""===t||Array.isArray(t)&&!t.length,T=W.bind(null,b,r,k),M=(e,t,r,s=F,a=O)=>{const i=e?t:r;k[b]=Object.assign({type:e?s:a,message:i,ref:n},T(e?s:a,i))};if(u&&(!B&&(U||i(t))||ce(t)&&!t||C&&!xe(o).isValid||D&&!Ae(o).isValid)){const{value:e,message:t}=De(u)?{value:!!u,message:u}:Be(u);if(e&&(k[b]=Object.assign({type:w,message:t,ref:v},T(w,t)),!r))return S(t),k}if(!(U||i(f)&&i(g))){let e,s;const a=Be(g),o=Be(f);if(isNaN(t)){const r=n.valueAsDate||new Date(t);fe(a.value)&&(e=r>new Date(a.value)),fe(o.value)&&(s=r<new Date(o.value))}else{const r=n.valueAsNumber||parseFloat(t);i(a.value)||(e=r>a.value),i(o.value)||(s=r<o.value)}if((e||s)&&(M(!!e,a.message,o.message,j,x),!r))return S(k[b].message),k}if((l||d)&&!U&&fe(t)){const e=Be(l),s=Be(d),a=!i(e.value)&&t.length>e.value,n=!i(s.value)&&t.length<s.value;if((a||n)&&(M(a,e.message,s.message),!r))return S(k[b].message),k}if(m&&!U&&fe(t)){const{value:e,message:s}=Be(m);if(Ce(e)&&!t.match(e)&&(k[b]=Object.assign({type:A,message:s,ref:n},T(A,s)),!r))return S(s),k}if(y)if(se(y)){const e=Ee(await y(t),v);if(e&&(k[b]=Object.assign(Object.assign({},e),T(V,e.message)),!r))return S(e.message),k}else if(c(y)){let e={};for(const s in y){if(!E(e)&&!r)break;const a=Ee(await y[s](t),v,s);a&&(e=Object.assign(Object.assign({},a),T(s,a.message)),S(a.message),r&&(k[b]=e))}if(!E(e)&&(k[b]=Object.assign({ref:v},e),!r))return k}return S(!0),k};const Te={mode:_,reValidateMode:h,shouldFocusError:!0},Me="undefined"==typeof window;function Ne(e={}){let t,r=Object.assign(Object.assign({},Te),e),s={isDirty:!1,isValidating:!1,dirtyFields:{},isSubmitted:!1,submitCount:0,touchedFields:{},isSubmitting:!1,isSubmitSuccessful:!1,isValid:!1,errors:{}},o={},c=r.defaultValues||{},y=r.shouldUnregister?{}:ae(c),b={action:!1,mount:!1,watch:!1},h={mount:new Set,unMount:new Set,array:new Set,watch:new Set},_=0,p={};const j={isDirty:!1,dirtyFields:!1,touchedFields:!1,isValidating:!1,isValid:!1,errors:!1},x={watch:new he,control:new he,array:new he,state:new he},F=oe(r.mode),O=oe(r.reValidateMode),A=r.criteriaMode===v,w=(e,t)=>!t&&(h.watchAll||h.watch.has(e)||h.watch.has((e.match(/\w+/)||[])[0])),V=async e=>{let t=!1;return j.isValid&&(t=r.resolver?E((await M()).errors):await N(o,!0),e||t===s.isValid||(s.isValid=t,x.state.next({isValid:t}))),t},k=(e,t)=>(I(s.errors,e,t),x.state.next({errors:s.errors})),D=(e,t,r)=>{const s=g(o,e);if(s){const a=g(y,e,g(c,e));f(a)||r&&r.defaultChecked||t?I(y,e,t?a:we(s._f)):W(e,a)}b.mount&&V()},C=(e,t,r,a=!0)=>{let n=!1;const i={name:e},o=g(s.touchedFields,e);if(j.isDirty){const e=s.isDirty;s.isDirty=i.isDirty=R(),n=e!==i.isDirty}if(j.dirtyFields&&!r){const r=g(s.dirtyFields,e);ie(g(c,e),t)?_e(s.dirtyFields,e):I(s.dirtyFields,e,!0),i.dirtyFields=s.dirtyFields,n=n||r!==g(s.dirtyFields,e)}return r&&!o&&(I(s.touchedFields,e,r),i.touchedFields=s.touchedFields,n=n||j.touchedFields&&o!==r),n&&a&&x.state.next(i),n?i:{}},B=(e,t)=>(I(s.dirtyFields,e,Se(t,g(c,e,[]),g(s.dirtyFields,e,[]))),ke(s.dirtyFields,e)),T=async(r,a,n,i,o)=>{const c=g(s.errors,a),u=j.isValid&&s.isValid!==n;var l,d;if(e.delayError&&i?(t=t||(l=k,d=e.delayError,(...e)=>{clearTimeout(_),_=window.setTimeout(()=>l(...e),d)}),t(a,i)):(clearTimeout(_),i?I(s.errors,a,i):_e(s.errors,a)),((i?!ie(c,i):c)||!E(o)||u)&&!r){const e=Object.assign(Object.assign(Object.assign({},o),u?{isValid:n}:{}),{errors:s.errors,name:a});s=Object.assign(Object.assign({},s),e),x.state.next(e)}p[a]--,j.isValidating&&!p[a]&&(x.state.next({isValidating:!1}),p={})},M=async e=>r.resolver?await r.resolver(Object.assign({},y),r.context,((e,t,r,s)=>{const a={};for(const r of e){const e=g(t,r);e&&I(a,r,e._f)}return{criteriaMode:r,names:[...e],fields:a,shouldUseNativeValidation:s}})(e||h.mount,o,r.criteriaMode,r.shouldUseNativeValidation)):{},N=async(e,t,a={valid:!0})=>{for(const n in e){const i=e[n];if(i){const e=i._f,n=S(i,"_f");if(e){const n=await Ue(i,g(y,e.name),A,r.shouldUseNativeValidation);if(n[e.name]&&(a.valid=!1,t))break;t||(n[e.name]?I(s.errors,e.name,n[e.name]):_e(s.errors,e.name))}n&&await N(n,t,a)}}return a.valid},R=(e,t)=>(e&&t&&I(y,e,t),!ie(z(),c)),L=(e,t,r)=>{const s=Object.assign({},b.mount?y:f(t)?c:fe(e)?{[e]:t}:t);if(e){const t=U(e).map(e=>(r&&h.watch.add(e),g(s,e)));return Array.isArray(e)?t:t[0]}return r&&(h.watchAll=!0),s},W=(e,t,r={},s)=>{const n=g(o,e);let c=t;if(n){const r=n._f;r&&(I(y,e,Fe(t,r)),c=ge&&ue(r.ref)&&i(t)?"":t,le(r.ref)?[...r.ref.options].forEach(e=>e.selected=c.includes(e.value)):r.refs?a(r.ref)?r.refs.length>1?r.refs.forEach(e=>e.checked=Array.isArray(c)?!!c.find(t=>t===e.value):c===e.value):r.refs[0].checked=!!c:r.refs.forEach(e=>e.checked=e.value===c):r.ref.value=c,s&&x.control.next({values:y,name:e}))}(r.shouldDirty||r.shouldTouch)&&C(e,c,r.shouldTouch),r.shouldValidate&&H(e)},P=(e,t,r)=>{for(const s in t){const a=t[s],i=`${e}.${s}`,c=g(o,i);!h.array.has(e)&&ne(a)&&(!c||c._f)||n(a)?W(i,a,r,!0):P(i,a,r)}},q=async e=>{const t=e.target;let n=t.name;const i=g(o,n);if(i){let l,d;const f=t.type?we(i._f):t.value,b=e.type===m,h=!((c=i._f).mount&&(c.required||c.min||c.max||c.maxLength||c.minLength||c.pattern||c.validate)||r.resolver||g(s.errors,n)||i._f.deps)||((e,t,r,s,a)=>!a.isOnAll&&(!r&&a.isOnTouch?!(t||e):(r?s.isOnBlur:a.isOnBlur)?!e:!(r?s.isOnChange:a.isOnChange)||e))(b,g(s.touchedFields,n),s.isSubmitted,O,F),_=w(n,b);b?i._f.onBlur&&i._f.onBlur(e):i._f.onChange&&i._f.onChange(e),I(y,n,f);const v=C(n,f,b,!1),S=!E(v)||_;if(!b&&x.watch.next({name:n,type:e.type}),h)return S&&x.state.next(Object.assign({name:n},_?{}:v));if(!b&&_&&x.state.next({}),p[n]=(p[n],1),j.isValidating&&x.state.next({isValidating:!0}),r.resolver){const{errors:e}=await M([n]);if(l=g(e,n),a(t)&&!l){const t=u(n),r=g(o,t);if(Array.isArray(r)&&r.every(e=>e._f&&a(e._f.ref))){const r=g(e,t,{});r.type&&(l=r),n=t}}d=E(e)}else l=(await Ue(i,g(y,n),A,r.shouldUseNativeValidation))[n],d=await V(!0);i._f.deps&&H(i._f.deps),T(!1,n,d,l,v)}var c},H=async(e,t={})=>{let a,n;const i=U(e);if(x.state.next({isValidating:!0}),r.resolver){const t=await(async e=>{const{errors:t}=await M();if(e)for(const r of e){const e=g(t,r);e?I(s.errors,r,e):_e(s.errors,r)}else s.errors=t;return t})(f(e)?e:i);a=E(t),n=e?!i.some(e=>g(t,e)):a}else e?(n=(await Promise.all(i.map(async e=>{const t=g(o,e);return await N(t&&t._f?{[e]:t}:t)}))).every(Boolean),V()):n=a=await N(o);return x.state.next(Object.assign(Object.assign({},fe(e)&&a===s.isValid?{name:e}:{}),{errors:s.errors,isValid:a,isValidating:!1})),t.shouldFocus&&!n&&$(o,e=>g(s.errors,e),e?i:h.mount),n},z=e=>{const t=Object.assign(Object.assign({},c),b.mount?y:{});return f(e)?t:fe(e)?g(t,e):e.map(e=>g(t,e))},G=(e,t={})=>{for(const a of e?U(e):h.mount)h.mount.delete(a),h.array.delete(a),g(o,a)&&(t.keepValue||(_e(o,a),_e(y,a)),!t.keepError&&_e(s.errors,a),!t.keepDirty&&_e(s.dirtyFields,a),!t.keepTouched&&_e(s.touchedFields,a),!r.shouldUnregister&&!t.keepDefaultValue&&_e(c,a));x.watch.next({}),x.state.next(Object.assign(Object.assign({},s),t.keepDirty?{isDirty:R()}:{})),!t.keepIsValid&&V()},J=(e,t={})=>{const s=g(o,e);return I(o,e,{_f:Object.assign(Object.assign(Object.assign({},s&&s._f?s._f:{ref:{name:e}}),{name:e,mount:!0}),t)}),h.mount.add(e),!f(t.value)&&I(y,e,t.value),s?ce(t.disabled)&&I(y,e,t.disabled?void 0:g(y,e,we(s._f))):D(e,!0),Me?{name:e}:Object.assign(Object.assign({name:e},ce(t.disabled)?{disabled:t.disabled}:{}),{onChange:q,onBlur:q,ref:s=>{if(s){J(e,t);let r=g(o,e);const n=f(s.value)&&s.querySelectorAll&&s.querySelectorAll("input,select,textarea")[0]||s,i=(e=>de(e)||a(e))(n);if(n===r._f.ref||i&&d(r._f.refs||[]).find(e=>e===n))return;r={_f:i?Object.assign(Object.assign({},r._f),{refs:[...d(r._f.refs||[]).filter(me),n],ref:{type:n.type,name:e}}):Object.assign(Object.assign({},r._f),{ref:n})},I(o,e,r),(!t||!t.disabled)&&D(e,!1,n)}else{const s=g(o,e,{}),a=r.shouldUnregister||t.shouldUnregister;s._f&&(s._f.mount=!1),a&&(!l(h.array,e)||!b.action)&&h.unMount.add(e)}}})};return{control:{register:J,unregister:G,_getWatch:L,_getDirty:R,_updateValid:V,_removeUnmounted:()=>{for(const e of h.unMount){const t=g(o,e);t&&(t._f.refs?t._f.refs.every(e=>!me(e)):!me(t._f.ref))&&G(e)}h.unMount=new Set},_updateFieldArray:(e,t,r,a=[],n=!0,i=!0)=>{if(b.action=!0,i&&g(o,e)){const s=t(g(o,e),r.argA,r.argB);n&&I(o,e,s)}if(Array.isArray(g(s.errors,e))){const a=t(g(s.errors,e),r.argA,r.argB);n&&I(s.errors,e,a),ke(s.errors,e)}if(j.touchedFields&&g(s.touchedFields,e)){const a=t(g(s.touchedFields,e),r.argA,r.argB);n&&I(s.touchedFields,e,a),ke(s.touchedFields,e)}(j.dirtyFields||j.isDirty)&&B(e,a),x.state.next({isDirty:R(e,a),dirtyFields:s.dirtyFields,errors:s.errors,isValid:s.isValid})},_getFieldArray:t=>g(b.mount?y:c,t,e.shouldUnregister?g(c,t,[]):[]),_subjects:x,_proxyFormState:j,get _fields(){return o},set _fields(e){o=e},get _formValues(){return y},set _formValues(e){y=e},get _stateFlags(){return b},set _stateFlags(e){b=e},get _defaultValues(){return c},set _defaultValues(e){c=e},get _names(){return h},set _names(e){h=e},get _formState(){return s},set _formState(e){s=e},get _options(){return r},set _options(e){r=Object.assign(Object.assign({},r),e)}},trigger:H,register:J,handleSubmit:(e,t)=>async a=>{a&&(a.preventDefault&&a.preventDefault(),a.persist&&a.persist());let n=!0,i=Object.assign({},y);x.state.next({isSubmitting:!0});try{if(r.resolver){const{errors:e,values:t}=await M();s.errors=e,i=t}else await N(o);E(s.errors)&&Object.keys(s.errors).every(e=>g(i,e))?(x.state.next({errors:{},isSubmitting:!0}),await e(i,a)):(t&&await t(s.errors,a),r.shouldFocusError&&$(o,e=>g(s.errors,e),h.mount))}catch(e){throw n=!1,e}finally{s.isSubmitted=!0,x.state.next({isSubmitted:!0,isSubmitting:!1,isSubmitSuccessful:E(s.errors)&&n,submitCount:s.submitCount+1,errors:s.errors})}},watch:(e,t)=>se(e)?x.watch.subscribe({next:r=>e(L(void 0,t),r)}):L(e,t,!0),setValue:(e,t,r={})=>{const a=g(o,e),n=h.array.has(e);I(y,e,t),n?(x.array.next({name:e,values:y}),(j.isDirty||j.dirtyFields)&&r.shouldDirty&&(B(e,t),x.state.next({name:e,dirtyFields:s.dirtyFields,isDirty:R(e,t)}))):!a||a._f||i(t)?W(e,t,r,!0):P(e,t,r),w(e)&&x.state.next({}),x.watch.next({name:e})},getValues:z,reset:(t,r={})=>{const a=!E(t),n=t||c,i=ae(n);if(r.keepDefaultValues||(c=n),!r.keepValues){if(ge)for(const e of h.mount){const t=g(o,e);if(t&&t._f){const e=Array.isArray(t._f.refs)?t._f.refs[0]:t._f.ref;try{ue(e)&&e.closest("form").reset();break}catch(e){}}}y=e.shouldUnregister?r.keepDefaultValues?c:{}:i,o={},x.control.next({values:a?i:c}),x.watch.next({}),x.array.next({values:i})}h={mount:new Set,unMount:new Set,array:new Set,watch:new Set,watchAll:!1,focus:""},x.state.next({submitCount:r.keepSubmitCount?s.submitCount:0,isDirty:r.keepDirty?s.isDirty:!!r.keepDefaultValues&&!ie(t,c),isSubmitted:!!r.keepIsSubmitted&&s.isSubmitted,dirtyFields:r.keepDirty?s.dirtyFields:r.keepDefaultValues&&t?Object.entries(t).reduce((e,[t,r])=>Object.assign(Object.assign({},e),{[t]:r!==g(c,t)}),{}):{},touchedFields:r.keepTouched?s.touchedFields:{},errors:r.keepErrors?s.errors:{},isSubmitting:!1,isSubmitSuccessful:!1}),b.mount=!j.isValid||!!r.keepIsValid,b.watch=!!e.shouldUnregister},clearErrors:e=>{e?U(e).forEach(e=>_e(s.errors,e)):s.errors={},x.state.next({errors:s.errors,isValid:!0})},unregister:G,setError:(e,t,r)=>{const a=(g(o,e,{_f:{}})._f||{}).ref;I(s.errors,e,Object.assign(Object.assign({},t),{ref:a})),x.state.next({name:e,errors:s.errors,isValid:!1}),r&&r.shouldFocus&&a&&a.focus&&a.focus()},setFocus:e=>{const t=g(o,e)._f;(t.ref.focus?t.ref:t.refs[0]).focus()}}}e.Controller=e=>e.render(L(e)),e.FormProvider=e=>s.createElement(k.Provider,{value:S(e,"children")},e.children),e.appendErrors=W,e.get=g,e.set=I,e.useController=L,e.useFieldArray=e=>{const t=D(),{control:r=t.control,name:a,keyName:n="id",shouldUnregister:i}=e,[o,c]=s.useState(J(r._getFieldArray(a),n)),u=s.useRef(o),l=s.useRef(a);l.current=a,u.current=o,r._names.array.add(a),N({callback:({values:e,name:t})=>{t!==l.current&&t||c(J(g(e,l.current),n))},subject:r._subjects.array,skipEarlySubscription:!0});const d=s.useCallback(e=>{const t=((e,t)=>e.map((e={})=>S(e,t)))(e,n);return I(r._formValues,a,t),c(e),t},[r,a,n]);return s.useEffect(()=>{if(r._stateFlags.action=!1,r._names.watchAll)r._subjects.state.next({});else for(const e of r._names.watch)if(a.startsWith(e)){r._subjects.state.next({});break}r._subjects.watch.next({name:a,values:r._formValues}),r._names.focus&&$(r._fields,e=>e.startsWith(r._names.focus)),r._names.focus="",r._proxyFormState.isValid&&r._updateValid()},[o,a,r,n]),s.useEffect(()=>(!g(r._formValues,a)&&I(r._formValues,a,[]),()=>{(r._options.shouldUnregister||i)&&r.unregister(a)}),[a,r,n,i]),{swap:s.useCallback((e,t)=>{const s=z(r._getFieldArray(a),u,n);te(s,e,t),r._updateFieldArray(a,te,{argA:e,argB:t},d(s),!1)},[d,a,r,n]),move:s.useCallback((e,t)=>{const s=z(r._getFieldArray(a),u,n);Y(s,e,t),r._updateFieldArray(a,Y,{argA:e,argB:t},d(s),!1)},[d,a,r,n]),prepend:s.useCallback((e,t)=>{const s=Z(z(r._getFieldArray(a),u,n),J(U(e),n));r._updateFieldArray(a,Z,{argA:Q(e)},d(s)),r._names.focus=H(a,0,t)},[d,a,r,n]),append:s.useCallback((e,t)=>{const s=U(e),i=K(z(r._getFieldArray(a),u,n),J(s,n));r._updateFieldArray(a,K,{argA:Q(e)},d(i)),r._names.focus=H(a,i.length-s.length,t)},[d,a,r,n]),remove:s.useCallback(e=>{const t=ee(z(r._getFieldArray(a),u,n),e);r._updateFieldArray(a,ee,{argA:e},d(t))},[d,a,r,n]),insert:s.useCallback((e,t,s)=>{const i=X(z(r._getFieldArray(a),u,n),e,J(U(t),n));r._updateFieldArray(a,X,{argA:e,argB:Q(t)},d(i)),r._names.focus=H(a,e,s)},[d,a,r,n]),update:s.useCallback((e,t)=>{const s=z(r._getFieldArray(a),u,n),i=re(s,e,t);u.current=J(i,n),r._updateFieldArray(a,re,{argA:e,argB:t},d(u.current),!0,!1)},[d,a,r,n]),replace:s.useCallback(e=>{const t=J(U(e),n);r._updateFieldArray(a,()=>t,{},d(t),!0,!1)},[d,a,r,n]),fields:o}},e.useForm=function(e={}){const t=s.useRef(),[r,a]=s.useState({isDirty:!1,isValidating:!1,dirtyFields:{},isSubmitted:!1,submitCount:0,touchedFields:{},isSubmitting:!1,isSubmitSuccessful:!1,isValid:!1,errors:{}});t.current?t.current.control._options=e:t.current=Object.assign(Object.assign({},Ne(e)),{formState:r});const n=t.current.control;return N({subject:n._subjects.state,callback:e=>{B(e,n._proxyFormState,!0)&&(n._formState=Object.assign(Object.assign({},n._formState),e),a(Object.assign({},n._formState)))}}),s.useEffect(()=>{n._stateFlags.mount||(n._proxyFormState.isValid&&n._updateValid(),n._stateFlags.mount=!0),n._stateFlags.watch&&(n._stateFlags.watch=!1,n._subjects.state.next({})),n._removeUnmounted()}),t.current.formState=C(r,n._proxyFormState),t.current},e.useFormContext=D,e.useFormState=R,e.useWatch=function(e){const t=D(),{control:r=t.control,name:a,defaultValue:n,disabled:i}=e||{},o=s.useRef(a);o.current=a,N({disabled:i,subject:r._subjects.watch,callback:e=>{if(T(o.current,e.name)){r._stateFlags.mount=!0;const e=r._getWatch(o.current,n);l(c(e)?Object.assign({},e):Array.isArray(e)?[...e]:e)}}});const[u,l]=s.useState(f(n)?r._getWatch(a):n);return s.useEffect(()=>{r._removeUnmounted()}),u},Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=index.umd.js.map
