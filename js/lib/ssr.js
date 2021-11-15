
<html>
<head>
    {{stylesheets}}
    
    {{imports}}
</head>

<body>
<div id="root">{{serverside}}</div>
<script  type="text/babel">
    {{javascript}}
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