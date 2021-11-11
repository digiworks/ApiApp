
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/react-table/6.11.5/react-table.css" />
    <!--  <link rel="stylesheet" href="https://unpkg.com/@douyinfe/semi-ui@2.0.0/dist/css/semi.css"/> -->
    
    <script src="/js/boot.js"></script>
    <script src="/js/engines/react/date-fns/1.30.1/date_fns.js"></script>
    <script src="/js/engines/react/17.0.2/umd/react.development.js"></script>
    <script src="/js/engines/react/react-dom/17.0.2/umd/react-dom.development.min.js"></script>
    <script src="/js/engines/react/babel/6.26.0/babel.js"></script>
    
    <script src="/js/engines/react/lib/validator@1.0.0/form-validator.js"></script>
    <script src="/js/engines/react/lib/validator@1.0.0/locale/it.js"></script>
    
    <script src="/js/engines/react/i18next@21.4.0/dist/umd/i18next.js"></script>
    <script src="/js/engines/react/react-i18next@11.13.0/react-i18next.js"></script>
    
    <script src="/js/core.js"></script>
    
    <!-- Material-Ui -->
    <!-- <script src="https://unpkg.com/@mui/material@5.0.4/umd/material-ui.development.js"></script> -->
    <script src="/js/engines/react/material@5.0.6/umd/material-ui.development.js"></script>
    <script src="/js/engines/react/mui.js"></script>
     
    <!-- Semi-Ui -->                   
    <!-- min: <script src="https://unpkg.com/@douyinfe/semi-ui@2.0.0/dist/umd/semi-ui-react.min.js"></script> -->
    <!-- normal: <script src="https://unpkg.com/@douyinfe/semi-ui@2.0.0/dist/umd/semi-ui-react.js"></script> -->
    <!-- <script src="/js/engines/react/semiui.js"></script> -->
    
    <!-- DatePicker and dependencies-->
    <script src="https://cdn.jsdelivr.net/npm/date-object@latest/dist/umd/date-object.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-element-popper@latest/build/browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-multi-date-picker@latest/build/browser.min.js"></script>

    <!-- Optional Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/react-multi-date-picker@latest/build/date_picker_header.browser.js"></script>
    <script src="js/engines/react/reactmultidatepicker.js"></script>
    
    <script type="text/babel" src="js/engines/react/components.js"></script>

    
</head>

<body>
<div id="root">%s</div>
<script  type="text/babel">
    %s
</script>
</body>
<script  type="text/babel">
    function init(){
        ReactDOM.hydrate(
          <App />,
          document.getElementById("root")
        );
    }
    init();
</script>
</html>